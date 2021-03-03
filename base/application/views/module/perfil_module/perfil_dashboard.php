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
      <div class="col-md-12 col-sm-12  ">
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
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="text-warning"><i class="fa fa-table"></i> Weekly Report - <small>Table</small> </h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

              <table id="table_investor_profit_perfil" class="display" style="width:100%" class="table">
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
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="text-warning"><i class="fa fa-area-chart"></i> Weekly Profit - <small>Chart</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content" id="investor_weekly_profit_chart">
                <canvas class="" id="investorWeeklyIncomeChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php } ?>
<!-- /page content -->
<?php } ?>
