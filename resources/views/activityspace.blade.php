<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 09-Apr-19
 * Time: 23:01
 */
    $itemlist = session()->get('itemlist');
    $a = $itemlist->remainingactivities[0];
    $al = $itemlist->activityspaces;

?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Activity {{$a->name}}</title>

<body>
<center>
    <h1>Activity {{$a->name}}</h1>
    <form action="/" method="post">
        @csrf
        <input type="hidden" name="page" value="activityspace">
<!--        <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;">-->

        <br>
        <h2>Activity Spaces</h2>
        <p>Tentukan activity spaces dari activity {{$a->name}}</p>
        <table>
            <tr valign="top"><td><table>

<!--                    </table></td></tr>-->
                        <thead><th colspan="2">Customer</th></thead>
            <tbody>
            @php ($i=0)
            @foreach ($al as $a)
            <tr><td><input type="checkbox" name="index[]" class="essence" value="{{$i}}"></td><td>{{$a->name}}</td></tr>
            @php ($i++)
            @if (($i == 4) or ($i == 10))
                </tbody></table></td>
                <td>
                    <table>
                        <thead><th colspan="2">
                        @if ($i == 4)
                            Solution
                        @else
                            Endeavour
                        @endif
                        </th></thead><tbody>
            @endif
            @endforeach
<!--            </tbody>-->
            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
            <!--            <tr><td colspan="4" height="10"></td></tr>-->
                    </table></td></tr></table>
<!--        <button type=button class="add_button"><b>+</b></button>-->
        <br>
        <button type="submit" class="btn btn-success">Next</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>

