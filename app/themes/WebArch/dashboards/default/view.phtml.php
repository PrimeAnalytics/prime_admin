<!DOCTYPE html>
<html><head><link href="/themes/WebArch/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet">
<link href="/themes/WebArch/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet">
<link href="/themes/WebArch/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="/themes/WebArch/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="/themes/WebArch/assets/css/animate.min.css" rel="stylesheet">
<link href="/themes/WebArch/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet">
<link href="/themes/WebArch/assets/css/style.css" rel="stylesheet">
<link href="/themes/WebArch/assets/css/responsive.css" rel="stylesheet">
<link href="/themes/WebArch/assets/css/custom-icon-set.css" rel="stylesheet"></head><body><body class="">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse "> 
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
	<div class="header-seperation"> 
		<ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
<li class="dropdown"> <a id="main-menu-toggle" href="#main-menu" class=""> <div class="iconset top-menu-toggle-white"></div> </a> </li>		 
		</ul>
<!-- BEGIN LOGO --><a href="index.html"><img src="<?php echo $parm['orgimage']; ?>" class="logo" alt="" data-src="assets/img/logo.png" data-src-retina="assets/img/logo2x.png" width="106" height="21"></a>
      <!-- END LOGO --> 
      <ul class="nav pull-right notifcation-center">
<li class="dropdown" id="header_task_bar"> <a href="#" class="dropdown-toggle active" data-toggle=""> <div class="iconset top-home"></div> </a> </li>
		<li class="dropdown" id="portrait-chat-toggler" style="display:none"> <a href="#sidr" class="chat-menu-toggle"> <div class="iconset top-chat-white "></div> </a> </li>        
      </ul>
</div>
      <!-- END RESPONSIVE MENU TOGGLER --> 
      <div class="header-quick-nav"> 
      <!-- BEGIN TOP NAVIGATION MENU -->
	  <div class="pull-left"> 
        <ul class="nav quick-section">
<li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle">
            <div class="iconset top-menu-toggle-dark"></div>
            </a> </li>
        </ul>
<ul class="nav quick-section">
<li class="quicklinks"> <a href="#" class="">
            <div class="iconset top-reload"></div>
            </a> </li>
          <li class="quicklinks"> <span class="h-seperate"></span>
</li>
          <li class="quicklinks"> <a href="#" class="">
            <div class="iconset top-tiles"></div>
            </a> </li>
			<li class="m-r-10 input-prepend inside search-form no-boarder">
				<span class="add-on"> <span class="iconset top-search"></span></span>
				 <input name="" type="text" class="no-boarder " placeholder="Search Dashboard" style="width:250px;">
</li>
		  </ul>
</div>
	 <!-- END TOP NAVIGATION MENU -->
	 
	 <div class="pull-right"> 
		<div class="chat-toggler">	
				<a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content="" data-toggle="dropdown" data-original-title="Notifications">
					<div class="user-details"> 
						<div class="username">
							<?php echo $username; ?>									
						</div>						
					</div> 
					<div class="iconset top-down-arrow"></div>
				</a>	
				<div class="profile-pic"> 
					<img src="<?php echo $userimage; ?>" alt="" data-src="<?php echo $userimage; ?>" data-src-retina="<?php echo $userimage; ?>" width="35" height="35"> 
				</div>       			
			</div>
		 <ul class="nav quick-section ">
			<li class="quicklinks"> 
				<a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">						
					<div class="iconset top-settings-dark "></div> 	
				</a>
				<ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                  <li><a href="<?php echo $logout; ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
               </ul>
			</li> 
		</ul>
      </div>
      </div> 
      <!-- END TOP NAVIGATION MENU --> 
   
  </div>
  <!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar" id="main-menu"> 
  <!-- BEGIN MINI-PROFILE -->
   <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper"> 
   <div class="user-info-wrapper">	
	<div class="profile-wrapper">
		<img src="<?php echo $userimage; ?>" alt="" data-src="<?php echo $userimage; ?>" data-src-retina="<?php echo $userimage; ?>" width="69" height="69">
</div>
    <div class="user-info">
      <div class="greeting">Welcome</div>
      <div class="username"><?php echo $username; ?>
</div>
      <div class="status">Status<a href="#"><div class="status-icon green"></div>Online</a>
</div>
    </div>
   </div>
  <!-- END MINI-PROFILE -->
   
   <!-- BEGIN SIDEBAR MENU -->	
	<p class="menu-title">BROWSE <span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>
    <ul>
        <?php foreach ($menu as $item) { ?> 
        <li class=""> <a href="<?php echo $item['link']; ?>"> <i class="fa <?php echo $item['icon']; ?>"></i> <span class="title"><?php echo $item['title']; ?></span> </a> </li>  
        <?php } ?>
    </ul>
	<div class="clearfix"></div>
    <!-- END SIDEBAR MENU --> 
  </div>
  </div>
  <a href="#" class="scrollup">Scroll</a>
   <div class="footer-widget">		
	<div class="pull-right">
		<div class="details-status">
		<span data-animation-duration="560" data-value="86" class="animate-number"></span>%
	</div>	
	<a href="<?php echo $logout; ?>"><i class="fa fa-power-off"></i></a>
</div>
  </div>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
<div class="row">
    <?php echo $region[0]; ?>
</div>
<div class="row">
    <?php echo $region[1]; ?>
</div>
<div class="row">
    <?php echo $region[2]; ?>
</div>
<div class="row">
    <?php echo $region[3]; ?>
</div>
<div class="row">
    <?php echo $region[4]; ?>
</div>
<div class="row">
    <?php echo $region[5]; ?>
</div>
<div class="row">
    <?php echo $region[6]; ?>
</div>
<div class="row">
    <?php echo $region[7]; ?>
</div>
<div class="row">
    <?php echo $region[8]; ?>
</div>
<div class="row">
    <?php echo $region[9]; ?>
</div>


    </div>
  </div>
 </div>
<!-- END CONTAINER --> 

<!-- END CONTAINER -->
<!-- BEGIN CORE JS FRAMEWORK--> 
<!-- END CORE JS FRAMEWORK --><!-- BEGIN PAGE LEVEL JS --><!-- END PAGE LEVEL PLUGINS --><!-- BEGIN CORE TEMPLATE JS --><!-- END CORE TEMPLATE JS -->
</body><script src="/themes/WebArch/assets/plugins/jquery-1.8.3.min.js"></script>
<script src="/themes/WebArch/assets/plugins/boostrapv3/js/bootstrap.min.js"></script>
<script src="/themes/WebArch/assets/plugins/breakpoints.js"></script>
<script src="/themes/WebArch/assets/plugins/jquery-unveil/jquery.unveil.min.js"></script>
<script src="/themes/WebArch/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="/themes/WebArch/assets/plugins/pace/pace.min.js"></script>
<script src="/themes/WebArch/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js"></script>
<script src="/themes/WebArch/assets/js/core.js"></script>
<script src="/themes/WebArch/assets/js/chat.js"></script><?php echo $this->getContent(); ?></body></html>