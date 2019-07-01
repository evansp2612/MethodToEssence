<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 31-Mar-19
 * Time: 20:08
 */

$i = 0;

$itemlist = session()->get('itemlist');
$checklists = array();
$desc = '';
$cancel = true;
foreach ($itemlist->alphas as $al){
    if ($al->name == $alpha){
        foreach ($al->states as $s){
            if ($s->name == $state){
                $checklists = $s->checklists;
                $desc = $s->description;
                break;
            }
        }
        if (isset($al->remainingstates)) {
            $cancel = false;
            $next = 'Next';
        }
        else
            $next = 'Save';
        break;
    }
}
$size = sizeof($checklists);

?>
<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>{{$alpha}}::{{$state}}</title>

<body>
<center>
    <h1>{{$alpha}}::{{$state}}</h1>
    <form action="/edit" method="post">
        @csrf
<!--        <input type="hidden" name="saveeditstate" value="{{$state}}">-->
        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;" value="{{$desc}}">

        <br>
        <h2>Checklist</h2>
        <p>Tentukan checklists yang dimiliki</p>
        <table id="table">
            <thead>
            </thead>
            <tbody>
            @if($size == 0)
            <tr>
                <td><input name="name[]" class="form-control state" type="text" /></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRow(this)">🗑️</button></td>
            </tr>
            @else
            @foreach ($checklists as $checklist)
            <tr>
                <td><input name="name[]" class="form-control state" type="text" value="{{$checklist}}" /></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRow(this)">🗑️</button></td>
            </tr>
            @endforeach
            @endif
            </tbody>
            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
            <!--            <tr><td colspan="4" height="10"></td></tr>-->
        </table>
        <button type=button class="btn btn-default" id="add_button" onclick="addRow('table', 'state')"><b>+</b></button>
        <br>
        <br>
        <input type="hidden" name="alpha" value="{{$alpha}}">
        @if ($cancel)
        <button type="submit" class="btn btn-danger" name="state" value="{{$state}}">Cancel</button>
        @endif
        <br><br>
        <button type="submit" class="btn btn-success" name="saveeditstate" value="{{$state}}">{{$next}}</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
