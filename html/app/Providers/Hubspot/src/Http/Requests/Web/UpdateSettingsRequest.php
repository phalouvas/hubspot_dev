<?php

namespace Smsto\Hubspot\Http\Requests\Web;

use Smsto\Hubspot\Http\Requests\FormRequest;
use Smsto\Hubspot\Rules\ApiKey;

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
            'api_key' => ['required', 'string', new ApiKey],
            'sender_id' => ['required', 'string', 'max:9'],
            'show_reports' => ['string', 'nullable'],
            'show_people' => ['string', 'nullable'],
        ];
    }
}
