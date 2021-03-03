<!-- page content -->
<?php if(isset($systm_accss) && isset($artcl_accss) && isset($prsnl_accss) && isset($ttl_accss)){ ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= $page_title ?></h3>
      </div>
    </div>

    <div class="clearfix"></div>
<?php if($systm_accss == 1 || $ttl_accss == 1){ ?>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-plus-square-o"></i> Add Investor</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal form-label-left">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="x_title">
                    <h4 class="text-warning"><i class="fa fa-info-circle"></i> Personal Info</h4>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="text" class="form-control has-feedback-left" id="first_name" name="first_name" placeholder="First Name">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="text" class="form-control has-feedback-left" id="last_name" name="last_name" placeholder="Last Name">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="text" class="form-control has-feedback-left" id="dob" name="dob" placeholder="DOB">
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="email" class="form-control has-feedback-left" id="email" name="email" placeholder="Email">
                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4"><h6>Status: </h6></label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <select class="select2_single form-control" id="status" name="status" tabindex="-1">
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
                    <h4 class="text-warning"><i class="fa fa-shield"></i> Privilege Info</h4>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
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
                        <td><small class="text-default">Checking this box the investor will also have access to System's funtionalities.</small></td>
                        <td><small class="text-default">Checking this box the investor will also have access to Article's funtionalities.</small></td>
                        <td><small class="text-default">Checking this box the investor will also have access to Personal's funtionalities.</small></td>
                        <td><small class="text-default">Checking this box the investor will have Total access to the funtionalities.</small></td>
                      </tr>
                      </tbody>
                    </table>
                </div>
              </div>
              <div class="clearfix"></div>
              <br>
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="x_title">
                    <h4 class="text-warning"><i class="fa fa-unlock-alt"></i> Access Info</h4>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="text" class="form-control has-feedback-left" id="username" name="username" placeholder="Username">
                    <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="password" class="form-control has-feedback-left" id="passwd" name="passwd" placeholder="Password">
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="password" class="form-control has-feedback-left" id="r_passwd" name="r_passwd" placeholder="Repeat Password">
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="x_title">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <button id="btn-clear-new-investor" type="button" class="btn btn-warning"><i class="fa fa-eraser"></i> Clear</button>
                  <button id="btn-save-new-investor" type="button" class="btn btn-primary" ><i class="fa fa-save"></i> Save</button>
                </div>
              </div>
          </form>
          </div>
        </div>
      </div>
    </div>
<?php } ?>
    <div class="clearfix"></div>
<?php if ($ttl_accss == 1) {?>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-reorder"></i> List of Investors</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="table_quick_investors_list" class="display" style="width:100%" class="table">
      <thead>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Options</th>
          </tr>
      </thead>

      <tfoot>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Options</th>
          </tr>
      </tfoot>
  </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Delete User Modal -->
<div class="modal fade bd-example-modal-sm delete_modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content" style="background-color: #FEF3CD">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-exclamation-circle"></i> Confirmation Needed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this record?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-danger" id="confirm_delete"><i class="fa fa-check"></i> Deleted</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- /Delete User Modal -->
<!-- Show User information Modal -->
<div class="modal fade bd-example-modal-sm details_modal" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-body">
        <div class="widget widget_tally_box">
          <div class="x_panel fixed_height_390">
            <div class="x_content">
              <div class="flex">
                <ul class="list-inline widget_profile_box">
                  <li>
                    <img src="<?= base_url()."assets/dashboard/"; ?>production/images/user.png" alt="..." class="img-circle profile_img">

                  </li>
                  <li></li>
                </ul>
              </div>
              <h4 class="name full_name" style="color:#2A3F54;font-size:20px"></h4>
              <div class="flex">
                <ul class="list-inline count2 privileges">
                </ul>
              </div>
              <label class="status"></label><br>
              <label class="username"></label><br>
              <label class="email"></label><br>
              <label class="created_date"></label>
              <?= form_open('welcome/fetch_investor_profile'); ?>
              <input type="hidden" name="id_data" id="id_data">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-folder-open-o"></i> Open</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div></form>
    </div>
  </div>
</div>
<!-- /Show User information Modal -->
<!-- Edit User Info Modal -->
<div class="modal fade bd-example-modal-lg edit_modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-body">
        <div class="widget widget_tally_box">
          <div class="x_panel ui-ribbon-container fixed_height_390">
            <div class="ui-ribbon-wrapper">
              <div class="ui-ribbon quick-edit-model">
                status
              </div>
            </div>
            <div class="x_title">
              <h2><i class="fa fa-edit"></i> Quick Edit Info</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control has-feedback-left" id="edit_first_name" name="edit_first_name" placeholder="First Name">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      <input type="hidden" class="form-control has-feedback-left" id="edit_id" name="edit_id">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control has-feedback-left" id="edit_last_name" name="edit_last_name" placeholder="Last Name">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="email" class="form-control has-feedback-left" id="edit_email" name="edit_email" placeholder="Email">
                      <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control has-feedback-left" id="edit_username" name="edit_username" placeholder="Username">
                      <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="col-md-12">
                        <select class="select2_single form-control" id="edit_status" name="edit_status" tabindex="-1">
                          <option value="-1">Select a Status...</option>
                          <option value="1">Active Investor</option>
                          <option value="0">Inactive Investor</option>
                          <option value="2">Pending Investor</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm update-btn-investor"><i class="fa fa-save"></i> Updated</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- /Edit USer Info Modal -->
<!-- Edit Confirmation Modal -->
<div class="modal fade bd-example-modal-sm edit_confirmation_modal" id="editConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-primary btn-success" id="confirm_edit"><i class="fa fa-check"></i> Accept</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!-- /Edit Confirmation Modal -->
<!-- /page content -->
<?php } ?>
