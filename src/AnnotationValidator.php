<?php

declare(strict_types = 1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Validation;

use ReflectionClass;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

/**
 * annotation validator power by symfony validator component
 * @see https://symfony.com/doc/current/validation.html
 */
class AnnotationValidator
{
    public static function validate(object $object): void
    {
        $validatorBuilder = Validation::createValidatorBuilder();
        $validatorBuilder->enableAnnotationMapping();
        /** @var ConstraintViolationList $errors */
        $errors = $validatorBuilder->getValidator()->validate($object);
        if (count($errors) > 0) {
            throw new ValidationFailedException('Verification failed', $errors);
        }
        $reflectionClass = new ReflectionClass($object);
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($object);
            if (is_object($value)) {
                static::validate($value);
            }
            if (is_array($value)) {
                foreach ($value as $item) {
                    if (is_object($item)) {
                        static::validate($item);
                    }
                }
            }
        }
    }
}
