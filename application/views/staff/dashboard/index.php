
  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        <?php echo $page_title ;?>
      </h1>
     <?php echo $breadcrumb; ?>
    </section>
   <section class="content">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">My Class</span>
              <span class="info-box-number"><?php echo $class->name.' '.$section->name ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">My Students</span>
              <span class="info-box-number"><?php echo $stu_count ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
	  </div>
	  <div class="row">
	 	<div class="col-md-12">
			<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">
			  	Students Performance
			  </h3>
			   <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
          </div>
		</div>
	 </div>
	</section>
  </div>
 <script src="<?php echo site_url('assets/admin/plugins/charts/Chart.min.js') ?>" type="text/javascript"></script>  
<script>
$(function (){
	var barChartCanvas = $("#barChart").get(0).getContext("2d");
		var barChart = new Chart(barChartCanvas);
		var barChartData = {
		  labels: <?php echo $chart_student ?>,
	  	  datasets: [
			{
			  label: "Total Students",
			  fillColor: "#f39c12",
			  strokeColor: "#f39c12",
			  pointColor: "#f39c12",
			  pointStrokeColor: "#f39c12",
			  pointHighlightFill: "#f39c12",
			  pointHighlightStroke: "rgba(220,220,220,1)",
			  data: <?php echo $chart_student_percent ?>
			},
		  ]
		};
		/*barChartData.datasets[1].fillColor = "#00a65a";
		barChartData.datasets[1].strokeColor = "#00a65a";
		barChartData.datasets[1].pointColor = "#00a65a";*/
		
		var barChartOptions = {
		  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		  scaleBeginAtZero: true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines: true,
		  //String - Colour of the grid lines
		  scaleGridLineColor: "rgba(0,0,0,.05)",
		  //Number - Width of the grid lines
		  scaleGridLineWidth: 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines: true,
		  //Boolean - If there is a stroke on each bar
		  barShowStroke: true,
		  //Number - Pixel width of the bar stroke
		  barStrokeWidth: 2,
		  //Number - Spacing between each of the X value sets
		  barValueSpacing: 5,
		  //Number - Spacing between data sets within X values
		  barDatasetSpacing: 1,
		  //String - A legend template
		  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		  //Boolean - whether to make the chart responsive
		  responsive: true,
		  maintainAspectRatio: true
		};
	
		barChartOptions.datasetFill = false;
		barChart.Bar(barChartData, barChartOptions);
});
</script>  