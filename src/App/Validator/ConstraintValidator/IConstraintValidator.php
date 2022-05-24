<?php
/**
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Validator\ConstraintValidator;

interface IConstraintValidator
{
    public function getConstraints():array;
}
