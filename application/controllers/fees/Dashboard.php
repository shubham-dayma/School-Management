<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends Fees_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('dashboard');
			$this->load->model('admin/dashboards');		
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['session_recieved'] = $this->dashboards->get_session_fees_recieved($this->session->userdata('academic_session'))->amount;
			$this->data['today_recieved'] = $this->dashboards->get_dated_fees_recieved(date('Y-m-d'))->amount;
			$this->data['month_recieved'] = $this->dashboards->get_between_dates_fees_recieved(date("Y-m-d", strtotime("-30 days",strtotime( date('Y-m-d')))),date('Y-m-d'))->amount;
			$this->data['session_discount'] = $this->dashboards->get_session_discount_given($this->session->userdata('academic_session'))->amount;
			$this->data['todays_recipts'] = $this->dashboards->get_dated_all_recipt($this->session->userdata('academic_session'),date('Y-m-d'));
			//echo '<pre>';print_r($this->data['todays_recipt']);die;
			/*--Chart--*/
			$begin = new DateTime( date("Y-m-d", strtotime("-12 Months",strtotime( date('Y-m-d')))) );
			$end = new DateTime( date("Y-m-d", strtotime("+1 Months",strtotime( date('Y-m-d')))));
			$interval = DateInterval::createFromDateString('1 Month');
			$period = new DatePeriod($begin, $interval, $end);
			foreach ( $period as $dt ){
			  //echo $dt->format( "l Y-m-d H:i:s\n" );
			  $result = $this->dashboards->get_month_fees_recieved($dt->format('m'),$dt->format('Y'))->amount;
			  $mounth[] = !empty($result) ? $result : 0;
			  $dates[] = $dt->format("M, Y");	
			}
			$this->data['mounth'] = json_encode($dates);
			$this->data['mounth_amount'] = json_encode($mounth);
			$this->template->fees_render('fees/dashboard/index',$this->data);
		}
	}	
