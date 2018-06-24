<?php
/**
 * Created by PhpStorm.
 * User: Oleg G.
 * Date: 24.06.2018
 * Time: 14:11
 */

namespace PhpHelper\Validator;

use PhpHelper\Validator\Rules\BaseRule;

interface ValidatorInterface
{
    public function addRule(string $name): ValidatorInterface;

    public function storeRule(string $name, BaseRule $rule): void;

    public function validate(array $data): void;

    public function getErrors(): array;

    public function getErrorsMessages(): array;

    public function getErrorsStrings(string $errorLinesDelimiter = PHP_EOL): string;
}