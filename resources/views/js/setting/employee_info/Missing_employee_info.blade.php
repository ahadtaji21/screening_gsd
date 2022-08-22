<script>

    /**
     * Created by ahad.local on 9/28/2021.
     */

$(document).ready(function () {

    var form1 = $('#SearchMissingEmp');
    var DataGrid = $('#MissingEmpGrid');

    var user_region_id = $('#user_region_id').val();
    var user_field_office_id = $('#user_field_office_id').val();
    var created_by = $('#created_by').val();
    
    //alert(screening_status);


    
    //******************* Data table Grid *******************************

    if (created_by != '')
    {
        var url = "{{url('/search_missing_employee')}}"
                + '?created_by=' + created_by;
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

            //{data: "employee_name"},
            {
                data: null, render: function (data, type, row) {
                var url_emp_view = "{{url('/employee_view/')}}";
                return '<a href="'+url_emp_view+'/'+data.employee_info_id+'">'+data.employee_name +' '+ data.employee_surname+'</i></a>';
            }
            },
            {data: "gender"},
            {data: "nic"},

            {data: "dob"},
            {data: "email"},
            {data: "nationality"},
            {data: "ethnicity"},
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

            {
                data: null, render: function (data, type, row) {
                return data.created_by +'<br/>'+data.created_at;
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

    var created_at_from = $('#created_at_from', form1);
    var created_at_to = $('#created_at_to', form1);
    
    var gender = $('#gender', form1);
    var screening_status = $('#screening_status', form1);

    form1.submit(function (event) {
        //alert('contract_start_date='+contract_start_date.val()+' contract_end_date= '+contract_end_date.val());

        var url_search = "{{url('/search_missing_employee')}}"
            + '?gender=' + gender.val()
            + '&screening_status=' + screening_status.val()
            + '&nic=' + nic.val()
            + '&created_at_from=' + created_at_from.val()
            + '&created_at_to=' + created_at_to.val()
            + '&created_by=' + created_by;


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
            $("#gender").val('').trigger('change');
            $("#screening_status").val('').trigger('change');

            $("#nic").val('').trigger('change');
            $("#created_at_from").val('').trigger('change');
            $("#created_at_to").val('').trigger('change');
        }
    });


    //************************************* Search form and btn End ********************************


    
});

</script>



