<script>

    /**
     * Created by ahad.local on 9/28/2021.
     */

$(document).ready(function () {

    var form1 = $('#SearchScreening');
    var DataGrid = $('#ScreeningGrid');

    var user_region_id = $('#user_region_id').val();
    var user_field_office_id = $('#user_field_office_id').val();
    var screening_status = $('#screening_status').val();
    var type_of_staff = $('#type_of_staff').val();

    var region_clicked = $('#region_clicked').val().trim();
    //var user_field_office_id = $.parseJSON(user_field_office_id);
    //alert(region_clicked);


    FillRegionsDropDown();
    //FillFieldOfficesDropDown(0);
    FillDepartmentDropDown();
    FillDesignationDropDown();
    FillUserDropDown();


    //---------- regions -------------//
    function FillRegionsDropDown() {
        var region_id = $('#region_id', form1);
        if (region_clicked == 1)
        {
            if (region_clicked == user_region_id || user_region_id == 0)
            {
                Helper_FillRegionsByUserRegionDropDown(region_clicked, region_id, "", "All");
            }
            else
            {
                Helper_FillRegionsByUserRegionDropDown(user_region_id, region_id, "", "All");
            }

        }
        else
        {
            if (user_region_id == 0)
            {
                Helper_FillRegionsDropDown(region_id, "", "All");
            }
            else
            {
                Helper_FillRegionsByUserRegionDropDown(user_region_id, region_id, "", "All");
            }
        }



    }

    var region_id = $('#region_id', form1);
    region_id.on('change', function (result) {
        var id_val = $(this).val();

        if (id_val === '') {
            id_val = 0;
            FillFieldOfficesDropDown(0);
        }
        else {
            //FillRegionDropDown(id_val);
            FillFieldOfficesByRegionDropDown(id_val);
        }


    });



    //---------- Field Offices -------------//
    function FillFieldOfficesDropDown(region_id) {
        var field_office_id = $('#field_office_id', form1);
        Helper_FillFieldOfficesDropDown(region_id,field_office_id, "", "All");
    }

    //---------- Field Offices By Region-------------//
    function FillFieldOfficesByRegionDropDown(region_id) {
        var field_office_id = $('#field_office_id', form1);
        if (user_field_office_id != '')
        {
            //alert(user_field_office_id);
            Helper_FillFieldOfficesByUserFieldOfficeDropDown(user_field_office_id,field_office_id, "", "All");
        }
        else
        {
            //alert('fill');
            Helper_FillFieldOfficesByRegionDropDown(region_id,field_office_id, "", "All");
        }

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
        var APP_URL = {!! json_encode(url('/')) !!}
        Helper_FillUserDropDown(created_by, "", "All" );
    }



    //******************* Data table Grid *******************************

    if (screening_status == '' && type_of_staff == '' && region_clicked == '')
    {
        var url = "{{url('/search_employee')}}"
                + '?user_region_id=' + user_region_id
                + '&user_field_office_id=' + user_field_office_id;
    }
    else
    {
        if (screening_status != '')
        {
            var url = "{{url('/search_employee')}}"
                    + '?user_region_id=' + user_region_id
                    + '&user_field_office_id=' + user_field_office_id
                    + '&screening_status=' + screening_status;
        }
        else if (type_of_staff != '')
        {
            var url = "{{url('/search_employee')}}"
                    + '?user_region_id=' + user_region_id
                    + '&user_field_office_id=' + user_field_office_id
                    + '&type_of_staff=' + type_of_staff;
        }
        else if (region_clicked != '')
        {
            if (region_clicked == user_region_id || user_region_id == 0)
            var url = "{{url('/search_employee')}}"
                    + '?user_region_id=' + region_clicked
                    + '&user_field_office_id=' + user_field_office_id
                    + '&type_of_staff=' + type_of_staff;
        }
    }


    var dataTable = DataGrid.DataTable({
        dom: "Blfrtip",
        aaSorting: [], //disabled initial sorting
        ajax: url,
        paging: true,
        searching: false,
        info: true,
        autoWidth: false,
        responsive: true,
        processing: true,
        serverSide: true,
        ordering: true,
        lengthMenu: [[10,25, 50, 100, 200, 500], [10,25, 50, 100, 200, 500]],
        pageLength: 10,
        LengthChange: false,
        "scrollX": true,


        /*"columnDefs": [
            {"width": "10%", "targets": 4, "class":'word-wrap'},
        ],*/
        columns: [
            //Table Column Header Collection

            //{data: "employee_name"},
            {
                data: null, render: function (data, type, row) {
                var url_emp_view = "{{url('/employee_view/')}}";
                return '<a href="'+url_emp_view+'/'+data.employee_info_id+'">'+data.employee_name +' '+ data.employee_surname+'</i></a>';
            }
            },
            {data: "gender"},

            {data: "nic"},
            {data: "reference_no"},
            //{data: "dob"},
            //{data: "email"},
            //{data: "field_office"},
            {
                data: null, render: function (data, type, row) {
                return data.region +'<br/>- '+data.field_office;
            }
            },
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
                /*else if (data.screening_status == '2') {
                    return '<span class="badge badge-info">In-Progress</span>';
                }*/
                else if (data.screening_status == '2') {
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
                if (data.screening_status == '1')
                {
                    if (data.days == '4')// 4 days ago
                    {
                        let color = 'yellow';
                        //return data.created_by +'<br/>'+data.created_at +'<br/>'+data.days +' days ago';
                        return '<span style="background:' + color + '">' + data.created_by +'<br/>'+data.created_at +'<br/>'+data.days +' days ago' + '</span>';
                    }
                    else if (data.days >= '5')
                    {
                        color = 'pink';
                        //return data.created_by +'<br/>'+data.created_at +'<br/>'+data.days +' days ago';
                        return '<span style="background:' + color + '">' + data.created_by +'<br/>'+data.created_at +'<br/>'+data.days +' days ago' + '</span>';
                    }
                    else
                    {
                        return data.created_by +'<br/>'+data.created_at +'<br/>'+data.days +' days ago';
                    }

                }
                else
                {
                    return data.created_by +'<br/>'+data.created_at;
                }

            }
            },
            {
                data: null, render: function (data, type, row) {
                var url_edit = "{{url('/employee_info_edit/')}}";
                var url_screen = "{{url('/screening_add/')}}";
                var url_emp_view = "{{url('/employee_view/')}}";

                if (data.screening_status == '2')
                {
                    return '<a href="'+url_edit+'/'+data.employee_info_id+'" class="btn btn-sm btn-info" data-id="'+data.employee_info_id+'" data-toggle="tooltip" data-placement="bottom" title="Edit Employee"><i class="fas fa-pen-nib"></i></a>&nbsp;'+
                        '<a href="'+url_screen+'/'+data.employee_info_id+'" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Add Screening"><i class="fas fa-plus"></i></a>&nbsp;'+
                        '<a href="'+url_emp_view+'/'+data.employee_info_id+'" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="View Employee Details and Screening"><i class="fas fa-eye"></i></a>'
                }
                else if (data.screening_status == '1')
                {
                    return '<a href="'+url_edit+'/'+data.employee_info_id+'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit Employee"><i class="fas fa-pen-nib"></i></a>&nbsp;'+

                        '<a href="'+url_emp_view+'/'+data.employee_info_id+'" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="View Employee Details and Screening"><i class="fas fa-eye"></i></a>'
                }
                else
                {
                    return '<a href="'+url_edit+'/'+data.employee_info_id+'" class="btn btn-sm btn-info" data-id="'+data.employee_info_id+'" data-toggle="tooltip" data-placement="bottom" title="Edit Employee"><i class="fas fa-pen-nib"></i></a>&nbsp;'+
                            '<a href="'+url_screen+'/'+data.employee_info_id+'" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Add Screening"><i class="fas fa-plus"></i></a>&nbsp;'+
                            '<a href="'+url_emp_view+'/'+data.employee_info_id+'" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="View Employee Details and Screening"><i class="fas fa-eye"></i></a>'
                }
            }
            },

        ],
    });
    //************************************* Data table End ********************************
    var scrolled = 0;
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
    var region_id = $('#region_id', form1);
    var field_office_id = $('#field_office_id', form1);

    var created_by = $('#created_by', form1);
    var gender = $('#gender', form1);
    var type_of_staff = $('#type_of_staff', form1);
    var screening_result = $('#screening_result', form1);
    var screening_status = $('#screening_status', form1);

    form1.submit(function (event) {
        //alert('contract_start_date='+contract_start_date.val()+' contract_end_date= '+contract_end_date.val());

        var url_search = "{{url('/search_employee')}}"
            + '?department_id=' + department_id.val()
            + '&region_id=' + region_id.val()
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
            + '&user_region_id=' + user_region_id
            + '&user_field_office_id=' + user_field_office_id


        console.log(url_search);
        //debugger;
        dataTable.ajax.url(url_search).load();

        //var n = $(document).height();
        $('html, body').animate({ scrollTop: 500 }, 100);
        //App.scrollTo(DataGrid, -200);

        event.preventDefault();
    });

    var btnReset = $('#btnReset');
    btnReset.on('click', function (result) {
        if (confirm("Area you sure want to reset filter values?")) {
            $("#department_id").val('').trigger('change');
            $("#region_id").val('').trigger('change');
            $("#field_office_id").val('').trigger('change');
            $("#designation_id").val('').trigger('change');
            $("#gender").val('').trigger('change');
            $("#screening_result").val('').trigger('change');
            $("#screening_status").val('').trigger('change');

            $("#type_of_staff").val('').trigger('change') ;
            $("#created_by").val('').trigger('change');

            $("#nic").val('').trigger('change');

            $("#contract_start_date").val('').trigger('change');
            $("#contract_end_date").val('').trigger('change');
            $("#created_at_from").val('').trigger('change');
            $("#created_at_to").val('').trigger('change');

            $("#screening_date_from").val('').trigger('change');
            $("#screening_date_to").val('').trigger('change');
        }
    });


    //************************************* Search form and btn End ********************************


    
});

</script>



