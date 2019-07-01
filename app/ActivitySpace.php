<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ActivitySpace extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'activityspaces';
//
    function __construct($n = '')
    {

    }

}
