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
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_content">
            <div class="col-md-12 col-sm-12 form-group pull-right top_search">
              <div class="input-group">
                <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-warning" type="button">Go!</button>
                </span>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row" id="result">

  </div>
</div>
<?php } ?>
<!-- /page content -->
<?php } ?>
