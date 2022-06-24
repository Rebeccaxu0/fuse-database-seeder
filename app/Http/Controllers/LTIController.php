<?php

namespace App\Http\Controllers;

use App\LTI\Database;
use Illuminate\Http\Request;
use Packback\Lti1p3\LtiMessageLaunch;
use Packback\Lti1p3\LtiOidcLogin;

class LTIController extends Controller
{
    public function login(Request $request)
    {
        $login = LtiOidcLogin::new(new Database);
        try {
            $redirect = $login->doOidcLoginRedirect(route('lti.launch'));
        }
        catch (Packback\Lti1p3\OidException $e) {
            // handle the error?
        }
        return redirect($redirect->getRedirectUrl());
    }

    public function launch(Request $request)
    {
        $launch = LtiMessageLaunch::new(new Database);
        if ($launch->isResourceLaunch()) {
            echo 'Resource Launch!';
        } else if ($launch->isDeepLinkLaunch()) {
            echo 'Deep Linking Launch!';
        } else {
            echo 'Unknown launch type';
        }
        if ($launch->hasAgs()) {
            echo 'Has Assignments and Grades Service';
        }
        if ($launch->hasNrps()) {
            echo 'Has Names and Roles Service';
        }
        return;

        // Old Drupal Code
        /**
         * Given a user email and a challenge id, check if the email and challenge
         * exists and if the user is eligible for the challenge. Then log the user in
         * and redirect them to the highest unlocked level page of the challenge.
         */
        // Create a launch object and validate.
        try {
            $launch = LTI\LTI_Message_Launch::new(new LTI_Config_Database())
                ->validate();
        }
        catch (IMSGlobal\LTI\LTI_EXCEPTION $e) {
            drupal_set_message('Bad LTI configuration provided: ' . $e->getMessage(), 'error');
            return t('ERROR');
        }

        $launch_data = $launch->get_launch_data();

        // Get email and challenge id from the launch data.
        $mail = trim($launch_data['email']);
        $cid = $launch_data['https://purl.imsglobal.org/spec/lti/claim/resource_link']['id'];
        $iss = $launch_data['iss'];
        // $ags_endpoint = $launch->get_launch_data()['https://purl.imsglobal.org/spec/lti-ags/claim/endpoint'];
        // Check user exists.
        if (empty($mail)) {
            drupal_set_message('No email address provided', 'error');
            return t('ERROR');
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            drupal_set_message('Bad email address ("' . htmlspecialchars($mail) . '") provided', 'error');
            return t('ERROR');
        }
        $user = user_load_by_mail($mail);
        if (!$user) {
            // Get platform entity.
            $platforms_q = db_select('l3_platform', 'p')
                ->fields('p')
                ->condition('domain', $iss)
                ->range(0, 1)
                ->execute();
            $platform = $platforms_q->fetchObject();
            // Only add user if the platform is associated with a single studio.
            if ($platform) {
                $platform_studios = array_keys(fuse_l3_api_get_platform_studio_affiliation($platform->id));
                if (count($platform_studios) === 1) {
                    // Create the user and add them to the default studio.
                    $user = fuse_l3_api_create_new_user($mail, $platform_studios[0]);
                }
                else {
                    drupal_set_message(t("Sorry, we don't know what studio you belong to. Please ask your facilitator for help."), 'error');
                    drupal_goto('lti-error', [], 307);
                }
            }
            else {
                drupal_set_message(t("Sorry, you don't have a FUSE account, and we can't make one right now. Please ask your facilitator for help."), 'error');
                drupal_goto('lti-error', [], 307);
            }
        }
        // Find a studio to set the current location to.
        $current_studio_nid = _fuse_l3_api_get_current_studio($iss, $cid, $user->uid);
        // Check user has access to the challenge.
        $message = fuse_util_get_challenge_prerequisite_message($cid, $user->uid);

        if ($message) {
            drupal_set_message($message, 'error');
            drupal_goto('dashboard', [], 307);
        }
        // Setting login parameters.
        $form_state = [];
        $form_state['uid'] = $user->uid;
        // Set the challenge id.
        $form_state['LTI_cid'] = $cid;
        $form_state['LTI_sid'] = $current_studio_nid;
        // Log the user in and redirect to challenge page.
        user_login_submit([], $form_state);
        drupal_goto();
    }
    /**
     * Find the current studio and challenge for the user from the launch data.
     *
     * @param string $iss
     *   Domain of the launching platform.
     * @param int $cid
     *   Challenge ID.
     * @param int $uid
     *   User ID.
     *
     * @return int|NULL
     *   Studio NID or NULL.
     */
    function _fuse_l3_api_get_current_studio($iss, $cid, $uid) {
        // Get platform entity.
        $platforms_q = db_select('l3_platform', 'p')
            ->fields('p')
            ->condition('domain', $iss)
            ->range(0, 1)
            ->execute();
        $platform = $platforms_q->fetchObject();
        if (!$platform){
            drupal_set_message(t('The site you are redirected from does not exist in our system.'), 'error');
            drupal_not_found();
        }
        // Get platform studio affiliations.
        $platform_studios = array_keys(fuse_l3_api_get_platform_studio_affiliation($platform->id));
        $platform_orgs = array_keys(fuse_l3_api_get_platform_organization_affiliation($platform->id));
        foreach ($platform_orgs as $org) {
            $org_studios = fuse_util_get_studios_in_org($org);
            if ($org_studios) {
                $platform_studios = array_merge($platform_studios, $org_studios);
            }
        }
        $platform_studios = array_unique($platform_studios);

        if (!$platform_studios) {
            drupal_set_message(t('The site you came from is not affiliated with any studio.'), 'error');
            drupal_not_found();
        }
        // Get user studio affiliations.
        $user_studios = fuse_util_get_users_studios($uid);
        if (!$user_studios) {
            drupal_set_message(t('You do not have any studio affiliation.'), 'error');
            drupal_not_found();
        }
        // Get common studios between platform and user.
        $common_studios = array_intersect($platform_studios, $user_studios);
        if (!$common_studios) {
            // TODO: Add flag to LTI platform to allow for new user creation. Will
            // require a default studio per platform.
            if (count($platform_studios) == 1) {
                fuse_util_add_student_action($uid, $platform_studios[0]);
            }
            else {
                drupal_set_message(t('You are not a member of an EL3 studio. Please talk to your facilitator or teacher.'), 'error');
                drupal_not_found();
            }
        }
        $current_studio = entity_metadata_wrapper('user', $uid)->field_current_location;
        if ($current_studio) {
            $current_studio_nid = $current_studio->getIdentifier();
            $idx = array_search($current_studio_nid, $common_studios);
            // Move the current studio to beginning of the common studio array.
            if ($idx != 0) {
                unset($common_studios[$idx]);
                array_unshift($common_studios, $current_studio_nid);
            }
        }
        // Check challenge exists.
        $challenge = entity_metadata_wrapper('node', intval($cid));
        $entity_type = $challenge->getBundle();
        if ($entity_type != 'challenge') {
            drupal_set_message(t('The challenge you are trying to launch does not exist.'), 'error');
            drupal_not_found();
        }
        $current_studio_nid = NULL;
        // Check common studio challenges against versioned challenge.
        foreach ($common_studios as $studio_nid) {
            $studio_entity = entity_metadata_wrapper('node', $studio_nid);
            $studio_challenges = array_column($studio_entity->field_challenge->value(), 'nid');
            // Challenge is enabled in the studio.
            if (in_array($cid, $studio_challenges)) {
                $current_studio_nid = $studio_nid;
                break;
            }
        }
        if (is_null($current_studio_nid)) {
            drupal_set_message(t('The challenge you are trying to launch may not be available in this studio.'), 'error');
        }
        return $current_studio_nid;
    }

    /**
     * Get challenge versions.
     *
     * @param int $generic_challenge_id
     *   Main challenge id.
     *
     * @return Array
     *   Array of challenge versions.
     */
    function fuse_l3_api_get_challenge_versions($generic_challenge_id) {
        // Get a list of specific challenges for the generic challenge.
        $query = db_select('field_data_field_version_of', 'c');
        $query->fields('c', array('entity_id'));
        $query->condition('c.field_version_of_target_id', $generic_challenge_id);
        $query->condition('c.entity_type', 'node');
        $query->condition('c.bundle', 'challenge');

        $challenge_results = $query->execute();
        $challenges = [];
        foreach ($challenge_results as $challenge) {
            $challenges[] = $challenge->entity_id;
        }
        return $challenges;
    }

    /**
     * Get the highest unlocked level id in a challenge for a user.
     *
     * @param int $challenge_id
     *   Challenge id.
     *
     * @param int $uid
     *   User ID.
     *
     * @return int
     *   Highest unlocked level NID in the challenge.
     */
    function fuse_l3_api_challenge_current_level($challenge_id, $uid) {
        $challenge = entity_metadata_wrapper('node', $challenge_id);
        $levels = $challenge->field_child_levels->getIterator();
        $unlocked_level_nid = NULL;
        foreach ($levels as $i => $level) {
            if (_fuse_level_level_is_unlocked($level->nid->value(), $uid)){
                $unlocked_level_nid = $level->nid->value();
            }
        }
        return $unlocked_level_nid;
    }

    /**
     * Post Level Start, Save and Complete activity back to the platform.
     *
     * @param object $user
     *   User object.
     *
     * @param object $level
     *   Level node.
     *
     * @param string $type
     *   Activity type.
     *
     * @param object $attachment
     *   Attachment object.
     */
    function _fuse_l3_api_post_activity($user, $level, $type, $attachment) {
        watchdog('fuse_l3_api', 'call to _fuse_l3_api_post_activity - User @userid, @level, @type,', ['@userid' => $user->uid, '@level' => $level->title, '@type' => $type], WATCHDOG_DEBUG);
        $db = new LTI_Config_Database();
        // Prepare the score and lineitem to post to platforms.
        $score = LTI\LTI_Grade::new()
            ->set_score_given(0)
            ->set_score_maximum(0)
            ->set_timestamp(date(DateTime::ISO8601))
            ->set_activity_progress($type)
            ->set_grading_progress('NA')
            ->set_user_id($user->mail);

        // Add attachment if available.
        if ($attachment) {
            $score = $score->add_attachment($attachment);
        }

        $score_lineitem = LTI\LTI_Lineitem::new()
            ->set_tag($level->nid)
            ->set_score_maximum(100)
            ->set_resource_id($level->field_challenge['und'][0]['nid'])
            ->set_label($level->title);

        $platforms = fuse_l3_api_user_studio_platform_affiliation($user->uid);
        if ($platforms) {
            watchdog('fuse_l3_api', 'Trying to report to platforms - @platforms', ['@platforms' => print_r($platforms, 1)], WATCHDOG_DEBUG);
            $platform_entities = entity_load('l3_platform', $platforms);
            foreach ($platform_entities as $platform_entity) {
                watchdog('fuse_l3_api', 'Trying to report to platform @entity', ['@entity' => $platform_entity->id], WATCHDOG_DEBUG);
                $registration = $db->find_registration_by_issuer($platform_entity->domain);
                $service_data = array('lineitems' => $platform_entity->lineitems,
                    'scope' => json_decode($platform_entity->scope));
                // Create Assignment and Grade service.
                $assignment_grade_service = new LTI\LTI_Assignments_Grades_Service(new LTI\LTI_Service_Connector($registration), $service_data);
                // Post to platform.
                $resp = $assignment_grade_service->put_grade($score, $score_lineitem);
                // Log platform response.
                watchdog('fuse_l3_api', 'Platform response @platform_response',
                    ['@platform_response' => print_r($resp, 1)], WATCHDOG_INFO);
            }
        }
    }

    /**
     * Post user studio affiliation to the platform.
     */
    function fuse_l3_api_post_campaign_data() {
        global $user;
        $platforms = fuse_l3_api_user_studio_platform_affiliation($user->uid);
        if ($platforms) {
            $platform_entities = entity_load('l3_platform', array_keys($platforms));
            foreach ($platform_entities as $platform_entity) {
                $platform_id = $platform_entity->id;
                $api_token = $platform_entity->api_token;
                $api_secret = $platform_entity->api_secret;
                $api_endpoint = $platform_entity->api_endpoint;

                $user_to_invite = ['email' => $user->mail,
                    'metadata' => ['studios' => $platforms[$platform_id]]
                ];
                $data_to_post = ['payload' => ['users' => [$user_to_invite]],
                    'exp' => time() + 30*60,
                    'version' =>'V1',
                    'sub' => 'campaigns'];
                $jwt = JWT::encode($data_to_post, $api_secret);
                $data = ['jwt' => $jwt];
                $headers = [];
                $headers[] = "Authorization: JWT token=".$api_token;
                $response = WWW::post_with_headers($api_endpoint, $data, $headers);
                // Log platform response.
                watchdog('fuse_l3_api', 'Platform response for campaign update @platform_response',
                    ['@platform_response' => print_r($response, TRUE)], WATCHDOG_INFO);
            }
        }
    }

    /**
     * Implements hook_fuse_student_activity().
     */
    function fuse_l3_api_fuse_student_activity($uid, $type, $details, $timestamp) {
        $account = user_load($uid);
        $activity_type = [
            'start_level' => 'Started',
            'save_level' => 'Submitted',
            'completed_level' => 'Completed'
        ];
        // Only process level start, save and complete.
        if (in_array($type, ['start_level', 'save_level', 'completed_level'])) {
            $user = user_load($uid);
            $level = node_load($details['lid']);
            $url = NULL;
            $attachment = NULL;
            // For level save and complete, get the artifacts.
            if ($type == 'save_level' || $type == 'completed_level') {
                $completion_proof_nid = $details['artifact_nid'];
                $artifact = node_load($details['artifact_nid']);
                $artifact_info = fuse_artifact_util_artifact_get_file_info($artifact);
                $mime_type = $artifact_info['mime'];
                // Get the artifact url based on the type of upload
                // if user typed in upload code.
                if ($artifact->field_student_upload) {
                    $uri = $artifact->field_student_upload['und'][0]['uri'];
                    if (substr($uri, 0, 5) == 's3://') {
                        $path = substr($uri, 5);
                        $url = Filestack::storageAlias($path);
                    }
                }
                // If user uploaded a file on the filestack widget.
                elseif ($artifact->field_filestack) {
                    $target_id = $artifact->field_filestack['und'][0]['target_id'];
                    $filestack_entities = entity_load('filestack', [$target_id]);
                    $url = $filestack_entities[$target_id]->filestack_url;
                }
                // If user typed in an external url.
                elseif ($artifact->field_url) {
                    $url = $artifact->field_url['und'][0]['url'];
                }

                $attachment = LTI\LTI_Attachment::new()
                    ->set_id($artifact->nid)
                    ->set_attachment_type("media")
                    ->set_content($artifact->title)
                    ->set_url_mediaType($mime_type)
                    ->set_is_private(FALSE)
                    ->set_url_type("Url")
                    ->set_url_href($url);
            }
            // Post the activity and the artifact url back to the platform.
            _fuse_l3_api_post_activity($user, $level, $activity_type[$type], $attachment);
        }
    }

    /*
     * During platform launch, create a new student account if one does not exist.
     */
    function fuse_l3_api_create_new_user($email, $studio_nid) {
        if (empty($email)) return false;
        $new_user = array(
            'name' => $email,
            //'field_full_name' => $email, //leave name blank
            //'pass' => user_password(),   //leave password blank
            'mail' => $email,
            'status' => 1,
            'language' => 'en',
            'timezone' => 'America/Chicago',
            'init' => $email,
            'roles' => array(
                2 => 'authenticated user',
                7 => 'student'
            ),

        );
        $user = user_save(NULL, $new_user);
        fuse_util_add_student_action($user->uid, $studio_nid);
        return $user;
    }

    /**
     * Implements hook_form().
     * Platform form.
     */
    function fuse_l3_api_platform_form($form, &$form_state) {
        $form['id'] = [
            '#type' => 'hidden',
            '#title' => t('Platform ID'),
            '#size' => 10,
            '#maxlength' => 10,
            '#required' => FALSE,
        ];
        $form['domain'] = [
            '#type' => 'textfield',
            '#title' => t('Platform domain'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => TRUE,
            '#description' => '<i>e.g. l3.digitalyouthnetwork.org</i>'
        ];
        $form['client_id'] = [
            '#type' => 'textfield',
            '#title' => t('Client ID'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => TRUE,
            '#description' => '<i>eg. l3test </i>'
        ];
        $form['auth_login_url'] = [
            '#type' => 'textfield',
            '#title' => t('Authentication Login URL'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => TRUE,
            '#description' => '<i>e.g. https://qa.cityoflearning.me/lti-auth</i>'
        ];
        $form['auth_token_url'] = [
            '#type' => 'textfield',
            '#title' => t('Authentication Token URL'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => TRUE,
            '#description' => '<i>e.g. http://evanston.col-engine-qa.com/api/v1/lti_tool_providers/2/auth.json</i>'
        ];

        $form['key_set_url'] = [
            '#type' => 'textfield',
            '#title' => t('Key Set URL'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => TRUE,
            '#description' => '<i>e.g. https://qa.cityoflearning.me/packages/l3lti/assets/jwks.json</i>'
        ];
        $form['private_key'] = [
            '#type' => 'textarea',
            '#title' => t('Private key'),
            '#size' => 2048,
            '#maxlength' => 2048,
            '#required' => TRUE,
            '#description' => '<i>Contents of RSA private key file</i>'
        ];
        $form['deployment'] = [
            '#type' => 'textfield',
            '#title' => t('Deployment string in json '),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => TRUE,
            '#description' => '<i>e.g. {"1234" : "1234"}</i>'
        ];
        $form['lineitems'] = [
            '#type' => 'textfield',
            '#title' => t('Line items URL'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => TRUE,
            '#description' => '<i>e.g. http://evanston.col-engine-qa.com/api/v1/lti_line_items</i>'
        ];
        $scope_desc_html =<<<HTML
<i>e.g. ['https://purl.imsglobal.org/spec/lti-ags/scope/lineitem',
'https://purl.imsglobal.org/spec/lti-ags/scope/result.readonly',
'https://purl.imsglobal.org/spec/lti-ags/scope/score']</i>
HTML;
        $form['scope'] = [
            '#type' => 'textfield',
            '#title' => t('Scope URLs'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => TRUE,
            '#description' => $scope_desc_html,
        ];
        $form['api_token'] = [
            '#type' => 'textfield',
            '#title' => t('API Token'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => FALSE,
            '#description' => ''
        ];
        $form['api_secret'] = [
            '#type' => 'textfield',
            '#title' => t('API Secret'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => FALSE,
            '#description' => ''
        ];
        $form['api_endpoint'] = [
            '#type' => 'textfield',
            '#title' => t('API Endpoint'),
            '#size' => 60,
            '#maxlength' => 255,
            '#required' => FALSE,
            '#description' => ''
        ];
        $form['save'] = [
            '#type' => 'submit',
            '#value' => t('Save'),
            '#submit' => ['fuse_l3_api_platform_submit'],
        ];
        return $form;
    }

    /**
     * Submit handler for a new platform.
     *
     * @param object $form
     *   Form object.
     *
     * @param object $form_state
     *   Form_state object.
     */
    function fuse_l3_api_platform_submit($form, &$form_state) {
        // Insert into l3_platform schema.
        db_insert('l3_platform')
            ->fields([
                'domain' => $form_state['values']['domain'],
                'client_id' => $form_state['values']['client_id'],
                'auth_login_url' => $form_state['values']['auth_login_url'],
                'auth_token_url' => $form_state['values']['auth_token_url'],
                'key_set_url' => $form_state['values']['key_set_url'],
                'private_key' => $form_state['values']['private_key'],
                'deployment' => $form_state['values']['deployment'],
                'lineitems' => $form_state['values']['lineitems'],
                'scope' => $form_state['values']['scope'],
                'api_token' => $form_state['values']['api_token'],
                'api_secret' => $form_state['values']['api_secret'],
                'api_endpoint' => $form_state['values']['api_endpoint'],
            ])->execute();
        // Redirect to platform list page.
        drupal_goto('/admin/config/fuse/lti-platforms');
    }

    /**
     * List of platforms.
     *
     * @param object $form
     *   Form object.
     *
     * @param object $form_state
     *   Form_state object.
     *
     * @return form
     *   Form object with platform details populated.
     */
    function fuse_l3_api_platforms($form, &$form_state) {

        $form['platforms'] = [
            '#type' => 'container',
            '#attributes' => ['id' => 'platform_list'],
        ];
        $form['platforms']['add platform'] = [
            '#type' => 'link',
            '#title' => t('ADD PLATFORM'),
            '#href' => '/lti-platform/add/',
            '#options' => ['attributes' => ['class' => ['btn', 'fuse-btn', 'sms-button']]],
        ];

        // Table Header.
        $header = [t('Domain'), t('Client ID'), t('Auth Login URL'), t('Auth Token URL'),
            t('Key Set URL'), t('Private Key'), t('Deployment'), t('Lineitems'),
            t('Scope'), t('Affiliated Studios'), t('API Token'),
            t('API Secret'), t('API Endpoint')];
        $form['platforms']['list'] = [
            '#theme' => 'table',
            '#header' => $header,
            '#empty' => t('No Platforms'),
        ];
        // Get all LTI Platforms from the db.
        $platform_results = db_select('l3_platform', 'p')
            ->fields('p')
            ->execute();

        // List platforms with edit links.
        if (!empty($platform_results)) {
            foreach ($platform_results as $platform) {
                $affiliated_studios = fuse_l3_api_get_platform_studio_affiliation($platform->id);
                $affiliated_orgs = fuse_l3_api_get_platform_organization_affiliation($platform->id);
                $form['platforms']['list']['#rows'][] = [
                    $platform->domain . '<br><br>' . l(t('Edit'), "/lti-platform/{$platform->id}/edit") .
                    '&nbsp;&nbsp;&nbsp;' . l(t('Delete'), "/lti-platform/{$platform->id}/delete", ['attributes' => ['class' => 'delete_platform']]),
                    $platform->client_id,
                    $platform->auth_login_url,
                    $platform->auth_token_url,
                    $platform->key_set_url,
                    substr($platform->private_key, 0, 30),
                    $platform->deployment,
                    $platform->lineitems,
                    $platform->scope,
                    implode(', ', array_merge($affiliated_studios, $affiliated_orgs)),
                    $platform->api_token,
                    $platform->api_secret,
                    $platform->api_endpoint,
                ];
            }
        }
        drupal_add_js(drupal_get_path('module', 'fuse_l3_api') . "/js/fuse_l3_api.js");
        return $form;
    }

    /**
     * Edit an existing platform.
     *
     * @param object $form
     *   Form object.
     *
     * @param object $form_state
     *   Form_state object.
     *
     * @param int $platform_id
     *   Platform ID.
     *
     * @return form
     *   Form object with platform details populated.
     */
    function fuse_l3_api_edit_platform($form, &$form_state, $platform_id) {
        // Get platform details.
        $platforms_q = db_select('l3_platform', 'p')
            ->fields('p')
            ->condition('id', $platform_id)
            ->range(0, 1)
            ->execute();
        $platform = $platforms_q->fetchObject();
        // Populate the form with platform details.
        $form = fuse_l3_api_platform_form($form, $form_state);
        $form['header'] = [
            '#markup' => "<h1>Edit {$platform->domain}</h1>",
            '#weight' => -1,
        ];
        $form['id']['#default_value'] = $platform->id;
        $form['domain']['#default_value'] = $platform->domain;
        $form['client_id']['#default_value'] = $platform->client_id;
        $form['auth_login_url']['#default_value'] = $platform->auth_login_url;
        $form['auth_token_url']['#default_value'] = $platform->auth_token_url;
        $form['key_set_url']['#default_value'] = $platform->key_set_url;
        $form['private_key']['#default_value'] = $platform->private_key;
        $form['deployment']['#default_value'] = $platform->deployment;
        $form['lineitems']['#default_value'] = $platform->lineitems;
        $form['scope']['#default_value'] = $platform->scope;
        $form['api_token']['#default_value'] = $platform->api_token;
        $form['api_secret']['#default_value'] = $platform->api_secret;
        $form['api_endpoint']['#default_value'] = $platform->api_endpoint;
        // Set the form submit handler.
        $form['save'] = [
            '#type' => 'submit',
            '#value' => t('Save'),
            '#submit' => ['fuse_l3_api_edit_platform_submit'],
        ];
        return $form;
    }

    /**
     * Submit handler for an edited platform.
     *
     * @param object $form
     *   Form object.
     *
     * @param object $form_state
     *   Form_state object.
     */
    function fuse_l3_api_edit_platform_submit($form, &$form_state) {
        // Update the platform entity.
        db_update('l3_platform')
            ->fields([
                'domain' => $form_state['values']['domain'],
                'client_id' => $form_state['values']['client_id'],
                'auth_login_url' => $form_state['values']['auth_login_url'],
                'auth_token_url' => $form_state['values']['auth_token_url'],
                'key_set_url' => $form_state['values']['key_set_url'],
                'private_key' => $form_state['values']['private_key'],
                'deployment' => $form_state['values']['deployment'],
                'lineitems' => $form_state['values']['lineitems'],
                'scope' => $form_state['values']['scope'],
                'api_token' => $form_state['values']['api_token'],
                'api_secret' => $form_state['values']['api_secret'],
                'api_endpoint' => $form_state['values']['api_endpoint'],
            ])
            ->condition('id', $form_state['values']['id'])
            ->execute();
        // Redirect to platforms page.
        drupal_goto('/admin/config/fuse/lti-platforms');
    }

    /**
     * Delete a platform.
     *
     * @param int $platform_id
     *   Platform ID.
     */
    function fuse_l3_api_delete_platform($platform_id) {
        $num_deleted = db_delete('l3_platform')
            ->condition('id', $platform_id)
            ->execute();
        drupal_set_message("Platform with id {$platform_id} deleted");
        //redirect to platform list page
        drupal_goto('/admin/config/fuse/lti-platforms');
    }

    /**
     * Create an entity for the LTI Platform schema.
     */
    function fuse_l3_api_entity_info() {
        return [
            'l3_platform' => [
                'label' => t('LTI Platform'),
                'base table' => 'l3_platform',
                'entity keys' => ['id' => 'id'],
                'label callback' => 'fuse_l3_api_platform_entity_class_label',
                'access callback' => 'fuse_l3_api_entity_access',
            ],
        ];
    }

    /**
     * l3_platform entity access callback.
     *
     * @param string $arg
     *   Arg.
     *
     * @return bool
     *   True if $arg == 'view', False otherwise.
     */
    function fuse_l3_api_entity_access($arg) {
        if ($arg == 'view'){
            return TRUE;
        }
        return FALSE;
    }

    /**
     * l3_platform entity label callback.
     *
     * @param object $entity
     *   Platform entity.
     *
     * @return string
     *   Platform domain.
     */
    function fuse_l3_api_platform_entity_class_label($entity) {
        return $entity->domain;
    }

    /**
     * Get a list of studio affiliation for the given platform.
     *
     * @param int $platform_id
     *   Platform ID.
     *
     * @return Array
     *   Array of studios.
     */
    function fuse_l3_api_get_platform_studio_affiliation($platform_id) {
        $studios = &drupal_static(__FUNCTION__ . $platform_id);
        if (!isset($studios)) {
            $studios = NULL;
            if ($cache = cache_get('platform_studios_for_' . $platform_id, 'cache_fuse')) {
                $studios = $cache->data;
            }
            else {
                // DB look up of platform studio mapping.
                $query = db_select('node', 'n');
                $query->condition('n.type', 'space', '=');
                $query->join('field_data_field_l3_platforms', 'p', 'n.nid = p.entity_id');
                $query->condition('p.field_l3_platforms_target_id', $platform_id, '=');
                $query->condition('p.entity_type', 'node', '=');
                $query->condition('p.bundle', 'space', '=');
                $query->fields('n', array('nid', 'title'));
                $studio_results = $query->execute();
                $studios = [];
                foreach ($studio_results as $studio) {
                    $studios[$studio->nid] = $studio->title .' ('. $studio->nid .')';
                }
                cache_set('platform_studios_for_' . $platform_id, $studios, 'cache_fuse');
            }
        }
        return $studios;
    }

    /**
     * Get a list of organization affiliation for the given platform.
     *
     * @param int $platform_id
     *   Platform ID.
     *
     * @return Array
     *   Array of organizations.
     */
    function fuse_l3_api_get_platform_organization_affiliation($platform_id) {
        $orgs = &drupal_static(__FUNCTION__ . $platform_id);
        if (!isset($orgs)) {
            $orgs = NULL;
            if ($cache = cache_get('platform_orgs_for_' . $platform_id, 'cache_fuse')) {
                $orgs = $cache->data;
            }
            else {
                $query = db_select('node', 'n');
                $query->condition('n.type','organization', '=');
                $query->join('field_data_field_l3_platforms', 'p', 'n.nid = p.entity_id');
                $query->condition('p.field_l3_platforms_target_id', $platform_id, '=');
                $query->condition('p.entity_type', 'node', '=');
                $query->condition('p.bundle', 'organization', '=');
                $query->fields('n', array('nid', 'title'));
                $org_results = $query->execute();
                $orgs = [];
                foreach ($org_results as $org) {
                    $orgs[$org->nid] = $org->title .' ('. $org->nid .')';
                }
                cache_set('platform_orgs_for_' . $platform_id, $orgs, 'cache_fuse');
            }
        }
        return $orgs;
    }

    /**
     * For the given user, create a platform studios mapping.
     *
     * @param int $uid
     *   User ID.
     *
     * @return Array
     *   Array of platforms.
     */
    function fuse_l3_api_user_studio_platform_affiliation($uid) {
        $account = user_load($uid);
        // Get all studio affiliation of the user.
        $studios = fuse_util_get_users_studios($uid);
        $platforms = [];
        // For each studio, get mapped platforms.
        foreach ($studios as $studio_nid){
            $studio_platforms = fuse_l3_api_build_platform_studio_mapping($studio_nid);
            $platforms = array_merge($platforms, $studio_platforms);
        }
        return array_unique($platforms);
    }

    /**
     * For the given studio, create a platform studios mapping.
     *
     * @param object $studio
     *   Studio object.
     *
     * @return Array
     *   Array of platforms.
     */
    function fuse_l3_api_build_platform_studio_mapping($studio_nid) {
        $platforms = &drupal_static(__FUNCTION__ . $studio_nid);
        if (!isset($platforms)) {
            $platforms = NULL;
            if ($cache = cache_get('studio_platforms_for_' . $studio_nid, 'cache_fuse')) {
                $platforms = $cache->data;
            }
            else {
                $studio = node_load($studio_nid);
                $platforms = [];
                if (isset($studio->field_l3_platforms['und'])) {
                    // For each platform mapped to the studio create a reverse mapping.
                    foreach ($studio->field_l3_platforms['und'] as $platform_idx){
                        $platform_id = $platform_idx['target_id'];
                        $platforms[] = $platform_id;
                    }
                }
                elseif ($studio->og_group_ref) {
                    foreach ($studio->og_group_ref['und'] as $parent) {
                        $parent_platforms = fuse_l3_api_build_platform_studio_mapping($parent['target_id']);
                        $platforms = array_merge($platforms, $parent_platforms);
                    }
                }
                $platforms = array_unique($platforms);
                cache_set('studio_platforms_for_' . $studio_nid, $platforms, 'cache_fuse');
            }
        }
        return $platforms;
    }

    function fuse_l3_api_error_page() {
        return ['#markup' => t('<h1>An error occured</h1>')];
    }

}
