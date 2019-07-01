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
$act_competencies = $a->competencies;
$competencies = $itemlist->competencies;
$alphas = $itemlist->alphas;



?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Activity {{$a->name}}</title>

<body>
<center>
    <h1>Activity {{$a->nameId}}</h1>
    <form action="/edit" method="post">
        @csrf
<!--        <input type="hidden" name="saveeditactivity" value="{{$a->name}}">-->
        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;" value="{{$a->description}}">
        <table>
            <tr>
                <td align="center" valign="top">
                    <h2>Input</h2>
                    <table id="table1">
                        <thead>
                        <!--            <th>Subalpha {{$a->name}}</th>-->
                        </thead>
                        <tbody>
                        @if (sizeof($entry) == 0)
                        <tr><td><select name="entry[]" class="form-control entry" class="essence">
                                    <option disabled selected value="None">None</option>
                                    @foreach ($alphas as $alpha)
                                    @foreach ($alpha->states as $s)
                                    <option>{{$alpha->nameId.'.'.$s->nameId}}</option>
                                    @endforeach
                                    @endforeach
                                </select></td>
                            <td><button type="button" class="btn btn-danger" onclick="deleteRow(this, 'table1')">🗑️</button></td>
                        </tr>
                        @else
                        @foreach ($entry as $e)
                        <tr><td><select name="entry[]" class="form-control entry" class="essence">
                                    <option disabled selected value="None">None</option>
                                    @foreach ($alphas as $alpha)
                                    @foreach ($alpha->states as $s)
                                    @if(strtolower($alpha->nameId.'.'.$s->nameId) == strtolower($e))
                                    <option selected>{{$alpha->nameId.'.'.$s->nameId}}</option>
                                    @else
                                    <option>{{$alpha->nameId.'.'.$s->nameId}}</option>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </select></td>
                            <td><button type="button" class="btn btn-danger" onclick="deleteRow(this, 'table1')">🗑️</button></td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    <button type=button class="btn btn-default" id="add_button" onclick="addRow('table1', 'entry')"><b>+</b></button>
                </td>
                <td align="center" valign="top">
                    <h2>Output</h2>
                    <table id="table2">
                        <thead>
                        </thead>
                        <tbody>
                        @if (sizeof($complete) == 0)
                        <tr><td><select name="complete[]" class="form-control complete" class="essence">
<!--                                    <option disabled selected value>Select</option>-->
                                    <option disabled selected value="None">None</option>
                                    @foreach ($alphas as $alpha)
                                    @foreach ($alpha->states as $s)
                                    <option>{{$alpha->nameId.'.'.$s->nameId}}</option>
                                    @endforeach
                                    @endforeach
                                </select></td>
                            <td><button type="button" class="btn btn-danger" onclick="deleteRow(this, 'table2')">🗑️</button></td>
                        </tr>
                        @else
                        @foreach ($complete as $c)
                        <tr><td><select name="complete[]" class="form-control complete" class="essence">
<!--                                    <option disabled selected value>Select</option>-->
                                    <option disabled selected value="None">None</option>
                                    @foreach ($alphas as $alpha)
                                    @foreach ($alpha->states as $s)
                                    @if(strtolower($alpha->nameId.'.'.$s->nameId) == strtolower($c))
                                    <option selected>{{$alpha->nameId.'.'.$s->nameId}}</option>
                                    @else
                                    <option>{{$alpha->nameId.'.'.$s->nameId}}</option>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </select></td>
                            <td><button type="button" class="btn btn-danger" onclick="deleteRow(this, 'table2')">🗑️</button></td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    <button type=button class="btn btn-default" id="add_button" onclick="addRow('table2', 'complete')"><b>+</b></button>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <h2>Competencies</h2>
                    <table>
                        <thead>
                        </thead>
                        <tbody>
                        @php ($i=0)
                        @foreach ($competencies as $c)
                        <tr>
                            @if (in_array($c->name, $act_competencies))
                            <td><input type="checkbox" name="competencies[]" class="essence" value="{{$c->name}}" checked></td>
                            @else
                            <td><input type="checkbox" name="competencies[]" class="essence" value="{{$c->name}}"></td>
                            @endif
                            <td>{{$c->name}}</td>
                        </tr>
                        @php ($i++)
                        @endforeach
                        </tbody>
                        <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
                        <!--            <tr><td colspan="4" height="10"></td></tr>-->
                    </table>
                    <br>
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-danger" name="activity" value="{{$a->name}}">Cancel</button>
        <br><br>
        <button type="submit" class="btn btn-success" name="saveeditactivity" value="{{$a->name}}">Save</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
