<?php

class Player
{
    private $name;
    private $pinsThrown;

    public function __construct($name)
    {
        $this->name = $name;
        $this->pinsThrown = [];
        return $this;
    }

    public function throwPins($one, $two)
    {
        array_push($this->pinsThrown, [$one, $two]);
    }

    public function getPinsThrown()
    {
        return $this->pinsThrown;
    }

    public function getName()
    {
        return $this->name;
    }
}
