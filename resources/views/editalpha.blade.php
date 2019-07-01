<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 31-Mar-19
 * Time: 20:08
 */

$itemlist = session()->get('itemlist');
foreach ($itemlist->alphas as $act){
    if ($act->name == $alpha){
        $a = $act;
        break;
    }
}
$states = $a->states;
$i = 0;

?>
<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Subalpha {{$a->name}}</title>

<body>
<center>
    <h1>Subalpha {{$a->name}}</h1>
    <form action="/edit" method="post">
        @csrf
        <input type="hidden" name="page" value="subalpha">
        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;">

        <br>
        <h2>States</h2>
        <p>Tentukan states yang dimiliki</p>
        <table id="table">
            <thead>
            <!--            <th>Subalpha {{$a->name}}</th>-->
            </thead>
            <tbody>
            @foreach ($states as $state)
            <tr>
                <td><input name="name[]" class="form-control state" type="text" value="{{$state->name}}" /></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRow(this)">🗑️</button></td>
            </tr>
            @endforeach
            </tbody>
            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
            <!--            <tr><td colspan="4" height="10"></td></tr>-->
        </table>
        <button type=button class="btn btn-default" id="add_button" onclick="addRow('table', 'state')"><b>+</b></button>
        <br>
        <br>
        <button type="submit" class="btn btn-danger" name="alpha" value="{{$a->name}}">Cancel</button>
        <br><br>
        <button type="submit" class="btn btn-success" name="saveeditalpha" value="{{$a->name}}">Save</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
