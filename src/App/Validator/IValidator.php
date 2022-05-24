<?php
/**
 * src/App/Validator/IValidator.php
 *
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Validator;

use Console\App\Validator\ConstraintValidator\IConstraintValidator;

interface IValidator
{
    public function validate(&$parameters, IConstraintValidator $constraintValidator);
}