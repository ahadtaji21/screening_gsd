/**
 * Created by ahad.local on 9/17/2021.
 */
var User_search = function () {

    var DataGrid = $('#UserGrid');

    var loadGridUrl =  "{{url('/show_user_list')}}";

    var dataTable = null;
    var loadGrid = function () {
        alert('called');

        var url = loadGridUrl;

        dataTable = DataGrid.DataTable({
            dom: "Blfrtip",
            aaSorting: [], //disabled initial sorting
            ajax: url,
            paging: true,
            searching: true,
            info: true,

            processing: true,
            serverSide: false,
            lengthMenu: [[25, 50, 100, 200, 500], [25, 50, 100, 200, 500]],
            pageLength: 25,


            "columnDefs": [
                {"width": "13%", "targets": 4, "class":'word-wrap'},
            ],

            buttons: [
                {extend: "csv"}
            ],

            columns: [
                //Table Column Header Collection

                {data: "id"},
                {data: "name"},
                {data: "field_office"},

                {data: "department"},
                {data: "designation"},
                {data: "email"},
                {data: "role"},
                //{data: "is_locked"},
                {
                    data: null, render: function (data, type, row) {
                    if (data.is_locked == '1') {
                        return '<span class="label label-warning label-sm">Pending</span>';
                    }
                    else if (data.is_locked == '2') {
                        return '<span class="label label-success label-sm">Unlock</span>';
                    }
                    else if (data.is_locked == '3') {
                        return '<span class="label label-danger label-sm">Locked</span>';
                    }
                }
                },
                {data: "created_at"},
                {
                    data: null, render: function (data, type, row) {
                    // Combine the first and last names into a single table field

                    if(user_id==1 || user_id==21) {

                        return '<a href="#" class="btn btn-gray btn-xs purple editView" title="Edit" data-id="' + data.user_id + '"><i class="fa fa-edit"></i> Edit</a>' +
                            '| <a href="#" class="btn btn-warning btn-xs purple deleteView" title="Delete" data-id="' + data.user_id + '"><i class="fa fa-trash-o"></i> Delete</a>';

                    }else {
                        return '';
                    }
                }
                },

            ],
        });

        $("#UserGrid_tools > li > a.tool-action").on("click", function () {
            var e = $(this).attr("data-action");
            dataTable.button(e).trigger();
        });

        $(".dt-buttons").hide();

        jQuery('#UserGrid_wrapper .dataTables_filter input').addClass("form-control input-small"); // modify table search input
        jQuery('#UserGrid_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        jQuery('#UserGrid_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
    }


    var reloadGrid = function () {
        //debugger;
        dataTable.ajax.reload(null, false);
    }



    return {
        //main function to initiate the module,
        init: function () {


            //Grid loading
            if (!jQuery().dataTable) {
                return;
            }
            loadGrid();
        },
        reloadGrid: function () {
            reloadGrid();
        }
    };
}();

