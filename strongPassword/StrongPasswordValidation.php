<?php

use App\Rules\StrongPassword;

class StrongPasswordValidation
{
    public function rules(): array
    {
        return [
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                new StrongPassword
            ],
            'password_confirmation' => [
                'required',
            ],
        ];
    }

    public function register()
    {
        $this->validate();

        // Some code here
    }
}
