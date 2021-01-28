	<!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo lang('main_navigation'); ?></li>
<?php if ($this->user->type == 'Fees'){?>
		<!--Admin-->		
        <li class="<?=active_link_controller('dashboard')?> treeview">
          <a href="<?php echo site_url ('fees');?>">
            <i class="fa fa-dashboard"></i> 
			<span><?php echo lang('dashboard'); ?></span>
          </a>
        </li>
		<li class="<?=active_link_controller('heads')?>">
			<a href="<?php echo site_url ('fees/heads'); ?>">
				<i class="fa fa-sitemap"></i>
				<?php echo lang('fee_heads'); ?>
			</a>
		</li>
		<?php $controllers = array ('bill_scheme','classes'); ?>
		<li class="<?php echo (in_array ($this->uri->segment(2),$controllers)) ? 'active' : '';?> treeview">
          <a href="#">
            <i class="fa fa-columns"></i> 
			<span><?php echo lang('bills'); ?></span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
             <li class="<?=active_link_controller('bill_scheme')?>">
				<a href="<?php echo site_url ('fees/bill_scheme'); ?>">
					<i class="fa fa-circle-o"></i>
					<?php echo lang('bill_schemes'); ?>
				</a>
			</li>
			<li class="<?=active_link_controller('classes')?>">
				<a href="<?php echo site_url ('fees/classes'); ?>">
					<i class="fa fa-circle-o"></i>
					<?php echo lang('classes'); ?>
				</a>
			</li>
          </ul>	
        </li>
		<li class="<?=active_link_controller('fast_bills')?> treeview">
          <a href="<?php echo site_url('fees/fast_bills') ?>">
            <i class="fa fa-file-text"></i> 
			<span><?php echo lang('fast_bills'); ?></span>
		  </a>
        </li>
		<li class="<?=active_link_controller('counter')?> treeview">
          <a href="<?php echo site_url ('fees/counter');?>">
            <i class="fa fa-inr"></i> 
			<span><?php echo lang('fees_counter'); ?></span>
          </a>
        </li>
		<li class="<?=active_link_controller('recipt')?> treeview">
          <a href="<?php echo site_url ('fees/recipt');?>">
            <i class="fa fa-search"></i> 
			<span><?php echo lang('search').' '.lang('recipt'); ?></span>
          </a>
        </li>
		<li class="<?=active_link_controller('reports')?> treeview">
          <a href="<?php echo site_url ('fees/reports');?>">
            <i class="fa fa-book"></i> 
			<span><?php echo lang('reports'); ?></span>
          </a>
        </li>
		
	<!--/Admin-->	
<?php } ?> 
     </ul>
	  
	  </section>
    <!-- /.sidebar -->
  </aside>
