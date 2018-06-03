<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 18.03.2018
 * Time: 13:29
 */

namespace PhpHelper\Validator\Rules;

abstract class BaseRule
{
    protected $errorMessage = '%s value must be grater than %s.';
    protected $isValid = null;

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
