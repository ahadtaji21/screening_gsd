<script>
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


function Helper_FillRegionsDropDown(region_id, all_value, all_text, callback) {

  if(all_value === undefined) {
    all_value = "";
  }
  if(all_text === undefined) {
    all_text = "All";
  }
  //var url = baseApiUrl + "employee_management/all_departments/";

  region_id.empty();
  region_id.append($('<option/>').attr("value", all_value).text(all_text));
  //field_office_id.append($("<option     />").val(all_value).text(all_text));
  //field_office_id.select2('val', all_value);

  var data = [
    {
      id: "1",
      name: "Asia",

    },
    {
      id: "2",
      name: "West Africa",
    },
    {
      id: "3",
      name: "East Africa",
    },
    {
      id: "4",
      name: "MENAEE",

    },
  ];

  $.each(data, function(i, option) {
    region_id.append($('<option/>').attr("value", option.id).text(option.name));
  });

  if(callback !== undefined) {
    callback.call();
  }
}

function Helper_FillRegionsByUserRegionDropDown(user_region_id, region_id, all_value, all_text, callback) {

  if(all_value === undefined) {
    all_value = "";
  }
  if(all_text === undefined) {
    all_text = "All";
  }
  //var url = baseApiUrl + "employee_management/all_departments/";

  region_id.empty();
  region_id.append($('<option/>').attr("value", all_value).text(all_text));
  //field_office_id.append($("<option     />").val(all_value).text(all_text));
  //field_office_id.select2('val', all_value);

  if (user_region_id == 1)
  {
    var data = [
      {
        id: "1",
        name: "Asia"

      }
    ];
  }
  else if (user_region_id == 2)
  {
    var data = [
      {
        id: "2",
        name: "West Africa"
      }
    ];
  }
  else if (user_region_id == 3)
  {
    var data = [
      {
        id: "3",
        name: "East Africa"
      }
    ];
  }
  else if (user_region_id == 4)
  {
    var data = [
      {
        id: "4",
        name: "MENAEE"
      }
    ];
  }


  $.each(data, function(i, option) {
    region_id.append($('<option/>').attr("value", option.id).text(option.name));
  });

  if(callback !== undefined) {
    callback.call();
  }
}


function Helper_FillFieldOfficesByUserFieldOfficeDropDown(user_field_office_id, field_office_id, all_value, all_text, callback) {
  if(all_value === undefined) {
    all_value = "";
  }
  if(all_text === undefined) {
    all_text = "All";
  }
  //var url = "/fillCountryDropDown";

  field_office_id.empty();
  field_office_id.append($('<option/>').attr("value", all_value).text(all_text));
  //field_office_id.append($("<option     />").val(all_value).text(all_text));
  //field_office_id.select2('val', all_value);

  var data = {
    "user_field_office_id": user_field_office_id
  };
  $.ajax({
    url: "{{url('/fillUserFieldOfficeDropDown')}}",
    type: 'get',
    dataType: 'json',
    data: data,
    success: function(response){

      if (response.data !== null) {

        $.each(response.data, function (i, option) {
          field_office_id.append($('<option/>').attr("value", option.id).text(option.acronym+' - '+option.name));
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


function Helper_FillFieldOfficesDropDown(region_id, field_office_id, all_value, all_text, callback) {

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
      Acronym:"AF"

    },
    {
      id: "2",
      name: "Albania",
      Acronym:"AL"
    },
    {
      id: "3",
      name: "Bangladesh",
      Acronym:"BD"
    },
    {
      id: "4",
      name: "Bosnia",
      Acronym:"BA"

    },
    {
      id: "5",
      name: "Chad",
      Acronym:"TD"
    },
    {
      id: "6",
      name: "China",
      Acronym:"CN"
    },
    {
      id: "7",
      name: "Ethiopia",
      Acronym:"ET"
    },
    {
      id: "8",
      name: "India",
      Acronym:"IN"
    },
    {
      id: "9",
      name: "Indonesia",
      Acronym:"ID"

    },
    {
      id: "10",
      name: "Iraq",
      Acronym:"IQ"
    },
    {
      id: "11",
      name: "Jordan",
      Acronym: "JO"
    },
    {
      id: "12",
      name: "Kenya",
      Acronym:"KE"

    },
    {
      id: "13",
      name: "Kosovo",
      Acronym:"KS"
    },
    {
      id: "14",
      name: "Lebanon",
      Acronym:"LB"
    },
    {
      id: "15",
      name: "Malawi",
      Acronym:"MW"

    },
    {
      id: "16",
      name: "Mali",
      Acronym:"ML"
    },
    {
      id: "17",
      name: "Myanmar",
      Acronym:"MM"
    },
    {
      id: "18",
      name: "Nepal",
      Acronym:"NP"

    },
    {
      id: "19",
      name: "Niger",
      Acronym:"NE"
    },
    {
      id: "20",
      name: "Pakistan",
      Acronym:"PK"
    },
    {
      id: "21",
      name: "Palestine Gaza",
      Acronym:"PS-G"
    },
    {
      id: "22",
      name: "Palestine West Bank",
      Acronym:"PS-W"
    },
    {
      id: "23",
      name: "Philippines",
      Acronym:"PH"

    },
    {
      id: "24",
      name: "Russian Federation",
      Acronym:"RU"

    },
    {
      id: "25",
      name: "Somalia",
      Acronym:"SO"
    },
    {
      id: "26",
      name: "South Sudan",
      Acronym:"SS"
    },
    {
      id: "27",
      name: "Sri Lanka",
      Acronym:"LK"

    },
    {
      id: "28",
      name: "Sudan",
      Acronym:"SD"
    },
    {
      id: "29",
      name: "Syria",
      Acronym:"SY"
    },
    {
      id: "30",
      name: "Tunisia",
      Acronym:"TN"

    },
    {
      id: "31",
      name: "Turkey",
      Acronym:"TR"
    },
    {
      id: "32",
      name: "Yemen",
      Acronym:"YE"
    },
  ];
  
  $.each(data, function(i, option) {
    field_office_id.append($('<option/>').attr("value", option.id).text(option.Acronym+' - '+option.name));
  });

  if(callback !== undefined) {
    callback.call();
  }
}

function Helper_FillFieldOfficesByRegionDropDown(region_id, field_office_id, all_value, all_text, callback) {

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

  if (region_id == 1)//Asia
  {
    var data = [
      {
        id: "1",
        name: "Afghanistan",
        Acronym:"AF"

      },
      {
        id: "3",
        name: "Bangladesh",
        Acronym:"BD"
      },
      {
        id: "6",
        name: "China",
        Acronym:"CN"
      },
      {
        id: "8",
        name: "India",
        Acronym:"IN"
      },
      {
        id: "9",
        name: "Indonesia",
        Acronym:"ID"

      },
      {
        id: "17",
        name: "Myanmar",
        Acronym:"MM"
      },
      {
        id: "18",
        name: "Nepal",
        Acronym:"NP"

      },
      {
        id: "20",
        name: "Pakistan",
        Acronym:"PK"
      },
      
      {
        id: "23",
        name: "Philippines",
        Acronym:"PH"

      },
      {
        id: "27",
        name: "Sri Lanka",
        Acronym:"LK"

      },
    ];
  }
  else if (region_id == 2)//West Africa
  {
    var data = [
      {
        id: "5",
        name: "Chad",
        Acronym:"TD"
      },
      {
        id: "15",
        name: "Malawi",
        Acronym:"MW"

      },
      {
        id: "16",
        name: "Mali",
        Acronym:"ML"
      },

      {
        id: "19",
        name: "Niger",
        Acronym:"NE"
      },
    ];
  }
  else if (region_id == 3)// East Africa
  {
    var data = [
      {
        id: "7",
        name: "Ethiopia",
        Acronym:"ET"
      },
      {
        id: "12",
        name: "Kenya",
        Acronym:"KE"

      },
      {
        id: "25",
        name: "Somalia",
        Acronym:"SO"
      },
      {
        id: "26",
        name: "South Sudan",
        Acronym:"SS"
      },

      {
        id: "28",
        name: "Sudan",
        Acronym:"SD"
      },
    ];
  }
  else if (region_id == 4)//MEANEE
  {
    var data = [
      {
        id: "2",
        name: "Albania",
        Acronym:"AL"
      },
      {
        id: "4",
        name: "Bosnia",
        Acronym:"BA"

      },
      {
        id: "10",
        name: "Iraq",
        Acronym:"IQ"
      },
      {
        id: "11",
        name: "Jordan",
        Acronym: "JO"
      },
      {
        id: "13",
        name: "Kosovo",
        Acronym:"KS"
      },
      {
        id: "14",
        name: "Lebanon",
        Acronym:"LB"
      },
      {
        id: "21",
        name: "Palestine Gaza",
        Acronym:"PS-G"
      },
      {
        id: "22",
        name: "Palestine West Bank",
        Acronym:"PS-W"
      },
      {
        id: "24",
        name: "Russian Federation",
        Acronym:"RU"

      },
      {
        id: "29",
        name: "Syria",
        Acronym:"SY"
      },
      {
        id: "30",
        name: "Tunisia",
        Acronym:"TN"

      },
      {
        id: "31",
        name: "Turkey",
        Acronym:"TR"
      },
      {
        id: "32",
        name: "Yemen",
        Acronym:"YE"
      },
    ];
  }

  $.each(data, function(i, option) {
    field_office_id.append($('<option/>').attr("value", option.id).text(option.Acronym+' - '+option.name));
  });

  if(callback !== undefined) {
    callback.call();
  }
}


function Helper_FillCountryDropDown(country_of_birth, all_value, all_text, callback) {
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
    url: "{{url('/fillCountryDropDown')}}",
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


function Helper_FillDepartmentDropDown(department, all_value, all_text, callback) {
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
    url: "{{url('/fillDepartmentDropDown')}}",
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

function Helper_FillDesignationDropDown(designation, all_value, all_text, callback) {
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
    url: "{{url('/fillDesignationDropDown')}}",
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


function Helper_FillUserDropDown(user, all_value, all_text, callback, url) {
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
    url: "{{url('/fillUserDropDown')}}",
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

</script>