<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <?= anchor(base_url()."index.php/welcome/perfil_dashboard", '<i class="fa fa-line-chart text-warning"></i> <span class="text-warning"> InvestGlez</span>', array('class' => 'site_title'))?>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?= base_url()."assets/dashboard/"; ?>production/images/img.jpg" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?= $full_name ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />
