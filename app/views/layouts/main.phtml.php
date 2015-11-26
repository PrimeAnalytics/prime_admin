<?php use Phalcon\Tag as Tag ?>
<?php $auth = $this->session->get('auth');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="/assets/global/images/favicon.png" type="image/png">
    <title>Prime Analytics - Admin</title>
    <link href="/assets/global/css/style.css" rel="stylesheet">
    <link href="/assets/global/css/theme.css" rel="stylesheet">
    <link href="/assets/global/css/ui.css" rel="stylesheet">
    <link href="/assets/admin/layout1/css/layout.css" rel="stylesheet">
    <!-- BEGIN PAGE STYLE -->
    <link href="/assets/global/plugins/metrojs/metrojs.min.css" rel="stylesheet">
    <link href="/assets/global/plugins/maps-amcharts/ammap/ammap.min.css" rel="stylesheet">
    <!-- END PAGE STYLE -->
    <script src="/assets/global/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
      <script src="/assets/global/plugins/jquery/jquery-1.11.1.min.js"></script>
      <script src="/assets/global/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
      <script src="/assets/global/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
      <script src="/assets/global/plugins/jquery-ui/jquery-ui-droppable-iframe-fix.js"></script>
      <script src="/assets/global/plugins/gsap/main-gsap.min.js"></script>
      <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="/assets/global/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
      <script src="/assets/global/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
      <link href="/assets/global/plugins/hover-effects/hover-effects.min.css" rel="stylesheet">

      
      <link href="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.css" rel="stylesheet">

      <link href="/assets/plugins/croppic/croppic.css" rel="stylesheet">

      <link href="/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
      <link href="/assets/plugins/page-builder/css/style.css" rel="stylesheet">

      <script src="/assets/plugins/bootstrap-select2/select2.js" type="text/javascript"></script>

      <script src="/assets/global/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
      <link href="/assets/global/plugins/icon-picker/css/fontawesome-iconpicker.min.css" rel="stylesheet">
      <script src="/assets/global/plugins/icon-picker/js/fontawesome-iconpicker.js"></script>

      <link href="/assets/global/plugins/jquery-tageditor/jquery.tag-editor.css" rel="stylesheet">


 

  </head>
  <!-- LAYOUT: Apply "submenu-hover" class to body element to have sidebar submenu show on mouse hover -->
  <body class="fixed-topbar fixed-sidebar theme-sdtl color-default dashboard" >
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section>
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar">
        <div class="logopanel">
          <h1>
            <a href="https://primeanalytics.io"></a>
          </h1>
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
            <div class="userlogged clearfix">
              <i class="icon icons-faces-users-01"></i>
              <div class="user-details">
                <h4><?php echo $auth['full_name'] ?></h4>
                <div class="dropdown user-login">
                  <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                  <i class="online"></i><span>Available</span><i class="fa fa-angle-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="#"><i class="busy"></i><span>Busy</span></a></li>
                    <li><a  href="#"><i class="turquoise"></i><span>Invisible</span></a></li>
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
            </div>
          </div>
          <ul class="nav nav-sidebar">

              <?php $menu= $this->elements->getMenu();
              foreach($menu as $menuItem)
              {
              echo '
              <li class="">
                  ';
                  echo Phalcon\Tag::linkTo($menuItem['link'], '<i class="fa '.$menuItem['icon'].'"></i> <span class="title">'.$menuItem['title'].'</span> <span class="selected"></span>');
                  echo '
              </li>';

              }

              ?>

          </ul>
          <!-- SIDEBAR WIDGET FOLDERS -->
          <div class="sidebar-footer clearfix">
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
            <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left btn-effect" href="/session/end" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
            <i class="icon-power"></i></a>
          </div>
        </div>
      </div>
      <!-- END SIDEBAR -->
      <div class="main-content" >
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
              <ul class="nav nav-icons">
                <li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img src="<?php echo $auth['image_path'] ?>" alt="user image">
                <span class="username">Hi, <?php echo $auth['full_name'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="/session/end"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
              <!-- CHAT BAR ICON -->
              <li id="quickview-toggle"><a href="#"><i class="icon-bubbles"></i></a></li>
            </ul>
          </div>
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin" >
                <?php echo $this->getContent() ?>
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright 2015 </span>
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

    <!-- BEGIN SEARCH -->

    <!-- END SEARCH -->
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

    <script src="/assets/global/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
    <script src="/assets/global/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
    <script src="/assets/global/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
    <script src="/assets/global/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
    <script src="/assets/global/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
    <script src="/assets/global/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
    <script src="/assets/global/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
    <script src="/assets/global/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
    <script src="/assets/global/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
    <script src="/assets/global/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="/assets/global/js/application.js"></script> <!-- Main Application Script -->
    <script src="/assets/global/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="/assets/global/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="/assets/global/js/quickview.js"></script> <!-- Chat Script -->
    <script src="/assets/global/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPT -->
    <script src="/assets/global/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
    <script src="/assets/global/plugins/bootstrap-editable/js/bootstrap-editable.min.js"></script> <!-- Inline Edition X-editable -->
    <script src="/assets/global/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js"></script> <!-- Context Menu -->
    <script src="/assets/global/plugins/multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
    <script src="/assets/global/js/widgets/todo_list.js"></script>
    <script src="/assets/global/plugins/metrojs/metrojs.min.js"></script> <!-- Flipping Panel -->
    <script src="/assets/global/plugins/charts-chartjs/Chart.min.js"></script>  <!-- ChartJS Chart -->
    <script src="/assets/global/plugins/charts-highstock/js/highstock.min.js"></script> <!-- financial Charts -->
    <script src="/assets/global/plugins/charts-highstock/js/modules/exporting.min.js"></script> <!-- Financial Charts Export Tool -->
    <script src="/assets/global/plugins/maps-amcharts/ammap/ammap.min.js"></script> <!-- Vector Map -->
    <script src="/assets/global/plugins/maps-amcharts/ammap/maps/js/worldLow.min.js"></script> <!-- Vector World Map  -->
    <script src="/assets/global/plugins/maps-amcharts/ammap/themes/black.min.js"></script> <!-- Vector Map Black Theme -->
    <script src="/assets/global/plugins/skycons/skycons.min.js"></script> <!-- Animated Weather Icons -->
    <script src="/assets/global/plugins/simple-weather/jquery.simpleWeather.js"></script> <!-- Weather Plugin -->
    <script src="/assets/global/js/pages/notifications.js"></script>
      <script src="/assets/global/plugins/colorpicker/spectrum.min.js"></script>
      <script src="/assets/global/plugins/jquery-tageditor/jquery.caret.min.js"></script>
      <script src="/assets/global/plugins/jquery-tageditor/jquery.tag-editor.min.js"></script>
      <script src="/assets/global/plugins/datatables/jquery.dataTables.min.js"></script> 
      <script src="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.js"></script>

      <script src="/assets/plugins/croppic/croppic.js"></script> <!-- Image Croping -->

    <!-- END PAGE SCRIPT -->
   
  </body>
</html>





















            
