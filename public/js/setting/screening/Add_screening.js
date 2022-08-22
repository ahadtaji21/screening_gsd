/**
 * Created by ahad.local on 9/28/2021.
 */

$(document).ready(function () {

    var form1 = $('#AddScreening');




    
    



    FillFieldOfficesDropDown();
    FillCountryDropDown();
    FillNationalityDropDown();
    FillEthnicityDropDown();
    FillDepartmentDropDown();
    FillDesignationDropDown();
    FillUserDropDown();
    FillLineManagerDesignationDropDown();



    //---------- Field Offices -------------//
    function FillFieldOfficesDropDown() {
        var field_office_id = $('#field_office_id', form1);
        Helper_FillFieldOfficesDropDown(field_office_id, "", "All");
        
    }

    //---------- Country -------------//

    function FillCountryDropDown() {
        var country_of_birth = $('#country_of_birth', form1);
        Helper_FillCountryDropDown(country_of_birth, "", "All");
    }

    //---------- Nationality -------------//

    function FillNationalityDropDown() {
        var nationality = $('#nationality', form1);
        Helper_FillCountryDropDown(nationality, "", "All");
    }

    //---------- Ethnicity -------------//

    function FillEthnicityDropDown() {
        var ethnicity = $('#ethnicity', form1);
        Helper_FillCountryDropDown(ethnicity, "", "All");
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
        var on_behalf_user = $('#on_behalf_user', form1);
        Helper_FillUserDropDown(on_behalf_user, "", "All");
    }

    //---------- Line Mnager Designation -------------//

    function FillLineManagerDesignationDropDown() {
        var line_manager_designation = $('#line_manager_designation', form1);
        Helper_FillDesignationDropDown(line_manager_designation, "", "All");
    }
    
});



/*$(function () {
    $.validator.setDefaults({
        submitHandler: function () {
            alert( "Form successful submitted!" );
        }
    });
    $('#AddScreening').validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 5
            },
            terms: {
                required: true
            },
        },
        messages: {
            email: {
                required: "Please enter a email address",
                email: "Please enter a vaild email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});*/
