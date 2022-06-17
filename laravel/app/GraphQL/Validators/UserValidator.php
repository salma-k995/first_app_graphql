<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;
use Illuminate\Validation\Rule;

final class UserValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            // TODO Add your validation rules
            'name'=> ['required' ,'min:2']

        ];
    }

    public function messages():array {
        return [ 
        'name.required' => 'Le champs nom est obligatoire.',
        'name.min' => 'Le champs nom doit ksqdlqknsd.'
        ];

    }
}
