<?php

namespace App\Http\Livewire;

use App\Models\Artifact;
use App\Models\Level;
use App\Models\Media;
use App\Models\User;
use App\Rules\UploadCode;
use Filestack\Filelink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use MediaUploader;

class LevelSaveOrCompleteForm extends Component
{
    public bool $uploadCodeDisappear = false;
    public bool $urlDisappear = false;
    public bool $uploadCodeDisabled = false;
    public bool $urlDisabled = false;
    public string $uploadCode = '';
    public string $url = '';
    public bool $previewOpen = false;
    public string $previewUrl = '';
    public string $previewName = '';
    public int $lid;
    public int $mediaId;
    public string $type = 'save';
    public string $filestackHandle = '';
    public string $artifactName = '';
    public string $notes = '';
    public $studioMembers;
    public array $teammates = [];
    public array $teamNames = [];

    /**
     * As the parent, this component is the only one that needs to know about
     *  its children. Siblings shouldn't know about each other to stay modular.
     */
    protected $listeners = [
        'filestackUploadComplete',
        'filestackUploadDeleted',
        'makePreviewImage',
        'removePreview',
        'setType',
    ];

    public function setType($val)
    {
        $this->type = $val;
    }

    public function filestackUploadComplete()
    {
        $this->uploadCodeDisabled = true;
        $this->urlDisabled = true;
    }

    public function filestackUploadDeleted()
    {
        $this->uploadCodeDisabled = false;
        $this->urlDisabled = false;
    }

    public function enableURL()
    {
        $this->urlDisabled = false;
        $this->previewOpen = false;
        unset($this->previewUrl);
    }

    public function updatedTeammates($value)
    {
        $this->teamNames = [];
        foreach ($this->teammates as $k => $uid) {
            $this->teamNames[] = User::find($uid)->full_name;
        }
    }

    public function updatedUploadCode($code)
    {
        if ($code == '') {
            $this->emit('filestackAppear');
            $this->urlDisabled = false;
        }
        else {
            $this->url = '';
            $this->urlDisabled = true;
            // Validate here.
            $response = Http::acceptJson()
                ->get('https://api.fusestudio.net/validate/' . urlencode($code));
            if ($response->ok()) {
                $status = $response->json()['status'];
                if ($status == 'ready') {
                    $this->emit('filestackDisappear');
                    $location = $response->json()['location'];
                    $mimetype = $response->json()['mimetype'];
                    $this->emit('makePreviewImage', 'mobile upload code', ['mime' => $mimetype, 'file_url' => $location]);
                }
            }
        }
    }

    public function updatedUrl($url)
    {
        if ($url == '') {
            $this->emit('filestackAppear');
            $this->uploadCodeDisabled = false;
            $this->validateOnly('url');
        }
        else {
            $this->validateOnly('url');
            $this->emit('filestackDisappear');
            $this->uploadCodeDisabled = true;
            $this->makePreviewImage('url', ['url' => $url]);
        }
    }

    public function removePreview()
    {
        $this->uploadCode = '';
        $this->uploadCodeDisabled = false;
        $this->uploadCodeDisappear = false;
        $this->url = '';
        $this->urlDisabled = false;
        $this->urlDisappear = false;
        $this->emit('filestackAppear');
        $this->previewOpen = false;
        $this->previewName = '';
        unset($this->previewUrl);
    }

    /**
     * Populates the preview image/icon based on the method and details.
     *
     * @param string $type
     *   Valid options are 'filestack', 'mobile upload code', and 'url'.
     * @param array $details
     *   Contents vary based on type.
     *   'filestack' implies key of 'handle' to hydrate a Filestack\Filelink object.
     *   'mobile upload code' implies keys of 'mime' and 'file_url'
     *   'url' implies key of 'url'
     */
    public function makePreviewImage(string $type, array $details)
    {
        // If there's a valid file preview, hide file upload inputs.
        $this->uploadCodeDisappear = true;
        $this->urlDisappear = ! array_key_exists('url', $details);
        $this->emit('filestackDisappear');

        $fskey = config('filestack.api_key');
        $validTypes = ['filestack', 'mobile upload code', 'url'];
        if (! in_array($type, $validTypes)) {
            // Throw exception;
            return;
        }

        if ('url' == $type) {
            // TODO: see if we can use Filestack to get a screenshot of the URL for type 'url'.
            $this->previewOpen = true;
            $this->previewUrl = '/img/link.svg';
            $this->previewName = $details['url'];
            return;
        }

        $filename = $mime = '';

        if ($type == 'filestack') {
            // TODO: add enough information to delete file later if abandonded.
            // "fs_response" => array:12 [
            //     "filename" => "180px-Jolly_Dumple.PNG"
            //     "handle" => "eUIHSp6zS1aL5OANqR9Y"
            //     "mimetype" => "image/png"
            //     "originalPath" => "180px-Jolly_Dumple.PNG"
            //     "size" => 27648
            //     "source" => "local_file_system"
            //     "url" => "https://cdn.filestackcontent.com/eUIHSp6zS1aL5OANqR9Y"
            //     "uploadId" => "xKsO8EaiGc2W6Ogc"
            //     "originalFile" => array:3 [▶]
            //     "status" => "Stored"
            //     "key" => "1/eoa4EiKxR2yigaANROTW_180px-Jolly_Dumple.PNG"
            //     "container" => "fuse-dev-artifacts"
            $this->filestackHandle = $details['fs_response']['handle'];
            $filelink = new Filelink($this->filestackHandle, $fskey);
            //
            // $path = $filelink->getMetaData()['path'];
            // $temp = explode('/', $path);
            // $filename = array_pop($temp);
            // $directory = implode('/', $temp);
            // $temp = explode('.', $filename);
            // $extension = end($temp);
            // $media = MediaUploader::import('artifacts', $directory, $filename, $extension);
            // $media = MediaUploader::importPath('artifacts', '1/kxur0IWsRui6mUgnM85K_180px-Jolly_Dumple.png');
            $media = MediaUploader::importPath('artifacts', $filelink->getMetaData()['path']);
            $this->mediaId = $media->id;
            // Storage::disk('artifacts')->delete($filelink->getMetaData()['key']);
            //      "container" => "fuse-dev-artifacts"
            //      "filename" => "180px-Jolly_Dumple.PNG"
            //      "key" => "1/NpAfS5bXR1WfLSF796dT_180px-Jolly_Dumple.PNG"
            //      "location" => "S3"
            //      "mimetype" => "image/png"
            //      "path" => "1/NpAfS5bXR1WfLSF796dT_180px-Jolly_Dumple.PNG"
            //      "size" => 27648
            //      "uploaded" => 1657036702369.6
            //      "writeable" => true
            $mime = $filelink->getMetaData()['mimetype'];
            $filename = $filelink->getMetaData()['filename'];
            $this->previewName = $filename;
        }
        else if ($type == 'mobile upload code') {
            $mime = $details['mime'];
            $url = $details['file_url'];
            $exploded_url = explode('/', $url);
            $this->previewName = $filename = array_pop($exploded_url);
        }

        $mimetype = explode('/', $this->mimetype($mime, $filename));
        $this->previewOpen = true;
        $this->previewName = $this->previewName;

        switch($mimetype[0]) {
        case 'audio':
            $this->previewUrl = '/img/audio.svg';
            break;

        case 'video':
            $this->previewUrl = '/img/video.svg';
            break;

        case 'image':
            if ($type == 'filestack') {
                $this->previewUrl = $filelink->resize(100, 75, 'crop')->transform_url;
            }
            else {
                $this->previewUrl = "https://cdn.art.fusestudio.net/{$fskey}/resize=w:100,h:75,fit:crop/src://fuse/{$details['file_url']}";
            }
            break;

        default:
            $this->previewUrl = '/img/misc.svg';
        }
    }

    public function makeArtifact()
    {
        $validated = $this->validate();
        $user = Auth::user();
        $team = [$user];
        $artifact = new Artifact;
        $artifact->level_id = $validated['lid'];
        $artifact->type = $validated['type'];
        $artifact->name = $validated['artifactName'];
        $artifact->notes = $validated['notes'];
        $artifact->url = $validated['url'];
        $artifact->filestack_handle = $validated['filestackHandle'];

        if (array_key_exists('teammates', $validated)) {
            $students = $user->activeStudio->students;
            foreach ($validated['teammates'] as $teammate) {
                if ($students->contains($teammate)) {
                    $team[] = User::find($teammate);
                }
            }
        }

        if ($validated['uploadCode']) {
            $src = '/tmp/' . $this->previewName;
            // We should probably use the upload code to remove the prefix.
            // For now we just assume 6 char code plus dash is 7 char offset.
            $newFilename = substr($this->previewName, 7);
            $dest = '/' . Auth::user()->id . "/{$newFilename}";
            if (Storage::disk('artifacts')->exists($src)) {
                Storage::disk('artifacts')->copy($src, $dest);
                Storage::disk('artifacts')->delete($src);
                // TODO: convert to a media instance.
            }
            else {
            }
        }
        $artifact->save();
        $artifact->users()->saveMany($team);
        $level = Level::find($validated['lid']);
        $is_team_artifact = (bool) (count($team) > 1);
        foreach ($team as $teammate) {
            $teammate->currentLevel()->associate($level);
            $teammate->save();
            if (! $teammate->hasStartedLevel($level)) {
                $start = $level->start($teammate, true);
                $start->created_at = $start->created_at->subSecond();
                $start->save;
            }
            if ($validated['type'] == 'save') {
                $action = 'save_level';
            }
            else {
                $action = 'completed_level';
            }
            Log::channel('fuse_activity_log')
                ->info($action, [
                    'user' => $teammate,
                    'level' => Level::find($validated['lid']),
                    'artifact' => $artifact,
                    'is_team_artifact' => $is_team_artifact,
                ]);
        }
        if (! $artifact->url) {
            if ($artifact->filestack_handle) {
                $fskey = config('filestack.api_key');
                $filelink = new Filelink($artifact->filestack_handle, $fskey);
                $path = $filelink->getMetaData()['path'];
            }
            // $media = MediaUploader::importPath('artifacts', $path);
            $media = Media::find($this->mediaId);
            $artifact->attachMedia($media, 'file');
        }

        switch ($validated['type']) {
        case 'save':
            $statusMsg = __('Save successful!');
            $destination = URL::previous();
            break;

        case 'complete':
            $level = Level::find($validated['lid']);
            foreach ($team as $teammate) {
                Cache::put("u{$teammate->id}_has_completed_level_{$level->id}", true, 3600);
                // Remove from dashboard 'In Progress' if last level.
                if (! $level->next()) {
                    Cache::forget("u{$teammate->id}_in_progress_challenge_versions");
                }
            }
            if ($level->next()) {
                $statusMsg = __("Great Job! You've leveled up!");
                $params = [
                    'challengeVersion' => $level->next()->levelable,
                    'level' => $level->next(),
                ];
                $destination = route('student.level', $params);
            }
            else {
                $statusMsg = __("Great Job! You've finished a challenge!");
                $destination = route('student.challenges');
            }
            break;

        }
        return redirect($destination)->with('status', $statusMsg);
    }

    public function mount()
    {
        $user = Auth::user();
        $this->studioMembers = $user->activeStudio->students->except($user->id);
        for ($i = 0; $i < count($this->studioMembers); $i++) {
            if (old("teammates.{$i}")) {
                $this->teammates[] = old("teammates.{$i}");
            }
        }
        $this->updatedTeammates($this->teammates);
    }

    public function render()
    {
        return view('livewire.level-save-or-complete-form');
    }

    /**
     * Get more accurate mimetype
     *
     * Some binary files self-report as 'application/octet-stream' when they're
     * actually images or videos.
     * This function guesses based on extension for those mimetypes.
     * See https://www.sitepoint.com/mime-types-complete-list/
     *
     * @param string $filemime
     *  Mimetype.
     * @param string $filename
     *  Filename.
     *
     * @return string
     *  Updated mimetype.
     */
    function mimetype($filemime, $filename = '') {
        if ($filename == '' || ($filemime != '' && $filemime != 'application/octet-stream')) {
            return $filemime;
        }
        $name_boom = explode('.', $filename);
        $ext = strtolower(array_pop($name_boom));
        if ('jpg' == $ext || 'jpeg' == $ext) {
            $filemime = 'image/jpeg';
        }
        else if ('gif' == $ext) {
            $filemime = 'image/gif';
        }
        else if ('png' == $ext) {
            $filemime = 'image/png';
        }
        else if ('mp2' == $ext) {
            $filemime = 'audio/mpeg';
        }
        else if ('mp3' == $ext) {
            $filemime = 'audio/mpeg3';
        }
        else if ('avi' == $ext) {
            $filemime = 'video/avi';
        }
        else if ('mkv' == $ext) {
            $filemime = 'video/x-matroska';
        }
        else if ('m1v' == $ext || 'm2v' == $ext || 'mpeg' == $ext || 'mpg' == $ext) {
            $filemime = 'video/mpeg';
        }
        else if ('mov' == $ext || 'moov' == $ext || 'qt' == $ext) {
            $filemime = 'video/quicktime';
        }
        else if ('mp4' == $ext) {
            $filemime = 'video/mp4';
        }
        return $filemime;
    }

    protected function rules()
    {
        return [
            'lid' => 'int|exists:App\Models\Level,id',
            'type' => ['required', 'regex:/^(save)|(complete)$/'],
            'filestackHandle' => 'required_without_all:url,uploadCode',
            'uploadCode' => ['required_without_all:filestackHandle,url', 'max:10', new UploadCode],
            'url' => 'required_without_all:filestackHandle,uploadCode|nullable|url|max:2048',
            'artifactName' => 'max:255',
            'notes' => 'max:4098',
            'teammates.*' => 'int|nullable',
        ];
    }
}

