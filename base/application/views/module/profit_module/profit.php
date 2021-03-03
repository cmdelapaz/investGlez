<!-- page content -->
<?php if(isset($systm_accss) && isset($artcl_accss) && isset($prsnl_accss) && isset($ttl_accss)){ ?>
  <?php if($systm_accss == 1 || $ttl_accss == 1){ ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= $page_title ?></h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-line-chart"></i>  Insert Profit</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content profit_set">
            <form>
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <input type="text" class="form-control has-feedback-left" id="weekProfit" name="weekProfit" placeholder="DOB">
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  Select the week.
                </div>
                <div class="col-lg-2" id="profit_prcnt" style="display:none">
                  <div class="form-group">
                    <input type="text" class="form-control has-feedback-left" id="profit" name="profit" placeholder="%">
                    <span class="fa fa-line-chart form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  Insert the profit (%) value.
                </div>
                <div class="col-lg-2" id="div_profit_btc">
                  <div class="form-group">
                    <input type="text" class="form-control has-feedback-left" id="profit_btc" name="profit_btc" placeholder="0.00000000">
                    <span class="fa fa-btc form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  Insert the profit (<i class="fa fa-btc"></i>) value.
                </div>
                <div class="col-lg-1">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                    <label class="custom-control-label" for="customSwitch1"><i class="fa fa-btc"></i></label>
                  </div>
                </div>
                <div class="col-lg-4">
                  <button id="btn-save-profit" type="button" class="btn btn-primary" ><i class="fa fa-save"></i> Save</button>
                  <button id="btn-clear-profit" type="button" class="btn btn-warning"><i class="fa fa-eraser"></i> Clear</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-6  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-list-alt"></i>  Profit History</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <table id="table_all_profit" class="display" style="width:100%" class="table">
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
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-area-chart"></i>  Chart Profit History</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content" id="profit_chart">
            <canvas class="" id="profitChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!-- /page content -->
<?php } ?>
