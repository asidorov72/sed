<?php

namespace Console\App\Service;

use Console\App\Validator\SedCommandValidator;
use Console\App\Validator\ConstraintValidator\SedCommandConstraints;
use Console\App\Helper\FileHelper;

class SedCommandService implements ICommandHandler
{
    /**
     * @var SedCommandValidator $sedCommandReplaceValidator
     */
    private $sedCommandReplaceValidator;

    public function __construct(SedCommandValidator $sedCommandReplaceValidator)
    {
        $this->sedCommandReplaceValidator = $sedCommandReplaceValidator;
    }

    public function handle(array $params):array
    {
        $result = [];

        try {
            $this->sedCommandReplaceValidator->validate($params, new SedCommandConstraints());
            $result = FileHelper::findAndReplaceStr($params['filename'], $params['search'], $params['replace'], $params['flag-ignore']);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    public function outputResult(array $result):string
    {
        $resultStr = "";

        if (!empty($result['content'])) {
            $resultStr .= $result['content'] . "\n";
        }

        $resultStr .= "> " . $result['message'];

        return $resultStr;
    }
}