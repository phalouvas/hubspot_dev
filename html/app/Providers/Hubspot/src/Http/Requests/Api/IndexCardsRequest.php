<?php

namespace Smsto\Hubspot\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Smsto\Hubspot\Http\Requests\FormRequest;

class IndexCardsRequest extends FormRequest
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
            'associatedObjectType' => ['required', 'string', Rule::in(['CONTACT'])],
            'portalId' => ['required', 'integer'],
            'userId' => ['required', 'integer'],
            'associatedObjectId' => ['required', 'integer'],
            'phone' => ['required', 'string'],
        ];
    }
}
