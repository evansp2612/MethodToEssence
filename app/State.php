<?php

namespace App;

class State
{
    //
    var $nameId;
    var $name;
    var $description;
    var $checklists = [];

    function __construct($n)
    {
        $this->nameId = preg_replace('/\s/', '', $n);
        $this->name = $n;
        $this->description = '';
        $this->checklists = [];
    }

    function AddChecklist(string $c){
        array_push($this->checklists, $c);
    }
}
