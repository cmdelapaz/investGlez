<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <nav class="nav navbar-nav">
      <ul class=" navbar-right">
        <li class="nav-item dropdown open" style="padding-left: 15px;">
          <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo base_url()."assets/dashboard/"; ?>production/images/img.jpg" alt=""><?= $username?>
          </a>
          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
            <?= anchor('welcome/perfil','<i class="fa fa-user"></i> Profile',array('class'=>'dropdown-item')) ?>
            <?= anchor('ctrl_sign_in/log_out','<i class="fa fa-sign-out"></i> Log Out',array('class'=>'dropdown-item')) ?>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->
