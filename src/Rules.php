<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 30.05.2018
 * Time: 19:27
 */

namespace PhpHelper\Validator;

use PhpHelper\Validator\Rules\Between;
use PhpHelper\Validator\Rules\Email;
use PhpHelper\Validator\Rules\EqualTo;
use PhpHelper\Validator\Rules\Min;
use PhpHelper\Validator\Rules\MinLength;
use PhpHelper\Validator\Rules\NotEmpty;
use PhpHelper\Validator\Rules\Required;


class Rules
{
    private $name;
    private $rules = [];

    public function addRule(string $name): Rules
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    private function storeRule(string $name, BaseRule $rule)
    {
        $this->rules[$name][] = $rule;
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