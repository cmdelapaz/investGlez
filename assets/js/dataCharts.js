// Weekly Income Chart Admin Dashboard
$(document).ready(function(){
    var paramWeeks = [];
    var paramValues = [];
    $.ajax({
      url:'../ctrl_investor/get_weekly_profit_chart_data',
      dataType: 'json',
      method: 'POST',
      success: function (data){
        $.each(data,function (i,item){
          paramWeeks.push(item.week_data_range);
          paramValues.push(item.btc_profit);
        });
        $("#generalWeeklyIncomeChart").remove();
        $("#chart_content").append('<canvas class="" id="generalWeeklyIncomeChart"></canvas>');

        var ctx = $("#generalWeeklyIncomeChart");

        var generalWeeklyIncomeChart = new Chart(ctx,
                {
                  type: "line",
                  data:{
                    labels: paramWeeks,
                    datasets: [
                            {
                              label: "Income",
                              fill: true,
                              lineTension: 0.1,
                              backgroundColor: "rgba(255,197,7,0.3)",
                              borderColor: "rgba(255,193,7,1)",
                              borderCapStyle: "butt",
                              borderDash: [],
                              borderDashOffset:0.0,
                              borderJoinStyle: "miter",
                              pointBorderColor: "rgba(255,193,7,1)",
                              pointBackgroundColor: "#fff",
                              pointBorderWidth: 10,
                              pointHoverRadius: 5,
                              pointHoverBackgroundColor:"rgba(255,193,7,0.4)",
                              pointHoverBorderColor: "rgba(255,193,7,1)",
                              pointHoverBorderWidth: 5,
                              pointRadius:1,
                              pointHitRadius:10,
                              data: paramValues,
                              spanGaps:false
                            }
                        ]
                  },
                  options:{
                    responsive:true,
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem) {
                          return "Income: BTC " + Number(tooltipItem.yLabel);
                        }
                      }
                    },
                    title:{
                      display: true,
                      text:'Weekly Profit Chart'
                    },
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero: true
                        }
                      }]
                    }
                  }
                }
            )
      }
    })
});

// Weekly Income Chart Admin Dashboard
$(document).ready(function(){
    var paramMonths = [];
    var paramValues = [];
    $.ajax({
      url:'../ctrl_investor/get_monthly_income_chart_data',
      dataType: 'json',
      method: 'POST',
      success: function (data){
        $.each(data,function (i,item){
          paramMonths.push(item.month);
          paramValues.push(item.deposit_amount);
        });


        $("#generalMonthlyIncomeChart").remove();
        $("#income_chart_content").append('<canvas class="" id="generalMonthlyIncomeChart"></canvas>');

        var ctx = $("#generalMonthlyIncomeChart");

        var generalMonthlyIncomeChart = new Chart(ctx,
                {
                  type: "line",
                  data:{
                    labels: paramMonths,
                    datasets: [
                            {
                              label: "Income",
                              fill: true,
                              lineTension: 0.1,
                              backgroundColor: "rgba(255,197,7,0.3)",
                              borderColor: "rgba(255,193,7,1)",
                              borderCapStyle: "butt",
                              borderDash: [],
                              borderDashOffset:0.0,
                              borderJoinStyle: "miter",
                              pointBorderColor: "rgba(255,193,7,1)",
                              pointBackgroundColor: "#fff",
                              pointBorderWidth: 10,
                              pointHoverRadius: 5,
                              pointHoverBackgroundColor:"rgba(255,193,7,0.4)",
                              pointHoverBorderColor: "rgba(255,193,7,1)",
                              pointHoverBorderWidth: 5,
                              pointRadius:1,
                              pointHitRadius:10,
                              data: paramValues,
                              spanGaps:false
                            }
                        ]
                  },
                  options:{
                    responsive:true,
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem) {
                          return "Income: BTC " + Number(tooltipItem.yLabel);
                        }
                      }
                    },
                    title:{
                      display: true,
                      text:'Monthly Income Chart'
                    },
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero: true
                        }
                      }]
                    }
                  }
                }
            )
      }
    })
});

// Weekly Income Chart Investor Dashboard
$(document).ready(function(){
    var paramWeeks = [];
    var paramValues = [];
    var id = $('#id').val();
    $.ajax({
      url:'../ctrl_investor/get_investor_weekly_profit_chart_data',
      dataType: 'json',
      method: 'POST',
      data:{id:id},
      success: function (data){
        $.each(data,function (i,item){
          paramWeeks.push(item.week_data_range);
          paramValues.push(item.profit_btc);
        });
        $("#investorWeeklyIncomeChart").remove();
        $("#investor_weekly_profit_chart").append('<canvas class="" id="investorWeeklyIncomeChart"></canvas>');

        var ctx = $("#investorWeeklyIncomeChart");

        var generalWeeklyIncomeChart = new Chart(ctx,
                {
                  type: "line",
                  data:{
                    labels: paramWeeks,
                    datasets: [
                            {
                              label: "Income",
                              fill: true,
                              lineTension: 0.1,
                              backgroundColor: "rgba(255,197,7,0.3)",
                              borderColor: "rgba(255,193,7,1)",
                              borderCapStyle: "butt",
                              borderDash: [],
                              borderDashOffset:0.0,
                              borderJoinStyle: "miter",
                              pointBorderColor: "rgba(255,193,7,1)",
                              pointBackgroundColor: "#fff",
                              pointBorderWidth: 10,
                              pointHoverRadius: 5,
                              pointHoverBackgroundColor:"rgba(255,193,7,0.4)",
                              pointHoverBorderColor: "rgba(255,193,7,1)",
                              pointHoverBorderWidth: 5,
                              pointRadius:1,
                              pointHitRadius:10,
                              data: paramValues,
                              spanGaps:false
                            }
                        ]
                  },
                  options:{
                    responsive:true,
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem) {
                          return "Income: BTC " + Number(tooltipItem.yLabel);
                        }
                      }
                    },
                    title:{
                      display: true,
                      text:'Weekly Profit Chart'
                    },
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero: true
                        }
                      }]
                    }
                  }
                }
            )
      }
    })
});

// Weekly Activities Chart Investor
$(document).ready(function(){
    var paramWeeks = [];
    var paramContribution = [];
    var paramCompounding = [];
    var paramWithdraw = [];
    //var paramActivities = [];
    var id = $('#id').val();
    $.ajax({
      url:'../ctrl_investor/get_investor_monthly_activity_chart_data',
      dataType: 'json',
      method: 'POST',
      data:{id:id},
      success: function (data){
        $.each(data,function (i,item){
          if(item.operation_type == 'Compounding'){
            paramWeeks.push(item.month);
            paramCompounding.push(item.deposit_amount);
          }else if(item.operation_type == 'Contribution'){
            paramWeeks.push(item.month);
            paramContribution.push(item.deposit_amount);
          }else if(item.operation_type == 'Withdraw'){
            paramWeeks.push(item.month);
            paramWithdraw.push(item.deposit_amount);
          }
        });
        $("#investorMonthlyActivitiesChart").remove();
        $("#investor_monthly_activities_chart").append('<canvas class="" id="investorMonthlyActivitiesChart"></canvas>');

        var ctx = $("#investorMonthlyActivitiesChart");

        var generalWeeklyIncomeChart = new Chart(ctx,
                {
                  type: "bar",
                  data:{
                    labels: paramWeeks,
                    datasets: [
                            {
                              label: "Compounding",
                              backgroundColor: window.chartColors.green,
                              data: paramCompounding,
                            },
                            {
                              label: "Contribution",
                              backgroundColor: window.chartColors.blue,
                              data: paramContribution,
                            },
                            {
                              label: "Withdraw",
                              backgroundColor: window.chartColors.red,
                              data: paramWithdraw,
                            }
                        ]
                  },
                  options: {
          					title: {
          						display: true,
          						text: 'Activities'
          					},
          					tooltips: {
          						mode: 'index',
          						intersect: false
          					},
          					responsive: true,
          					scales: {
          						xAxes: [{
          							stacked: true,
          						}],
          						yAxes: [{
          							stacked: true
          						}]
          					}
          				}
                }
            )
      }
    })
});

// Weekly Profit Chart profit view
$(document).ready(function(){
    var paramWeeks = [];
    var paramValues = [];
    $.ajax({
      url:'../ctrl_investor/get_weekly_profit_chart_data',
      dataType: 'json',
      method: 'POST',
      success: function (data){
        $.each(data,function (i,item){
          paramWeeks.push(item.week_data_range);
          paramValues.push(item.btc_profit);
        });
        $("#profitChart").remove();
        $("#profit_chart").append('<canvas class="" id="profitChart"></canvas>');

        var ctx = $("#profitChart");

        var generalWeeklyIncomeChart = new Chart(ctx,
                {
                  type: "line",
                  data:{
                    labels: paramWeeks,
                    datasets: [
                            {
                              label: "Income",
                              fill: true,
                              lineTension: 0.1,
                              backgroundColor: "rgba(255,197,7,0.3)",
                              borderColor: "rgba(255,193,7,1)",
                              borderCapStyle: "butt",
                              borderDash: [],
                              borderDashOffset:0.0,
                              borderJoinStyle: "miter",
                              pointBorderColor: "rgba(255,193,7,1)",
                              pointBackgroundColor: "#fff",
                              pointBorderWidth: 10,
                              pointHoverRadius: 5,
                              pointHoverBackgroundColor:"rgba(255,193,7,0.4)",
                              pointHoverBorderColor: "rgba(255,193,7,1)",
                              pointHoverBorderWidth: 5,
                              pointRadius:1,
                              pointHitRadius:10,
                              data: paramValues,
                              spanGaps:false
                            }
                        ]
                  },
                  options:{
                    responsive:true,
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem) {
                          return "Income: BTC " + Number(tooltipItem.yLabel);
                        }
                      }
                    },
                    title:{
                      display: true,
                      text:'Weekly Profit Chart'
                    },
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero: true
                        }
                      }]
                    }
                  }
                }
            )
      }
    })
});
