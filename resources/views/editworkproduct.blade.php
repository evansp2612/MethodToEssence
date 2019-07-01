<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 08-Apr-19
 * Time: 0:01
 */


$itemlist = session()->get('itemlist');

$i = 0;

$workproducts = $itemlist->workproducts;
$alphas = $itemlist->alphas;
$alpha_list = array();

foreach ($workproducts as $wp){
    foreach ($alphas as $a){
        $found = false;
        foreach ($a->workProducts as $w){
            if ($wp == $w->name) {
                array_push($alpha_list, $a->name);
                $found = true;
                break;
            }
        }
        if ($found)
            break;
    }
}


?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Work Products</title>

<body>
<center>
    <h2>Work Products</h2>
    <form action="/edit" method="post">
        @csrf
        <table>
            <thead>
            <th>Work Product</th>
            <th>Alpha</th>
            </thead>
            <tbody>
            @php ($x=0)
            @foreach ($workproducts as $wp)
            <tr>
                <td>{{$wp}}</td>
                <td><select name="index[]" class="form-control" class="essence">
                        <option disabled selected value>Select</option>
                        @php ($i=0)
                        @foreach ($alphas as $a)
                        @if ($alpha_list[$x] == $a->name)
                        <option value={{$i}} selected>{{$a->name}}</option>
                        @else
                        <option value={{$i}}>{{$a->name}}</option>
                        @endif
                        @php ($i++)
                        @endforeach
                    </select></td>
            </tr>
            @php ($x++)
            @endforeach
            </tbody>
            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
            <!--            <tr><td colspan="4" height="10"></td></tr>-->
        </table>
        <br>
        <button type="submit" class="btn btn-danger" name="workproduct" value="workproduct">Cancel</button>
        <br><br>
        <button type="submit" class="btn btn-success" name="saveeditworkproduct" value="saveeditworkproduct">Save</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
