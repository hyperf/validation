<?php

declare(strict_types = 1);


namespace HyperfTest\Validation\Cases;

use Hyperf\Validation\AnnotationValidator;
use HyperfTest\Validation\Cases\Stub\DemoDto;
use HyperfTest\Validation\Cases\Stub\DemoDtoSub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Exception\ValidationFailedException;

/**
 * @internal
 * @coversNothing
 */
class AnnotationValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $this->expectException(ValidationFailedException::class);
        $dto = new DemoDto();
        $dto->setName1('test');
        AnnotationValidator::validate($dto);
    }

    public function testValidateObjectSub(): void
    {
        $this->expectException(ValidationFailedException::class);
        $dto = new DemoDto();
        $dto->setName('test');
        $dto->setName1('test');
        $dto->setName2('test');
        $sub = new DemoDtoSub();
        $dto->setSub($sub);
        AnnotationValidator::validate($dto);
    }

    public function testValidateObjectSubs(): void
    {
        $this->expectException(ValidationFailedException::class);
        $dto = new DemoDto();
        $dto->setName('test');
        $dto->setName1('test');
        $dto->setName2('test');
        $sub = new DemoDtoSub();
        $dto->setSubs([$sub]);
        AnnotationValidator::validate($dto);
    }

    public function testValidateErrorMsg(): void
    {
        $dto = new DemoDto();
        $dto->setName('test');
        try {
            AnnotationValidator::validate($dto);
        } catch (ValidationFailedException $e) {
            self::assertEquals('Verification failed', $e->getValue());
            /** @var ConstraintViolation $violation */
            foreach ($e->getViolations() as $violation) {
                if ($violation->getPropertyPath() === 'name1') {
                    self::assertEquals('name1 not black', $violation->getMessage());
                } else {
                    self::assertEquals('name2 not black', $violation->getMessage());
                }
            }
        }
    }
}
