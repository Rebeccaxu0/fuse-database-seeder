<?php

namespace App\LTI;

use App\Models\Issuer;
use Packback\Lti1p3\Interfaces\IDatabase;
use Packback\Lti1p3\LtiDeployment;
use Packback\Lti1p3\LtiRegistration;
use Packback\Lti1p3\OidcException;

class Database implements IDatabase
{
    public static function findIssuer($issuer_url, $client_id = null)
    {
        $query = Issuer::where('issuer', $issuer_url);
        if ($client_id) {
            $query = $query->where('client_id', $client_id);
        }
        if ($query->count() > 1) {
            throw new OidcException('Found multiple registrations for the given issuer, ensure a client_id is specified on login (contact your LMS administrator)', 1);
        }
        return $query->first();
    }

    public function findRegistrationByIssuer($issuer, $client_id = null)
    {
        $issuer = self::findIssuer($issuer, $client_id);
        if (! $issuer) {
            return false;
        }

        return LtiRegistration::new()
            ->setAuthTokenUrl($issuer->auth_token_url)
            ->setAuthLoginUrl($issuer->auth_login_url)
            ->setClientId($issuer->client_id)
            ->setKeySetUrl($issuer->key_set_url)
            ->setKid($issuer->kid)
            ->setIssuer($issuer->issuer)
            ->setToolPrivateKey($issuer->tool_private_key);
    }

    public function findDeployment($issuer, $deployment_id, $client_id = null)
    {
        $issuerModel = self::findIssuer($issuer, $client_id);
        if (! $issuerModel) {
            return false;
        }
        $deployment = $issuerModel->deployments()->where('deployment_id', $deployment_id)->first();
        if (! $deployment) {
            return false;
        }

        return LtiDeployment::new()
            ->setDeploymentId($deployment->id);
                $platforms = $this->get_platforms();

        // Old FUSE code.
        if (empty($platforms[$iss]['deployment'][$deployment_id])) {
            return false;
        }
        $deployment = new LtiDeployment();
        return $deployment
            ->set_deployment_id($deployment_id);

    }

    // Old FUSE Code.
    private function get_platforms() {
        // $platforms = &drupal_static(__CLASS__ . __METHOD__);
        // if (! isset($platforms)) {
             // if ($cache = cache_get('LTI-platforms', 'fuse')) {
             //   $platforms = $cache->data;
             // }
             // else {
                // Do expensive DB lookup here.
                $platform_results = db_select('l3_platform', 'p')
                    ->fields('p')
                    ->execute();

                if (! empty($platform_results)) {
                    foreach ($platform_results as $platform) {
                        $platforms[$platform->domain] = [
                            'client_id' => $platform->client_id,
                            'auth_login_url' => $platform->auth_login_url,
                            'auth_token_url' => $platform->auth_token_url,
                            'key_set_url' => $platform->key_set_url,
                            'private_key' => $platform->private_key,
                            'deployment' => json_decode($platform->deployment, true),
                        ];
                    }
                }
               // cache_set('LTI-platforms', $platforms, 'fuse');
             // }
        // }
		return $platforms;
    }

    // Old FUSE Code.
    public function find_registration_by_issuer($iss) {
        $platforms = $this->get_platforms();
        if (empty($platforms) || empty($platforms[$iss])) {
            return false;
        }
        $registration = new LtiRegistration();
        return $registration
            ->set_auth_login_url($platforms[$iss]['auth_login_url'])
            ->set_auth_token_url($platforms[$iss]['auth_token_url'])
            ->set_client_id($platforms[$iss]['client_id'])
            ->set_key_set_url($platforms[$iss]['key_set_url'])
            ->set_issuer($iss)
            ->set_tool_private_key($platforms[$iss]['private_key']);
            //->set_tool_private_key($this->private_key($iss));
    }

}
