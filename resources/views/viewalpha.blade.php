<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 31-Mar-19
 * Time: 20:08
 */

$itemlist = session()->get('itemlist');
foreach ($itemlist->alphas as $al){
    if ($al->name == $alpha){
        $a = $al;
        $states = $a->states;
        break;
    }
}
$i = 0;

?>
<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Subalpha {{$a->name}}</title>

<body>
<center>
    <h1>Subalpha {{$a->name}}</h1>
    <p>{{$a->description}}</p>
<!--    <form action="/" method="post">-->
<!--        @csrf-->
<!--        <input type="hidden" name="page" value="subalpha">-->
<!--        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;">-->


        <br>
        <h2>States</h2>
<!--        <p>Tentukan states yang dimiliki</p>-->
    <form action="/edit" method="post">
        @csrf
        <input type="hidden" name="alpha" value="{{$alpha}}">
        <table id="table">
            <thead>
            <!--            <th>Subalpha {{$a->name}}</th>-->
            </thead>
            <tbody>
            @foreach ($states as $state)
            <tr>
                <td>{{$state->name}}</td><td><button name="state" type="submit" value="{{$state->name}}">✔</button></td>
            </tr>
            @endforeach
            </tbody>
            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
            <!--            <tr><td colspan="4" height="10"></td></tr>-->
        </table>
    </form>
<!--        <button type=button class="btn btn-default" id="add_button" onclick="addRow('table', 'state')"><b>+</b></button>-->
        <br>
        <br>
        <form action="/edit" method="post">
            @csrf
            <input type="hidden" name="editalpha" value="{{$alpha}}">
            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
        <a href="{{route('edit')}}" type="button" class="btn btn-success">Back</a>
<!--    </form>-->
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
