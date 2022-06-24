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
            'code' => ['required', 'string'],
            'api_key' => ['required', 'string'],
            'sender_id' => ['string', 'max:9', 'nullable'],
            'show_reports' => ['string', 'nullable'],
            'show_people' => ['string', 'nullable'],
        ];
    }
}
