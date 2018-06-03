<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 18.03.2018
 * Time: 14:17
 */

namespace PhpHelper\Validator\Rules;

class MinLength extends BaseRule implements RuleInterface
{
    protected $errorMessage = '%s length must be more than %s symbols.';

    private $minLength;

    public function __construct(int $minLength)
    {
        $this->minLength = $minLength;
    }

    public function validate(string $name, array $data): bool
    {
        $value = $data[$name] ?? null;
        $this->isValid = strlen($value) > $this->minLength;

        return $this->isValid;
    }

    public function errorMessage(string $name): string
    {
        return sprintf($this->errorMessage, ucfirst($name), $this->minLength);
    }
}
