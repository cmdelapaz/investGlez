  $(document).ready(function(){
    $('#btn_lgn').click(function(){
      var username = $("#usrnm").val().trim();
      var password = $("#pass").val().trim();
      if (username != "" && password != "" ) {
        $.ajax({
          url:'./index.php/ctrl_sign_in/sign_in',
          type:"POST",
          dataType:'json',
          data:{usrnm:username,pass:password},
          success:function(resp){
            if (resp.msg === 'error') {
              PNotify.prototype.options.styling = "bootstrap3";
              new PNotify({
                type: 'error',
                title: 'Ups!',
                text: 'The username and/or passwords are wrong!'
              });
            } else if (resp.msg === 'success'){
              PNotify.prototype.options.styling = "bootstrap3";
              dynNotice();
              window.location.href = "http://localhost:8888/investGlez/index.php/welcome/perfil_dashboard";
            }
          }
        });
      }
    });
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
          options.title = 'Checking...';
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
