<?php

namespace App\Http\Requests;

use App\Rules\WistiaCode;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateChallengeVersionRequest extends FormRequest
{
    public User $user;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'blurb' => 'required|max:255',
            'challenge_category_id' => 'required|exists:App\Models\ChallengeCategory,id',
            'challenge_id' => 'required|exists:App\Models\Challenge,id',
            'chromebook_info' => 'nullable|max:2048',
            'gallery_note' => 'nullable|max:128',
            'gallery_wistia_video_id' => ['nullable', new WistiaCode],
            'info_article_url' => 'nullable|url',
            'name' => 'required|unique:challenge_versions|max:255',
            'prerequisite_challenge_version_id' => 'nullable|exists:App\Models\ChallengeVersion,id',
        ];
    }
}
