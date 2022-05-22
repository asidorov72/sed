<?php

namespace Console\App\Validator;

use Console\App\Validator\ConstraintValidator\IConstraintValidator;

interface IValidator
{
    public function validate(&$parameters, IConstraintValidator $constraintValidator);
}