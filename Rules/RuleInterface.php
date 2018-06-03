<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 18.03.2018
 * Time: 13:27
 */

namespace PhpHelper\Validator\Rules;

interface RuleInterface
{
    public function validate(string $name, array $data): bool;

    public function errorMessage(string $name): string;
}
