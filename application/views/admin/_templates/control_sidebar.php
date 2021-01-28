<!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo lang('main_navigation'); ?></li>
<?php if ($this->user->type == 'Admin'){?>
		<!--Admin-->		
        <li class="<?=active_link_controller('dashboard')?> treeview">
          <a href="<?php echo site_url ('admin');?>">
            <i class="fa fa-dashboard"></i> 
			<span><?php echo lang('dashboard'); ?></span>
          </a>
        </li>
		<?php $controllers = array ('academic_session','subject','classes','sections','caste','category','nationality','religion','title','country'); ?>
		<li class="<?php echo (in_array ($this->uri->segment(2),$controllers)) ? 'active' : ''?> treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i> 
			<span><?php echo lang('masters'); ?></span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
				<li class="<?=active_link_controller('academic_session')?> treeview">
				  <a href="<?php echo site_url ('admin/academic_session');?>">
					<i class="fa fa-calendar"></i> 
					<span><?php echo lang('academic_session'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('subject')?> treeview">
				  <a href="<?php echo site_url ('admin/subject');?>">
					<i class="fa fa-book"></i> 
					<span><?php echo lang('subject'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('classes')?> treeview">
				  <a href="<?php echo site_url ('admin/classes');?>">
					<i class="fa fa-building"></i> 
					<span><?php echo lang('classes'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('sections')?> treeview">
				  <a href="<?php echo site_url ('admin/sections');?>">
					<i class="fa fa-list-ol"></i> 
					<span><?php echo lang('sections'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('country')?> treeview">
				  <a href="<?php echo site_url ('admin/country');?>">
					<i class="fa fa-globe"></i> 
					<span><?php echo lang('locality'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('caste')?> treeview">
				  <a href="<?php echo site_url ('admin/caste');?>">
					<i class="fa fa-male"></i> 
					<span><?php echo lang('caste'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('category')?> treeview">
				  <a href="<?php echo site_url ('admin/category');?>">
					<i class="fa fa-male"></i> 
					<span><?php echo lang('category'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('religion')?> treeview">
				  <a href="<?php echo site_url ('admin/religion');?>">
					<i class="fa fa-male"></i> 
					<span><?php echo lang('religion'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('nationality')?> treeview">
				  <a href="<?php echo site_url ('admin/nationality');?>">
					<i class="fa fa-globe"></i> 
					<span><?php echo lang('nationality'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('title')?> treeview">
				  <a href="<?php echo site_url ('admin/title');?>">
					<i class="fa fa-black-tie	"></i> 
					<span><?php echo lang('title'); ?></span>
				  </a>
				</li>
			</ul>
		</li>		
        <li class="<?php echo ($this->uri->segment(2) == 'staff' || $this->uri->segment(2) == 'staff_category' || $this->uri->segment(2) == 'staff_class') ? 'active' : '';?> treeview">
          <a href="#">
            <i class="fa fa-user"></i> 
			<span><?php echo lang('staff'); ?></span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
             <li class="<?=active_link_controller('staff_category')?>">
				<a href="<?php echo site_url ('admin/staff_category'); ?>">
					<i class="fa fa-sitemap"></i>
					<?php echo lang('staff').' '.lang('category'); ?>
				</a>
			</li>
			 <li class="<?=active_link_controller('staff')?>">
				<a href="<?php echo site_url ('admin/staff'); ?>">
					<i class="fa fa-list"></i>
					<?php echo lang('staff').' '.lang('list'); ?>
				</a>
			</li>
            <li class="<?=active_link_controller('staff_class')?>">
				<a href="<?php echo site_url ('admin/staff_class'); ?>">
					<i class="fa fa-sitemap"></i>
					<?php echo lang('assign_class'); ?>
				</a>
			</li>
          </ul>	
        </li>
		<?php $stu_drop_down = array ('student','certificates') ?>
		<li class="<?php echo (in_array ($this->uri->segment(2),$stu_drop_down)) ? 'active' : ''?> treeview">
          <a href="#">
            <i class="fa fa-users"></i> 
			<span><?php echo lang('student'); ?></span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
				<li class="<?=active_link_controller('student')?> treeview">
				  <a href="<?php echo site_url ('admin/student/sections');?>">
					<i class="fa fa-list"></i> 
					<span><?php echo lang('student'); ?></span>
				  </a>
				</li>
				<li class="<?=active_link_controller('certificates')?> treeview">
				  <a href="<?php echo site_url ('admin/certificates');?>">
					<i class="fa fa-certificate"></i> 
					<span><?php echo lang('certificates'); ?></span>
				  </a>
				</li>
			</ul>
		</li>
		<?php $exam_drop_down = array ('exam_scheme','graded_subjects','co_scolastic_grades','marksheet','grades','grade_scheme') ?>
		<li class="<?php echo (in_array ($this->uri->segment(2),$exam_drop_down)) ? 'active' : '';?> treeview">
          <a href="#">
            <i class="fa fa-user"></i> 
			<span><?php echo lang('examination'); ?></span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
             <li class="<?=active_link_controller('exam_scheme')?>">
				<a href="<?php echo site_url ('admin/exam_scheme'); ?>">
					<i class="fa fa-sitemap"></i>
					<?php echo lang('exam_scheme'); ?>
				</a>
			</li>
			 <li class="<?=active_link_controller('graded_subjects')?>">
				<a href="<?php echo site_url ('admin/graded_subjects'); ?>">
					<i class="fa fa-list"></i>
					<?php echo lang('co_scolastic'); ?>
				</a>
			</li>
            <li class="<?=active_link_controller('co_scolastic_grades')?>">
				<a href="<?php echo site_url ('admin/co_scolastic_grades'); ?>">
					<i class="fa fa-sitemap"></i>
					<?php echo lang('co_scolastic_grades'); ?>
				</a>
			</li>
			<li class="<?=active_link_controller('grade_scheme')?>">
				<a href="<?php echo site_url ('admin/grade_scheme'); ?>">
					<i class="fa fa-sitemap"></i>
					<?php echo lang('non_co_scolastic_grades'); ?>
				</a>
			</li>
			<li class="<?=active_link_controller('marksheet')?>">
				<a href="<?php echo site_url ('admin/marksheet'); ?>">
					<i class="fa fa-sitemap"></i>
					<?php echo lang('marksheet').' '.lang('list'); ?>
				</a>
			</li>
          </ul>	
        </li>
		<li class="<?=active_link_controller('staff_role')?> treeview">
          <a href="<?php echo site_url ('admin/staff_role/index/1?staff_cat=2');?>">
            <i class="fa fa-language"></i> 
			<span><?php echo lang('role_managment'); ?></span>
          </a>
        </li>
		<li class="<?=active_link_controller('utilites')?> treeview">
          <a href="<?php echo site_url ('admin/utilites');?>">
            <i class="fa fa-language"></i> 
			<span><?php echo lang('utilites'); ?></span>
          </a>
        </li>
		<?php $report_cont = array('dynamic_report'); ?>
		<li class="<?php echo (in_array ($this->uri->segment(3),$report_cont)) ? 'active' : '' ?> treeview">
          <a href="#">
            <i class="fa fa-language"></i> 
			<span><?php echo lang('reports'); ?></span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <ul class="treeview-menu">
             <li class="<?=active_link_controller('dynamic_report')?>">
				<a href="<?php echo site_url ('admin/dynamic_report'); ?>">
					<i class="fa fa-sitemap"></i>
					<?php echo lang('dynamic_report'); ?>
				</a>
			</li>
		  </ul>	
        </li>
		<li class="<?=active_link_controller('language')?> treeview">
          <a href="<?php echo site_url ('admin/language');?>">
            <i class="fa fa-language"></i> 
			<span><?php echo lang('language'); ?></span>
          </a>
        </li>
		<li class="<?=active_link_controller('setting')?> treeview">
          <a href="<?php echo site_url ('admin/setting');?>">
            <i class="fa fa-wrench"></i> 
			<span><?php echo lang('setting'); ?></span>
          </a>
        </li>
	<!--/Admin-->	
<?php } ?> 
     </ul>
	  
	  </section>
    <!-- /.sidebar -->
  </aside>
