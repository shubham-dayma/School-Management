<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo site_url('admin'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $this->setting->school_name; ?></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-language"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo lang('languages'); ?></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
				  <?php foreach ($this->languages as $lang) { 
				  		$check = '';
						if ($lang->name == $this->session->userdata('lang')){
							$check = 'fa fa-check';
						}
				  ?>
				  	<li>
						<a href="#" class="language" data-target = "<?php echo $lang->name; ?>">
							<div class="pull-left">
                        		<img src="<?php echo site_url ('upload/language/')?><?php echo (!empty ($lang->img)) ? $lang->img : 'images.jpg'; ?>" 
								class="img-circle" alt="User Image" style="height:20px;">
                      		</div>
							<h4>
								<?php echo ucwords ($lang->name) ?>
								<div class="pull-right">
								<i class="<?php echo $check ?>" style="color:#f39c12"></i>
							</div>
							</h4>
							
						</a>
					</li>
				  <?php } ?>	
                </ul>
				
			  </li>
			  <li class="footer"></li>
			 </ul>
		   </li>  	
		  <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				   <?php $gender = ($this->user->gender == 0) ? 'm_002.png' : 'f_005.png' ?>
              <img src="<?php echo site_url ('upload/users/'); ?><?php echo (!empty($this->user->img) ? $this->user->img : $gender)  ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucwords ($this->user->fname).' '.ucwords ($this->user->lname); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo site_url ('upload/users/'); ?><?php echo (!empty($this->user->img) ? $this->user->img : $gender)  ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo ucwords ($this->user->fname).' '.ucwords ($this->user->lname); ?> - <?php echo ucwords ($this->setting->school_name); ?>
					  <small><?php echo lang('member_since'); ?> <?php echo date('M Y', strtotime($this->user->creat_date));  ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url ('staff/profile') ?>" class="btn btn-default btn-flat"><?php echo lang('profile'); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url ('common/auth/logout') ?>" class="btn btn-default btn-flat"><?php echo lang('sign_out'); ?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>

    </nav>
  </header>