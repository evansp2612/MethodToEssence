<?php

namespace App;

class Activity
{
    //
    var $nameId;
    var $name;
    var $description;
    var $entryCriterions = [];
    var $completionCriterions = [];
    var $competencies = [];
    var $activitySpaces = [];

    function __construct($n = '')
    {
        $this->nameId = preg_replace('/\s/', '', $n);
        $this->name = $n;
        $this->description = '';
        $this->entryCriterions = [];
        $this->completionCriterions = [];
        $this->competencies = [];
        $this->activitySpaces = [];
    }
}
