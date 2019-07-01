<?php

namespace App\Http\Controllers;

use App\Criterion;
use App\State;
use App\WorkProduct;
use Illuminate\Http\Request;

class EditController extends Controller
{
    function finish($itemlist){

        foreach ($itemlist->activities as $a){
            foreach ($a->activitySpaces as $as){
                foreach ($itemlist->activityspaces as $activityspace){
                    if ($as == $activityspace->name) {
                        array_push($activityspace->activities, $a);
                        break;
                    }
                }
            }
            unset($a->activitySpaces);
        }

        unset($itemlist->subalphas);
        unset($itemlist->remainingactivities);
        unset($itemlist->remainingpatterns);
        unset($itemlist->workproducts);

        foreach ($itemlist->alphas as $a){
            unset($a->_id);
            unset($a->incrementing);
            unset($a->exists);
            unset($a->wasRecentlyCreated);
            unset($a->timestamps);
            unset($a->subalpha);
        }
        foreach ($itemlist->activityspaces as $a){
            unset($a->_id);
        }
        foreach ($itemlist->competencies as $a){
            unset($a->_id);
        }
        foreach ($itemlist->patterns as $a){
            unset($a->_id);
        }



        session()->put('itemlist', $itemlist);
        session()->save();
        return view('finish');
    }

    function edit(Request $request){
        if (isset($request->editactivity))
            return view('editactivity')->with('activity', $request->editactivity);
        if (isset($request->saveeditactivity))
            return $this->editActivity($request);

        if (isset($request->editworkproduct))
            return view('editworkproduct');
        if (isset($request->saveeditworkproduct))
            return $this->editWorkProducts($request);

        if (isset($request->editpattern))
            return view('editpattern')->with('pattern', $request->editpattern);
        if (isset($request->saveeditpattern))
            return $this->editPattern($request);

        if (isset($request->editstate))
            return view('editstate')->with('state', $request->editstate)->with('alpha', $request->alpha);
        if (isset($request->saveeditstate))
            return $this->editState($request);

        if (isset($request->editalpha))
            return view('editalpha')->with('alpha', $request->editalpha);
        if (isset($request->saveeditalpha))
            return $this->editAlpha($request);



        if (isset($request->state))
            return view('viewstate')->with('state', $request->state)->with('alpha', $request->alpha);
        if (isset($request->alpha))
            return view('viewalpha')->with('alpha', $request->alpha);
        if (isset($request->activity))
            return view('viewactivity')->with('activity', $request->activity);
        if (isset($request->pattern))
            return view('viewpattern')->with('pattern', $request->pattern);
        if (isset($request->workproduct))
            return view('viewworkproduct');



        $itemlist = session()->get('itemlist');
        return $this->finish($itemlist);

    }

    function editActivity(Request $request){
        $itemlist = session()->get('itemlist');

        foreach ($itemlist->activities as $act){
            if ($act->name == $request->saveeditactivity){
                $act->competencies = array();
                $act->description = '';

                $entry = new Criterion();
                if (isset($request->entry)) {
                    $request->entry = array_unique($request->entry);
                    foreach ($request->entry as $e) {
                        array_push($entry->alphas, $e);
                    }
                }
                $act->entryCriterions = $entry;

                $completion = new Criterion();
                if (isset($request->complete)) {
                    $request->complete = array_unique($request->complete);
                    foreach ($request->complete as $e) {
                        array_push($completion->alphas, $e);
                    }
                }
                $act->completionCriterions = $completion;

                foreach ($itemlist->patterns as $role) {
                    $i = 0;
                    if ($role->name == 'role'){
                        foreach ($role->activities as $activity){
                            if ($activity == $act->nameId){
                                unset($role->activities[$i]);
                                $role->activities = array_values($role->activities);
                                break;
                            }
                            $i++;
                        }
                    }
                }

                foreach ($request->competencies as $e){
                    array_push($act->competencies, $e);
                }

                foreach ($itemlist->patterns as $role) {
                    if ($role->name == 'role') {
                        $found = true;
                        foreach ($request->competencies as $e) {
                            if (!in_array($e, $role->competencies)) {
                                $found = false;
                                break;
                            }
                        }
                        if ($found)
                            array_push($role->activities, $act->nameId);
                    }
                }

                if (isset($request->description))
                    $act->description = $request->description;
                break;
            }
        }





        session()->put('itemlist', $itemlist);
        session()->save();
        return view('viewactivity')->with('activity', $request->saveeditactivity);
    }

    function editWorkProducts(Request $request){
        $itemlist = session()->get('itemlist');

        foreach ($itemlist->alphas as $a){
            $a->workProducts = array();
        }

        $i = 0;
        foreach ($itemlist->workproducts as $wp){
            $index = $request->index[$i];
            array_push($itemlist->alphas[$index]->workProducts, new WorkProduct($wp));
            $i++;
        }

        session()->put('itemlist', $itemlist);
        session()->save();
        return view('viewworkproduct');
    }

    function editPattern(Request $request){
        $itemlist = session()->get('itemlist');

        foreach ($itemlist->patterns as $a) {
            if ($a->nameId == $request->saveeditpattern) {
                $a->alphas = array();
                $a->activities = array();
                $a->competencies = array();
                $a->description = '';

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

                    if ($a->name == 'role'){
                        foreach ($itemlist->activities as $act){
                            $found = true;
                            foreach ($act->competencies as $c){
                                if (!in_array($c, $a->competencies)) {
                                    $found = false;
                                    break;
                                }
                            }
                            if ($found)
                                array_push($a->activities, $act->nameId);
                        }
                    }
                }

                if (isset($request->description))
                    $a->description = $request->description;


                session()->put('itemlist', $itemlist);
                session()->save();
                return view('viewpattern')->with('pattern', $request->saveeditpattern);
            }
        }

    }

    function editState(Request $request){
        $itemlist = session()->get('itemlist');

        foreach ($itemlist->alphas as $al){
            if ($al->name == $request->alpha){
                foreach ($al->states as $s){
                    if ($s->name == $request->saveeditstate){
                        $s->checklists = array();
                        foreach ($request->name as $checklist){
                            array_push($s->checklists, $checklist);
                        }
                        if (isset($request->description))
                            $s->description = $request->description;


                        break;
                    }
                }
                if (isset($al->remainingstates)) {
                    unset($al->remainingstates[0]);
                    $al->remainingstates = array_values($al->remainingstates);
                    if (sizeof($al->remainingstates) > 0) {
                        return view('editstate')->with('state', $al->remainingstates[0])->with('alpha', $al->name);
                    }
                    else {
                        unset($al->remainingstates);
                        return view('viewalpha')->with('alpha', $al->name);
                    }
                }
                break;
            }
        }



        session()->put('itemlist', $itemlist);
        session()->save();

        return view('viewstate')->with('state', $request->saveeditstate)->with('alpha', $request->alpha);;
    }

    function editAlpha(Request $request){
        $itemlist = session()->get('itemlist');

        $temp = [];
        foreach ($itemlist->alphas as $alpha){
            if ($alpha->name == $request->saveeditalpha){
                foreach ($request->name as $state){
                    $i = array_search($state, array_column($alpha->states, 'name'));
                    if ($i !== false){
                        array_push($temp, $alpha->states[$i]);
                    }
                    else {
                        array_push($temp, new State($state));
                        if (!(isset($alpha->remainingstates)))
                            $alpha->remainingstates = array();
                        array_push($alpha->remainingstates, $state);
                    }
                }

                $alpha->states = $temp;

                if (isset($request->description))
                    $alpha->description = $request->description;

                session()->put('itemlist', $itemlist);
                session()->save();
                if (isset($alpha->remainingstates))
                    return view('editstate')->with('state', $alpha->remainingstates[0])->with('alpha', $alpha->name);
                break;
            }
        }
        return view('viewalpha')->with('alpha', $request->saveeditalpha);


    }
}
