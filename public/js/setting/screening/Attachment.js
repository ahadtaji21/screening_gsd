/**
 * Created by ahad.local on 9/28/2021.
 */

$(document).ready(function () {

    var form_attachment_nic = $('#Form_Attach_NIC');
    var form_attachment_resume = $('#Form_Attach_Resume');
    var form_attachment_qualification = $('#Form_Attach_Qualification');
    var form_attachment_experience = $('#Form_Attach_Experience');
    var form_attachment_police = $('#Form_Attach_Police');
    var form_attachment_other = $('#Form_Attach_Other');

    var DataGrid = $('#ScreeningGrid');

    // get primary ID from the form
    var screening_detail_id = $('#ShowScreeningDetail #screening_detail_id').val();
    
    
    //************************************ Fill Attachment Section **********************************************
    //FillAttachmentsNIC(screening_detail_id);
    //FhillAttachmentsResume(screening_detail_id);
    //FillAttachmentsQualification(screening_detail_id);
    //FillAttachmentsExperience(screening_detail_id);
    //FillAttachmentsPolice(screening_detail_id);
    //FillAttachmentsOther(screening_detail_id);


    function FillAttachmentsNIC(sdid) {

        var attachment = $('#show_attachment_nic');
        attachment.empty();
        //var url = '/find_attachment_nic/'+sdid;
        var c = document.createDocumentFragment();
        $.ajax({
            type:'GET',
            url: '/find_attachment_nic/',
            dataType: 'json',
            data: {document_id:1, screening_detail_id:sdid},
            success: (function (data) {
                if (data.status == 'success')
                {
                    console.log(data.status);
                    var ul = document.createElement("ul");

                    $.each(data.data, function () {
                        var element = this;
                        //debugger;

                        var li = document.createElement("li");

                        /*var newImage = document.createElement('img');
                        newImage.setAttribute('src', image);
                        newImage.width = 500;
                        newImage.heigth = 200;
                        newImage.innerHTML = newImage.outerHTML;*/


                        var aEdit = document.createElement('a');
                        aEdit.setAttribute('href', 'storage/app/'+element.store_path);
                        aEdit.setAttribute('target', "_blank");
                        aEdit.className = "editAttachment";
                        aEdit.setAttribute('data-daid', element.id);
                        aEdit.innerHTML = element.attachment;

                        // +', Crated by: '+ element.created_user + ', Created at: '+ GetDateAndTimeFormatOnly(element.created_date)

                        var label = document.createElement('small');
                        label.innerHTML =  element.created_by + ', at: '+ GetDateAndTimeFormatOnly(element.created_at);


                        var aDelete = document.createElement('a');

                        if(element.allow_edit == true) {

                            aDelete = document.createElement('a');
                            aDelete.setAttribute('href', "#");
                            aDelete.setAttribute('data-daid', element.id);
                            aDelete.className = "deleteAttachment";
                            aDelete.innerHTML = '<i class="fa fa-trash-o"></i>';
                        }


                        li.append(aEdit, ' ', label, ' ', aDelete);

                        ul.append(li);
                    });

                    c.appendChild(ul);
                    attachment.append(c);
                }


            })
        });
    }

    //************************************ Fill Attachment Section END **********************************************

    //************************************* File Uploading Section **********************************************
    var btnAttachmentNIC = $('#btnAttachmentNIC');
    var btnAttachmentResume = $('#btnAttachmentResume');
    var btnAttachmentQualification = $('#btnAttachmentQualification');
    var btnAttachmentExperience = $('#btnAttachmentExperience');
    var btnAttachmentPolice = $('#btnAttachmentPolice');
    var btnAttachmentOther = $('#btnAttachmentOther');
    
    
    btnAttachmentNIC.on('click', function(e){
        FileUploadNIC();

        e.preventDefault();
    });

    btnAttachmentResume.on('click', function(e){
        FileUploadResume();

        e.preventDefault();
    });

    btnAttachmentQualification.on('click', function(e){
        FileUploadQualification();

        e.preventDefault();
    });

    btnAttachmentExperience.on('click', function(e){
        FileUploadExperience();

        e.preventDefault();
    });

    btnAttachmentPolice.on('click', function(e){
        FileUploadPolice();

        e.preventDefault();
    });

    btnAttachmentOther.on('click', function(e){
        FileUploadOther();

        e.preventDefault();
    });

    
    function FileUploadNIC() {
        var formData = new FormData(document.getElementById("Form_Attach_NIC"));
        var TotalFiles = $('#file_attachment_nic')[0].files.length; //Total files
        var files = $('#file_attachment_nic')[0];
        for (var i = 0; i < TotalFiles; i++) {
            formData.append('files' + i, files.files[i]);
        }
        formData.append('TotalFiles', TotalFiles);
        formData.append('screening_detail_id', screening_detail_id);

        $.ajax({
            type:'POST',
            url: "{{/save_attachment_nic",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (function (data) {
                location.reload();
                console.log(data);
                if (data.status == 'success')
                {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'File has been uploaded'
                    });
                }


            })
        });
    }//---- func End


    function FileUploadResume() {
        var formData = new FormData(document.getElementById("Form_Attach_Resume"));
        var TotalFiles = $('#file_attachment_resume')[0].files.length; //Total files
        var files = $('#file_attachment_resume')[0];
        for (var i = 0; i < TotalFiles; i++) {
            formData.append('files' + i, files.files[i]);
        }
        formData.append('TotalFiles', TotalFiles);
        formData.append('screening_detail_id', screening_detail_id);

        $.ajax({
            type:'POST',
            url: "/save_attachment_resume",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (function (data) {
                location.reload();
                console.log(data);
                if (data.status == 'success')
                {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });


                    Toast.fire({
                        icon: 'success',
                        title: 'File has been uploaded'
                    });
                }


            })
        });
    }//---- func End

    function FileUploadQualification() {
        var formData = new FormData(document.getElementById("Form_Attach_Qualification"));
        var TotalFiles = $('#file_attachment_qualification')[0].files.length; //Total files
        var files = $('#file_attachment_qualification')[0];
        for (var i = 0; i < TotalFiles; i++) {
            formData.append('files' + i, files.files[i]);
        }
        formData.append('TotalFiles', TotalFiles);
        formData.append('screening_detail_id', screening_detail_id);

        $.ajax({
            type:'POST',
            url: "/save_attachment_qualification",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (function (data) {
                location.reload();
                console.log(data);
                if (data.status == 'success')
                {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });


                    Toast.fire({
                        icon: 'success',
                        title: 'File has been uploaded'
                    });
                }


            })
        });
    }//---- func End

    function FileUploadPolice() {
        var formData = new FormData(document.getElementById("Form_Attach_Police"));
        var TotalFiles = $('#file_attachment_police')[0].files.length; //Total files
        var files = $('#file_attachment_police')[0];
        for (var i = 0; i < TotalFiles; i++) {
            formData.append('files' + i, files.files[i]);
        }
        formData.append('TotalFiles', TotalFiles);
        formData.append('screening_detail_id', screening_detail_id);

        $.ajax({
            type:'POST',
            url: "/save_attachment_police",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (function (data) {
                location.reload();
                console.log(data);
                if (data.status == 'success')
                {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });


                    Toast.fire({
                        icon: 'success',
                        title: 'File has been uploaded'
                    });
                }


            })
        });
    }//---- func End

    function FileUploadExperience() {
        var formData = new FormData(document.getElementById("Form_Attach_Experience"));
        var TotalFiles = $('#file_attachment_experience')[0].files.length; //Total files
        var files = $('#file_attachment_experience')[0];
        for (var i = 0; i < TotalFiles; i++) {
            formData.append('files' + i, files.files[i]);
        }
        formData.append('TotalFiles', TotalFiles);
        formData.append('screening_detail_id', screening_detail_id);

        $.ajax({
            type:'POST',
            url: "/save_attachment_experience",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (function (data) {
                location.reload();
                console.log(data);
                if (data.status == 'success')
                {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });


                    Toast.fire({
                        icon: 'success',
                        title: 'File has been uploaded'
                    });
                }


            })
        });
    }//---- func End

    function FileUploadOther() {
        var formData = new FormData(document.getElementById("Form_Attach_Other"));
        var TotalFiles = $('#file_attachment_other')[0].files.length; //Total files
        var files = $('#file_attachment_other')[0];
        for (var i = 0; i < TotalFiles; i++) {
            formData.append('files' + i, files.files[i]);
        }
        formData.append('TotalFiles', TotalFiles);
        formData.append('screening_detail_id', screening_detail_id);

        $.ajax({
            type:'POST',
            url: "/save_attachment_other",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (function (data) {
                location.reload();
                console.log(data);
                if (data.status == 'success')
                {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });


                    Toast.fire({
                        icon: 'success',
                        title: 'File has been uploaded'
                    });
                }


            })
        });
    }//---- func End
    //************************************* File Uploading Section END **********************************************



    //************************************* File Delete Section *************************************************
    $('body').on('click', 'a.deleteAttachment', function() {
        var document_id = $(this).data('id');

        /*if(confirm("Area you sure want to delete?")) {
            DeleteAttachment(document_id);
        }*/

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function (result) {
            if (result.isConfirmed)
            {
                DeleteAttachment(document_id)
            }
        });
    });

    function DeleteAttachment(id) {
        //var formData = new FormData();
        //formData.append('disciplinary_attachment_id', id);

        //var url = "/delete_attachment_nic/"+id;
        $.ajax({
            type:'GET',
            url: '/delete_attachment/'+id,
            dataType: 'json',
            success: (function (data) {
                if (data.status == 'success')
                {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    });


                    Toast.fire({
                        icon: 'success',
                        title: 'Attachment has been deleted'
                    });
                    
                    location.reload();
                }
            })
        });
    }

    //************************************* File Delet Section END **********************************************



    
    
    
}); //--- document ready end





