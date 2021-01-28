
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b></b>
    </div>
    <strong><?php echo $this->encryption->decrypt($this->setting->owner).' '.$this->setting->footer_text ?></strong> 
  </footer>
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo site_url ('assets/common/bootstrap/js/'); ?>bootstrap.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo site_url ('assets/common/'); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url ('assets/admin/'); ?>dist/js/app.min.js"></script>
<!-- datatable -->
<script src="<?php echo site_url ('assets/admin/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url ('assets/admin/'); ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo site_url ('assets/admin/plugins/redactor/redactor.min.js') ?>"></script>
<script src="<?php echo site_url ('assets/common/plugins/toaster/'); ?>jquery.toaster.js"></script>
<script>
$(document).ready(function (){  
  <?php if ($this->session->flashdata('success')) { ?>
 	 $.toaster('<?php echo $this->session->flashdata('success') ?>', '','purple');
  <?php } ?>
  <?php if ($this->session->flashdata('danger')) { ?>
  	$.toaster('<?php echo $this->session->flashdata('danger') ?>', '','danger');
  <?php } ?>
  $(function () {
    $("#example1").DataTable();
  });
  $('.language').click(function (){
  	call_loader();
	var lang = $(this).attr('data-target');
	$.ajax ({
			url:'<?php echo site_url('admin/language/user_lang'); ?>',
				type:'Post',
				data:{lang:lang},
				success : function (result){
					location.reload();
				}	
	});
  });
   $('.redactor').redactor({
			  // formatting: ['p', 'blockquote', 'h2','img'],
            minHeight: 200,
            imageUpload: '<?php echo site_url('upload/redactor/wysiwyg/upload_image');?>',
            fileUpload: '<?php echo base_url('upload/redactor/wysiwyg/upload_file');?>',
            imageGetJson: '<?php echo base_url('upload/redactor/wysiwyg/get_images');?>',
            imageUploadErrorCallback: function(json)
            {
                alert(json.error);
            },
            fileUploadErrorCallback: function(json)
            {
                alert(json.error);
            }
      
	  });
});

  function remove_loader()
	{
		$('#overlay1').remove();
	}
  function call_loader(){
		if($('#overlay1').length == 0 ){
			var over = '<div id="overlay1">' +
						'<img  style="padding-top:300px; margin: 0 auto; " class="img-responsive " id="loading" src="<?php echo base_url('upload/loader/gif-load.gif')?>"></div>';
			$(over).appendTo('body');
		}
	} 
</script>


</body>
</html>
