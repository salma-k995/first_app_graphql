<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class CreatePostValidator extends Validator
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
            'description' => ['required', 'min:30']
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'Le champs nom est obligatoire.',
            'description.min' => 'Le champs description doit comporte au minimum 30 caractéres.'
        ];
    }
}
