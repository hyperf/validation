<?php

declare(strict_types = 1);


namespace HyperfTest\Validation\Cases\Stub;


use Symfony\Component\Validator\Constraints as Assert;

class DemoDtoSub
{
    /**
     * @Assert\NotBlank(message="subName not blank")
     * @var string
     */
    protected $subName;

    /**
     * @return string
     */
    public function getSubName(): string
    {
        return $this->subName;
    }

    public function setSubName(string $subName): self
    {
        $this->subName = $subName;
        return $this;
    }
}