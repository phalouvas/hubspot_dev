<?php

namespace Smsto\Hubspot\Http\Requests;

class ActionRequest extends FormRequest
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
            'inputFields.api_key' => ['required', 'string'],
            'inputFields.to' => ['required', 'string'],
            'inputFields.message' => ['required', 'string'],
            'inputFields.sender_id' => ['nullable', 'string'],
            'inputFields.bypass_optout' => ['nullable', 'boolean'],
            'inputFields.callback_url' => ['nullable', 'string'],
            'inputFields.scheduled_for' => ['nullable', 'string'],
            'inputFields.timezone' => ['nullable', 'string'],
        ];
    }
}
