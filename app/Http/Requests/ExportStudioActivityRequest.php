<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportStudioActivityRequest extends FormRequest
{
    /**
     * Does the user have access to this studio?
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('exportActivity', $this->studio);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date'],
        ];
    }
}
