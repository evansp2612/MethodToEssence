<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 13-Apr-19
 * Time: 5:59
 */

$itemlist = session()->get('itemlist');
foreach ($itemlist->patterns as $p){
    if ($p->nameId == $pattern){
        $a = $p;
        $patternalphas = $p->alphas;
        $patterncompetencies = $p->competencies;
        $patternactivities = $p->activities;
        break;
    }
}
$alphas = $itemlist->alphas;
$competencies = $itemlist->competencies;
$activities = $itemlist->activities;

$name = $a->nameId;

if ($a->name == 'role')
    $title = 'Role';
else
    $title = 'Pattern'

?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>{{$title}} {{$a->name}}</title>

<body>
<center>
    <h1>{{$title}} {{$a->nameId}}</h1>
    <p>Asosiasikan {{$title}} {{$a->nameId}} dengan konsep-konsep yang ada</p>
    <form action="/edit" method="post">
        @csrf
        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;" value="{{$a->description}}">
        <table>
            <tr>
                @if($title == 'Pattern')
                <td align="center" valign="top">
                    <h2>Alphas</h2>
                    <table>
                        <thead>
                        </thead>
                        <tbody>
                        @foreach ($alphas as $a)
                        <tr>
                            @if (in_array($a->name, $patternalphas))
                            <td><input type="checkbox" name="alphas[]" class="essence" value="{{$a->name}}" checked></td>
                            @else
                            <td><input type="checkbox" name="alphas[]" class="essence" value="{{$a->name}}"></td>
                            @endif
                            <td>{{$a->name}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                        <!--            <tr><td colspan="4" height="10"></td></tr>-->
                    </table>
                </td>
                @if (sizeof($activities) > 0)
                <td align="center" valign="top">
                    <h2>Activities</h2>
                    <table>
                        <thead>
                        </thead>
                        <tbody>
                        @foreach ($activities as $a)
                        <tr>
                            @if (in_array($a->name, $patternactivities))
                            <td><input type="checkbox" name="activities[]" class="essence" value="{{$a->name}}" checked></td>
                            @else
                            <td><input type="checkbox" name="activities[]" class="essence" value="{{$a->name}}"></td>
                            @endif
                            <td>{{$a->name}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                        <!--            <tr><td colspan="4" height="10"></td></tr>-->
                    </table>
                </td>
                @endif
                @endif
                <td align="center" valign="top">
                    <h2>Competencies</h2>
                    <table>
                        <thead>
                        </thead>
                        <tbody>
                        @foreach ($competencies as $a)
                        <tr>
                            @if (in_array($a->name, $patterncompetencies))
                            <td><input type="checkbox" name="competencies[]" class="essence" value="{{$a->name}}" checked></td>
                            @else
                            <td><input type="checkbox" name="competencies[]" class="essence" value="{{$a->name}}"></td>
                            @endif
                            <td>{{$a->name}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                        <!--            <tr><td colspan="4" height="10"></td></tr>-->
                    </table>
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-danger" name="pattern" value="{{$name}}">Cancel</button>
        <br><br>
        <button type="submit" class="btn btn-success" name="saveeditpattern" value="{{$name}}">Save</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
