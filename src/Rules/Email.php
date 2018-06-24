<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 18.03.2018
 * Time: 13:29
 */

namespace PhpHelper\Validator\Rules;

use PhpHelper\Validator\RuleInterface;

class Email extends BaseRule implements RuleInterface
{
    protected $errorMessage = '%s is not email.';

    public function validate(string $name, array $data): bool
    {
        $value = $data[$name] ?? null;
        $this->isValid = filter_var($value, FILTER_VALIDATE_EMAIL);

        return $this->isValid;
    }

    public function errorMessage(string $name): string
    {
        return sprintf($this->errorMessage, ucfirst($name));
    }
}
