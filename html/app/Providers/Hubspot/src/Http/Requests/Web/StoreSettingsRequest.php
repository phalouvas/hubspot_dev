<?php

namespace Smsto\Hubspot\Http\Requests\Web;

use Smsto\Hubspot\Http\Requests\FormRequest;
use Smsto\Hubspot\Rules\ApiKey;

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
            'api_key' => ['required', 'string', new ApiKey],
            'sender_id' => ['string', 'max:9', 'nullable'],
            'show_reports' => ['boolean', 'required'],
            'show_people' => ['boolean', 'required'],
        ];
    }
}
