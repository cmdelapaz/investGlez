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
        <div class="row">
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-4  ">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-university"></i>
            </div>
            <div class="count current_invested_by_company"></div>
            <h3>Current</h3>
            <p>Current amount investing by InvestGlez</p>
          </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4  ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-btc"></i>
          </div>
          <div class="count total_company_profit"></div>
          <h3>Total Profit</h3>
          <p>Total Company Profit</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-4  ">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-download"></i>
        </div>
        <div class="count total_company_withdraw"></div>
        <h3>Total Withdraw</h3>
        <p>Total withdraw by all investors</p>
      </div>
    </div>
        </div>
        <div class="row">
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-4  ">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-bar-chart"></i>
            </div>
            <div class="count last_week_profit"></div>
            <h3>Profit (%)</h3>
            <p>Last Week Profit (%)</p>
          </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4  ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-btc"></i>
          </div>
          <div class="count last_week_company_profit_btc"></div>
          <h3>Profit (<i class="fa fa-btc"></i>)</h3>
          <p>Last Week Profit (<i class="fa fa-btc"></i>)</p>
        </div>
      </div>
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-4  ">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-university"></i>
            </div>
            <div class="count total_invested_by_company"></div>
            <h3>Total</h3>
            <p>Total Invested by InvestGlez</p>
          </div>
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Weekly Profit</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
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
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Weekly Profit Chart</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content" id="chart_content">
                    <canvas class="" id="generalWeeklyIncomeChart"></canvas>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="x_panel">
              <div class="x_title">
                <h2>Monthly Income Chart</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content" id="income_chart_content">
                <canvas class="" id="generalMonthlyIncomeChart"></canvas>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="x_panel">
              <div class="x_title">
                <h2>Online Users</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <ul class="list-unstyled top_profiles scroll-view who_is_online">

              </ul>
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
