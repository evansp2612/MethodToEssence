<?php

namespace App;

class Method
{
    //
    var $name;
    var $description;
    var $alphas = [];
    var $subalphas = [];
    var $activities = [];
    var $activityspaces = [];
    var $remainingactivities = [];
    var $workproducts = [];
    var $patterns = [];
    var $remainingpatterns = [];
    var $competencies = [];
    var $conceptlist = [];
    var $categorylist = [];
    var $subalphas_name = [];

    function addAlpha($alpha){
        array_push($this->alphas, $alpha);
    }

    function addSubAlpha($subalpha){
        array_push($this->subalphas, $subalpha);
        array_push($this->subalphas_name, $subalpha->nameId);
    }

    function addActivity($activity){
        array_push($this->remainingactivities, $activity);
    }

    function addWorkProduct($workproduct){
        array_push($this->workproducts, $workproduct);
    }

    function addRole($role){
        $role->name = 'role';
        array_push($this->remainingpatterns, $role);
    }

}
