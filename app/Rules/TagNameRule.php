<?php

namespace App\Rules;

use Illuminatech\Validation\Composite\CompositeRule;

class TagNameRule extends CompositeRule
{
    protected function rules(): array
    {
        return [
            'string',
            'max:255',
        ];
    }
}
