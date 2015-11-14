<!DOCTYPE html>
<html><head><link href="/themes/Make/assets/global/images/favicon.png" rel="stylesheet">
<link href="/themes/Make/assets/global/css/style.css" rel="stylesheet">
<link href="/themes/Make/assets/global/css/theme.css" rel="stylesheet">
<link href="/themes/Make/assets/global/css/ui.css" rel="stylesheet">
<link href="/themes/Make/assets/admin/layout1/css/layout.css" rel="stylesheet"></head><body><body class="fixed-topbar fixed-sidebar theme-sdtl color-default">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section><!-- BEGIN SIDEBAR --><div class="sidebar">
        <div class="logopanel">
          <h1>
            <a href="dashboard.html"></a>
          </h1>
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
            <form action="search-result.html" method="post" class="searchform" id="search-results">
              <input type="text" class="form-control" name="keyword" placeholder="Search...">
</form>
            <div class="userlogged clearfix">
              <i class="icon icons-faces-users-01"></i>
              <div class="user-details">
                <h4><?php echo $username; ?></h4>
                <div class="dropdown user-login">
                  <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                  <i class="online"></i><span>Available</span><i class="fa fa-angle-down"></i>
                  </button>
                  <ul class="dropdown-menu">
<li><a href="#"><i class="busy"></i><span>Busy</span></a></li>
                    <li><a href="#"><i class="turquoise"></i><span>Invisible</span></a></li>
                    <li><a href="#"><i class="away"></i><span>Away</span></a></li>
                  </ul>
</div>
              </div>
            </div>
          </div>
          <div class="menu-title">
            Navigation 
            <div class="pull-right menu-settings">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300"> 
              <i class="icon-settings"></i>
              </a>
              <ul class="dropdown-menu">
<li><a href="#" id="reorder-menu" class="reorder-menu">Reorder menu</a></li>
                <li><a href="#" id="remove-menu" class="remove-menu">Remove elements</a></li>
                <li><a href="#" id="hide-top-sidebar" class="hide-top-sidebar">Hide user &amp; search</a></li>
              </ul>
</div>
          </div>
          <ul class="nav nav-sidebar">

<?php foreach ($menu as $item) { ?>
<li><a href="<?php echo $item['link']; ?>"><i class="fa <?php echo $item['icon']; ?>"></i><span><?php echo $item['title']; ?></span></a></li>
<?php } ?>

          </ul>
<!-- SIDEBAR WIDGET FOLDERS --><div class="sidebar-widgets">
            <p class="menu-title widget-title">Folders <span class="pull-right"><a href="#" class="new-folder"> <i class="icon-plus"></i></a></span></p>
         
</div>
          <div class="sidebar-footer clearfix">
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
            <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left btn-effect" href="<?php echo $logout; ?>" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
            <i class="icon-power"></i></a>
          </div>
        </div>
      </div>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
              <ul class="nav nav-icons">
<li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
                <li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>
                <li><a href="#"><span class="octicon octicon-flame"></span></a></li>
                <li><a href="builder-page.html"><span class="octicon octicon-rocket"></span></a></li>
              </ul>
</div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <!-- END USER DROPDOWN -->

              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img src="<?php echo $userimage; ?>" alt="user image"><span class="username">Hi, <?php echo $username; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="<?php echo $logout; ?>"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
                </ul>
</li>
            </ul>
</div>
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
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
          
          
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2015 </span>
                <span>Prime Analytics</span>.
                <span>All rights reserved. </span>
              </p>
              <p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
    </section>
    <!-- BEGIN PRELOADER -->
    <div class="loader-overlay">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <!-- Jquery Cookies, for theme --><!-- simulate synchronous behavior when using AJAX --><!-- Modal with Validation --><!-- Custom Scrollbar sidebar --><!-- Show Dropdown on Mouseover --><!-- Charts Sparkline --><!-- Retina Display --><!-- Select Inputs --><!-- Checkbox & Radio Inputs --><!-- Background Image --><!-- Animated Progress Bar --><!-- Theme Builder --><!-- Sidebar on Hover --><!-- Notes Widget --><!-- Chat Script --><!-- Search Script --><!-- Main Plugin Initialization Script --><!-- Main Application Script --><!-- Main Application Script -->
</body><script src="/themes/Make/assets/global/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script src="/themes/Make/assets/global/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="/themes/Make/assets/global/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="/themes/Make/assets/global/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
<script src="/themes/Make/assets/global/plugins/gsap/main-gsap.min.js"></script>
<script src="/themes/Make/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/themes/Make/assets/global/plugins/jquery-cookies/jquery.cookies.min.js"></script>
<script src="/themes/Make/assets/global/plugins/jquery-block-ui/jquery.blockUI.min.js"></script>
<script src="/themes/Make/assets/global/plugins/bootbox/bootbox.min.js"></script>
<script src="/themes/Make/assets/global/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/themes/Make/assets/global/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script src="/themes/Make/assets/global/plugins/charts-sparkline/sparkline.min.js"></script>
<script src="/themes/Make/assets/global/plugins/retina/retina.min.js"></script>
<script src="/themes/Make/assets/global/plugins/select2/select2.min.js"></script>
<script src="/themes/Make/assets/global/plugins/icheck/icheck.min.js"></script>
<script src="/themes/Make/assets/global/plugins/backstretch/backstretch.min.js"></script>
<script src="/themes/Make/assets/global/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="/themes/Make/assets/global/plugins/charts-chartjs/Chart.min.js"></script>
<script src="/themes/Make/assets/global/js/builder.js"></script>
<script src="/themes/Make/assets/global/js/sidebar_hover.js"></script>
<script src="/themes/Make/assets/global/js/widgets/notes.js"></script>
<script src="/themes/Make/assets/global/js/quickview.js"></script>
<script src="/themes/Make/assets/global/js/pages/search.js"></script>
<script src="/themes/Make/assets/global/js/plugins.js"></script>
<script src="/themes/Make/assets/global/js/application.js"></script>
<script src="/themes/Make/assets/admin/layout1/js/layout.js"></script><?php echo $this->getContent(); ?></body></html>