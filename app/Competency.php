<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Competency extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'competency';
//
    function __construct($n = '')
    {

    }
}
