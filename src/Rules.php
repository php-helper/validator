<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 30.05.2018
 * Time: 19:27
 */

namespace PhpHelper\Validator;

use PhpHelper\Validator\Rules\BaseRule;
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

    public function required()
    {
        $ruleObject = new Required();
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function notEmpty()
    {
        $ruleObject = new NotEmpty();
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function min(int $minValue)
    {
        $ruleObject = new Min($minValue);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function minLength(int $minLength)
    {
        $ruleObject = new MinLength($minLength);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function email()
    {
        $ruleObject = new Email();
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }

    public function equalTo(string $name)
    {
        $ruleObject = new EqualTo($name);
        $this->storeRule($this->name, $ruleObject);

        return $this;
    }
}