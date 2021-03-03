<!-- page content -->
<?php if(isset($systm_accss) && isset($artcl_accss) && isset($prsnl_accss) && isset($ttl_accss)){ ?>
  <?php if($prsnl_accss == 1){ ?>
    <input type="hidden" name="id" id="id" value="<?= $id ?>">
    <input type="hidden" name="id_privilege_hidden" id="id_privilege_hidden" value="<?= $privileges ?>">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= $page_title ?></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="x_panel">

          <div class="x_content">
            <div class="col-md-3 col-sm-3  profile_left investor_info_profile">
              <div class="profile_img">
                <div id="crop-avatar">
                  <img class="img-responsive avatar-view" src="<?= base_url()."assets/dashboard/"; ?>production/images/user.png" alt="Avatar" title="Change the avatar">
                </div>
              </div>
              <h3 id="first_last_name"></h3>
              <div class="btn-group">
                <input type="hidden" name="first_last_name_hidden" id="first_last_name_hidden" value="">
                <button type="button" class="btn btn-success btn-sm deposit_btn" data-toggle="modal" data-placement="top" title="Deposit" data-target=".deposit_operation_modal" data-original-title="Deposit"><i class="fa fa-btc"></i> Deposit</button>



                <button type="button" class="btn btn-danger btn-sm withdraw_btn" data-toggle="modal" data-placement="top" title="Withdraw" data-target=".withdraw_operation_modal" data-original-title="Withdraw"><i class="fa fa-download"></i> Withdraw</button>
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
                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Edit User Information</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Compounding Setting</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Edit Perfil</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">
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
                    <button type="button" class="btn btn-primary btn-warning update-btn-investor-conf" id="update-btn-investor-conf"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                  </form>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <div class="row justify-content-md-start">
                      <div class="col-md-auto">
                        <h4>Commission Capitalizacion</h4>
                      </div>
                      <div class="col col-lg-2"></div>
                      <div class="col col-lg-2"></div>
                    </div>
                    <form action="" method="">
                      <div class="row justify-content-md-start">
                        <div class="col-md-auto">
                          <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="compounding" id="compounding"/>
                        </div>
                        <div class="col col-lg-2"></div>
                        <div class="col col-lg-2"></div>
                      </div>
                      <div class="row justify-content-md-start">
                        <div class="col-md-auto">

                          <label>If the button is green (ON) you will be using Compound Interest. <br>If it's set in red (OFF) you will be requesting a withdraw every week</label>
                        </div>
                        <div class="col col-lg-2"></div>
                        <div class="col col-lg-2"></div>
                      </div>
                      <button type="button" class="btn btn-primary btn-warning compounding_btn" id="compounding_btn"><i class="fa fa-check"></i> Accept</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                    </form>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                    <form>
                      <input type="hidden" name="id" id="id" value="<?= $id ?>">
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <input type="password" class="form-control has-feedback-left" id="current_passwd" name="current_passwd" placeholder="Current Password">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            <?php echo form_error('current_passwd', '<div class="text-danger">', '</div>') ?>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <input type="password" class="form-control has-feedback-left" id="new_passwd" name="new_passwd" placeholder="Password">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            <?php echo form_error('new_passwd', '<div class="text-danger">', '</div>') ?>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <input type="password" class="form-control has-feedback-left" id="re_passwd" name="re_passwd" placeholder="Repeat Password">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            <?php echo form_error('re_passwd', '<div class="text-danger">', '</div>') ?>
                          </div>
                        </div>
                      </div>
                      <button type="button" class="btn btn-primary btn-warning edit_profile_investor_data" id="commission_cap"><i class="fa fa-save"></i> Save</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                    </form>
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
<!-- /page content -->
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
<?php } ?>
<!-- /page content -->
<?php } ?>
