<script>
    /**
     * Created by ahad.local on 9/28/2021.
     */

$(document).ready(function () {

    //var current_url = window.location.href;
    //var sdid = current_url.substring(current_url.lastIndexOf('/') + 1);
    var sdid = $('#screening_detail_id').val();
    //alert(sdid);

    if (sdid > 0)
    {
        FillComments(sdid);
    }

    //-----------------------------------------------------------------------------------
    // ************* Fill Comments of Screening *****************************************
    function FillComments(sdid){
        //debugger;

        var feedback = $('#feedback');
        feedback.empty();

        var c = document.createDocumentFragment();

        $.ajax({
            type:'GET',
            url: "{{url('/find_screening_comments/')}}",
            dataType: 'json',
            data: {screening_detail_id:sdid},
            success: (function (data) {
                if (data.status == 'success')
                {
                    //console.log(data.data);
                    //var ul = document.createElement("ul");

                    $.each(data.data, function (index) {
                        var element = data.data;
                        //console.log(element[index].created_by);

                        var e = document.createElement("blockquote");

                        //Created by and time
                        var small = document.createElement('small');

                        var desc = "";

                        /*var span = document.createElement('span');
                         span.className = "label label-sm label-gray";

                         if(element.disciplinary_status_id !== null) {
                         span.append(element.status_description);

                         //debugger;
                         //desc = desc + ' '+GetDateAndTimeFormatOnly(element.status_date) +' :: ';
                         }*/

                        desc = desc + ' Created By: '+ element[index].created_by +', Created Date: '+GetDateAndTimeFormatOnly(element[index].created_at);

                        //small.append(span, desc);
                        small.append(desc);


                        var div = document.createElement('div');
                        div.className = "pull-right";


                        if(element[index].allow_edit == true) {
                            //Edit and delete

                            var aEdit = document.createElement('a');
                            aEdit.setAttribute('href', "#");
                            aEdit.className = "editView";
                            aEdit.setAttribute('data-screening_comment_id', element[index].id);
                            aEdit.innerHTML = '<i class="fas fa-pen-nib"></i> Edit ';

                            var aDelete = document.createElement('a');
                            aDelete.setAttribute('href', "#");
                            aDelete.setAttribute('data-screening_comment_id', element[index].id);
                            aDelete.className = "deleteView";
                            aDelete.innerHTML = '<i class="fas fa-trash"></i> Delete';

                            //div.append(aEdit);
                            div.append(aDelete);
                        }
                        //debugger;
                        var d = element[index].description_comment;

                        //var text =  $(d).text()

                        //d = jQuery.parseHTML(d);
                        d = '<p style="page-break-before: always">'+d+'</p>';
                        var text =  $(d).text();

                        //debugger;
                        e.append(small, div, text);
                        c.appendChild(e);
                    });
                    feedback.append(c);
                }


            })
        });
    }
    //---------------------------------------------------------------------------------------------

    var description_comment = $('#description_comment');
    description_comment.keyup(function() {
        var content = description_comment.val();

        if(content === ""){
            btnAddComment.attr('disabled', 'disabled');
        }else{
            btnAddComment.removeAttr('disabled');
        }
    });

    var btnAddComment = $('#btnAddComment');
    btnAddComment.on('click', function(result){
        InsertComment();
    });

    //-----------------------------------------------------------------------------------------------------
    //****************** Insert comment ****************************************************************
    function InsertComment() {

        var id = $('#screening_detail_id').val();
        var description_text = $('#description_comment').val();

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', 0);
        formData.append('screening_detail_id', id);
        formData.append('description_comment', description_text);

        $.ajax({
            type:'POST',
            url: "{{url('/save_screening_comments/')}}",
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: (function (data) {
                if (data.status == 'success')
                {
                    //debugger;
                    SentEmailInsertComment(id,description_text);
                    location.reload();
                    $('#description_comment').val('');

                    $('html, body').animate({ scrollTop: 1200 }, 700);
                    btnAddComment.attr('disabled', 'disabled');
                    //debugger;

                }
            })
        });
    }

    function SentEmailInsertComment(screening_detail_id, description_text) {
        event.preventDefault();


        $.ajax({
            type:'GET',
            url: "{{url('/send_email_insert_comment/')}}",
            dataType: 'json',
            data: {'screening_detail_id':screening_detail_id, 'description_comment':description_text},
            //processData: false,
            //contentType: false,
            success: (function (data) {
                if (data.status == 'success')
                {
                    /*alert(data.status);
                    location.reload();*/

                }
            })
        });
    }
    //-------------------------------------------------------------------------------------------
    $('body').on('click', 'a.deleteView', function() {

        var screening_comment_id = $(this).data('screening_comment_id');


        if(confirm("Area you sure want to delete?")) {
            DeleteComment(screening_comment_id);
        }
    });


    function DeleteComment(screening_comment_id) {

        //var id = screening_comment_id;
        //alert(id);
        //var formData = new FormData();
        //formData.append('id', id);

        //var url = deleteCommentUrl;
        $.ajax({
            type:'GET',
            url: "{{url('/delete_screening_comments/')}}",
            dataType: 'json',
            data: {id:screening_comment_id},
            //processData: false,
            //contentType: false,
            success: (function (data) {
                if (data.status == 'success')
                {
                    location.reload(true);
                    $('#description_comment').val('');
                    btnAddComment.attr('disabled', 'disabled');
                    $('html, body').animate({ scrollTop: 1200 }, 1000);
                }
            })
        });
    }
    
    
}); //--- document ready end



</script>

