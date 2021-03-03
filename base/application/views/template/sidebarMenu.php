<!-- sidebar menu -->
<?php if(isset($systm_accss) && isset($artcl_accss) && isset($prsnl_accss) && isset($ttl_accss)){ ?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <?php if($systm_accss == 1 || $ttl_accss == 1){ ?>
    <h3>General</h3>
    <ul class="nav side-menu">
      <li><?= anchor('welcome/dashboard','<i class="fa fa-dashboard"></i> Home')?></li>
    </ul>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-users"></i> Investors <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><?php echo anchor('welcome/invstr_module_add','<i class="fa fa-plus-square"></i> Add Investor')?></li>
          <li><?php echo anchor('welcome/investors_list','<i class="fa fa-reorder"></i> List Investors')?></li>
          <li><?php echo anchor('welcome/search_investor','<i class="fa fa-search"></i> Search Investor')?></li>
        </ul>
      </li>
      <li><?= anchor('welcome/module_profit','<i class="fa fa-btc"></i> Profit')?></li>
      <li><?= anchor('welcome/withdraw_list','<i class="fa fa-download"></i> Withdraw')?></li>
      <li><?= anchor('welcome/hold_contribution_list','<i class="fa fa-refresh"></i> Release Deposit <span class="badge bg-green deposit_hold_count"></span>')?></li>
      <li><?= anchor('welcome/hold_withdraw_list','<i class="fa fa-exchange"></i> Release Withdraw <span class="badge bg-green withdraw_hold_count"></span>')?></li>
    </ul>





  <?php } ?>
  </div>
  <div class="menu_section">
    <?php if($prsnl_accss == 1){ ?>
    <h3>Personal</h3>
    <ul class="nav side-menu">
      <li><?= anchor('welcome/perfil_dashboard','<i class="fa fa-desktop"></i> Dashboard')?></li>
      <li><?= anchor('welcome/my_finance','<i class="fa fa-dollar"></i> My Finances')?></li>
      <li><?= anchor('welcome/calculator_tool','<i class="fa fa-calculator"></i> Calculator')?></li>
      <li><?= anchor('welcome/perfil','<i class="fa fa-user"></i> User',array('id'=>'link_edit_profile'))?></li>
    </ul>
    <?php } ?>
  </div>

</div>
<?php } ?>
<!-- /sidebar menu -->
