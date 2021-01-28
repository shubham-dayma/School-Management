<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
		 <?php $gender = ($this->user->gender == 0) ? 'm_002.png' : 'f_005.png' ?>
          <img src="<?php echo site_url ('upload/users/'); ?><?php echo (!empty($this->user->img) ? $this->user->img : $gender)  ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="position: initial">
          <p><?php echo ucwords ($this->user->fname).' '.ucwords ($this->user->lname); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang ('online'); ?></a>
        </div>
      </div>
      