<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Alpha extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'alpha';

    //
    var $nameId;
    var $name;
    var $description;
    var $states = [];
    var $workProducts = [];
    var $subalphaIds = [];
    var $remainingstates = [];
    var $subalpha;

    function __construct($n = '')
    {
        $this->nameId = preg_replace('/\s/', '', $n);
        $this->name = $n;
        $this->description = '';
        $this->states = [];
        $this->workProducts = [];
        $this->subalphaIds = [];
        $this->remainingstates = [];
        $this->subalpha = true;
    }
}
