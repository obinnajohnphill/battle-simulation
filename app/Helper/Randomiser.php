<?php

/**
 * A class randomises battle processes
 */
class Randomiser {
    private $fixedValue = null;

    /**
     * @param null $fixedValue
     */
    public function __construct($fixedValue = null) {
        $this->fixedValue = $fixedValue;
    }

    /**
     * @return float|int|null
     */
    public function generate()
    {
        return isset($this->fixedValue) ? $this->fixedValue : mt_rand() / mt_getrandmax();
    }

    /**
     * @param float $chance
     * @return boolean
     */
    public function generateBoolean($chance = null)
    {
        $chance = isset($chance) ? $chance : 0.5;
        return $this->generate() > 1 - $chance;
    }

    /**
     * @param array $array
     * @return boolean
     */
    public function getArrayItem(Array $array)
    {
        $key = floor($this->generate() * count($array));
        if($key == count($array)) {$key--;}
        return $array[$key];
    }
}

