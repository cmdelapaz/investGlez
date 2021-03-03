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
            <h2 class="text-warning"> <i class="fa fa-calculator"></i> Calculator - <small>Converter</small> </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
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
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php } ?>
<!-- /page content -->
<?php } ?>
