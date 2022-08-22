<script>
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
    var validLifeTime = $('#valid_for_life_time').val();

    if(validLifeTime == 'Yes')
    {
        $('#Form_Attach_NIC #expiry_date').attr('disabled', true);
    }
    else if(validLifeTime == 'No')
    {
        $('#Form_Attach_NIC #expiry_date').attr('disabled', false);
    }
    else
    {
        $('#Form_Attach_NIC #expiry_date').attr('disabled', false);
    }


    var DataGrid = $('#ScreeningGrid');

    // get primary ID from the form
    var screening_detail_id = $('#ShowScreeningDetail #screening_detail_id').val();


    $("#Form_Attach_NIC #valid_for_life_time").on('click', function(){
        if($(this).is(':checked'))
        {
            $('#Form_Attach_NIC #expiry_date').attr('disabled', true);
        } 
        else
        {
            $('#Form_Attach_NIC #expiry_date').attr('disabled', false);
        }
    });
    
    
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
            url: "{{url('/find_attachment_nic/')}}",
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
        //var expiryDate = $('#Form_Attach_NIC #expiry_date').val(moment().format('YYYY-MM-DD'));
        //var expiryDateVal = document.getElementById("expiry_date").value;
        
        var expiryDateVal = $("input[type=date]").val();
        var fileVal = $('#Form_Attach_NIC #file_attachment_nic').val().length;
        var validLifeTimeVal = $('#Form_Attach_NIC #valid_for_life_time').val();
        
        // if ($('#valid_for_life_time').is(":checked"))
        // {
        //     alert('checked');
        // }
        // else
        // {
        //     alert('not checked');   
        // }
        
        
        // alert(expiryDateVal);

        if(fileVal > 0)
        {
            if($('#valid_for_life_time').is(":checked"))
            {
                // alert('1');
                FileUploadNIC();
            }
            else
            {
                if(expiryDateVal == '')
                {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        icon: 'warning',
                        title: 'Please select expiry date or check the checkbox if NIC is valid for life time'
                    });
                }
                else
                {
                    // alert('2');
                    FileUploadNIC();
                }
            }
        }
        else
        {
            var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
            });

            Toast.fire({
                icon: 'error',
                title: 'Please Select File'
            });
        }
        //FileUploadNIC();

        e.preventDefault();
    });

    btnAttachmentResume.on('click', function(e){

        var fileResumeVal = $('#Form_Attach_Resume #file_attachment_resume').val().length;

        if(fileResumeVal > 0)
        {
            FileUploadResume();
        }
        else
        {
            var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
            });

            Toast.fire({
                icon: 'error',
                title: 'Please Select File'
            });
        }
        // FileUploadResume();

        e.preventDefault();
    });

    btnAttachmentQualification.on('click', function(e){
        var fileQualVal = $('#Form_Attach_Qualification #file_attachment_qualification').val().length;

        if(fileQualVal > 0)
        {
            FileUploadQualification();
        }
        else
        {
            var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
            });

            Toast.fire({
                icon: 'error',
                title: 'Please Select File'
            });
        }

        // FileUploadQualification();

        e.preventDefault();
    });

    btnAttachmentExperience.on('click', function(e){
        var fileExpVal = $('#Form_Attach_Experience #file_attachment_experience').val().length;

        if(fileExpVal > 0)
        {
            FileUploadExperience();
        }
        else
        {
            var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
            });

            Toast.fire({
                icon: 'error',
                title: 'Please Select File'
            });
        }

        // FileUploadExperience();

        e.preventDefault();
    });

    btnAttachmentPolice.on('click', function(e){
        var filePoliceVal = $('#Form_Attach_Police #file_attachment_police').val().length;

        if(filePoliceVal > 0)
        {
            FileUploadPolice();
        }
        else
        {
            var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
            });

            Toast.fire({
                icon: 'error',
                title: 'Please Select File'
            });
        }
        // FileUploadPolice();

        e.preventDefault();
    });

    btnAttachmentOther.on('click', function(e){
        var fileOtherVal = $('#Form_Attach_Other #file_attachment_other').val().length;

        if(fileOtherVal > 0)
        {
            FileUploadOther();
        }
        else
        {
            var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
            });

            Toast.fire({
                icon: 'error',
                title: 'Please Select File'
            });
        }
        // FileUploadOther();

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
            url: "{{url('/save_attachment_nic')}}",
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


            }),
            error: (function(data) {
                console.log(data);
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                // var expiryDate = $('#Form_Attach_NIC #expiry_date').val();
                // alert(expiryDate);
                // if(expiryDate == "")
                // {                    
                //     Toast.fire({
                //     icon: 'error',
                //     title: 'Please enter expiry date'
                //     });
                    
                //     $('#Form_Attach_NIC #expiry_date').css( {'background-color': 'red', 'border': '1px'} );
                // }
                // else
                // {
                //     Toast.fire({
                //     icon: 'error',
                //     title: 'Your file size is more than 2mb'
                //     });
                // }


                Toast.fire({
                    icon: 'error',
                    title: 'Your file size is more than 2mb'
                });
            }),
            
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
            url: "{{url('/save_attachment_resume')}}",
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


            }),
            error: function(error) {

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });


                Toast.fire({
                    icon: 'error',
                    title: 'Your file size is more than 2mb'
                });
            }
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
            url: "{{url('/save_attachment_qualification')}}",
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


            }),
            error: function(error) {

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });


                Toast.fire({
                    icon: 'error',
                    title: 'Your file size is more than 2mb'
                });
            }
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
            url: "{{url('/save_attachment_police')}}",
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


            }),
            error: function(error) {

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });


                Toast.fire({
                    icon: 'error',
                    title: 'Your file size is more than 2mb'
                });
            }
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
            url: "{{url('/save_attachment_experience')}}",
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


            }),
            error: function(error) {

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });


                Toast.fire({
                    icon: 'error',
                    title: 'Your file size is more than 2mb'
                });
            }
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
            url: "{{url('/save_attachment_other')}}",
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


            }),
            error: function(error) {

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });


                Toast.fire({
                    icon: 'error',
                    title: 'Your file size is more than 2mb'
                });
            }
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
        var url = '{{ route("delete_attachment", ":id") }}';
        url = url.replace(':id', id );
        $.ajax({
            type:'GET',
            url: url,
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



</script>

