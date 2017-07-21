<?php

abstract class Step {

    /**
     * @var Install
     */
    protected $install;

    public function __construct($install) {
        $this->install = $install;
    }

    abstract public function run();
}