<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 18.03.2018
 * Time: 13:54
 */

namespace PhpHelper\Validator\Rules;

class Min extends BaseRule implements RuleInterface
{
    protected $errorMessage = '%s value must be grater than %s.';

    private $minValue;

    public function __construct(int $minValue)
    {
        $this->minValue = $minValue;
    }

    public function validate(string $name, array $data): bool
    {
        $value = $data[$name] ?? null;
        $this->isValid = $value >= $this->minValue;

        return $this->isValid;
    }

    public function errorMessage(string $name): string
    {
        return sprintf($this->errorMessage, ucfirst($name), $this->minValue);
    }
}
