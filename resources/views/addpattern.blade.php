<?php
$itemlist = session()->get('itemlist');
?>

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Add Pattern</title>

<body>
<center>
    <h1>Additional Patterns</h1>
    <p>Tambahkan konsep-konsep dalam bentuk pattern, jika diperlukan</p>
    <form action="/" method="post">
        @csrf
        <input type="hidden" name="page" value="addpattern">

        <br>
        <h2>Pattern's names</h2>
        <table id="table">
            <thead>
            </thead>
            <tbody>
            <tr>
                <td><input name="name[]" class="form-control state" type="text" /></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRow(this)">🗑️</button></td>
            </tr>
            </tbody>
            <!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
            <!--            <tr><td colspan="4" height="10"></td></tr>-->
        </table>
        <button type=button class="btn btn-default" id="add_button" onclick="addRow('table', 'state')"><b>+</b></button>
        <br>
        <br>
        <br>
        <button name="skip" type="submit" class="btn btn-danger" value="skip">Skip</button>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Next</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
