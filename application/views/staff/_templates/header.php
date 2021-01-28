<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->setting->school_name; ?></title>
  <link rel="icon" href="<?php echo site_url('upload/favicon/'.$this->setting->favicon) ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo site_url ('assets/common/'); ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url ('assets/common/font-awesome-4.4.0/css/'); ?>font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo site_url ('assets/common/ionicons/css/'); ?>ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url ('assets/admin/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo site_url ('assets/admin/'); ?>dist/css/skin-yellow-light.min.css">
  <!-- datatable -->
  <link rel="stylesheet" href="<?php echo site_url ('assets/admin/'); ?>/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo site_url ('assets/admin/plugins/redactor/redactor.css') ?>">
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo site_url ('assets/common/plugins/jQuery/'); ?>jquery-2.2.3.min.js"></script>
 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style>
#overlay1 {
	position: fixed;
	left: 0;
	top: 0;
	bottom: 0;
	right: 0;
	background: #ffffff;
	opacity: 0.7;
	filter: alpha(opacity=80);
	-moz-opacity: 0.6;
	z-index: 10000;
}
</style>
<body class="sidebar-mini skin-yellow-light fixed">
<div class="wrapper">
<?php $this->load->library('encryption',array('key'=>$this->config->item('encryption_key'))); ?>