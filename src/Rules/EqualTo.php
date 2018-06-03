<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 03.06.2018
 * Time: 10:57
 */

namespace PhpHelper\Validator\Rules;

class EqualTo extends BaseRule implements RuleInterface
{
    protected $errorMessage = '%s must equal to %s.';

    private $equalTo;

    public function __construct(string $equalTo)
    {
        $this->equalTo = $equalTo;
    }

    public function validate(string $name, array $data): bool
    {
        $value1 = $data[$name] ?? null;
        $value2 = $data[$this->equalTo] ?? null;
        $this->isValid = $value1 == $value2;

        return $this->isValid;
    }

    public function errorMessage(string $name): string
    {
        return sprintf($this->errorMessage, ucfirst($name), ucfirst($this->equalTo));
    }
}