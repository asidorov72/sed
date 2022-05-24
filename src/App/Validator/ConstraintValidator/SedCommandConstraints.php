<?php
/**
 * src/App/Validator/ConstraintValidator/SedCommandConstraints.php
 *
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Validator\ConstraintValidator;

use Console\App\Validator\ConstraintValidator\IConstraintValidator;

class SedCommandConstraints implements IConstraintValidator
{
    const SED_COMMAND = 'sed';

    /**
     * @var array|null
     */
    protected $constraints = [
        'command' => self::SED_COMMAND,
        'argumentsPattern' => '/^(s{1})\/([^\/]+)\/([^\/]+)\/$/',
        'fileExists' => true,
        'isFileWritable' => true,
        'allowEmptyFlag' => true
    ];

    public $message = 'The command or passed arguments are not valid.';

    /**
     * SedCommandReplaceConstraints constructor.
     * @param null $constraints
     */
    public function __construct($constraints = null)
    {
        $this->constraints = $constraints ?? $this->constraints;
    }

    /**
     * @return array
     */
    public function getConstraints():array
    {
        return $this->constraints;
    }
}