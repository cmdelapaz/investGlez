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
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">

            <h2><i class="fa fa-tasks"></i>  List of Investors</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="table_full_investors_list" class="display" style="width:100%" class="table">
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
