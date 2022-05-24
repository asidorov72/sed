<?php
/**
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Validator;

use Console\App\Validator\ConstraintValidator\IConstraintValidator;

class SedCommandValidator implements IValidator
{
    public function validate(&$parameters, IConstraintValidator $constraintValidator)
    {
        $constraints = $constraintValidator->getConstraints();

        $matches = [];

        if ($constraints['command'] && (trim($parameters['command']) !== trim($constraints['command']))) {
             throw new \Exception('Sed command is invalid.');
        }

        $result = preg_match($constraints['argumentsPattern'], trim($parameters['parameters']), $matches);

        if ($result === false || (empty($matches[1]) || empty($matches[2]) || empty($matches[3]))) {
            throw new \Exception('Sed parameters are invalid.');
        }

        if ($constraints['fileExists'] &&  !file_exists(trim($parameters['filename']))) {
            throw new \Exception('File is invalid.');
        }

        if ($constraints['isFileWritable'] &&  !is_writable(trim($parameters['filename']))) {
            throw new \Exception('File is not writable.');
        }

        if ($constraints['allowEmptyFlag'] === false && empty($parameters['flag-ignore'])) {
            throw new \Exception('Flag is required.');
        }

        $parameters['rule'] = $matches[1];
        $parameters['search'] = $matches[2];
        $parameters['replace'] = $matches[3];
    }
}
