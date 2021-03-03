$(document).on("ready");
//fetch all users in the system
var user_table =$('#table_users_list_data').DataTable({
                      "pageLength" : 5,
                      "retrieve": true,
                      "ajax": {           //load table date by using ajax
                          url: "../ctrl_user/fetch_users",
                          type: "POST",
                      }
                    });
//Loading data into the table
user_table.ajax.reload();
load_roles();

//fetch all roles in the system.
function load_roles()
{
  $.ajax({
    url: "../ctrl_user/fetch_rol",
    type: "POST",
    dataType: 'json',
    success: function(responseData){
        $('#rol').empty();
        var select_option = '';
        if (responseData == '') {
          select_option = '<option value="-1">Select Algo</option>';
        }else{
          select_option = '<option value="-1">Select...</option>';
          for(emp in responseData){
            select_option += '<option value="'+responseData[emp].rolID+'">'+responseData[emp].description+'</option>';
            $('#rol').append(select_option);
          }
        }
      }
  });
}


//Add check mark after click on fullAccess Privileges and removed in case you click in a different option
$("#fullAccess").on("click", function(){
        var id = parseInt($(this).val(), 10);
        if($(this).is(":checked")) {
          $('#articlesAccess').prop('checked',true);
          $('#statsAccess').prop('checked',true);
        } else {
          $('#articlesAccess').prop('checked',false);
          $('#statsAccess').prop('checked',false);
        }
});
$("#articlesAccess").on("click", function(){
        var id = parseInt($(this).val(), 10);
        if(!$(this).is(":checked")) {
          $('#fullAccess').prop('checked',false);
        }
        if($(this).is(":checked") && $("#statsAccess").is(":checked")) {
          $('#fullAccess').prop('checked',true);
        }
});
$("#statsAccess").on("click", function(){
        var id = parseInt($(this).val(), 10);
        if(!$(this).is(":checked")) {
          $('#fullAccess').prop('checked',false);
        }
        if($(this).is(":checked") && $("#articlesAccess").is(":checked")) {
          $('#fullAccess').prop('checked',true);
        }
});

//Save user
$('#btn-save-new-user').on('click',function(event){
  event.preventDefault();
  var full_name       = $('#full_name').val();
  var email           = $('#email').val();
  var rol             = $('#rol').children("option:selected").val();
  var username        = $('#username').val();
  var passwd          = $('#passwd').val();
  var r_passwd        = $('#r_passwd').val();

  var chkfullAccess = document.getElementById("fullAccess");
  var chkarticlesAccess = document.getElementById("articlesAccess");
  var chkstatsAccess = document.getElementById("statsAccess");
  var fullAccess = '0';
  var articlesAccess = '0';
  var statsAccess = '0';
  if(chkfullAccess.checked)
  {
    fullAccess = '1';
    articlesAccess = '1';
    statsAccess = '1';
  }else
  if(chkarticlesAccess.checked)
  {
    articlesAccess = '1';
    fullAccess = '0';
    statsAccess = '0';
  }else
  if(chkstatsAccess.checked)
  {
    statsAccess = '1';
    fullAccess = '0';
    articlesAccess = '0';
  }
  $.ajax({
    type : "POST",
    url  : "../ctrl_user/add_user",
    dataType : "JSON",
    data : {full_name:full_name,email:email,rol:rol,username:username,passwd:passwd,r_passwd:r_passwd,fullAccess:fullAccess,articlesAccess:articlesAccess,statsAccess:statsAccess},
    success: function(data){
      if (data.msg == '1') {
        $('#full_name').val("");
        $('#email').val("");
        $('#username').val("");
        $('#passwd').val("");
        $('#r_passwd').val("");
        $('#rol').prop('selectedIndex',0);
        $('#fullAccess').prop('checked',false);
        $('#articlesAccess').prop('checked',false);
        $('#statsAccess').prop('checked',false);
        PNotify.prototype.options.styling = "bootstrap3";
        dynNotice();
      } else if(data.msg == '-1'){ // Contrasenas no coinciden
        $('#passwd').val("");
        $('#r_passwd').val("");
        $("#passwd,#r_passwd").attr("disabled", false).css("border","1px solid #F4A82E");
        PNotify.prototype.options.styling = "bootstrap3";
        new PNotify({
          type: 'notice',
          title: 'Ups!',
          text: 'The passwords do not match'
        });
      }else
        if (data.msg == '0') { // No se inserto correctamente la informacion
          new PNotify({
            type: 'error',
            title: 'Ups!',
            text: 'Error in the system. Please try it again or contact your System Admin'
          });
        }else
        if (data.msg == '2') { // Error en el formulario de validacion
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'error',
            title: 'Ups!',
            text: data.error
          });
        }
        user_table.ajax.reload();
        load_roles();
    }
  });
  user_table.ajax.reload();
  load_roles();
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
        options.title = 'Almost There';
      }
      if (percent >= 100) {
        window.clearInterval(interval);
        options.title = 'Done!';
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

//Deleting users
$(document).on('click','.delete',function(){
  var exists = false;
  var user_id = $(this).attr("id");
  var privilegesID = $(this).attr("privilege-id");
  $('.delete_modal').modal('show');
  $('#confirm_delete').on('click',function(event){
    event.preventDefault();
    $.ajax({
      url:"../ctrl_user/delete_user",
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
          user_table.ajax.reload();
          load_roles();
        }else {
          PNotify.prototype.options.styling = "bootstrap3";
          new PNotify({
            type: 'error',
            title: 'Oh No!',
            text: 'Something happened. Register was not deleted!'
          });
          user_table.ajax.reload();
          load_roles();
        }
      }
    });
    $('.delete_modal').modal('hide');
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
    url:"../ctrl_user/fetch_a_single_user",
    method: "POST",
    data:{id:user_id},
    dataType:"json",
    success:function(data){
      $('.user_code').html(data.user_code);
      $('.full_name').html(data.full_name);
      $('.privileges').append(data.system);
      $('.privileges').append(data.article);
      $('.privileges').append(data.stats);
      $('.status').append(data.status);
      $('.username').append(data.username);
      $('.email').append(data.email);
      $('.created_date').append(data.created_date);
      $('#id_data').val(user_id);
    }
  });
})

//Quick Edit User
$(document).on('click','.edit',function(){
  $('#edit_full_name').val('');
  $('#edit_email').val('');
  $('#edit_username').val('');
  $('#edit_id').val('');

  $('.edit_modal').modal('show');
  var id = $(this).attr("id");
  $.ajax({
    url:"../ctrl_user/fetch_single_user_to_edit",
    method: "POST",
    data:{id_user:id},
    dataType:"json",
    success:function(data){
      $('#edit_full_name').val(data.full_name);
      $('#edit_id').val(id);
      $('#edit_email').val(data.email);
      $('#edit_username').val(data.username);
      $('#edit_rol option[value="'+data.description+'"]').attr('selected','selected');

      if (data.status == '1') {
        $('div .quick-edit-model').css('background-color','green');
        $('#edit_status option[value="1"]').attr('selected','selected');
      } else if(data.status == '-1'){
        $('div .quick-edit-model').css('background-color','red');
        $('#edit_status option[value="-1"]').attr('selected','selected');
      }else if (data.status == '0') {
        $('div .quick-edit-model').css('background-color','orange');
        $('#edit_status option[value="0"]').attr('selected','selected');
      }
    }
  });
})
$(document).on('click','.update-btn-user',function(){
  $('.edit_confirmation_modal').modal('show');
})

$(document).on('click','.edit_confirmation_modal',function(){
  var full_name       = $('#edit_full_name').val();
  var email           = $('#edit_email').val();
  var rol             = $('#edit_rol').children("option:selected").val();
  var username        = $('#edit_username').val();
  var status          = $('#edit_status').children("option:selected").val();
  var id              = $('#edit_id').val();
  $.ajax({
    type:'POST',
    url:'../ctrl_user/quick_user_edit',
    dataType:'JSON',
    data:{id:id,edit_full_name:full_name,edit_email:email,edit_rol:rol,edit_username:username,edit_status:status},
    success:function(data){
      if (data.msg == '1') {
        $('#edit_full_name').val("");
        $('#edit_email').val("");
        $('#edit_username').val("");
        $('#edit_rol').prop('selectedIndex',0);
        $('#edit_status').prop('selectedIndex',0);
        $('.edit_confirmation_modal').modal('hide');
        $('.edit_modal').modal('hide');
        PNotify.prototype.options.styling = "bootstrap3";
        dynNotice();
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
            type: 'error',
            title: 'Ups!',
            text: data.error
          });
        }
        user_table.ajax.reload();
    }
  })
})


// Show datos generales de un usuario
$(document).on('click','#show-user-details',function(){
  var id = $('#id_data').val();
  //alert(id);
  $.ajax({
    url:'../Welcome/users_system_sub_module',
    dataType:"JSON",
    data:{id:id},
    success:function(){
      //return TRUE;
      alert(id);
    }
  })
})
