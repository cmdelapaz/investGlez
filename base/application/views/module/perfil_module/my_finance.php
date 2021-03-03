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
          <div class="x_title">
            <h2 class="text-warning"> <i class="fa fa-table"></i> Active Financing </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
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
        </div>
        <div class="clearfix"></div>
      </div>

        <div class="clearfix"></div>

    </div>
  </div>
</div>
<!-- /page content -->
<?php } ?>
<!-- /page content -->
<?php } ?>
