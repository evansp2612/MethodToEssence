<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 31-Mar-19
 * Time: 20:08
 */

$itemlist = session()->get('itemlist');
$a = $itemlist->subalphas[0];
$state = $a->remainingstates[0];
$checklists = $a->remainingstates[0]->checklists;
$i = 0;

$size = sizeof($checklists);

?>
<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>{{$a->name}}::{{$state->name}}</title>

<body>
<center>
    <h1>{{$a->name}}::{{$state->name}}</h1>
    <form action="/" method="post">
        @csrf
        <input type="hidden" name="page" value="checklists">
        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;" value="{{$state->description}}">

        <br>
        <h2>Checklist</h2>
        <p>Tentukan checklists yang dimiliki</p>
        <table id="table">
            <thead>
            <!--            <th>Subalpha {{$a->name}}</th>-->
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
        <button type="submit" class="btn btn-success">Next</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
