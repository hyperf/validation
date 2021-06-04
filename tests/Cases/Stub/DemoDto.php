<?php

declare(strict_types = 1);


namespace HyperfTest\Validation\Cases\Stub;

use Symfony\Component\Validator\Constraints as Assert;

class DemoDto
{
    /**
     * @Assert\NotBlank(message="name not black")
     * @var string
     */
    private $name;

    /**
     * @Assert\NotBlank(message="name1 not black")
     * @var string
     */
    protected $name1;

    /**
     * @Assert\NotBlank(message="name2 not black")
     * @var string
     */
    public $name2;

    /**
     * @var DemoDtoSub
     */
    protected $sub;

    /**
     * @var DemoDtoSub []
     */
    protected $subs;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName1(): string
    {
        return $this->name1;
    }

    public function setName1(string $name1): self
    {
        $this->name1 = $name1;
        return $this;
    }

    /**
     * @return string
     */
    public function getName2(): string
    {
        return $this->name2;
    }

    public function setName2(string $name2): self
    {
        $this->name2 = $name2;
        return $this;
    }

    /**
     * @return DemoDtoSub
     */
    public function getSub(): DemoDtoSub
    {
        return $this->sub;
    }

    public function setSub(DemoDtoSub $sub): self
    {
        $this->sub = $sub;
        return $this;
    }

    /**
     * @return DemoDtoSub[]
     */
    public function getSubs(): array
    {
        return $this->subs;
    }

    public function setSubs(array $subs): self
    {
        $this->subs = $subs;
        return $this;
    }
}
