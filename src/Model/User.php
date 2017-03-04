<?php

namespace ThirdBridge\Model;

final class User
{
    /** @var string */
    private $name;
    /** @var bool */
    private $active;
    /** @var int */
    private $value;

    public function __construct(string $name, bool $active, int $value)
    {
        $this->name   = $name;
        $this->active = $active;
        $this->value  = $value;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return User
     */
    public function setActive(bool $active): User
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return User
     */
    public function setValue(int $value): User
    {
        $this->value = $value;
        return $this;
    }


}