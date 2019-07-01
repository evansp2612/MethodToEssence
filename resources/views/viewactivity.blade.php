<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 13-Apr-19
 * Time: 5:59
 */

$itemlist = session()->get('itemlist');
foreach ($itemlist->activities as $act){
    if ($act->name == $activity){
        $a = $act;
        $entry = $a->entryCriterions->alphas;
        $complete = $a->completionCriterions->alphas;
        break;
    }
}
$competencies = $a->competencies;

$roles = array();
foreach ($itemlist->patterns as $p){
    if (($p->name == 'role') and (in_array((preg_replace('/\s/', '', $activity)), $p->activities)))
        array_push($roles, $p->nameId);
}


?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Activity {{$a->name}}</title>

<body>
<center>
    <h1>Activity {{$a->nameId}}</h1>
<!--    <form action="/" method="post">-->
<!--        @csrf-->
    <p>{{$a->description}}</p>
        <table>
            <tr>
                @if (isset($entry[0]))
                <td align="center" valign="top">
                    <h2 align="center">Input</h2>
                    <table id="table1">
                        <thead>
                        <!--            <th>Subalpha {{$a->name}}</th>-->
                        </thead>
                        <tbody>
                        @foreach ($entry as $a)
                        <tr><td align="center">{{$a}}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
<!--                    <button type=button class="btn btn-default" id="add_button" onclick="addRow('table1', 'entry')"><b>+</b></button>-->
                </td>
                @endif
                @if (isset($complete[0]))
                <td align="center" valign="top">
                    <h2 align="center">Output</h2>
                    <table id="table2">
                        <thead>
                        </thead>
                        <tbody>

                        @foreach ($complete as $a)
                        <tr><td align="center">{{$a}}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
<!--                    <button type=button class="btn btn-default" id="add_button" onclick="addRow('table2', 'complete')"><b>+</b></button>-->
                </td>
                @endif
            </tr>
        </table>
        <table>
            <tr>
                <td align="center" valign="top">
                    <h2>Competencies</h2>
                    <table>
                        <thead>
                        </thead>
                        <tbody>
                        @php ($i=0)
                        @foreach ($competencies as $a)
                        <tr><td>{{$a}}</td></tr>
                        @php ($i++)
                        @endforeach
                        </tbody>
                        <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                        <!--            <tr><td colspan="4" height="10"></td></tr>-->
                    </table>
                    <br>
                </td>
                <br>
                @if (sizeof($roles) > 0)
                <td align="center" valign="top">
                    <h2>Roles</h2>
                    <table>
                        <thead>
                        </thead>
                        <tbody>
                        @php ($i=0)
                        @foreach ($roles as $a)
                        <tr><td>{{$a}}</td></tr>
                        @php ($i++)
                        @endforeach
                        </tbody>
                        <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                        <!--            <tr><td colspan="4" height="10"></td></tr>-->
                    </table>
                    <br>
                </td>
                @endif
            </tr>
        </table>
    <form action="/edit" method="post">
        @csrf
        <input type="hidden" name="editactivity" value="{{$activity}}">
        <button type="submit" class="btn btn-warning">Edit</button>
    </form>
    <a href="{{route('edit')}}" type="button" class="btn btn-success">Back</a>
<!--    </form>-->
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
