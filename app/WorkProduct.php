<?php

namespace App;

class WorkProduct
{
    //
    var $nameId;
    var $name;
    var $description;
    var $levelOfDetails = [];

    function __construct($n)
    {
        $this->nameId = preg_replace('/\s/', '', $n);
        $this->name = $n;
        $this->description = '';
        $this->levelOfDetails = [];
    }
}
