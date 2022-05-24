<?php
/**
 * src/App/Validator/SedCommandValidator.php
 *
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Validator;

use Console\App\Helper\FileHelper;
use Console\App\Validator\ConstraintValidator\IConstraintValidator;
use Console\App\Helper\LoggerHelper;

class SedCommandValidator implements IValidator
{
    public $logger;

    public function __construct(LoggerHelper $logger)
    {
       $this->logger = $logger;
    }

    public function validate(&$parameters, IConstraintValidator $constraintValidator)
    {
        $constraints = $constraintValidator->getConstraints();

        $matches = [];

        if ($constraints['command'] && (trim($parameters['command']) !== trim($constraints['command']))) {
            $error = 'Sed command is invalid.';
            $this->logger->log($error);
            throw new \Exception($error);
        }

        $result = preg_match($constraints['argumentsPattern'], trim($parameters['parameters']), $matches);

        if ($result === false || (empty($matches[1]) || empty($matches[2]) || empty($matches[3]))) {
            $error = 'Sed parameters are invalid.';
            $this->logger->log($error);
            throw new \Exception($error);
        }

        if ($constraints['fileExists'] &&  !file_exists(trim($parameters['filename']))) {
            $error = 'File ' . $parameters['filename'] . ' is invalid.';
            $this->logger->log($error);
            throw new \Exception($error);
        }

        if ($constraints['isFileWritable'] &&  !is_writable(trim($parameters['filename']))) {
            $error = 'File ' . $parameters['filename'] . ' is not writable.';
            $this->logger->log($error);
            throw new \Exception($error);
        }

        if ($constraints['allowEmptyFlag'] === false && empty($parameters['flag-ignore'])) {
            $error = 'Flag --i is required.';
            $this->logger->log($error);
            throw new \Exception($error);
        }

        $parameters['rule'] = $matches[1];
        $parameters['search'] = $matches[2];
        $parameters['replace'] = $matches[3];
    }
}
