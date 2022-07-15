<?php

namespace Smsto\Hubspot\Http\Requests\Web;

use Smsto\Hubspot\Http\Requests\FormRequest;

class SendCardsRequest extends FormRequest
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
            'to' => ['nullable', 'string'],
            'sender_id' => ['nullable', 'string'],
            'active_tab' => ['nullable', 'string']
        ];
    }
}
