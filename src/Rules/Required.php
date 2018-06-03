<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 29.03.2018
 * Time: 19:43
 */

namespace PhpHelper\Validator\Rules;

class Required extends BaseRule implements RuleInterface
{
    protected $errorMessage = '%s is required.';

    public function validate(string $name, array $data): bool
    {
        $this->isValid = !empty($data[$name]);

        return $this->isValid;
    }

    public function errorMessage(string $name): string
    {
        return sprintf($this->errorMessage, ucfirst($name));
    }
}
