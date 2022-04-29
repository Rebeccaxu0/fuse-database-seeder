<?php

namespace App\Http\Requests;

use App\Rules\UploadCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class LevelSaveOrCompleteRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Add URL fragment to navigate to place in page where form lives to show errors.
        $this->redirect = URL::previous() . '#save-complete';

        // An artifact must always have an associated file, upload code, or URL.
        // Name, Team, and Notes are optional.
        // Also, we are passed the user if, and currently this must match the
        // Authenticated user, but a nice to have would be bypassing this for
        // Admins and Facilitators.
        return [
            'lid' => 'int|exists:App\Models\Level,id',
            'uid' => ['int', 'exists:App\Models\User,id', Rule::in([Auth::user()->id])],
            'type' => ['required', 'regex:/^(save)|(complete)$/'],
            'file' => 'required_without_all:url,uploadcode',
            'uploadcode' => ['required_without_all:file,url', 'max:10', new UploadCode],
            'url' => 'required_without_all:file,uploadcode|nullable|url|max:2048',
            'name' => 'max:255',
            'notes' => 'max:4098',
            'teammates.*' => 'int',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file.required_without_all' => 'At least, but only ONE of the following is allowed: upload, upload code, or URL.',
            'uploadcode.required_without_all' => 'At least, but only ONE of the following is allowed: upload, upload code, or URL.',
            'url.required_without_all' => 'At least, but only ONE of the following is allowed: upload, upload code, or URL.',
        ];
    }

}

