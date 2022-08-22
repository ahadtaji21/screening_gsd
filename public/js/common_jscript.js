//---- AJAX Default Function -----------
//**************************************

function GetDateAndTimeFormatOnly(date) {
  if(date === null || date === '' || date === '0000-00-00 00:00:00') return ' ';
  return (moment(date).format("DD-MMM-YYYY HH:mm"));
}


function GetAjax(dataUrl, callback, params, showLoading) {
  if(showLoading === undefined) {
    showLoading = true;
  }

  if(showLoading) {
    //ShowAjaxLoader();
  }

  $.ajaxQueue({
    url: dataUrl,
    type: "GET",
    accepts: 'application/json',
    cache: true,
    dataType: 'jsonp',
    success: function (data) {
      if(showLoading) {
        //HideAjaxLoader();
      }

      if (callback) {
        callback(data, params);
      }
    },
    error: function (jqXHR, exception) {
      var msg = '';
      if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
      } else if (jqXHR.status === 404) {
        msg = 'Requested page not found. [404]';
      } else if (jqXHR.status === 500) {
        msg = 'Internal Server Error [500].';
      } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
      } else if (exception === 'timeout') {
        msg = 'Time out error.';
      } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
      } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
      }
      console.log(msg);
      //loader.modal('hide');
      //alert(msg);
      //if(showLoading) {
      //    HideAjaxLoader();
      //}

    },
  });
}

function SaveAjax(postData, dataUrl, callback) {

  //ShowAjaxLoader();

  $.ajaxQueue({
    url: dataUrl,
    type: "POST",
    data: postData,
    accepts: 'application/json',
    cache: false,
    dataType: 'jsonp',
    processData: false,
    contentType: false, //'multipart/form-data',

    success: function (data) {
      //HideAjaxLoader();
      if (callback) {
        callback(data);
      }
    },
    error: function (jqXHR, exception) {
      var msg = '';
      if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
      } else if (jqXHR.status === 404) {
        msg = 'Requested page not found. [404]';
      } else if (jqXHR.status === 500) {
        msg = 'Internal Server Error [500].';
      } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
      } else if (exception === 'timeout') {
        msg = 'Time out error.';
      } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
      } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
      }
      //HideAjaxLoader();
    },
  });
}

function DeleteAjax(postData, dataUrl, callback) {

  //ShowAjaxLoader();

  $.ajaxQueue({
    url: dataUrl,
    type: "POST",
    data: postData,
    accepts: 'application/json',
    cache: false,
    dataType: 'jsonp',

    success: function (data) {
      //HideAjaxLoader();
      if (callback) {
        callback(data);
      }
    },
    error: function (jqXHR, exception) {
      var msg = '';
      if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
      } else if (jqXHR.status === 404) {
        msg = 'Requested page not found. [404]';
      } else if (jqXHR.status === 500) {
        msg = 'Internal Server Error [500].';
      } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
      } else if (exception === 'timeout') {
        msg = 'Time out error.';
      } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
      } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
      }
      //HideAjaxLoader();
    },
  });
}

////////////////////////////////////////
//****************************************

var handleDateTime = function () {
  if (jQuery().datepicker) {
    $('.date-picker').datepicker({
      rtl: App.isRTL(),
      format: 'dd-M-yyyy',
      autoclose: true
    });
    $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    //$(".datepicker").css("z-index", "10300");
  }
};




//----------------------- Drop Down function ------------------------------------------------
//*******************************************************************************************

function Helper_FillFieldOfficesDropDownold(field_office_id, all_value, all_text, callback) {

  if(all_value === undefined) {
    all_value = "";
  }
  if(all_text === undefined) {
    all_text = "All";
  }
  //var url = baseApiUrl + "employee_management/all_departments/";

  field_office_id.empty();
  field_office_id.append($('<option/>').attr("value", all_value).text(all_text));
  //field_office_id.append($("<option     />").val(all_value).text(all_text));
  //field_office_id.select2('val', all_value);

  var data = [
    {
      id: "1",
      name: "Afghanistan",
      Acronyme:"AF"

    },
    {
      id: "2",
      name: "Albania",
      Acronyme:"AL"
    },
    {
      id: "3",
      name: "Bangladesh",
      Acronyme:"BD"
    },
    {
      id: "4",
      name: "Bosnia",
      Acronyme:"BA"

    },
    {
      id: "5",
      name: "Chad",
      Acronyme:"TD"
    },
    {
      id: "6",
      name: "Ethiopia",
      Acronyme:"ET"
    },
    {
      id: "7",
      name: "Indonesia",
      Acronyme:"ID"

    },
    {
      id: "8",
      name: "Iraq",
      Acronyme:"IQ"
    },
    {
      id: "9",
      name: "Jordan",
      Acronyme:"JO"
    },
    {
      id: "10",
      name: "Kenya",
      Acronyme:"KE"

    },
    {
      id: "11",
      name: "Kosovo",
      Acronyme:"KS"
    },
    {
      id: "12",
      name: "Lebanon",
      Acronyme:"LB"
    },
    {
      id: "13",
      name: "Malawi",
      Acronyme:"MW"

    },
    {
      id: "14",
      name: "Mali",
      Acronyme:"ML"
    },
    {
      id: "15",
      name: "Myanmar",
      Acronyme:"MM"
    },
    {
      id: "16",
      name: "Nepal",
      Acronyme:"NP"

    },
    {
      id: "17",
      name: "Niger",
      Acronyme:"NE"
    },
    {
      id: "18",
      name: "Pakistan",
      Acronyme:"PK"
    },
    {
      id: "19",
      name: "Philippines",
      Acronyme:"PH"

    },
    {
      id: "20",
      name: "Somalia",
      Acronyme:"SO"
    },
    {
      id: "21",
      name: "South Sudan",
      Acronyme:"SS"
    },
    {
      id: "22",
      name: "Sri Lanka",
      Acronyme:"LK"

    },
    {
      id: "23",
      name: "Sudan",
      Acronyme:"SD"
    },
    {
      id: "24",
      name: "Syria",
      Acronyme:"SY"
    },
    {
      id: "25",
      name: "Tunisia",
      Acronyme:"TN"

    },
    {
      id: "26",
      name: "Turkey",
      Acronyme:"TR"
    },
    {
      id: "27",
      name: "Yemen",
      Acronyme:"YE"
    },
  ];
  
  $.each(data, function(i, option) {
    field_office_id.append($('<option/>').attr("value", option.id).text(option.Acronyme+' - '+option.name));
  });

  if(callback !== undefined) {
    callback.call();
  }
}


function Helper_FillCountryDropDownold(country_of_birth, all_value, all_text, callback) {
  if(all_value === undefined) {
    all_value = "";
  }
  if(all_text === undefined) {
    all_text = "All";
  }
  //var url = "/fillCountryDropDown";

  country_of_birth.empty();
  country_of_birth.append($('<option/>').attr("value", all_value).text(all_text));
  //field_office_id.append($("<option     />").val(all_value).text(all_text));
  //field_office_id.select2('val', all_value);

  $.ajax({
    url: "/fillCountryDropDown",
    type: 'get',
    dataType: 'json',
    success: function(response){

      if (response.data !== null) {

        $.each(response.data, function (i, option) {
          country_of_birth.append($('<option/>').attr("value", option.id).text(option.name));
        });
      }
      if (callback !== undefined) {
        callback.call();
      }
    }
  });
  if(callback !== undefined) {
    callback.call();
  }
}


function Helper_FillDepartmentDropDownold(department, all_value, all_text, callback) {
  if(all_value === undefined) {
    all_value = "";
  }
  if(all_text === undefined) {
    all_text = "All";
  }
  //var url = "/fillCountryDropDown";

  department.empty();
  department.append($('<option/>').attr("value", all_value).text(all_text));
  //field_office_id.append($("<option     />").val(all_value).text(all_text));
  //field_office_id.select2('val', all_value);

  $.ajax({
    url: "/fillDepartmentDropDown",
    type: 'get',
    dataType: 'json',
    success: function(response){

      if (response.data !== null) {

        $.each(response.data, function (i, option) {
          department.append($('<option/>').attr("value", option.id).text(option.name));
        });
      }
      if (callback !== undefined) {
        callback.call();
      }
    }
  });
  if(callback !== undefined) {
    callback.call();
  }
}

function Helper_FillDesignationDropDownold(designation, all_value, all_text, callback) {
  if(all_value === undefined) {
    all_value = "";
  }
  if(all_text === undefined) {
    all_text = "All";
  }
  //var url = "/fillCountryDropDown";

  designation.empty();
  designation.append($('<option/>').attr("value", all_value).text(all_text));
  //field_office_id.append($("<option     />").val(all_value).text(all_text));
  //field_office_id.select2('val', all_value);

  $.ajax({
    url: "/fillDesignationDropDown",
    type: 'get',
    dataType: 'json',
    success: function(response){

      if (response.data !== null) {

        $.each(response.data, function (i, option) {
          designation.append($('<option/>').attr("value", option.id).text(option.name));
        });
      }
      if (callback !== undefined) {
        callback.call();
      }
    }
  });
  if(callback !== undefined) {
    callback.call();
  }
}


function Helper_FillUserDropDownold(user, all_value, all_text, callback, url) {
  if(all_value === undefined) {
    all_value = "";
  }
  if(all_text === undefined) {
    all_text = "All";
  }
  //var url = "/fillCountryDropDown";

  user.empty();
  user.append($('<option/>').attr("value", all_value).text(all_text));
  //field_office_id.append($("<option     />").val(all_value).text(all_text));
  //field_office_id.select2('val', all_value);

  $.ajax({
    url: "/fillUserDropDown",
    type: 'get',
    dataType: 'json',
    success: function(response){

      if (response.data !== null) {

        $.each(response.data, function (i, option) {
          user.append($('<option/>').attr("value", option.id).text(option.name));
        });
      }
      if (callback !== undefined) {
        callback.call();
      }
    }
  });
  if(callback !== undefined) {
    callback.call();
  }
}