<?php

namespace Smsto\Hubspot\Http\Requests;

class StoreSettingsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'api_key' => ['required', 'string', 'max:255'],
            'sender_id' => ['required', 'string', 'max:9'],
            'show_reports' => ['required', 'boolean'],
            'show_people' => ['required', 'boolean'],
        ];
    }
}
