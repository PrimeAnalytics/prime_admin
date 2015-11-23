<!DOCTYPE html>
<html><head><link href="/themes/Santone/assets/img/fav.png" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open Sans:300,400,600"></link>
<link href="http://fonts.googleapis.com/css?family=Archivo Narrow"></link>
<link href="/themes/Santone/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/themes/Santone/assets/css/font-awesome.min.css" rel="stylesheet">
<link href="/themes/Santone/assets/css/metcreative.audio/nouislider.fox.css" rel="stylesheet">
<link href="/themes/Santone/assets/css/metcreative.audio/nouislider.space.css" rel="stylesheet">
<link href="/themes/Santone/assets/css/metcreative.audio/style.css" rel="stylesheet">
<link href="/themes/Santone/assets/css/superfish.css" rel="stylesheet">
<link href="/themes/Santone/assets/css/magnific-popup.css" rel="stylesheet">
<link href="/assets/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet">
<link href="/themes/Santone/assets/css/style.css" rel="stylesheet">
<link href="/themes/Santone/assets/css/responsive.css" rel="stylesheet">
<link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="/assets/plugins/listboxjs/listbox.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/f3e99a6c02/integration/bootstrap/3/dataTables.bootstrap.css">
</head><body><body class="clearfix">
<header class="clearfix"><form method="get" action="?">
		<div class="met_bgcolor met_transition">
			<button type="submit"><i class="fa fa-search"></i></button>
			
</div>
	</form>

	<nav><ul class="met_clean_list">
            <?php foreach ($menu as $item) { ?> 
            <li><a href="<?php echo $item['link']; ?>" class="met_color_transition"><?php echo $item['title']; ?></a></li>  
            <?php } ?>
		</ul></nav><ul class="met_clean_list met_header_socials">
		    
<li><a href="<?php echo $logout; ?>" class="met_color_transition"><i class="fa fa-sign-out"></i></a></li>
    </ul></header><aside class="met_left_bar"><a href="#" class="met_logo"><img src="<?php echo $parm['orgimg']; ?>" alt="" style="max-height:108px;max-width:160px;"></a>
    <div class="row">
        <?php echo $region[0]; ?>
    </div>
<div class="row">
    <?php echo $region[1]; ?>
</div>
</aside><section class="met_content_wrapper clearfix"><div class="met_content_loading"><figure class="met_ajax_loading"></figure></div>

	<!-- Right Side Bar -->
	<div class="met_rightSide">
		<div class="met_rightSide_inner">
			<div class="met_sidebar_block">
                <?php echo $region[2]; ?>
			</div>
<!-- Popular Posts ENDS -->
            <div class="met_sidebar_block">
                <?php echo $region[3]; ?>
            </div>
<!-- Popular Posts ENDS -->
		</div>
	</div>
<!-- Right Side Bar ENDS -->

	<!-- Center Content -->
	<div class="met_content">
		<div class="met_content_inner">
		    <div class="row">
		    <?php echo $filters; ?>
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
<!-- Center Content ENDS -->
</section><!-- Scripts --><!--[if lte IE 8]><script src="js/respond.min.js"></script><![endif]-->
</body><script src="/themes/Santone/assets/js/modernizr.js"></script>
<script src="/themes/Santone/assets/js/jquery-1.11.2.min.js"></script>
<script src="/themes/Santone/assets/js/jquery.easing.js"></script>
<script src="/themes/Santone/assets/js/jquery.mCustomScrollbar.min.js"></script>
<script src="/themes/Santone/assets/js/jquery.mousewheel.min.js"></script>
<script src="/themes/Santone/assets/js/bootstrap.min.js"></script>
<script src="/assets/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.js"></script>
<script src="/themes/Santone/assets/js/retina.js"></script>
<script src="/themes/Santone/assets/js/superfish.js"></script>
<script src="/themes/Santone/assets/js/hoverIntent.js"></script>
<script src="/themes/Santone/assets/js/flickrfeed.min.js"></script>
<script src="/themes/Santone/assets/js/caroufredsel.js"></script>
<script src="/themes/Santone/assets/js/imagesLoaded.js"></script>
<script src="/themes/Santone/assets/js/masonry.js"></script>
<script src="/themes/Santone/assets/js/isotope.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="/themes/Santone/assets/js/gmaps.js"></script>
<script src="/themes/Santone/assets/js/jquery.debounceresize.js"></script>
<script src="/themes/Santone/assets/js/jquery.hcsticky.min.js"></script>
<script src="/themes/Santone/assets/js/jquery.tubeplayer.js"></script>
<script src="/themes/Santone/assets/js/magnific-popup.js"></script>
<script src="/themes/Santone/assets/js/jquery.mixitup.min.js"></script>
<script src="/themes/Santone/assets/js/responsiveCarousel.min.js"></script>
<script src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
<script src="/themes/Santone/assets/js/jquery.nouislider.min.js"></script>
<script src="/themes/Santone/assets/js/metcreative.html5audio.js"></script>
<script src="/themes/Santone/assets/js/scripts.js"></script>

<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="/themes/Pages/assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="/themes/Pages/assets/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="/themes/Pages/assets/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    
    <script type="text/javascript" src="/assets/plugins/listboxjs/listbox.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="https://code.highcharts.com/modules/funnel.js"></script>
        
        <script src="http://www.amcharts.com/lib/3/ammap.js"></script>
<script src="http://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
<script src="http://www.amcharts.com/lib/3/themes/dark.js"></script><?php echo $this->getContent(); ?></body></html>