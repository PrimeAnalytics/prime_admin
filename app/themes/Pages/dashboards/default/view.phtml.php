<!DOCTYPE html>
<html><head><link href="/themes/Pages/assets/pages/ico/60.png" rel="stylesheet">
<link href="/themes/Pages/assets/pages/ico/76.png" rel="stylesheet">
<link href="/themes/Pages/assets/pages/ico/120.png" rel="stylesheet">
<link href="/themes/Pages/assets/pages/ico/152.png" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/mapplic/css/mapplic.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
<link href="/themes/Pages/assets/assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet">
<link href="/themes/Pages/assets/pages/css/pages-icons.css" rel="stylesheet">
<link href="/themes/Pages/assets/pages/css/pages.css" rel="stylesheet"></head><body><body class="fixed-header   ">
    <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
      <!-- BEGIN SIDEBAR MENU HEADER-->
      <div class="sidebar-header">
        <img src="<?php echo $parm['orgimg']; ?>" alt="logo" class="brand" data-src="<?php echo $parm['orgimg']; ?>" data-src-retina="<?php echo $parm['orgimg']; ?>" width="78" height="22"><div class="sidebar-header-controls">
          <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu">
          </button>
          <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
          </button>
        </div>
      </div>
      <!-- END SIDEBAR MENU HEADER-->
      <!-- START SIDEBAR MENU -->
      <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
            <?php foreach ($menu as $link) { ?>


<li class="">
            <a href="<?php echo $link['link']; ?>">
              <span class="title"><?php echo $link['title']; ?></span>
            </a>
            <span class="icon-thumbnail"><i class="fa <?php echo $link['icon']; ?>"></i></span>
          </li>
          
          <?php } ?>

        </ul>
<div class="clearfix"></div>
      </div>
      <!-- END SIDEBAR MENU -->
    </nav><!-- END SIDEBAR --><!-- END SIDEBPANEL--><!-- START PAGE-CONTAINER --><div class="page-container">
      <!-- START HEADER -->
      <div class="header ">
        <!-- START MOBILE CONTROLS -->
        <!-- LEFT SIDE -->
        <div class="pull-left full-height visible-sm visible-xs">
          <!-- START ACTION BAR -->
          <div class="sm-action-bar">
            <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">
              <span class="icon-set menu-hambuger"></span>
            </a>
          </div>
          <!-- END ACTION BAR -->
        </div>
        <!-- END MOBILE CONTROLS -->
        <div class=" pull-left sm-table">
          <div class="header-inner">
            <div class="brand inline">
              <img src="<?php echo $parm['logo']; ?>" alt="logo" data-src="<?php echo $parm['logo']; ?>" data-src-retina="<?php echo $parm['logo']; ?>" width="78" height="22">
</div>
</div>
        </div>

        <div class=" pull-right">
          <!-- START User Info-->
          <div class="visible-lg visible-md m-t-10">
            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
              <span class="semi-bold"><?php echo $username; ?></span>
            </div>
            <div class="dropdown pull-right">
              <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="<?php echo $userimage; ?>" alt="" data-src="<?php echo $userimage; ?>" data-src-retina="<?php echo $userimage; ?>" width="32" height="32"></span>
              </button>
              <ul class="dropdown-menu profile-dropdown" role="menu">
                <li class="bg-master-lighter">
                  <a href="<?php echo $logout; ?>" class="clearfix">
                    <span class="pull-left">Logout</span>
                    <span class="pull-right"><i class="pg-power"></i></span>
                  </a>
                </li>
              </ul>
</div>
          </div>
          <!-- END User Info-->
        </div>
      </div>
      <!-- END HEADER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
          
                    <div class="container-fluid"><div class="row">
<?php echo $region['0']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['1']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['2']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['3']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['4']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['5']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['6']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['7']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['8']; ?>
</div></div>
<div class="container-fluid"><div class="row">
<?php echo $region['9']; ?>
</div></div>
          
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
              <span class="hint-text">Copyright © 2015 </span>
              <span class="font-montserrat">Prime Analytics</span>.
              <span class="hint-text">All rights reserved. </span>
              <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
            </p>
            <p class="small no-margin pull-right sm-pull-reset">
              <a href="#">Hand-crafted</a> <span class="hint-text">&amp; Made with Love ®</span>
            </p>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    <!-- BEGIN VENDOR JS -->
    <!-- END VENDOR JS --><!-- BEGIN CORE TEMPLATE JS --><!-- END CORE TEMPLATE JS --><!-- BEGIN PAGE LEVEL JS --><!-- END PAGE LEVEL JS -->
</body><script src="/themes/Pages/assets/assets/plugins/pace/pace.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/modernizr.custom.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/boostrapv3/js/bootstrap.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery/jquery-easy.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery-unveil/jquery.unveil.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery-ios-list/jquery.ioslist.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/bootstrap-select2/select2.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/classie/classie.js"></script>
<script src="/themes/Pages/assets/assets/plugins/switchery/js/switchery.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/nvd3/lib/d3.v3.js"></script>
<script src="/themes/Pages/assets/assets/plugins/nvd3/nv.d3.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/nvd3/src/utils.js"></script>
<script src="/themes/Pages/assets/assets/plugins/nvd3/src/tooltip.js"></script>
<script src="/themes/Pages/assets/assets/plugins/nvd3/src/interactiveLayer.js"></script>
<script src="/themes/Pages/assets/assets/plugins/nvd3/src/models/axis.js"></script>
<script src="/themes/Pages/assets/assets/plugins/nvd3/src/models/line.js"></script>
<script src="/themes/Pages/assets/assets/plugins/nvd3/src/models/lineWithFocusChart.js"></script>
<script src="/themes/Pages/assets/assets/plugins/mapplic/js/hammer.js"></script>
<script src="/themes/Pages/assets/assets/plugins/mapplic/js/jquery.mousewheel.js"></script>
<script src="/themes/Pages/assets/assets/plugins/mapplic/js/mapplic.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/assets/global/plugins/morris/morris.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/rickshaw/rickshaw.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery-metrojs/MetroJs.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="/themes/Pages/assets/assets/plugins/skycons/skycons.js"></script>
<script src="/themes/Pages/assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/themes/Pages/assets/pages/js/pages.min.js"></script>
<script src="/themes/Pages/assets/assets/js/dashboard.js"></script>
<script src="/themes/Pages/assets/assets/js/scripts.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="/themes/Pages/assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="/themes/Pages/assets/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="/themes/Pages/assets/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<?php echo $this->getContent(); ?></body></html>