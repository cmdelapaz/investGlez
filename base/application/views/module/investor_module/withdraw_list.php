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
            <h2><i class="fa fa-download"></i>  Withdraws</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="table_all_withdraw" class="display" style="width:100%" class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Investor</th>
                  <th>Amount</th>
                  <th>Operation Date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Investor</th>
                  <th>Amount</th>
                  <th>Operation Date</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!-- /page content -->
<?php } ?>
