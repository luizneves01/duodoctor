<?php

namespace Entity;

class RolesEntity {

    public $name;
    public $code;
    public $group;

    public function __construct($name, $code, $group)
    {
        $this->name = $name;
        $this->code = $code;
        $this->group = $group;
    }
}