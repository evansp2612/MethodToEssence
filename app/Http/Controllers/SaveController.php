<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivitySpace;
use App\Alpha;
use App\Competency;
use App\Criterion;
use App\Method;
use App\Pattern;
use App\State;
use App\WorkProduct;
use Illuminate\Http\Request;
use function MongoDB\BSON\fromJSON;
use function MongoDB\BSON\toPHP;

class SaveController extends Controller
{

    function saveConcepts(Request $request){
        $i = 0;
        $itemlist = new Method();
        $itemlist->name = $request->method_name;
        $itemlist->description = $request->description;

        $itemlist->conceptlist = $request->name;
        $itemlist->categorylist = $request->category;

        $alphas = toPHP(fromJSON(Alpha::all()));
        foreach ($alphas as $a){
            array_push($itemlist->alphas, $a);
        }

        $activityspaces = toPHP(fromJSON(ActivitySpace::all()));
        foreach ($activityspaces as $a){
            array_push($itemlist->activityspaces, $a);
        }

        $competencies = toPHP(fromJSON(Competency::all()));
        foreach ($competencies as $a){
            array_push($itemlist->competencies, $a);
        }

        while ($i < sizeof($request->name)){
            if ($request->essence[$i] == 'activity'){
                $itemlist->addActivity((object)(array)new Activity($request->name[$i]));
            }
            else if ($request->essence[$i] == 'role'){
                $itemlist->addRole((object)(array)new Pattern($request->name[$i]));
            }
            else if ($request->essence[$i] == 'work product'){
                $itemlist->addWorkProduct($request->name[$i]);
            }
            else{
                $subalpha = new Alpha($request->name[$i]);
                foreach ($itemlist->alphas as $alpha){
                    if ($alpha->name == $request->essence[$i]) {
                        array_push($alpha->subalphaIds, $request->name[$i]);
                        $subalpha->remainingstates = $alpha->states;
                        break;
                    }
                }
                $itemlist->addSubAlpha((object)(array)$subalpha);
            }
            $i++;
        };

        session_start();
        session()->put('itemlist', $itemlist);
        session()->save();
        if (sizeof($itemlist->subalphas) > 0)
            $link = 'subalpha';
        else if (sizeof($itemlist->workproducts) > 0)
            $link = 'workproduct';
        else if (sizeof($itemlist->remainingactivities) > 0)
            $link = 'activityspace';
        else if (sizeof($itemlist->remainingpatterns) > 0)
            $link = 'role';
        else
            $link = 'addpattern';
        return view($link);
    }

    function saveSubAlpha(Request $request){
        $itemlist = session()->get('itemlist');

        $temp = [];
        foreach ($request->name as $state){
            $i = array_search($state, array_column($itemlist->subalphas[0]->remainingstates, 'name'));
            if ($i !== false){
                array_push($temp, $itemlist->subalphas[0]->remainingstates[$i]);
            }
            else
                array_push($temp, new State($state));
        }

        $itemlist->subalphas[0]->remainingstates = $temp;

        if (isset($request->description))
            $itemlist->subalphas[0]->description = $request->description;

        session()->put('itemlist', $itemlist);
        session()->save();
        return view('checklists');
    }

    function saveChecklists(Request $request){
        $itemlist = session()->get('itemlist');

        $a = array_shift($itemlist->subalphas[0]->remainingstates);
        $a->checklists = array();

        foreach ($request->name as $checklist){
            array_push($a->checklists, $checklist);
        }
        if (isset($request->description))
            $a->description = $request->description;

        array_push($itemlist->subalphas[0]->states, $a);

        if (sizeof($itemlist->subalphas[0]->remainingstates) > 0)
            return view('checklists')->with('itemlist', $itemlist);
        else{
            $a = array_shift($itemlist->subalphas);
            array_push($itemlist->alphas, $a);
        }

        session()->put('itemlist', $itemlist);
        session()->save();
        if (sizeof($itemlist->subalphas) > 0)
            $link = 'subalpha';
        else if (sizeof($itemlist->workproducts) > 0)
            $link = 'workproduct';
        else if (sizeof($itemlist->remainingactivities) > 0)
            $link = 'activityspace';
        else if (sizeof($itemlist->remainingpatterns) > 0)
            $link = 'role';
        else
            $link = 'addpattern';
        return view($link);
    }

    function saveWorkProducts(Request $request){
        $itemlist = session()->get('itemlist');

        $i = 0;
        foreach ($itemlist->workproducts as $wp){
            $index = $request->index[$i];
            array_push($itemlist->alphas[$index]->workProducts, new WorkProduct($wp));
            $i++;
        }

        session()->put('itemlist', $itemlist);
        session()->save();
        if (sizeof($itemlist->remainingactivities) > 0)
            $link = 'activityspace';
        else if (sizeof($itemlist->remainingpatterns) > 0)
            $link = 'role';
        else
            $link = 'addpattern';
        return view($link);
    }

    function saveActivitySpaces(Request $request){
        $itemlist = session()->get('itemlist');

        $a = array_shift($itemlist->remainingactivities);
        $entry = new Criterion();
        $completion = new Criterion();
        foreach ($request->index as $index){
            array_push($a->activitySpaces, $itemlist->activityspaces[$index]->name);
            foreach ($itemlist->activityspaces[$index]->entryCriterions->alphas as $alpha){
                array_push($entry->alphas, $alpha);
            }
            foreach ($itemlist->activityspaces[$index]->completionCriterions->alphas as $alpha){
                array_push($completion->alphas, $alpha);
            }
        }

        $entry->alphas = array_unique($entry->alphas);
        $completion->alphas = array_unique($completion->alphas);
        $deleted_entries = array();
        foreach ($entry->alphas as $e){
            $i = 0;
            $j = 0;
            foreach ($completion->alphas as $c){
                if ($c == $e){
                    unset($completion->alphas[$i]);
                    $completion->alphas = array_values($completion->alphas);
                    array_push($deleted_entries, $i);
                    break;
                }
                $j++;
            }
            $i++;
        }
        foreach ($deleted_entries as $d){
            unset($entry->alphas[$d]);
            $entry->alphas = array_values($entry->alphas);
        }

        $a->entryCriterions = $entry;
        $a->completionCriterions = $completion;
        array_push($itemlist->activities, $a);


        if (sizeof($itemlist->remainingactivities) > 0)
            $link = 'activityspace';
        else if (sizeof($itemlist->remainingpatterns) > 0) {
            $itemlist->remainingactivities = $itemlist->activities;
            $itemlist->activities = array();
            $link = 'role';
        }
        else {
            $link = 'activity';
            $itemlist->remainingactivities = $itemlist->activities;
            $itemlist->activities = array();
        }
        session()->put('itemlist', $itemlist);
        session()->save();
        return view($link);
    }

    function saveRole(Request $request){
        $itemlist = session()->get('itemlist');

        $a = array_shift($itemlist->remainingpatterns);
        foreach ($request->index as $index){
            array_push($a->competencies, $itemlist->competencies[$index]->name);
        }
        if (isset($request->description))
            $a->description = $request->description;
        array_push($itemlist->patterns, $a);


        session()->put('itemlist', $itemlist);
        session()->save();
        if (sizeof($itemlist->remainingpatterns) > 0)
            $link = 'role';
        else if (sizeof($itemlist->remainingactivities) > 0)
            $link = 'activity';
        else
            $link = 'addpattern';
        return view($link);
    }

    function saveActivity(Request $request){
        $itemlist = session()->get('itemlist');

        $a = array_shift($itemlist->remainingactivities);


        $entry = new Criterion();
        if (isset($request->entry)) {
            $request->entry = array_unique($request->entry);
            foreach ($request->entry as $e) {
                array_push($entry->alphas, $e);
            }
        }
        $a->entryCriterions = $entry;

        $completion = new Criterion();
        if (isset($request->complete)) {
            $request->complete = array_unique($request->complete);
            foreach ($request->complete as $e) {
                array_push($completion->alphas, $e);
            }
        }
        $a->completionCriterions = $completion;

        if (isset($request->competencies)) {
            foreach ($request->competencies as $e) {
                array_push($a->competencies, $e);
            }

            foreach ($itemlist->patterns as $role) {
                $found = true;
                foreach ($request->competencies as $e) {
                    if (!in_array($e, $role->competencies)) {
                        $found = false;
                        break;
                    }
                }
                if ($found)
                    array_push($role->activities, $a->nameId);
            }
        }

        if (isset($request->description))
            $a->description = $request->description;
        array_push($itemlist->activities, $a);

        session()->put('itemlist', $itemlist);
        session()->save();
        if (sizeof($itemlist->remainingactivities) > 0)
            $link = 'activity';
        else
            $link = 'addpattern';
        return view($link);
    }

    function addPattern(Request $request){
        $itemlist = session()->get('itemlist');

        $temp = [];
        foreach ($request->name as $pattern){
            array_push($itemlist->remainingpatterns, new Pattern($pattern));
            array_push($itemlist->conceptlist, $pattern);
            array_push($itemlist->categorylist, 'Pattern');
        }

        session()->put('itemlist', $itemlist);
        session()->save();
        return view('pattern');
    }

    function savePattern(Request $request){
        $itemlist = session()->get('itemlist');

        $a = array_shift($itemlist->remainingpatterns);

        if (isset($request->alphas)) {
            foreach ($request->alphas as $e) {
                array_push($a->alphas, $e);
            }
        }
        if (isset($request->activities)) {
            foreach ($request->activities as $e) {
                array_push($a->activities, $e);
            }
        }

        if (isset($request->competencies)) {
            foreach ($request->competencies as $e) {
                array_push($a->competencies, $e);
            }
        }

        if (isset($request->description))
            $a->description = $request->description;

        array_push($itemlist->patterns, $a);

        session()->put('itemlist', $itemlist);
        session()->save();
        if (sizeof($itemlist->remainingpatterns) > 0)
            return view('pattern');
        else
            return redirect()->route('edit');

    }

    function finish($itemlist){

        return redirect()->route('edit')->with('itemlist', $itemlist);
    }

    function save(Request $request){
        if ($request->page == 'start')
            return view('concepts')->with('method_name', $request->method_name)->with('description', $request->description);

        if ($request->page == 'concepts')
            return $this->saveConcepts($request);

        if ($request->page == 'subalpha')
            return $this->saveSubAlpha($request);

        if ($request->page == 'checklists')
            return $this->saveChecklists($request);

        if ($request->page == 'workproduct')
            return $this->saveWorkProducts($request);

        if ($request->page == 'activityspace')
            return $this->saveActivitySpaces($request);

        if ($request->page == 'role')
            return $this->saveRole($request);

        if ($request->page == 'activity')
            return $this->saveActivity($request);

        if ($request->page == 'addpattern') {
            if (isset($request->skip)) {
                return redirect()->route('edit');
            }
            else
                return $this->addPattern($request);
        }

        if ($request->page == 'pattern')
            return $this->savePattern($request);
    }
}
