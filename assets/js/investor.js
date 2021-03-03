$(document).on("ready");
//fetch all users in the system
var investor_table =$('#table_quick_investors_list').DataTable({
                      "pageLength" : 5,
                      "retrieve": true,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_investor/fetch_quick_list_investors",
                          type: "POST",
                      }
                    });
//Loading data into the table
investor_table.ajax.reload();

//fetch all users in the system list of investors view
var full_investor_table =$('#table_full_investors_list').DataTable({
                      "pageLength" : 25,
                      "retrieve": true,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_investor/fetch_quick_list_investors",
                          type: "POST",
                      }
                    });
//Loading data into the table
full_investor_table.ajax.reload();

// Fetch A single investor active financing datas
var investor_active_financing_table =$('#table_investors_active_financing').DataTable({
                                          "pageLength" : 10,
                                          "retrieve": true,
                                          "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                                             if (aData[1] == "Withdraw") {
                                               $('td', nRow).css('color', 'Red');
                                             }
                                           },
                                          "ajax": {           //load table date by using ajax
                                              url: "../ctrl_investor/fetch_investor_active_financing",
                                              type: "POST",
                                              data:{id:$('#id').val()}
                                          }
                                        });
//Loading data into the table table_investors_active_financing
investor_active_financing_table.ajax.reload();

//fetch all company's profit
var all_profit_table =$('#table_all_profit').DataTable({
                      "pageLength" : 10,
                      "retrieve": true,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_investor/all_profit_data_table",
                          type: "POST"
                      }
                    });
//Loading data into the table
all_profit_table.ajax.reload();

//fetch investor's profit
var all_investor_table =$('#table_investor_profit').DataTable({
                      "pageLength" : 10,
                      "retrieve": true,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_investor/all_profit_investor_data_table",
                          type: "POST",
                          data:{id:$('#id').val()}
                      }
                    });
//Loading data into the table
all_investor_table.ajax.reload();
//fetch investor's profit perfil del usuario
var profit_investor_table =$('#table_investor_profit_perfil').DataTable({
                      "pageLength" : 5,
                      "retrieve": true,
                      "searching": false,
                      "lengthChange": false,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_investor/all_profit_investor_data_table",
                          type: "POST",
                          data:{id:$('#id').val()}
                      }
                    });
//Loading data into the table
profit_investor_table.ajax.reload();

//fetch all hold contributions
var all_hold_contributions =$('#table_hold_contributions').DataTable({
                      "pageLength" : 10,
                      "retrieve": true,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_investor/all_hold_contributions",
                          type: "POST",
                      }
                    });
//Loading data into the table
all_hold_contributions.ajax.reload();

//fetch all withdraw hold contributions
var all_withdraw_hold_contributions =$('#table_withdraw_hold_contributions').DataTable({
                      "pageLength" : 10,
                      "retrieve": true,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_investor/all_withdraw_hold_contributions",
                          type: "POST",
                      }
                    });
//Loading data into the table
all_withdraw_hold_contributions.ajax.reload();

//fetch all withdraw
var all_withdraw =$('#table_all_withdraw').DataTable({
                      "pageLength" : 25,
                      "retrieve": true,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_investor/all_withdraw",
                          type: "POST",
                      }
                    });
//Loading data into the table
all_withdraw.ajax.reload();

// mostrar investor buscado en la vista de buscar
function load_data(query)
{
  $.ajax({
   url:"../ctrl_investor/fetch_investors_view",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#result').html(data);
   }
  })
}
$('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
 });

//count withdraw and deposit holds
function count_withdraw_deposit_hold()
{
  $('.withdraw_hold_count').empty();
  $('.deposit_hold_count').empty();
  $.ajax({
    url:"../ctrl_investor/count_withdraw_deposit_hold",
    type: "POST",
    dataType: "JSON",
    success: function (data){
      $('.withdraw_hold_count').html(data.w_hold);
      $('.deposit_hold_count').html(data.d_hold);
    }
  })
}

$(document).ready(function(){
    count_withdraw_deposit_hold();
})

//fetch who is online
function who_is_online()
{
  $('.who_is_online').empty();
  $.ajax({
    url:"../ctrl_investor/who_is_online",
    type: "POST",
    //dataType: "JSON",
    success: function (data){
      $('.who_is_online').html(data);
    }
  })
};

$(document).ready(function(){
    who_is_online();
})

//fetch investor data
function load_investor_data()
{
    var id = $('#id').val();
    $('.investor_data_perfil').empty();
    $('.privilege_investor_profile').empty();
    $('#first_last_name').empty();
    $('#id_privilege_hidden').val("");
    $('#first_last_name_hidden').val("");
    //$('#compounding').prop('checked',true);

    $.ajax({
    url:"../ctrl_investor/fetch_investor_data",
    type: "POST",
    dataType: "JSON",
    data:{id_data:id},
    success:function(data){
      console.log('Valor: ' + data.compounding);
      if (data.compounding == 'on') {
        $('#compounding').bootstrapToggle('on');

      } else if (data.compounding == 'off'){
        $('#compounding').bootstrapToggle('off');
      }
      $('#first_last_name').html(data.first_last_name);
      $('#first_last_name_hidden').val(data.first_last_name);
      $('#id_privilege_hidden').val(data.id_privilege);
      $('.investor_data_perfil').append(data.status);
      $('.investor_data_perfil').append(data.username_investor);
      $('.investor_data_perfil').append(data.email);
      $('.investor_data_perfil').append(data.created);
      $('.investor_data_perfil').append(data.years_old);
      $('.investor_data_perfil').append(data.link);

      $('.privilege_investor_profile').append(data.personal);
      $('.privilege_investor_profile').append(data.total);
      $('.privilege_investor_profile').append(data.system);
      //$('.privilege_investor_profile').append(data.article);
    }
    });
}
$(document).ready(function(){
    load_investor_data();
})

//Herramienta de calculadora
$("#currency").change(function(){
  var amount  = $('#amount_to_convert').val();
  $('#convert_value').val("");
  var currency = $('#currency').children("option:selected").val();
  $.ajax({
    url:"../ctrl_investor/getPrice/"+currency,
    data:{currency: currency},
    dataType: "json",
    success: function(data){
      var value_converted = data.price * amount;
      $('#convert_value').val(value_converted);
    }
  })
});
$("#amount_to_convert").change(function(){
  var amount  = $('#amount_to_convert').val();
  $('#convert_value').val("");
  var currency = $('#currency').children("option:selected").val();
  $.ajax({
    url:"../ctrl_investor/getPrice/"+currency,
    data:{currency: currency},
    dataType: "json",
    success: function(data){
      var value_converted = data.price * amount;
      $('#convert_value').val(value_converted);
    }
  })
});
$("#convert_value").change(function(){
  var amount  = $('#convert_value').val();
  $('#amount_to_convert').val("");
  var currency = $('#currency').children("option:selected").val();
  $.ajax({
    url:"../ctrl_investor/getPrice/"+currency,
    data:{currency: currency},
    dataType: "json",
    success: function(data){
      var value_converted = amount / data.price;

      $('#amount_to_convert').val(value_converted.toFixed(8));
    }
  })
});

//load dashboard investor data
function load_dashboard_investor_data()
{
    var id = $('#id').val();
    //var currency = $('#currency').children("option:selected").val();
    $('.total_invested_by').empty();
    $('.name_investor').empty();
    $('.last_week_percent').empty();
    $('.last_week_profit_btc').empty();
    $('.total_profit_by').empty();
    $('.current_investment_amount').empty();
    $('.withdraw_total').empty();
    $('.amount_available').empty();

    $.ajax({
    url:"../ctrl_investor/load_dashboard_investor_data",
    type: "POST",
    dataType: "JSON",
    data:{id_data:id},
    success:function(data){
      $('.total_invested_by').html(data.total_invested_by);
      $('.name_investor').html(data.investor_name);
      $('.last_week_percent').html(data.last_week_percent);
      $('.last_week_profit_btc').html(data.last_week_profit_btc);
      $('.total_profit_by').html(data.total_profit_by);
      $('.current_investment_amount').html(data.current_investment_amount);
      $('.withdraw_total').html(data.withdraw_total);
      $('.amount_available').html(data.amount_available);
    }
    });
}
$(document).ready(function(){
    load_dashboard_investor_data();
})

//load dashboard admin data
function load_dashboard_admin_data()
{
    $('.current_invested_by_company').empty();
    $('.total_company_withdraw').empty();
    $('.total_invested_by_company').empty();
    $('.last_week_profit').empty();
    $('.last_week_company_profit_btc').empty();
    $('.total_company_profit').empty();
    $.ajax({
    url:"../ctrl_investor/load_dashboard_admin_data",
    type: "POST",
    dataType: "JSON",
    success:function(data){
      $('.current_invested_by_company').html(data.current_invested_by_company);
      $('.total_invested_by_company').html(data.total_invested_by_company);
      $('.last_week_profit').html(data.last_week_profit);
      $('.last_week_company_profit_btc').html(data.last_week_company_profit_btc);
      $('.total_company_profit').html(data.total_company_profit);
      $('.total_company_withdraw').html(data.total_company_withdraw);
    }
    });
}
$(document).ready(function(){
    load_dashboard_admin_data();
})

//Add check mark after click on ttl_accss Privileges and removed in case you click in a different option
$("#ttl_accss").on("click", function(){
        var id = parseInt($(this).val(), 10);
        if($(this).is(":checked")) {
          $('#systm_accss').prop('checked',true);
          $('#artcl_accss').prop('checked',true);
          $('#prsnl_accss').prop('checked',true);
        } else {
          $('#systm_accss').prop('checked',false);
          $('#artcl_accss').prop('checked',false);
          $('#prsnl_accss').prop('checked',false);
        }
});
$("#artcl_accss").on("click", function(){
        var id = parseInt($(this).val(), 10);
        if(!$(this).is(":checked")) {
          $('#ttl_accss').prop('checked',false);
        }
        if($(this).is(":checked") && $("#prsnl_accss").is(":checked") && $("#systm_accss").is(":checked")) {
          $('#ttl_accss').prop('checked',true);
        }
});
$("#prsnl_accss").on("click", function(){
        var id = parseInt($(this).val(), 10);
        if(!$(this).is(":checked")) {
          $('#ttl_accss').prop('checked',false);
        }
        if($(this).is(":checked") && $("#artcl_accss").is(":checked") && $("#systm_accss").is(":checked")) {
          $('#ttl_accss').prop('checked',true);
        }
});
$("#systm_accss").on("click", function(){
        var id = parseInt($(this).val(), 10);
        if(!$(this).is(":checked")) {
          $('#ttl_accss').prop('checked',false);
        }
        if($(this).is(":checked") && $("#artcl_accss").is(":checked") && $("#prsnl_accss").is(":checked")) {
          $('#ttl_accss').prop('checked',true);
        }
});

//Save user
$('#btn-save-new-investor').on('click',function(event){
  event.preventDefault();
  var first_name  = $('#first_name').val();
  var last_name   = $('#last_name').val();
  var dob         = $('#dob').val();
  var email       = $('#email').val();
  var status      = $('#status').children("option:selected").val();
  var username    = $('#username').val();
  var passwd      = $('#passwd').val();
  var r_passwd    = $('#r_passwd').val();

  var ttl_accss   = document.getElementById("ttl_accss");
  var artcl_accss = document.getElementById("artcl_accss");
  var systm_accss = document.getElementById("systm_accss");
  var prsnl_accss = document.getElementById("prsnl_accss");

  var totalAccess   = '0';
  var articlesAccess  = '0';
  var systemAccess    = '0';
  var personalAccess  = '0';
  if(ttl_accss.checked)
  {
    totalAccess     = '1';
    articlesAccess  = '1';
    systemAccess    = '1';
    personalAccess  = '1';
  }else
  if(artcl_accss.checked)
  {
    totalAccess     = '0';
    articlesAccess  = '1';
    systemAccess    = '0';
    personalAccess  = '0';
  }else
  if(systm_accss.checked)
  {
    totalAccess     = '0';
    articlesAccess  = '0';
    systemAccess    = '1';
    personalAccess  = '0';
  }else
  if(prsnl_accss.checked)
  {
    totalAccess     = '0';
    articlesAccess  = '0';
    systemAccess    = '0';
    personalAccess  = '1';
  }

  $.ajax({
    type : "POST",
    url  : "../ctrl_investor/insert_investor",
    dataType : "JSON",
    data : {first_name:first_name,last_name:last_name,dob:dob,email:email,status:status,
            username:username,pswd:passwd,r_pswd:r_passwd,totalAccess:totalAccess,
            articlesAccess:articlesAccess,systemAccess:systemAccess,personalAccess:personalAccess},
    success: function(data){
      if (data.msg == '1') {
        $('#first_name').val("");
        $('#last_name').val("");
        $('#dob').val("");
        $('#email').val("");
        $('#status').prop('selectedIndex',0);
        $('#username').val("");
        $('#passwd').val("");
        $('#r_passwd').val("");
        $('#ttl_accss').prop('checked',false);
        $('#artcl_accss').prop('checked',false);
        $('#systm_accss').prop('checked',false);
        $('#prsnl_accss').prop('checked',false);
        PNotify.prototype.options.styling = "bootstrap3";
        dynNotice();
      } else
        if (data.msg == '0') { // No se inserto correctamente la informacion
          new PNotify({
            type: 'error',
            title: 'Ups!',
            text: 'Error in the system. Please try it again or contact your System Admin'
          });
        }else
        if (data.msg == '-2') { // Error en el formulario de validacion
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'warning',
            title: 'Ups! Sorry',
            text: data.error
          });
        }
        investor_table.ajax.reload();
    }
  });
  investor_table.ajax.reload();
  full_investor_table.ajax.reload();
});
//******* Function to show a Notify after insert a new users
function dynNotice() {
  var percent = 0;
  var notice = new PNotify({
    type: 'info',
    text: 'Please Wait',
    icon: 'fa fa-spinner fa-pulse',
    hide: false,
    shadow: false,
    width: '300px',
    modules: {
      Buttons: {
        closer: false,
        sticker: false
      }
    }
  });

setTimeout(function() {
    notice.update({
      title: false
    });
    var interval = setInterval(function() {
      percent += 10;
      var options = {
        text: percent + '% complete.'
      };
      if (percent === 80) {
        options.title = 'Inserting...';
      }
      if (percent >= 100) {
        window.clearInterval(interval);
        options.title = 'Done!';
        options.text = 'Investor information added!';
        options.type = 'success';
        options.hide = true;
        options.icon = 'fa fa-check';
        options.shadow = true;
        options.width = '300px';
        options.modules = {
          Buttons: {
            closer: true,
            sticker: true
          }
        };
      }
      notice.update(options);
    }, 120);
  }, 2000);
}

//Deleting investor
$(document).on('click','.delete',function(){
  var exists = false;
  var user_id = $(this).attr("id");
  var privilegesID = $(this).attr("privilege-id");
  $('.delete_modal').modal('show');
  $('#confirm_delete').on('click',function(event){
    event.preventDefault();
    $.ajax({
      url:"../ctrl_investor/delete_investor",
      method: "POST",
      data:{id:user_id,privilegesID:privilegesID},
      success:function(data){
        if(data.msg == '1' || !data.error){
          PNotify.prototype.options.styling = "bootstrap3";
          $(".ui-pnotify-title").each(function() {
            if ($(this).html() == 'Info Message')
                exists = true;
              });
            if(!exists) {
              new PNotify({
                type: 'info',
                title: 'Info Message',
                text: 'The user information was deleted satisfactorily!',
                addclass:  'my_unique_class'
              });
            }
          investor_table.ajax.reload();
          full_investor_table.ajax.reload();
        }else {
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'error',
            title: 'Oh No!',
            text: 'Something happened. Register was not deleted!'
          });
          investor_table.ajax.reload();
          full_investor_table.ajax.reload();
        }
      }
    });
    $('.delete_modal').modal('hide');
  })
})

//Quick Edit User
$(document).on('click','.edit',function(){
  $('#edit_first_name').val('');
  $('#edit_last_name').val('');
  $('#edit_email').val('');
  $('#edit_username').val('');
  $('#edit_id').val('');
  $('#edit_status').prop('selectedIndex',0);

  $('.edit_modal').modal('show');
  var id = $(this).attr("id");
  $.ajax({
    url:"../ctrl_investor/fetch_single_investor_to_edit",
    method: "POST",
    data:{id_user:id},
    dataType:"json",
    success:function(data){
      $('#edit_first_name').val(data.first_name);
      $('#edit_last_name').val(data.last_name);
      $('#edit_id').val(id);
      $('#edit_email').val(data.email);
      $('#edit_username').val(data.username);
      $('#edit_status option[value="'+data.status+'"]').attr('selected','selected');

      if (data.status == '1') {
        $('div .quick-edit-model').css('background-color','green');
        $('#edit_status option[value="1"]').attr('selected','selected');
      } else if(data.status == '0'){
        $('div .quick-edit-model').css('background-color','red');
        $('#edit_status option[value="0"]').attr('selected','selected');
      }else if (data.status == '2') {
        $('div .quick-edit-model').css('background-color','orange');
        $('#edit_status option[value="2"]').attr('selected','selected');
      }
    }
  });
})
$(document).on('click','.update-btn-investor',function(){
  $('.edit_confirmation_modal').modal('show');
})

$(document).on('click','.edit_confirmation_modal',function(){
  var first_name      = $('#edit_first_name').val();
  var last_name       = $('#edit_last_name').val();
  var email           = $('#edit_email').val();
  var username        = $('#edit_username').val();
  var status          = $('#edit_status').children("option:selected").val();
  var id              = $('#edit_id').val();
  $.ajax({
    type:'POST',
    url:'../ctrl_investor/quick_investor_edit',
    dataType:'JSON',
    data:{id:id,edit_first_name:first_name,edit_last_name:last_name,edit_email:email,edit_username:username,edit_status:status},
    success:function(data){
      if (data.msg == '1') {
        $('#edit_first_name').val("");
        $('#edit_last_name').val("");
        $('#edit_email').val("");
        $('#edit_username').val("");
        $('#edit_status').prop('selectedIndex',0);
        $('#edit_id').val("");
        $('.edit_confirmation_modal').modal('hide');
        $('.edit_modal').modal('hide');
        PNotify.prototype.options.styling = "bootstrap3";
        dynNotice();
        investor_table.ajax.reload();
        full_investor_table.ajax.reload();
      } else if (data.msg == '0') { // No se inserto correctamente la informacion
          $('.edit_confirmation_modal').modal('hide');
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'error',
            title: 'Ups!',
            text: 'Error in the system. Please try it again or contact your System Admin'
          });
        }else if (data.msg == '-1') { // Error en el formulario de validacion
          $('.edit_confirmation_modal').modal('hide');
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'warning',
            title: 'Ups! Sorry',
            text: data.error
          });
        }
        investor_table.ajax.reload();
        full_investor_table.ajax.reload();
    }
  })
})
//Edit password of the investor
$(document).on('click','.edit_profile_investor_data',function(){
  var current_password   = $('#current_passwd').val();
  var new_password       = $('#new_passwd').val();
  var confirm_password   = $('#re_passwd').val();
  var id                 = $('#id').val();
  $.ajax({
    type:'POST',
    url:'../ctrl_investor/edit_investor_access_profile',
    dataType:'JSON',
    data:{id:id,current_passwd:current_password,new_passwd:new_password,re_passwd:confirm_password},
    success:function(data){
      if (data.msg == '1') {
         $('.editUserProfile').modal('hide');
        $('#current_passwd').val("");
        $('#new_passwd').val("");
        $('#re_passwd').val("");
        PNotify.prototype.options.styling = "bootstrap3";
        dynNotice();
        load_investor_data();
        full_investor_table.ajax.reload();
      } else if (data.msg == '0') { // No se inserto correctamente la informacion
          $('.edit_profile_investor_data').modal('show');
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'error',
            title: 'Ups!',
            text: 'Error in the system. Please try it again or contact your System Admin'
          });
         $('#current_passwd').val("");
         $('#new_passwd').val("");
         $('#re_passwd').val("");
         load_investor_data();
         full_investor_table.ajax.reload();
        }else if (data.msg == '-1') { // Error en el formulario de validacion
          $('.editUserProfile').modal('show');
         PNotify.prototype.options.styling = "bootstrap3";
         new PNotify({
           type: 'error',
           title: 'Ups!',
           text: data.error
         });
         $('#current_passwd').val("");
         $('#new_passwd').val("");
         $('#re_passwd').val("");
         load_investor_data();
         full_investor_table.ajax.reload();
        }else if (data.msg == '2') { // Current Contrasena no coinciden
          $('.editUserProfile').modal('show');
         PNotify.prototype.options.styling = "bootstrap3";
         new PNotify({
           type: 'error',
           title: 'Ups!',
           text: data.error
         });
         $('#current_passwd').val("");
         $('#new_passwd').val("");
         $('#re_passwd').val("");
         load_investor_data();
         full_investor_table.ajax.reload();
        }
        //investor_table.ajax.reload();
    }
  })
})

//Poblar los campos para q el usuario actualice sus valores

function perfil_info_edit(){
  $('#first_name_full_edit').val('');
  $('#last_name_full_edit').val('');
  $('#dob_full_edit').val('');
  $('#email_full_edit').val('');
  //$('#status_full_edit').prop('selectedIndex',0);
  $('#id_full_edit').val('');

  $('#ttl_accss').prop('checked',false);
  $('#artcl_accss').prop('checked',false);
  $('#systm_accss').prop('checked',false);
  $('#prsnl_accss').prop('checked',false);

  $('#ttl_accss').prop('disabled',true);
  $('#artcl_accss').prop('disabled',true);
  $('#systm_accss').prop('disabled',true);
  $('#prsnl_accss').prop('disabled',true);

  var id = $('#id').val();
  //alert(id);
  $.ajax({
    url:"../ctrl_investor/fetch_single_investor_to_edit",
    method: "POST",
    data:{id_user:id},
    dataType:"json",
    success:function(data){
      $('#first_name_full_edit').val(data.first_name);
      $('#last_name_full_edit').val(data.last_name);
      $('#id_full_edit').val(id);
      $('#email_full_edit').val(data.email);
      $('#dob_full_edit').val(data.dob);
      $('#status_full_edit option[value="'+data.status+'"]').attr('selected','selected');
      if (data.system_access == '1') {
        $('#systm_accss').prop('checked',true);
      }
      if (data.articles_access == '1') {
        $('#artcl_accss').prop('checked',true);
      }
      if (data.personal_access  == '1') {
        $('#prsnl_accss').prop('checked',true);
      }
      if (data.total_access  == '1') {
        $('#ttl_accss').prop('checked',true);
      }
    }
  });
}

$(document).ready(function(){
    perfil_info_edit();
})

//Full Edit User
$(document).on('click','.full_edit_profile',function(){
  $('#first_name_full_edit').val('');
  $('#last_name_full_edit').val('');
  $('#dob_full_edit').val('');
  $('#email_full_edit').val('');
  //$('#status_full_edit').prop('selectedIndex',0);
  $('#id_full_edit').val('');

  $('#ttl_accss').prop('checked',false);
  $('#artcl_accss').prop('checked',false);
  $('#systm_accss').prop('checked',false);
  $('#prsnl_accss').prop('checked',false);

  var id = $('#id').val();
  $.ajax({
    url:"../ctrl_investor/fetch_single_investor_to_edit",
    method: "POST",
    data:{id_user:id},
    dataType:"json",
    success:function(data){
      $('#first_name_full_edit').val(data.first_name);
      $('#last_name_full_edit').val(data.last_name);
      $('#id_full_edit').val(id);
      $('#email_full_edit').val(data.email);
      $('#dob_full_edit').val(data.dob);
      $('#status_full_edit option[value="'+data.status+'"]').attr('selected','selected');
      if (data.system_access == '1') {
        $('#systm_accss').prop('checked',true);
      }
      if (data.articles_access == '1') {
        $('#artcl_accss').prop('checked',true);
      }
      if (data.personal_access  == '1') {
        $('#prsnl_accss').prop('checked',true);
      }
      if (data.total_access  == '1') {
        $('#ttl_accss').prop('checked',true);
      }
    }
  });
})
$(document).on('click','.update-btn-investor-conf',function(){
  $('.full_edit_confirmation_modal').modal('show');
})
$(document).on('click','.full_edit_confirmation_modal',function(){
  var first_name      = $('#first_name_full_edit').val();
  var last_name       = $('#last_name_full_edit').val();
  var dob             = $('#dob_full_edit').val();
  var email           = $('#email_full_edit').val();
  var status          = $('#status_full_edit').children("option:selected").val();
  var ttl_accss       = '';
  var artcl_accss     = '';
  var systm_accss     = '';
  var prsnl_accss     = '';
  var id              = $('#id_full_edit').val();

  if (document.getElementById("ttl_accss").checked) {
    ttl_accss = '1';
  } else {
    ttl_accss = '0';
  }
  if (document.getElementById("systm_accss").checked) {
    systm_accss = '1';
  } else {
    systm_accss = '0';
  }
  if (document.getElementById("artcl_accss").checked) {
    artcl_accss = '1';
  } else {
    artcl_accss = '0';
  }
  if (document.getElementById("prsnl_accss").checked) {
    prsnl_accss = '1';
  } else {
    prsnl_accss = '0';
  }

  $.ajax({
    type:'POST',
    url:'../ctrl_investor/full_investor_edit',
    dataType:'JSON',
    data:{id:id,edit_first_name:first_name,edit_last_name:last_name,edit_email:email,edit_dob:dob,edit_status:status,
          ttl_accss:ttl_accss,artcl_accss:artcl_accss,systm_accss:systm_accss,prsnl_accss:prsnl_accss},
    success:function(data){
      if (data.msg == '1') {
        $('#first_name_full_edit').val("");
        $('#last_name_full_edit').val("");
        $('#email_full_edit').val("");
        $('#dob_full_edit').val("");
        $('#edit_status').prop('selectedIndex',0);
        $('#id_full_edit').val("");
        $('#ttl_accss').prop('checked',false);
        $('#artcl_accss').prop('checked',false);
        $('#systm_accss').prop('checked',false);
        $('#prsnl_accss').prop('checked',false);
        $('.full_edit_confirmation_modal').modal('hide');
        $('.total_edit_modal').modal('hide');
        PNotify.prototype.options.styling = "bootstrap3";
        dynNotice();
        load_investor_data();
        full_investor_table.ajax.reload();
        perfil_info_edit();
      } else if (data.msg == '0') { // No se inserto correctamente la informacion
          $('.full_edit_confirmation_modal').modal('hide');
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'error',
            title: 'Ups!',
            text: 'Error in the system. Please try it again or contact your System Admin'
          });
        }else if (data.msg == '-1') { // Error en el formulario de validacion
          $('.full_edit_confirmation_modal').modal('hide');
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'warning',
            title: 'Ups! Sorry',
            text: data.error
          });
        }
        //investor_table.ajax.reload();
    }
  })
})
//Info users
$(document).on('click','.details',function(){
  $('.details_modal').modal('show');
  $('.privileges').html('');
  $('.status').html('');
  $('.username').html('');
  $('.email').html('');
  $('.created_date').html('');
  var user_id = $(this).attr("id");

  $.ajax({
    url:"../ctrl_investor/fetch_a_single_investor",
    method: "POST",
    data:{id:user_id},
    dataType:"json",
    success:function(data){
      $('.full_name').html(data.full_name);
      $('.privileges').append(data.system);
      $('.privileges').append(data.article);
      $('.privileges').append(data.personal);
      $('.privileges').append(data.total);
      $('.status').append(data.status);
      $('.username').append(data.username);
      $('.email').append(data.email);
      $('.created_date').append(data.created_date);
      $('#id_data').val(user_id);
    }
  });
})

// Set Compounding Financing
$(document).on('click','.compounding_btn',function(){
    var id = $('#id').val();
    var compounding = $('#compounding').val();
               $.ajax({
                      url:'../ctrl_investor/edit_investor_compounding',
                      method: 'POST',
                      data:{id:id,compounding:compounding},
                      dataType:'json',
                      success:function(data){
                        if(data.msg == '1')
                          {
                            $('.compounding_modal').modal('hide');
                            $('#compounding').val('');
                            PNotify.prototype.options.styling = "bootstrap3";
                            dynNotice();
                            load_investor_data();
                            investor_active_financing_table.ajax.reload();
                            load_dashboard_investor_data();
                            full_investor_table.ajax.reload();
                          }
                        else if(data.msg == '0')
                          {
                            $('.deposit_operation_modal').modal('hide');
                            $('#compounding').val('');
                            PNotify.prototype.options.styling = "bootstrap3";
                              new PNotify({
                                type: 'error',
                                title: 'Ups! Sorry',
                                text: data.error
                              });
                              load_investor_data();
                              investor_active_financing_table.ajax.reload();
                              load_dashboard_investor_data();
                          }else if(data.msg == '-1')
                            {
                              $('.deposit_operation_modal').modal('hide');
                              $('#compounding').val('');
                              PNotify.prototype.options.styling = "bootstrap3";
                                new PNotify({
                                  type: 'error',
                                  title: 'Ups! Sorry',
                                  text: data.error
                                });
                                load_investor_data();
                                investor_active_financing_table.ajax.reload();
                                load_dashboard_investor_data();
                            }
                        }
                      });
})


// Hold BTC Contribution
$(document).on('click','.hold_deposit_operatio_btn',function(){
    var id = $('#id').val();
    var deposit_amount = $('#deposit_amount').val();
               $.ajax({
                      url:'../ctrl_investor/hold_contribution',
                      method: 'POST',
                      data:{id:id,dpst_amount:deposit_amount},
                      dataType:'json',
                      success:function(data){
                        if(data.resp == '1')
                          {
                            $('.deposit_operation_modal').modal('hide');
                            $('#deposit_amount').val("");
                            PNotify.prototype.options.styling = "bootstrap3";
                            dynNotice();
                            load_investor_data();
                            investor_active_financing_table.ajax.reload();
                            load_dashboard_investor_data();
                            full_investor_table.ajax.reload();
                          }
                        else if(data.resp == '0')
                          {
                            $('.deposit_operation_modal').modal('hide');
                            $('#deposit_amount').val("");
                            PNotify.prototype.options.styling = "bootstrap3";
                              new PNotify({
                                type: 'error',
                                title: 'Ups! Sorry',
                                text: data.msg
                              });
                          }
                        }
                      });
})

// Hold BTC Withdraw
$(document).on('click','.withdraw_operatio_btn',function(){
    var id = $('#id').val();
    var withdraw_amount = $('#withdraw_amount').val();
               $.ajax({
                      url:'../ctrl_investor/hold_withdraw',
                      method: 'POST',
                      data:{id:id,withdraw_amount:withdraw_amount},
                      dataType:'json',
                      success:function(data){
                        if(data.resp == '1')
                          {
                            $('.withdraw_operation_modal').modal('hide');
                            $('#withdraw_amount').val("");
                            PNotify.prototype.options.styling = "bootstrap3";
                            dynNotice();
                            load_investor_data();
                            investor_active_financing_table.ajax.reload();
                            load_dashboard_investor_data();
                            full_investor_table.ajax.reload();
                          }
                        else if(data.resp == '0')
                          {
                            $('.withdraw_operation_modal').modal('hide');
                            $('#withdraw_amount').val("");
                            PNotify.prototype.options.styling = "bootstrap3";
                              new PNotify({
                                type: 'error',
                                title: 'Ups! Sorry',
                                text: data.msg
                              });
                          }
                          else if(data.resp == '-1')
                            {
                              $('.withdraw_operation_modal').modal('hide');
                              $('#withdraw_amount').val("");
                              PNotify.prototype.options.styling = "bootstrap3";
                                new PNotify({
                                  type: 'error',
                                  title: 'Ups! Sorry',
                                  text: data.msg
                                });
                            }
                        }
                      });
})

// Deposit BTC Contribution
$(document).on('click','.release_hold',function(){
    var id = $(this).attr("id");
    var deposit_amount = $('#deposit_amount').val();
    var oprtn_type = 'Contribution';
               $.ajax({
                      url:'../ctrl_investor/deposit_operation',
                      method: 'POST',
                      data:{id:id,oprtn_type:oprtn_type,dpst_amount:deposit_amount},
                      dataType:'json',
                      success:function(data){
                        if(data.resp == '1')
                          {
                            $('.deposit_operation_modal').modal('hide');
                            $('#deposit_amount').val("");
                            PNotify.prototype.options.styling = "bootstrap3";
                            dynNotice();
                            load_investor_data();
                            investor_active_financing_table.ajax.reload();
                            load_dashboard_investor_data();
                            all_hold_contributions.ajax.reload();
                            full_investor_table.ajax.reload();
                            count_withdraw_deposit_hold();
                          }
                        else if(data.resp == '0')
                          {
                            $('.deposit_operation_modal').modal('hide');
                            $('#deposit_amount').val("");
                            PNotify.prototype.options.styling = "bootstrap3";
                              new PNotify({
                                type: 'error',
                                title: 'Ups! Sorry',
                                text: data.msg
                              });
                          }
                        }
                      });
})



// Manual Withdraws
$(document).on('click','.release_withdraw_hold',function(){
    var id = $('#id').val();

    $.ajax({
      type:'POST',
      url:'../ctrl_investor/release_withdraw_operation',
      data:{id:id},
      dataType:'json',
      success:function(data){
        if(data.status == '1')
        {
          $('.withdraw_operation_modal').modal('hide');
          PNotify.prototype.options.styling = "bootstrap3";
          dynNotice();
          load_investor_data();
          investor_active_financing_table.ajax.reload();
          load_dashboard_investor_data();
          full_investor_table.ajax.reload();
          all_withdraw_hold_contributions.ajax.reload();
          count_withdraw_deposit_hold();
        }
        else if(data.status == '0')
        {
          $('.withdraw_operation_modal').modal('hide');
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'error',
            title: 'Ups! Sorry',
            text: data.msg
          });
        }
      }
    });
});
//Profit Setting. Selectcionar tipo de profit, en btc o en %


$(function() {
    $('#customSwitch1').change(function() {
      var div_profit_prcnt = document.getElementById("profit_prcnt");
      var div_profit_btc = document.getElementById("div_profit_btc");

      if ($(this).prop('checked')) {
        div_profit_prcnt.style.display = "none";
        div_profit_btc.style.display = "block";
      } else {
        div_profit_prcnt.style.display = "block";
        div_profit_btc.style.display = "none";
      }
    })
  })
  //Save a % profit for the company
  $('#btn-save-profit').on('click',function(event){
    event.preventDefault();
    var profit_prcnt = '';
    var profit_btc = '';
    if ($('#customSwitch1').prop('checked')) {
      profit_btc = $('#profit_btc').val();
      profit_prcnt = 0;
    } else {
      profit_btc = 0;
      profit_prcnt = $('#profit').val();
    }
    var week_data_range = $('#weekProfit').val();
    //var profit_prcnt = $('#profit').val();
    $.ajax({
      url:'../ctrl_investor/add_general_profit',
      type:'POST',
      dataType:'JSON',
      data:{week_data_range:week_data_range,profit_prcnt:profit_prcnt,profit_btc:profit_btc},
      success:function(data){
        if (data.status == '1') {
          $('#weekProfit').val("");
          $('#profit').val("");
          PNotify.prototype.options.styling = "bootstrap3";
          dynNotice();
          all_profit_table.ajax.reload();
          investor_active_financing_table.ajax.reload();
          investor_table.ajax.reload();
          all_investor_table.ajax.reload();
          full_investor_table.ajax.reload();
          load_investor_data();
          load_dashboard_investor_data();
          load_dashboard_admin_data();
        }
        else if(data.status == '0'){
          $('#weekProfit').val("");
          $('#profit').val("");
          $('#profit_btc').val("");
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
              type: 'warning',
              title: 'Ups! Sorry',
              text: data.msg
            });
            all_profit_table.ajax.reload();
            investor_active_financing_table.ajax.reload();
            investor_table.ajax.reload();
            all_investor_table.ajax.reload();
            load_investor_data();
            load_dashboard_investor_data();
            load_dashboard_admin_data();
            full_investor_table.ajax.reload();
        }
        else if(data.status == '-1'){
          PNotify.prototype.options.styling = "bootstrap3";
            new PNotify({
              type: 'warning',
              title: 'Ups! Sorry',
              text: data.error
            });
            all_profit_table.ajax.reload();
            investor_active_financing_table.ajax.reload();
            investor_table.ajax.reload();
            all_investor_table.ajax.reload();
            load_investor_data();
            load_dashboard_investor_data();
            load_dashboard_admin_data();
            full_investor_table.ajax.reload();
        }
      }
    });
  })
