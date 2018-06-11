<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 18.03.2018
 * Time: 12:54
 */
namespace PhpHelper\Validator;

use PhpHelper\Validator\Exceptions\ValidationException;

class Validator
{
    private $rulesInstance;
    private $rules = [];
    private $errors = [];

    public function __construct()
    {
        $this->rulesInstance = new Rules($this);
    }

    public function addRule(string $name): Rules
    {
        $this->rulesInstance->addRule($name);
        
        return $this->rulesInstance;
    }

    public function storeRule(string $name, BaseRule $rule)
    {
        $this->rules[$name][] = $rule;
    }

    /**
     * @param mixed[] $data
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $this->errors = [];
        foreach ($this->rules as $name => $rules) {
            foreach ($rules as $rule) {
                /** @var RuleInterface $rule */
                $isValid = $rule->validate($name, $data);
                if (!$isValid) {
                    $this->errors[$name][] = $rule->errorMessage($name);
                }
            }
        }

        if (!empty($this->errors)) {
            throw new ValidationException($this->getErrorsAsString());
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getErrorsAsString(string $errorLinesDelimiter = PHP_EOL): string
    {
        $errorMessages = '';
        if (!empty($this->errors)) {
            $errorMessages = [];
            foreach ($this->errors as $fieldErrors) {
                $errorMessages = implode($errorLinesDelimiter, $fieldErrors);
            }
        }

        return $errorMessages;
    }
}
