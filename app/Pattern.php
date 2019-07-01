<?php

namespace App;

class Pattern
{
    //
    var $name = '';
    var $nameId = '';
    var $description = '';
    var $alphas = '';
    var $activities = '';
    var $competencies = [];

    function __construct($n = ''){
        $this->nameId = $n;
        $this->name = $n;
        $this->description = '';
        $this->alphas = [];
        $this->activities = [];
        $this->competencies = [];
    }
}
