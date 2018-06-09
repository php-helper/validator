<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 09.06.2018
 * Time: 15:03
 */

namespace PhpHelper\Validator\Rules;

use PhpHelper\Validator\BaseRule;
use PhpHelper\Validator\RuleInterface;

class Between extends BaseRule implements RuleInterface
{
    protected $errorMessage = '%s value must be between [%s-%s].';

    private $minValue;
    private $maxValue;

    public function __construct(int $minValue, int $maxValue, string $errorMessage = '')
    {
        parent::__construct($errorMessage);
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
    }

    public function validate(string $name, array $data): bool
    {
        $value = $data[$name] ?? null;
        $this->isValid = $value >= $this->minValue && $value <= $this->maxValue;

        return $this->isValid;
    }

    public function errorMessage(string $name): string
    {
        return sprintf($this->errorMessage, ucfirst($name), $this->minValue, $this->maxValue);
    }
}
