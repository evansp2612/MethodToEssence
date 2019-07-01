<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 13-Apr-19
 * Time: 5:59
 */

    $itemlist = session()->get('itemlist');
    $a = $itemlist->remainingpatterns[0];
    $al = $itemlist->competencies;

?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Role {{$a->nameId}}</title>

<body>
<center>
    <h1>Role {{$a->nameId}}</h1>
    <form action="/" method="post">
        @csrf
        <input type="hidden" name="page" value="role">
        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;">

        <br>
        <h2>Competencies</h2>
        <p>Tentukan competencies yang dimiliki oleh role {{$a->nameId}}</p>
        <table>
            <thead>
            <!--            <th>Subalpha {{$a->name}}</th>-->
            </thead>
            <tbody>
            @php ($i=0)
            @foreach ($al as $a)
            <tr><td><input type="checkbox" name="index[]" class="essence" value="{{$i}}"></td><td>{{$a->name}}</td></tr>
            @php ($i++)
            @endforeach
            </tbody>
            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
            <!--            <tr><td colspan="4" height="10"></td></tr>-->
        </table>
        <!--        <button type=button class="add_button"><b>+</b></button>-->
        <br>
        <button type="submit" class="btn btn-success">Next</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
