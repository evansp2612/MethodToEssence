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
        <input type="hidden" name="page" value="workproduct">
        <table>
            <thead>
            <th>Work Product</th>
            <th>Alpha</th>
            </thead>
            <tbody>
            @foreach ($workproducts as $wp)
            <tr>
                <td>{{$wp}}</td>
                <td>{{$alpha_list[$i]}}</td>
            </tr>
            @php ($i++)
            @endforeach
            </tbody>
            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
            <!--            <tr><td colspan="4" height="10"></td></tr>-->
        </table>
        <form action="/edit" method="post">
            @csrf
            <input type="hidden" name="editworkproduct" value="edit">
            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
        <a href="{{route('edit')}}" type="button" class="btn btn-success">Back</a>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
