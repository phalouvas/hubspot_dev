<?php

namespace Smsto\Hubspot\Http\Requests;


class UpdateSettingsRequest extends FormRequest
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
            'api_key' => ['string', 'max:255'],
            'sender_id' => ['string', 'max:9'],
            'show_reports' => ['boolean'],
            'show_people' => ['boolean'],
        ];
    }
}
