<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">

<body>
<center>
<form action="/" method="post" id="form" onsubmit="event.preventDefault(); checkForm('start');">
    @csrf
    <input type="hidden" name="page" value="start">

    <h3>Method name</h3>
    <input type="text" class="form-control" placeholder="Enter name" name="method_name" style="width:400px; margin-right:auto; margin-left:auto;">

    <br>
    <br>

    <h3>Method description</h3>
    <input type="text" class="form-control" placeholder="Enter description" name="description" style="width:400px; margin-right:auto; margin-left:auto;">
    <br>
    <button type="submit" class="btn btn-success">Next</button>
</form>
</center>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
