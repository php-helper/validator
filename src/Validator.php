<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 18.03.2018
 * Time: 12:54
 */
namespace PhpHelper\Validator;

use PhpHelper\Validator\Exceptions\ValidationException;
use PhpHelper\Validator\Rules\BaseRule;
use PhpHelper\Validator\Rules\Between;
use PhpHelper\Validator\Rules\Email;
use PhpHelper\Validator\Rules\EqualTo;
use PhpHelper\Validator\Rules\Min;
use PhpHelper\Validator\Rules\MinLength;
use PhpHelper\Validator\Rules\NotEmpty;
use PhpHelper\Validator\Rules\Required;

class Validator implements ValidatorInterface
{
    protected $rules = [];
    protected $errors = [];
    protected $name;

    /**
     * @param string $name
     * @return Validator
     */
    public function addRule(string $name): ValidatorInterface
    {
        $this->name = $name;

        return $this;
    }

    public function storeRule(string $name, BaseRule $rule): void
    {
        $this->rules[$name][] = $rule;
    }

    /**
     * @param mixed[] $data
     * @throws ValidationException
     */
    public function validate(array $data): void
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
            throw new ValidationException($this->getErrorsStrings());
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getErrorsMessages(): array
    {
        $errorMessages = [];
        if (!empty($this->errors)) {
            foreach ($this->errors as $fieldErrors) {
                foreach ($fieldErrors as $fieldError) {
                    $errorMessages[] = $fieldError;
                }
            }
        }

        return $errorMessages;
    }

    public function getErrorsStrings(string $errorLinesDelimiter = PHP_EOL): string
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

    public function required(string $errorMessage = '')
    {
        $ruleObject = new Required($errorMessage);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function notEmpty(string $errorMessage = '')
    {
        $ruleObject = new NotEmpty($errorMessage);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function min(int $minValue, string $errorMessage = '')
    {
        $ruleObject = new Min($minValue, $errorMessage);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function minLength(int $minLength, string $errorMessage = '')
    {
        $ruleObject = new MinLength($minLength, $errorMessage);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function email(string $errorMessage = '')
    {
        $ruleObject = new Email($errorMessage);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function equalTo(string $name, string $errorMessage = '')
    {
        $ruleObject = new EqualTo($name, $errorMessage);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function between(int $minValue, int $maxValue, string $errorMessage = '')
    {
        $ruleObject = new Between($minValue, $maxValue, $errorMessage);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }
}
