<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 14-Apr-19
 * Time: 1:21
 */
use Illuminate\Support\Facades\DB;

    $itemlist = session()->get('itemlist');

    $name = $itemlist->conceptlist;
    $category = $itemlist->categorylist;

    foreach ($category as &$c){
        if ($c == 'role')
            $c = 'Team';
        if ($c == 'work product')
            $c = 'Artifact';
        if ($c == 'activity')
            $c = 'Event';
    }

    unset($itemlist->conceptlist);
    unset($itemlist->categorylist);

        $x = 0;
    while ($x < sizeof($itemlist->activityspaces)){
        if (sizeof($itemlist->activityspaces[$x]->activities) == 0){
            unset($itemlist->activityspaces[$x]);
            $itemlist->activityspaces = array_values($itemlist->activityspaces);
        }
        else
            $x++;
    }

        $used_alphas = array();
    foreach ($itemlist->alphas as $x){
        if (((sizeof($x->subalphaIds) > 0) || (sizeof($x->workProducts) > 0)))
            array_push($used_alphas, $x->nameId);
    }

    foreach ($itemlist->activities as $act){
        foreach ($act->entryCriterions->alphas as $a){
            array_push($used_alphas, explode(".", $a)[0]);
        }
        foreach ($act->completionCriterions->alphas as $a){
            array_push($used_alphas, explode(".", $a)[0]);
        }
    }

    foreach ($itemlist->patterns as $p){
        foreach ($p->alphas as $a){
            array_push($used_alphas, preg_replace('/\s/', '', $a));
        }
    }

    $x = 0;
    while ($x < sizeof($itemlist->alphas)){
        if (!in_array($itemlist->alphas[$x]->nameId, $itemlist->subalphas_name) && !in_array($itemlist->alphas[$x]->nameId, $used_alphas)){
            unset($itemlist->alphas[$x]);
            $itemlist->alphas = array_values($itemlist->alphas);
        }
        else
            $x++;
    }

        $used_comp = array();
    foreach ($itemlist->patterns as $p){
        foreach ($p->competencies as $a){
            array_push($used_comp, $a);
        }
    }
    foreach ($itemlist->activities as $p){
        foreach ($p->competencies as $a){
            array_push($used_comp, $a);
        }
    }
    $x = 0;
    while ($x < sizeof($itemlist->competencies)){
        if (!in_array($itemlist->competencies[$x]->name, $used_comp)){
            unset($itemlist->competencies[$x]);
            $itemlist->competencies = array_values($itemlist->competencies);
        }
        else
            $x++;
    }

    unset($itemlist->activities);
    unset($itemlist->subalphas);
    unset($itemlist->subalphas_name);
    $result = json_encode((array)$itemlist, JSON_PRETTY_PRINT);

    $i = 0;

    DB::connection('mongodb')->collection('method')->insert((array)$itemlist);
?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Method {{$itemlist->name}}</title>

<body>
<center>
    <h1>Method {{$itemlist->name}}</h1>
     <table style="table-layout: fixed" border="1">
         <thead>
             <th align="center">Concepts</th>
             <th>Essence</th>
         </thead>
         <tbody>
             <tr>
                 <td valign="top" width="30%" align="center">
                     <table>
                         <thead>
                             <th>Concept Name</th>
                             <th>Category</th>
                         </thead>
                         <tbody>
                             @foreach ($name as $n)
                                <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$category[$i]}}</td>
                                </tr>
                                @php($i++)
                             @endforeach
                         </tbody>
                     </table>
                 </td>
                 <td valign="top" width="70%">
                     <pre style="white-space: pre-wrap;">{{$result}}</pre>
                 </td>
             </tr>
         </tbody>
     </table>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
