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
        $alphas = $p->alphas;
        $competencies = $p->competencies;
        $activities = $p->activities;
        break;
    }
}

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
    <p>{{$a->description}}</p>
<!--    <p>Asosiasikan pattern {{$a->nameId}} dengan konsep-konsep yang ada</p>-->
<!--    <form action="/" method="post">-->
<!--        @csrf-->
<!--        <input type="hidden" name="page" value="pattern">-->
<!--        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;">-->
        <table>
            <tr>
                @if (sizeof($alphas) > 0)
                    <td align="center" valign="top">
                        <h2>Alphas</h2>
                        <table>
                            <thead>
                            </thead>
                            <tbody>
                            @foreach ($alphas as $a)
                            <tr><td>{{$a}}</td></tr>
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
                            <tr><td>{{$a}}</td></tr>
                            @endforeach
                            </tbody>
                            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                            <!--            <tr><td colspan="4" height="10"></td></tr>-->
                        </table>
                    </td>
                @endif
                @if (sizeof($competencies) > 0)
                    <td align="center" valign="top">
                        <h2>Competencies</h2>
                        <table>
                            <thead>
                            </thead>
                            <tbody>
                            @foreach ($competencies as $a)
                            <tr><td>{{$a}}</td></tr>
                            @endforeach
                            </tbody>
                            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                            <!--            <tr><td colspan="4" height="10"></td></tr>-->
                        </table>
                    </td>
                @endif
            </tr>
        </table>
        <form action="/edit" method="post">
            @csrf
            <input type="hidden" name="editpattern" value="{{$pattern}}">
            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
        <a href="{{route('edit')}}" type="button" class="btn btn-success">Back</a>
<!--    </form>-->
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
