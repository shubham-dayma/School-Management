<!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo lang('main_navigation'); ?></li>
<?php if ($this->user->type == 'Staff'){?>
		<!--Staff-->		
        <li class="<?=active_link_controller('dashboard')?> treeview">
          <a href="<?php echo site_url ('staff');?>">
            <i class="fa fa-dashboard"></i> 
			<span><?php echo lang('dashboard'); ?></span>
          </a>
        </li>
		<li class="<?=active_link_controller('myclass')?> treeview">
          <a href="<?php echo site_url ('staff/myclass');?>">
            <i class="fa fa-graduation-cap"></i> 
			<span><?php echo lang('myclass'); ?></span>
          </a>
        </li>
		<li class="<?=active_link_controller('myrole')?> <?=active_link_controller('marks_manager')?> treeview">
          <a href="<?php echo site_url ('staff/myrole');?>">
            <i class="fa fa-calculator"></i> 
			<span><?php echo lang('myrole'); ?></span>
          </a>
        </li>
		<li class="<?=active_link_controller('report')?> treeview">
          <a href="<?php echo site_url ('staff/report');?>">
            <i class="fa fa-files-o"></i> 
			<span><?php echo lang('reports'); ?></span>
          </a>
        </li>
		
<?php } ?> 
     </ul>
	  
	  </section>
    <!-- /.sidebar -->
  </aside>
