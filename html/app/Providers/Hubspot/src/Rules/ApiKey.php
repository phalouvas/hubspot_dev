<?php

namespace Smsto\Hubspot\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ApiKey implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $user = Http::withToken($value)->asJson()->acceptJson()->get('https://sms.to/api/v1/authenticated_user');
            if ($user->failed()) {
                return false;
            }
            $user = json_decode($user, true);
            if (!isset($user['user'])) {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'API key invalid.';
    }
}
