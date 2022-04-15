<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelStartRequest extends FormRequest
{
    /**
     * Does the user have access to this studio?
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('start', $this->level);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
