
  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        <?php echo $page_title ;?>
      </h1>
     <?php echo $breadcrumb; ?>
    </section>
   <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-check-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo lang('session_fees_recieved') ?></span>
              <span class="info-box-number"><?php echo !empty($session_recieved) ? $session_recieved : '0' ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo lang('last_30_days_fees_recieved') ?></span>
              <span class="info-box-number"><?php echo !empty($month_recieved) ? $month_recieved : '0' ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar-times-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo lang('today_recieved') ?></span>
              <span class="info-box-number"><?php echo !empty($today_recieved) ? $today_recieved : '0' ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-calendar-minus-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo lang('session_discount_given'); ?></span>
              <span class="info-box-number"><?php echo !empty($session_discount) ? $session_discount : '0' ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
	  <div class="row">
	  	   <div class="col-md-12">
			   <div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title">
				  	<?php echo lang('fees_recieved').' : '.lang('from').' '.date('M, Y', strtotime("- 12 months", strtotime (date('Y-m-d')))).' '.lang('to').' '.date('M, Y') ?>
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
			   <div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title">
				  	<?php echo lang('todays_recipt');?>
				  </h3>
				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<div class="box-body">
				  <table id="example" class="table table-bordered table-striped">
					<thead>
						<tr>
						  <th><?php echo lang('sr.no') ?></th>
						  <th><?php echo lang('recipt_no') ?></th>
						  <th><?php echo lang('student').' '.lang('name') ?></th>
						  <th><?php echo lang('father').' '.lang('name') ?></th>
						  <th><?php echo lang('class') ?></th>
						  <th><?php echo lang('recipt').' '.lang('status') ?></th>
						  <th><?php echo lang('amount') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($todays_recipts)) { $i = 0; foreach ($todays_recipts as $todays_recipt) { $i++;?>
						<tr>
						  <td><?php echo $i ?></td>
						  <td><?php echo $todays_recipt->recipt_no ?></td>
						  <td>
						  	<a href="<?php echo site_url('fees/recipt/print/'.$todays_recipt->recipt_no) ?>">
								<?php echo ucwords ($todays_recipt->fname.' '.$todays_recipt->mname.' '.$todays_recipt->lname) ?>
							</a>
						  </td>
						  <td><?php echo ucwords($todays_recipt->f_name); ?></td>
						  <td><?php echo $todays_recipt->class.' '.$todays_recipt->section; ?></td>
						  <td>
						  	<span class="label label-<?php echo  ($todays_recipt->recipt_status == 0) ? 'success' : 'danger' ?>">
								<?php echo ($todays_recipt->recipt_status == 0) ? lang('active') : lang('canceled') ?>
						 	</span>
						  </td>
						  <td><?php echo $todays_recipt->sum_amount; ?></td>
						</tr>
						<?php } } ?>
					</tbody>
				 </table>
				</div>
			  </div>
		  </div>  
	 </div>
	 
	</section>
  </div>
  <script src="<?php echo site_url('assets/admin/plugins/charts/Chart.min.js') ?>" type="text/javascript"></script> 
  <script>
  	$(document).ready(function (){
			$('#example').DataTable();
	});		
	$(function () {
		var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
		var areaChart = new Chart(areaChartCanvas);
		var areaChartData = {
		  labels: <?php echo $mounth; ?>,
		  datasets: [
			{
			  label: "Digital Goods",
			  fillColor: "#dd4b39",
			  strokeColor: "#dd4b39",
			  pointColor: "#3b8bba",
			  pointStrokeColor: "rgba(60,141,188,1)",
			  pointHighlightFill: "#fff",
			  pointHighlightStroke: "rgba(60,141,188,1)",
			  data: <?php echo $mounth_amount; ?>
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
	});	
  </script>