<?php
/**
 * Created by IntelliJ IDEA.
 * User: ERFANDI SURYO PUTRA
 * Date: 31-Mar-19
 * Time: 20:08
 */
?>
<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

<title>Extract Concepts</title>

<body>
<center>
    <form action="/" method="post">
        @csrf
        <input type="hidden" name="method_name" value="{{$method_name}}" />
        <input type="hidden" name="description" value="{{$description}}" />
        <input type="hidden" name="page" value="concepts" />
        <table id="table">
            <thead>
                <th>Concept Name</th>
                <th>Category</th>
                <th>Essence Concept</th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td><input name="name[]" class="form-control" type="text" /></td>
                    <td><select name="category[]" class="form-control category" >
                            <option disabled selected value>Select</option>
                            <option value="role">Team</option>
                            <option value="work product">Artifact</option>
                            <option value="activity">Event</option>
                            <option value="Other">Other</option>
                        </select></td>
                    <td><select name="essence[]" class="form-control essence" >
                            <option disabled selected value>Select</option>
                            <option value="activity">Activity</option>
                            <option value="work product">Work Product</option>
                            <option value="role">Role</option>
                            <option value="Way of Working">Sub-Alpha of Way of Working</option>
                            <option value="Team">Sub-Alpha of Team</option>
                            <option value="Work">Sub-Alpha of Work</option>
                            <option value="Software System">Sub-Alpha of Software System</option>
                            <option value="Requirements">Sub-Alpha of Requirements</option>
                            <option value="Stakeholders">Sub-Alpha of Stakeholders</option>
                            <option value="Opportunity">Sub-Alpha of Opportunity</option>
                        </select></td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteRow(this)">🗑️</button></td>
                </tr>
            </tbody>
<!--            <tr><td align="center" colspan="4"><button type=button class="add_button"><b>+</b></button></td></tr>-->
<!--            <tr><td colspan="4" height="10"></td></tr>-->
        </table>
        <button type=button class="btn btn-default" id="add_button" onclick="addRow('table', 'category')"><b>+</b></button>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Next</button>
    </form>
</center>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
</body>
