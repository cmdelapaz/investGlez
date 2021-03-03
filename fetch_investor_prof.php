<!-- page content -->
<?php if(isset($systm_accss) && isset($artcl_accss) && isset($prsnl_accss) && isset($ttl_accss)){ ?>
  <?php if($systm_accss == 1 || $ttl_accss == 1){ ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= $page_title ?></h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-area-chart"></i> Investor Report <small>Activity report</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <div class="btn-group">
                  <input type="hidden" name="id" value="<?= $id ?>">
                  <button type="button" class="btn btn-link deposit_btn" data-toggle="modal" data-placement="top" title="Deposit" data-target=".deposit_operation_modal" data-original-title="Deposit"><i class="fa fa-btc"></i></button>
                  <button type="button" class="btn btn-link withdraw_btn" data-toggle="modal" data-placement="top" title="Withdraw" data-target=".withdraw_operation_modal" data-original-title="Withdraw"><i class="fa fa-download"></i></button>
                    <div class="dropdown">
                      <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" data-placement="top" title="" data-original-title="Settings"><i class="fa fa-wrench"></i></button>
                      <span class="caret"></span>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a class="dropdown-item" href="#" data-toggle="modal" data-target=".compounding_modal"><i class="fa fa-retweet"></i> Compound Investment</a></li>
                        <li><a class="dropdown-item" href="#" data-toggle="modal" data-target=".editUserProfile"><i class="fa fa-unlock"></i> Edit User Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="dropdown-item" href="#" data-toggle="modal" data-target=".calculatorToolModal"><i class="fa fa-calculator"></i> Calculator Tool</a></li>
                      </ul>
                    </div>
                  <button type="button" class="btn btn-link full_edit_profile" data-toggle="modal" data-placement="top" data-target=".total_edit_modal"title="" data-original-title="Edit User"><i class="fa fa-pencil-square-o"></i></button>
                  <button type="button" class="btn btn-link delete" data-toggle="modal" data-placement="top" data-target=".delete_modalP" title="" data-original-title="Delete User"><i class="fa fa-trash-o"></i></button>
                </div>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-3 col-sm-3  profile_left investor_info_profile">
              <div class="profile_img">
                <div id="crop-avatar">
                  <img class="img-responsive avatar-view" src="<?= base_url()."assets/dashboard/"; ?>production/images/user.png" alt="Avatar" title="Change the avatar">
                </div>
              </div>
              <h3 id="first_last_name"></h3>
              <div class="btn-group">
                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                <input type="hidden" name="id_privilege_hidden" id="id_privilege_hidden" value="<?= $id_privilege ?>">
                <input type="hidden" name="first_last_name_hidden" id="first_last_name_hidden" value="">
                <button type="button" class="btn btn-link deposit_btn" data-toggle="modal" data-placement="top" title="Deposit" data-target=".deposit_operation_modal" data-original-title="Deposit"><i class="fa fa-btc"></i></button>
                <button type="button" class="btn btn-link withdraw_btn" data-toggle="modal" data-placement="top" title="Withdraw" data-target=".withdraw_operation_modal" data-original-title="Withdraw"><i class="fa fa-download"></i></button>
                <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" data-placement="top" title="" data-original-title="Settings"><i class="fa fa-wrench"></i></button>
                  <span class="caret"></span>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target=".compounding_modal"><i class="fa fa-retweet"></i> Compound Investment</a></li>
                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target=".editUserProfile"><i class="fa fa-unlock"></i> Edit User Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target=".calculatorToolModal"><i class="fa fa-calculator"></i> Calculator Tool</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-link full_edit_profile" data-toggle="modal" data-placement="top" data-target=".total_edit_modal"title="" data-original-title="Edit User"><i class="fa fa-pencil-square-o"></i></button>
                <button type="button" class="btn btn-link delete" data-toggle="modal" data-placement="top" data-target=".delete_modalP" title="" data-original-title="Delete User"><i class="fa fa-trash-o"></i></button>

              </div>
              <ul class="list-unstyled user_data investor_data_perfil">

              </ul>
              <h5><center>Privileges</center></h5><hr>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <ul class="stats-overview privilege_investor_profile">

                  </ul>
                </div>
              </div>
              <br>
            </div>
            <div class="col-md-9 col-sm-9 ">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active">
                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Investor Dashboard</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Active Financing</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Finance History</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">
                    <div class="row">
                      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-university"></i>
                        </div>
                        <div class="count total_invested_by"></div>
                          <h3>Total</h3>
                          <p class="name_investor"></p>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-building"></i>
                        </div>
                        <div class="count current_investment_amount"></div>
                          <h3>Current</h3>
                          <p class="">Current amount invested</p>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-btc"></i>
                          </div>
                          <div class="count total_profit_by"></div>
                          <h3>Total Profit</h3>
                          <p>Total Personal Profit</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-bar-chart"></i>
                          </div>
                          <div class="count last_week_percent"></div>
                          <h3>Profit (%)</h3>
                          <p>Last week profit (%)</p>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-btc"></i>
                          </div>
                          <div class="count last_week_profit_btc"></div>
                          <h3>Profit (<i class="fa fa-btc"></i>)</h3>
                          <p>Last Week Profit (<i class="fa fa-btc"></i>)</p>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-download"></i>
                          </div>
                          <div class="count withdraw_total"></div>
                          <h3>Withdraw (<i class="fa fa-btc"></i>)</h3>
                          <p>Total amount withdraw (<i class="fa fa-btc"></i>)</p>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="x_content">
                            <h2 class="text-warning"> Weekly Report </h2>
                            <hr/>
                          <table id="table_investor_profit" class="display" style="width:100%" class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Profit</th>
                                <th>BTC</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Profit</th>
                                <th>BTC</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6"></div>
                    </div>

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <table id="table_investors_active_financing" class="display" style="width:100%" class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Pack</th>
                          <th>Date</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Pack</th>
                          <th>Date</th>
                          <th>Amount</th>
                        </tr>
                      </tfoot>
                    </table>

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Weekly Profit <small>Chart</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content" id="investor_weekly_profit_chart">
                                <canvas class="" id="investorWeeklyIncomeChart"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Monthly Activities <small>Chart</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content" id="investor_monthly_activities_chart">
                                <canvas class="" id="investorMonthlyActivitiesChart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<!-- Compound Investment -->
<div class="modal fade bd-example-modal-sm compounding_modal" id="compounding_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-retweet"></i> Compound Investment</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><center>Commission Capitalizacion</center></p>
        <form action="" method="">
          <div class="row">
            <div class="col-lg-12 col-lg-offset-6" style="padding-left:110px">
              <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="compounding" id="compounding"/>
            </div>
          </div>
          <div class="row">
            <div class="col-12-lg col-12-md col-12-sm">
              <p><center>If the button is green (ON) you will be using Compound Interest. If it's in red (OFF) you will be requesting a withdraw every week</center></p>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-warning compounding_btn" id="compounding_btn"><i class="fa fa-check"></i> Accept</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- End Compound Investment -->
<!-- Edit Perfil de Usuario -->
<div class="modal fade bd-example-modal-sm editUserProfile" id="editUserProfile" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-unlock"></i> Edit User Profile</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <form>
            <div class="form-group">
              <input type="hidden" name="id" id="id" value="<?= $id ?>">
              <input type="password" class="form-control has-feedback-left" id="current_passwd" name="current_passwd" placeholder="Current Password">
              <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
              <?php echo form_error('current_passwd', '<div class="text-danger">', '</div>') ?>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
              <input type="password" class="form-control has-feedback-left" id="new_passwd" name="new_passwd" placeholder="Password">
              <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
              <?php echo form_error('new_passwd', '<div class="text-danger">', '</div>') ?>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
              <input type="password" class="form-control has-feedback-left" id="re_passwd" name="re_passwd" placeholder="Repeat Password">
              <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
              <?php echo form_error('re_passwd', '<div class="text-danger">', '</div>') ?>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-warning edit_profile_investor_data" id="commission_cap"><i class="fa fa-save"></i> Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- End Edit Perfil de Usuario -->
<!-- Delete User Modal -->
<div class="modal fade bd-example-modal-sm delete_modalP" id="delete_modalP" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content" style="background-color: #FEF3CD">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-exclamation-circle"></i> Confirmation Needed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('index.php/welcome/delete_user_profile')?>" method="post">
      <div class="modal-body">
        <p>Are you sure you want to delete <strong>this</strong> record?</p>
        <input type="hidden" name="id" id="id" value="<?= $id ?>">
        <input type="hidden" name="id_privilege" id="id_privilege" value="<?= $id_privilege ?>">
        <input type="hidden" name="first_last_name" id="first_last_name" value="<?= $first_last_name?>">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-danger" id="confirm_delete_p"><i class="fa fa-check"></i> Deleted</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- /Delete User Modal -->
<!-- Edit User Modal -->
<div class="modal fade bd-example-modal-sm total_edit_modal" id="total_edit_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-pencil-square-o"></i> Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="x_title">
                <h6 class="text-warning"><i class="fa fa-info-circle"></i> Personal Info</h6>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
                <input type="hidden" name="id_full_edit" id="id_full_edit" value="">
              <div class="form-group">
                <input type="text" class="form-control has-feedback-left" id="first_name_full_edit" name="first_name_full_edit" placeholder="First Name">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <input type="text" class="form-control has-feedback-left" id="last_name_full_edit" name="last_name_full_edit" placeholder="Last Name">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <input type="text" class="form-control has-feedback-left" id="dob_full_edit" name="dob_full_edit" placeholder="DOB">
                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <input type="email" class="form-control has-feedback-left" id="email_full_edit" name="email_full_edit" placeholder="Email">
                <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4"><h6>Status: </h6></label>
                <div class="col-md-8 col-sm-8 col-xs-8">
                  <select class="select2_single form-control" id="status_full_edit" name="status_full_edit" tabindex="-1">
                    <option value="-1">Select...</option>
                    <option value="1">Active Investor</option>
                    <option value="0">Inactive Investor</option>
                    <option value="2">Pending Investor</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <br>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="x_title">
                <h6 class="text-warning"><i class="fa fa-shield"></i> Privilege Info</h6>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>System Access</th>
                    <th>Articles Access</th>
                    <th>Personal Access</th>
                    <th>Total Access</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="checkbox" value="1" name="systm_accss" id="systm_accss"></td>
                    <td><input type="checkbox" value="1" name="artcl_accss" id="artcl_accss"></td>
                    <td><input type="checkbox" value="1" name="prsnl_accss" id="prsnl_accss"></td>
                    <td><input type="checkbox" value="1" name="ttl_accss" id="ttl_accss"></td>
                  </tr>
                  <tr>
                    <td><small class="text-default">Checking this box the investor will also have access to System funtionalities.</small></td>
                    <td><small class="text-default">Checking this box the investor will also have access to Article funtionalities.</small></td>
                    <td><small class="text-default">Checking this box the investor will also have access to Personal funtionalities.</small></td>
                    <td><small class="text-default">Checking this box the investor will have Total access to the funtionalities.</small></td>
                  </tr>
                  </tbody>
                </table>
            </div>
          </div>
          <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-warning update-btn-investor-conf" id="update-btn-investor-conf"><i class="fa fa-save"></i> Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div></form>
    </div>
  </div>
</div>
<!-- /Edit User Modal -->
<!-- Edit Confirmation Modal -->
<div class="modal fade bd-example-modal-sm full_edit_confirmation_modal" id="editConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content" style="background-color: #FEF3CD">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-exclamation-circle"></i> Confirmation Needed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to modify this record?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-success" id="confirm_full_edit"><i class="fa fa-check"></i> Accept</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- /Edit Confirmation Modal -->
<!-- Deposit Operation -->
<div class="modal fade bd-example-modal-sm deposit_operation_modal" id="deposit_operation" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-cloud-download"></i> Deposit</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><center>Write the amount of BTC this user would like to contribute.</center></p>
        <form class="form-label-right input_mask" action="" method="">
          <input type="hidden" name="id" id="id" value="<?= $id ?>">
          <div class="col-lg-12 col-md-12 col-sm-12  form-group has-feedback">
            <input type="text" class="form-control has-feedback-right" id="deposit_amount" name="deposit_amount" placeholder="0.00000000">
            <span class="fa fa-btc form-control-feedback right" aria-hidden="true"></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-warning hold_deposit_operatio_btn" id="deposit_operatio_btn"><i class="fa fa-check"></i> Accept</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Deposit Operation -->
<!-- Withdraw Operation -->
<div class="modal fade bd-example-modal-sm withdraw_operation_modal" id="withdraw_operation" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-download"></i> Withdraw</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><center>Write the amount of BTC this user would like to withdraw from his/her account.</center></p>
        <form class="form-label-right input_mask" action="" method="">
          <input type="hidden" name="id" id="id" value="<?= $id ?>">
          <div class="col-lg-12 col-md-12 col-sm-12  form-group has-feedback">
            <input type="text" class="form-control has-feedback-right" id="withdraw_amount" name="withdraw_amount" placeholder="0.00000000">
            <span class="fa fa-btc form-control-feedback right" aria-hidden="true"></span>
          </div>
          <p><center>Amount Available: <span class="amount_available"><span></center></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-warning withdraw_operatio_btn" id="deposit_operatio_btn"><i class="fa fa-check"></i> Accept</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Withdraw Operation -->
<!-- Calculator Tool -->
<div class="modal fade bd-example-modal-lg calculatorToolModal" id="calculatorToolModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-refresh"></i> Calculator Tool</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6><center>CONVERTION RATE AS PER BITCOIN PRICE INDEX</center></h6>
        <p><center>Write the amount of BTC would like to convert.</center></p>
        <form class="form-label-right input_mask" action="" method="">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 has-feedback">
              <input type="text" class="form-control has-feedback-left" id="amount_to_convert" name="amount_to_convert" value="1">
              <span class="fa fa-btc form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1">
              <h2>=</h2>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <input type="text" class="form-control" id="convert_value" name="convert_value">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="col-md-9 col-sm-9 ">
                <select class="select2_single form-control" name="currency" id ="currency" tabindex="-1">
                  <option value="USD">USD</option>
                  <option value="EUR">EUR</option>
                  <option value="AUD">AUD</option>
                  <option value="BRL">BRL</option>
                  <option value="CAD">CAD</option>
                  <option value="CHF">CHF</option>
                  <option value="CLP">CLP</option>
                  <option value="CNY">CNY</option>
                  <option value="DKK">DKK</option>
                  <option value="GBP">GBP</option>
                  <option value="HKD">HKD</option>
                  <option value="INR">INR</option>
                  <option value="ISK">ISK</option>
                  <option value="JPY">JPY</option>
                  <option value="KRW">KRW</option>
                  <option value="NZD">NZD</option>
                  <option value="PLN">PLN</option>
                  <option value="RUB">RUB</option>
                  <option value="SEK">SEK</option>
                  <option value="SGD">SGD</option>
                  <option value="THB">THB</option>
                  <option value="TRY">TRY</option>
                  <option value="TWD">TWD</option>
                </select>
              </div>

            </div>
          </div>
          <p id="btcPrice"></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Calculator Tool -->
<?php } ?>
<!-- /page content -->
<?php } ?>
