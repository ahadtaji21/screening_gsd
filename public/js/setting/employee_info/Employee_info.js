/**
 * Created by ahad.local on 9/28/2021.
 */

$(document).ready(function () {

    var form1 = $('#SearchScreeningold');
    var DataGrid = $('#ScreeningGridold');

    
    FillFieldOfficesDropDownold();
    FillDepartmentDropDownold();
    FillDesignationDropDownold();
    FillUserDropDownold();





    //---------- Field Offices -------------//
    function FillFieldOfficesDropDownold() {
        var field_office_id = $('#field_office_id', form1);
        Helper_FillFieldOfficesDropDownold(field_office_id, "", "All");
        
    }

    //---------- Department -------------//

    function FillDepartmentDropDownold() {
        var department_id = $('#department_id', form1);
        Helper_FillDepartmentDropDownold(department_id, "", "All");
    }

    //---------- Designation -------------//

    function FillDesignationDropDownold() {
        var designation_id = $('#designation_id', form1);
        Helper_FillDesignationDropDownold(designation_id, "", "All");
    }

    //---------- User -------------//

    function FillUserDropDownold() {
        var created_by = $('#created_by', form1);
        Helper_FillUserDropDownold(created_by, "", "All");
    }



    //******************* Data table Grid *******************************

    var loadGridUrl = "/search_employee_old";
    var dataTable = DataGrid.DataTable({
        dom: "Blfrtip",
        aaSorting: [], //disabled initial sorting
        ajax: "{{url('/search_employee')}}",
        paging: true,
        searching: false,
        info: true,
        autoWidth: false,
        responsive: true,
        processing: true,
        serverSide: false,
        ordering: true,
        lengthMenu: [[10,25, 50, 100, 200, 500], [10,25, 50, 100, 200, 500]],
        pageLength: 10,
        LengthChange: false,


        /*"columnDefs": [
            {"width": "10%", "targets": 4, "class":'word-wrap'},
        ],*/
        columns: [
            //Table Column Header Collection

            {data: "reference_no"},
            {data: "employee_name"},
            {data: "gender"},
            {data: "nic"},
            {data: "dob"},
            {data: "email"},
            {data: "field_office"},

            {data: "department"},
            {data: "designation"},
            /*{
                data: null, render: function (data, type, row) {
                if (data.employee_status == '1') {
                    return '<span class="badge badge-success">Active</span>';
                }
                else if (data.employee_status == '2') {
                    return '<span class="badge badge-danger">Left</span>';
                }
                else
                {
                    return '<span class="badge badge-info">Not Defined</span>';
                }
            }
            },*/
            {
             data: null, render: function (data, type, row) {
                if (data.screening_status == '1') {
                    return '<span class="badge badge-warning">Pending</span>';
                }
                else if (data.screening_status == '2') {
                    return '<span class="badge badge-info">In-Progress</span>';
                }
                else if (data.screening_status == '3') {
                    return '<span class="badge badge-success">Completed</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Not Screened</span>';
                }
             }
             },
            {data: "screening_result"},
            {data: "screening_date"},

            {
                data: null, render: function (data, type, row) {
                return data.created_by +'<br/>'+data.created_at;
            }
            },
            {
                data: null, render: function (data, type, row) {
                if (data.screening_status == '3')
                {
                    return '<a href="/employee_info_edit/'+data.employee_info_id+'" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit Employee"><i class="fas fa-pen-nib"></i></a>&nbsp;'+
                        '<a href="/screening_add/'+data.employee_info_id+'" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add Screening"><i class="fas fa-plus"></i></a>&nbsp;'+
                        '<a href="/employee_view/'+data.employee_info_id+'" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="View Employee Details and Screening"><i class="fas fa-eye"></i></a>'
                }
                else
                {
                    return '<a href="/employee_info_edit/'+data.employee_info_id+'" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit Employee"><i class="fas fa-pen-nib"></i></a>&nbsp;'+

                        '<a href="/employee_view/'+data.employee_info_id+'" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="View Employee Details and Screening"><i class="fas fa-eye"></i></a>'
                }
            }
            },

        ],
    });
    //************************************* Data table End ********************************

    var reloadGrid = function () {
        //debugger;

        //counter = 1;
        dataTable.ajax.reload(null, false);
    }

    //************************************* Search Form and Reset btn ********************************
    var nic = $('#nic', form1);

    var screening_date_from = $('#screening_date_from', form1);
    var screening_date_to = $('#screening_date_to', form1);

    var created_at_from = $('#created_at_from', form1);
    var created_at_to = $('#created_at_to', form1);

    var contract_start_date = $('#contract_start_date', form1);
    var contract_end_date = $('#contract_end_date', form1);

    var department_id = $('#department_id', form1);
    var designation_id = $('#designation_id', form1);
    var field_office_id = $('#field_office_id', form1);
    var created_by = $('#created_by', form1);
    var gender = $('#gender', form1);
    var type_of_staff = $('#type_of_staff', form1);
    var screening_result = $('#screening_result', form1);
    var screening_status = $('#screening_status', form1);

    form1.submit(function (event) {
        //alert('form');

        var url = loadGridUrl
            + '?department_id=' + department_id.val()
            + '&field_office_id=' + field_office_id.val()
            + '&designation_id=' + designation_id.val()
            + '&gender=' + gender.val()
            + '&type_of_staff=' + type_of_staff.val()
            + '&screening_result=' + screening_result.val()
            + '&screening_status=' + screening_status.val()

            + '&contract_start_date=' + contract_start_date.val()
            + '&contract_end_date=' + contract_end_date.val()
            + '&nic=' + nic.val()
            + '&screening_date_from=' + screening_date_from.val()
            + '&screening_date_to=' + screening_date_to.val()
            + '&created_at_from=' + created_at_from.val()
            + '&created_at_to=' + created_at_to.val()
            + '&created_by=' + created_by.val()


        console.log(url);
debugger;
        dataTable.ajax.url(url).load();

        //App.scrollTo(DataGrid, -200);

        event.preventDefault();
    });

    var btnReset = $('#btnReset');
    btnReset.on('click', function (result) {
        if (confirm("Area you sure want to reset filter values?")) {
            $("#department_id").select2("val", "");
            $("#field_office_id").select2("val", "");
            $("#designation_id").select2("val", "");
            $("#gender").select2("val", "");
            $("#screening_result").select2("val", "");
            $("#screening_status").select2("val", "");

            $("#type_of_staff").select2("val", "");
            $("#created_by").select2("val", "");

            $("#nic").val("");

            $("#contract_start_date").val("");
            $("#contract_end_date").val("");
            $("#created_at_from").val("");
            $("#created_at_to").val("");

            $("#screening_date_from").select2("val", "");
            $("#screening_date_to").select2("val", "");
        }
    });


    //************************************* Search form and btn End ********************************


    
});





