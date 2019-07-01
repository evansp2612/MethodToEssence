var row;

$(document).ready(function(){
    row = 1;

    $(".category").change(function () {
        if ($(this).val() != 'Other') {
            $(this).closest('tr').find('.essence').val($(this).val()).change();
        }
    });
});

function addRow(table, value) {
    row++;
    $('#'.concat(table)).each(function () {
        var tds = '<tr>';
        jQuery.each($('tr:last td', this), function () {
            tds += '<td>' + $(this).html() + '</td>';
        });
        tds += '</tr>';
        if ($('tbody', this).length > 0) {
            $('tbody', this).append(tds);
        } else {
            $(this).append(tds);
        }
    });
    if (value == 'category')
        $(".category").change(function () {
            if ($(this).val() != 'Other') {
                $(this).closest('tr').find('.essence').val($(this).val()).change();
            }
        });
    else
        $(".".concat(value)).last().val("");
}

function deleteRow(btn, tableid) {
    tableid = tableid || 'table';
    if (document.getElementById(tableid).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length > 1) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
    else if ((tableid == "table1") || (tableid == "table2"))
        document.getElementById(tableid).getElementsByTagName("tbody")[0].getElementsByTagName("tr")[0].getElementsByTagName("td")[0].getElementsByTagName("select")[0].value = "None";
}

function checkForm(page) {
    if (page == 'start'){
        var name = document.forms["form"]["method_name"].value;
        var description = document.forms["form"]["description"].value;

        if ((name == '') || (description == ''))
            alert("Fill All Fields")
        else
            document.getElementById("form").submit()
    }
}
