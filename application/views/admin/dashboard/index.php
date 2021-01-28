
  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        <?php echo $page_title ?>
      </h1>
     <?php echo $breadcrumb; ?>
    </section>
   <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Classes</span>
              <span class="info-box-number"><?php echo $count_classes ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Students</span>
              <span class="info-box-number"><?php echo $count_students ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Staff</span>
              <span class="info-box-number"><?php echo $count_staffs ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Subjects</span>
              <span class="info-box-number"><?php echo $count_subjects ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
	  <div class="row">
	  	   <div class="col-md-12">
			   <div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">
				  	Session Wise Students Strength
				  </h3>
				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<div class="box-body">
				  <div class="chart">
					<canvas id="areaChart" style="height:250px"></canvas>
				  </div>
				</div>
			  </div>
		  </div>  
	 </div>
	 <div class="row">
	 	<div class="col-md-12">
			<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
			  	Class Wise Students Strength
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
	 <div class="row">
	 	<div class="col-md-12">
			<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
			  	New Admissions
			  </h3>
			</div>
            <div class="box-body">
              <div class="chart">
                <table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
						  <th>Sr.No</th>
						  <th>Admit Date</th>
						  <th>Enrol No</th>
						  <th>Name</th>
						  <th>Father Name</th>
						  <th>Class</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($new_admissions)) { $i = 0; foreach ($new_admissions as $new_admission) { $i++; ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $new_admission->admit_date; ?></td>
							<td><?php echo $new_admission->enrol_no; ?></td>
							<td>
								<a href="<?php echo site_url('admin/student/profile/'.$new_admission->stu_id) ?>">
									<?php echo ucwords($new_admission->fname.' '.$new_admission->mname.' '.$new_admission->mname); ?>
								</a>
							</td>
							<td><?php echo ucwords($new_admission->F_name); ?></td>
							<td><?php echo $new_admission->class_name.' '.$new_admission->section_name; ?></td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>	
              </div>
            </div>
          </div>
		</div>
	 </div> 
	</section>
  </div>
  <script src="<?php echo site_url('assets/admin/plugins/charts/Chart.min.js') ?>" type="text/javascript"></script> 
  <script>
  $(function () {
		var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
		var areaChart = new Chart(areaChartCanvas);
		var areaChartData = {
		  labels: <?php echo $sessions; ?>,
		  datasets: [
			{
			  label: "Digital Goods",
			  fillColor: "rgba(60,141,188,0.9)",
			  strokeColor: "rgba(60,141,188,0.8)",
			  pointColor: "#3b8bba",
			  pointStrokeColor: "rgba(60,141,188,1)",
			  pointHighlightFill: "#fff",
			  pointHighlightStroke: "rgba(60,141,188,1)",
			  data: <?php echo $sess_students; ?>
			}
		  ]
		};
	
		var areaChartOptions = {
		  //Boolean - If we should show the scale at all
		  showScale: true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines: false,
		  //String - Colour of the grid lines
		  scaleGridLineColor: "rgba(0,0,0,.05)",
		  //Number - Width of the grid lines
		  scaleGridLineWidth: 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines: true,
		  //Boolean - Whether the line is curved between points
		  bezierCurve: true,
		  //Number - Tension of the bezier curve between points
		  bezierCurveTension: 0.3,
		  //Boolean - Whether to show a dot for each point
		  pointDot: false,
		  //Number - Radius of each point dot in pixels
		  pointDotRadius: 4,
		  //Number - Pixel width of point dot stroke
		  pointDotStrokeWidth: 1,
		  //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		  pointHitDetectionRadius: 20,
		  //Boolean - Whether to show a stroke for datasets
		  datasetStroke: true,
		  //Number - Pixel width of dataset stroke
		  datasetStrokeWidth: 2,
		  //Boolean - Whether to fill the dataset with a color
		  datasetFill: true,
		  //String - A legend template
		  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio: true,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive: true
		};
		areaChart.Line(areaChartData, areaChartOptions);
		
		/*Class Student Chart*/
		var barChartCanvas = $("#barChart").get(0).getContext("2d");
		var barChart = new Chart(barChartCanvas);
		var barChartData = {
		  labels: <?php echo $class_label ?>,
	  	  datasets: [
			{
			  label: "Total Students",
			  fillColor: "rgba(210, 214, 222, 1)",
			  strokeColor: "rgba(210, 214, 222, 1)",
			  pointColor: "rgba(210, 214, 222, 1)",
			  pointStrokeColor: "#c1c7d1",
			  pointHighlightFill: "#fff",
			  pointHighlightStroke: "rgba(220,220,220,1)",
			  data: <?php echo $total_students ?>
			},
			{
			  label: "Male Students",
			  fillColor: "#00a65a",
			  strokeColor: "#00a65a",
			  pointColor: "#00a65a",
			  pointStrokeColor: "rgba(60,141,188,1)",
			  pointHighlightFill: "#fff",
			  pointHighlightStroke: "rgba(60,141,188,1)",
			  data: <?php echo $male_students ?>
			},
			{
			  label: "Female Students",
			  fillColor: "#f39c12",
			  strokeColor: "#f39c12",
			  pointColor: "#f39c12",
			  pointStrokeColor: "rgba(60,141,188,1)",
			  pointHighlightFill: "#fff",
			  pointHighlightStroke: "rgba(60,141,188,1)",
			  data: <?php echo $female_students ?>
			}
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
  