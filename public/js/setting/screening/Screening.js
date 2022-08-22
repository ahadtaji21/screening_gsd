/**
 * Created by ahad.local on 9/28/2021.
 */

$(document).ready(function () {

    var form1 = $('#SearchScreening');
    var DataGrid = $('#ScreeningGrid');

    
    FillFieldOfficesDropDown();
    FillDepartmentDropDown();
    FillDesignationDropDown();
    FillUserDropDown();





    //---------- Field Offices -------------//
    function FillFieldOfficesDropDown() {
        var field_office_id = $('#field_office_id', form1);
        Helper_FillFieldOfficesDropDown(field_office_id, "", "All");
        
    }

    //---------- Department -------------//

    function FillDepartmentDropDown() {
        var department_id = $('#department_id', form1);
        Helper_FillDepartmentDropDown(department_id, "", "All");
    }

    //---------- Designation -------------//

    function FillDesignationDropDown() {
        var designation_id = $('#designation_id', form1);
        Helper_FillDesignationDropDown(designation_id, "", "All");
    }

    //---------- User -------------//

    function FillUserDropDown() {
        var created_by = $('#created_by', form1);
        Helper_FillUserDropDown(created_by, "", "All");
    }



    //******************* Data table Grid *******************************
    var table = DataGrid.DataTable({
        dom: "Blfrtip",
        aaSorting: [], //disabled initial sorting
        ajax: "/search_employee",
        paging: true,
        searching: false,
        info: true,
        autoWidth: false,
        responsive: true,
        processing: true,
        serverSide: false,
        ordering: true,
        lengthMenu: [[25, 50, 100, 200, 500], [25, 50, 100, 200, 500]],
        pageLength: 25,
        LengthChange: false,


        /*"columnDefs": [
            {"width": "10%", "targets": 4, "class":'word-wrap'},
        ],*/
        columns: [
            //Table Column Header Collection

            {data: "reference_no"},
            {data: "employee_name"},
            {data: "field_office_name"},
            {data: "gender_id"},
            {data: "nationality_name"},
            {data: "nic"},
            
            /*{
                data: null, render: function (data, type, row) {
                if (data.screening_status_id == '1') {
                    return '<span class="badge badge-warning">Pending</span>';
                }
                else if (data.screening_status_id == '2') {
                    return '<span class="badge badge-info">In-Progress</span>';
                }
                else if (data.screening_status_id == '3') {
                    return '<span class="badge badge-success">Completed</span>';
                }
            }
            },*/
            {data: "created_at"},
            {data: "created_employee_by_name"},
            {
                data: null, render: function (data, type, row) {

                return '<a href="/employee_info_edit/'+data.employee_info_id+'" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit Employee" target="_blank"><i class="fas fa-pen-nib"></i></a>'+
                    '<a href="/screening_add_2/'+data.employee_info_id+'" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add Screening" target="_blank"><i class="fas fa-plus"></i></a>'+
                    '<a href="/employee_view/'+data.employee_info_id+'" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="View Employee Details and Screening" target="_blank"><i class="fas fa-eye"></i></a>'
            }
            },

        ],
    });
    //************************************* Data table End ********************************


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
    var gender_id = $('#gender_id', form1);
    var screening_result = $('#screening_result', form1);
    var type_of_staff = $('#type_of_staff', form1);

    form1.submit(function (event) {

        var url = loadGridUrl
            + '?department_id=' + department_id.val()
            + '&field_office_id=' + field_office_id.val()
            + '&designation_id=' + designation_id.val()
            + '&gender_id=' + gender_id.val()
            + '&screening_result=' + screening_result.val()
            + '&type_of_staff=' + type_of_staff.val()
            + '&created_by=' + created_by.val()
            + '&contract_start_date=' + contract_start_date.val()
            + '&contract_end_date=' + contract_end_date.val()
            + '&nic=' + nic.val()
            + '&screening_date_from=' + screening_date_from.val()
            + '&screening_date_to=' + screening_date_to.val()
            + '&created_at_from=' + created_at_from.val()
            + '&created_at_to=' + created_at_to.val()


        //console.log(url);

        dataTable.ajax.url(url).load();

        App.scrollTo(DataGrid, -200);

        event.preventDefault();
    });

    var btnReset = $('#btnReset');
    btnReset.on('click', function (result) {
        if (confirm("Area you sure want to reset filter values?")) {
            $("#department_id").select2("val", "");
            $("#field_office_id").select2("val", "");
            $("#designation_id").select2("val", "");
            $("#gender_id").select2("val", "");
            $("#screening_result").select2("val", "");

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





