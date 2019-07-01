<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 13-Apr-19
 * Time: 5:59
 */

$itemlist = session()->get('itemlist');
$alphas = $itemlist->alphas;
$subalphas = array();
foreach ($alphas as $alpha){
    if (isset($alpha->subalpha)){
        array_push($subalphas, $alpha);
    }
}

$patterns = $itemlist->patterns;
$activities = $itemlist->activities

?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Concept List</title>

<body>
<center>
    <h1>Concept List</h1>
    <form action="/edit" method="post">
        @csrf
<!--        <input type="hidden" name="page" value="pattern">-->
        <table>
            <tr>
                @if (sizeof($subalphas) > 0)
                    <td align="center" valign="top">
                        <h2>Sub-Alphas</h2>
                        <table>
                            <thead>
                            </thead>
                            <tbody>
                            @foreach ($subalphas as $a)
                                <tr><td><button name="alpha" type="submit" class="essence" value="{{$a->name}}">{{$a->name}}</button></td></tr>
                            @endforeach
                            </tbody>
                            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                            <!--            <tr><td colspan="4" height="10"></td></tr>-->
                        </table>
                    </td>
                @endif
                @if (sizeof($activities) > 0)
                    <td align="center" valign="top">
                        <h2>Activities</h2>
                        <table>
                            <thead>
                            </thead>
                            <tbody>
                            @foreach ($activities as $a)
                            <tr><td><button name="activity" type="submit" class="essence" value="{{$a->name}}">{{$a->name}}</button></td></tr>
                            @endforeach
                            </tbody>
                            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                            <!--            <tr><td colspan="4" height="10"></td></tr>-->
                        </table>
                    </td>
                @endif
                @if (sizeof($patterns) > 0)
                    <td align="center" valign="top">
                        <h2>Patterns</h2>
                        <table>
                            <thead>
                            </thead>
                            <tbody>
                            @foreach ($patterns as $a)
                            <tr><td><button name="pattern" type="submit" class="essence" value="{{$a->nameId}}">{{$a->nameId}}</button></td></tr>
                            @endforeach
                            </tbody>
                            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                            <!--            <tr><td colspan="4" height="10"></td></tr>-->
                        </table>
                    </td>
                @endif
            </tr>
            <br>
            @if (sizeof($itemlist->workproducts) > 0)
            <tr><td align="center" colspan="5"><h2>Work Products</h2></td></tr>
            <tr><td align="center" colspan="5"><button name="workproduct" type="submit" class="essence" value="workproduct">View Work Products</button></td></td></tr>
            @endif
        </table>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Finish</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
