var CoreJS = {

	initialized: false,

	initialize: function() {

		if (this.initialized) return;
		this.initialized = true;

		this.build();
		this.events();

	},

	build: function() {

		this.menu();

		this.flickfeed();

		this.twitterfeed();

		this.miniAudioPlayer();

		this.lightbox();

		this.responsiveNavigation();

		this.contentLoading();

		this.contentLoadingPositioning();


		/*
		 * Main Page Specific
		 * */
		this.mainpagePortfolio();

		this.mainpageIsotope();


		/*
		 * About Me Page Specific
		 * */
		this.twitterInContent();


		/*
		 * Blog List Specific
		 * */
		this.blogListCarousel();


		/*
		 * Contact Specific
		 * */
		this.contactMap();

		this.ajaxContactForm();


		/*
		 * Search Results Specific
		 * */
		this.accordion();


		/*
		 * Services Specific
		 * */
		this.brandsCarousel();


		/*
		 * Index 4 Specific
		 * */
		this.masonryBlog();


		/*
		 * Index 3 Specific
		 * */
		this.verticalCarousel();

		this.fullContentPortfolioDimensions();

		this.fullContentPortfolioPagePositions();


		/*
		 * Index 2 Specific
		 * */
		this.sidebarTabs();


		/*
		 * Box Page Specific
		 * */
		this.boxPageTrigger();



		/*
		 * Portfolio Stripe Specific
		 * */
		this.portfolioStripeSizes();


	},

	events: function() {

		$(window).load(function(){
			// hcSticky plugin for Left Sidebar
			$('.met_left_bar').hcSticky({
				wrapperClassName: 'leftbar-sticky clearfix'
			});
		});

		// hcSticky plugin for Right Sidebar
		if($('.met_rightSide').get(0)){
			$('.met_rightSide').hcSticky({noContainer: true,wrapperClassName: 'rightbar-sticky'});
		}

		// Tabs Widget
		$('#myTab a').click(function(e) {
			e.preventDefault();
			$(this).tab('show');
		});

		// Hiding and Revealing .met_sidebar_hide_seek_contents Contents for Responsive Layout
		$('.met_sidebar_hider_seeker a').click(function(e){
			e.preventDefault();
			var icon = $(this).children('i');
			if(icon.hasClass('fa-chevron-down')){
				$('.met_sidebar_hide_seek_contents').slideDown('slow', function(){
					icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
				});
			}else{
				$('.met_sidebar_hide_seek_contents').slideUp('slow', function(){
					icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
				});
			}
		});

		var ieVersion = CoreJS.ie();
		if(ieVersion <= 9 || Function('/*@cc_on return document.documentMode===10@*/')()){
			$('head').append('<link rel="stylesheet" href="css/ie.css" />');
		}

	},

	// Content Loading Effect
	contentLoading: function(){
		var ieVersion = CoreJS.ie();

		if(ieVersion < 9) return false;

		var met_content_loading = $('.met_content_loading');
		var html_body = $('body,html');
		html_body.css('overflow-y' ,'hidden');
		if(met_content_loading.get(0)){
			var met_content_wrapper = $('.met_content_wrapper');
			met_content_loading.css({
				position: 'fixed',
				width: met_content_wrapper.width(),
				left: met_content_wrapper.offset().left,
				top: met_content_wrapper.offset().top + 4,
				height: ($(window).height() - met_content_wrapper.offset().top - 4)+'px'
			});
			met_content_loading.fadeIn('fast');

			var met_full_portfolio            = $('.met_full_portfolio');
			var met_full_content_portfolio    = $('.met_full_content_portfolio');
			var tabbed_rightSide              = $('.met_rightSide_inner.tabbed');
			var met_portfolio_striped_wrapper = $('.met_portfolio_striped_wrapper');

			if(met_full_portfolio.get(0))            met_full_portfolio.css('visibility', 'hidden');
			if(met_full_content_portfolio.get(0))    met_full_content_portfolio.css('visibility', 'hidden');
			if(tabbed_rightSide.get(0))              tabbed_rightSide.css('visibility', 'hidden');
			if(met_portfolio_striped_wrapper.get(0)) met_portfolio_striped_wrapper.css('visibility', 'hidden');


			$(window).on('load', function(){
				met_content_loading.fadeOut('fast',function(){
					met_content_loading.remove();
					met_full_portfolio.css('visibility', 'visible');
					met_full_content_portfolio.css('visibility', 'visible');
					tabbed_rightSide.css('visibility', 'visible');
					met_portfolio_striped_wrapper.css('visibility', 'visible');
					html_body.css('overflow-y' ,'visible');
				});
			});
		}
	},

	// Responsive Navigation Controls
	responsiveNavigation: function(){
		$('.met_responsive_nav').on('change',function(){
			window.location = $(this).val();
		});
	},

	// Main Menu Plugin
	menu: function() {
		var main_menu = $('.met_left_bar nav ul');
		if(main_menu.get(0)){
			main_menu.superfish({
				delay: 0,
				speed:         'fast',
				speedOut:      'fast',
				onBeforeShow: function(){

				},
				onHide: function(){

				}
			});
		}

		$('.met_left_bar nav ul li').hover(function(){
			$('.leftbar-sticky').css('z-index','10');
			$('.met_content_wrapper').css('z-index','5');
			$('header').css('z-index','15');
		}, function(){
			$('.leftbar-sticky').css('z-index','5');
			$('.met_content_wrapper').css('z-index','15');
			$('header').css('z-index','10');
		});
	},

	// Lightbox Controls
	lightbox: function(){
		var rel_lb = $('[rel*="lb"]');
		rel_lb.each(function(){
			$('[rel="'+$(this).attr('rel')+'"]').magnificPopup({
				type: 'image',
				gallery:{
					enabled: true
				},
				mainClass: 'mfp-3d'
			});
		});
		var rel_video_lb = $('[rel*="video_lb"]');
		rel_video_lb.each(function(){
			$('[rel="'+$(this).attr('rel')+'"]').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false,
				mainClass: 'mfp-3d'
			});
		});
	},

	// Flickr Feed Controls
	flickfeed: function() {
		var met_sidebar_flickr = $('.met_sidebar_flickr');
		if(met_sidebar_flickr.get(0)){
			met_sidebar_flickr.jflickrfeed({
				limit: 10,
				qstrings: {
					id: '12202794@N04'
				},
				itemTemplate: '<li style="position: relative; right: -20px; opacity: 0;"><a href="{{image_b}}" rel="lb_flickr" target="_blank" class="met_transition"><img src="{{image_s}}" alt="{{title}}" /></a></li>',
				itemCallback: function(){
					var lastImage = met_sidebar_flickr.children().last();
					lastImage.imagesLoaded(function(){
						lastImage.animate({
							'right' : 0,
							'opacity': 1
						},300, function(){
							lastImage.removeAttr('style');
						});
					});

				}
			}, function(){
				CoreJS.ajaxLoadingHide($(this).children('.met_ajax_loading'));
				met_sidebar_flickr.find('a').magnificPopup({
					type: 'image',
					gallery:{
						enabled: true
					},
					mainClass: 'mfp-3d'
				});
			});
		}
	},

	// Twitter Feed on Sidebar Controls
	twitterfeed: function() {
		var met_sidebar_tweets = $('.met_sidebar_twitter');
		if(met_sidebar_tweets.get(0)){
			$.getJSON('twitter/get-tweets1.1.php?placement=sidebar',
				function(feeds) {
					met_sidebar_tweets.html('');
					for (var i=0; i<feeds.length; i++) {
						var status = feeds[i].text;
						$('.met_sidebar_twitter').append('<div class="met_sidebar_twit_item">'+status+'</div>');
					}
				}).done(function(){
					met_sidebar_tweets.carouFredSel({
						responsive: false,
						circular: true,
						infinite: true,
						prev: {
							button : function(){
								return $(this).parents('.met_left_bar_box').find('.met_sidebar_twitter_prev')
							}
						},
						next:{
							button : function(){
								return $(this).parents('.met_left_bar_box').find('.met_sidebar_twitter_next')
							}
						},
						auto:{
							play : true,
							pauseDuration: 0,
							duration: 1000
						},
						scroll: {
							duration: 400,
							wipe: true,
							pauseOnHover: true
						},
						items:{
							visible:{
								min: 1,
								max: 1
							},
							height: 'variable'
						},
						height: 'variable',
						direction: 'up',
						swipe:{
							onTouch:true
						},
						onCreate: function(){
							$(window).trigger('resize');
							CoreJS.ajaxLoadingHide($(this).parents('.met_sidebar_twitter_wrapper').find('.met_ajax_loading'));
						}
					});
				});
		}
	},

	// Twitter Feed on Content Controls
	twitterInContent: function() {
		var met_twitter_incontent = $('.met_twitter_incontent');
		if(met_twitter_incontent.get(0)){
			$.getJSON('twitter/get-tweets1.1.php?placement=incontent',
				function(feeds) {
					met_twitter_incontent.html('');
					var screenname = feeds[0]['screen_name'];
					for (var i=0; i<feeds.length; i++) {
						var status = feeds[i].text;
						$('.met_twitter_incontent').append('<div class="met_twitter_incontent_item"><div class="met_color met_twitter_screenname">#'+screenname+'</div>'+status+'</div>');
					}
				}).done(function(){
					met_twitter_incontent.carouFredSel({
						responsive: false,
						circular: true,
						infinite: true,
						auto:{
							play : true,
							pauseDuration: 0,
							duration: 1000
						},
						scroll: {
							duration: 400,
							wipe: true,
							pauseOnHover: true
						},
						items:{
							visible:{
								min: 3,
								max: 3
							},
							height: 'variable'
						},
						height: 'variable',
						direction: 'up',
						swipe:{
							onTouch:true
						},
						onCreate: function(){
							$(window).trigger('resize');
							CoreJS.ajaxLoadingHide($(this).parents('.met_twitter_incontent_wrapper').find('.met_ajax_loading'));
						}
					});
				});
		}
	},

	// Small Ajax Loading Effect
	ajaxLoadingHide: function(e){
		e.animate({
			opacity: 0,
			height: 0
		},400,function(){
			$(this).remove();
		});
	},

	// Big Content Loading Icon Positioning
	contentLoadingPositioning: function(){
		var loader = $('.met_content_loading');
		var spinner = $('.met_content_loading figure');
		if(loader.get(0)){
			var contentPosY = $('.met_content_wrapper').offset().top;
			var marginTop = (($(window).height() - contentPosY) / 2) - 23;
			spinner.css('margin-top', marginTop+'px');
			spinner.animate({opacity: 1}, 400);
			$(window).on('debouncedresize', function(){
				var contentPosY = $('.met_content_wrapper').offset().top;
				var marginTop = (($(window).height() - contentPosY) / 2) - 23;
				spinner.css('margin-top', marginTop+'px');
			});
		}
	},

	// Controls for Audio Player on Sidebar
	miniAudioPlayer: function(){

		if($('html').hasClass('no-audio')) return false;
		if(!$('.met_mini_audioplayer audio').get(0)) return false;

		var audioPlayer         = $('.met_mini_audioplayer audio'),
			metPlayer           = audioPlayer.parent('.met_mini_audioplayer'),
			metPlayerPlay       = metPlayer.children('.met_ma_play_stop'),
			metPlayerAudio      = metPlayer.children('.met_ma_volume'),

			metPlayerProgress   = metPlayer.find('.met_ma_current_progress'),
			progress            = 0,

			minutesContainer    = metPlayer.find('.met_ma_mins'),
			secondsContainer    = metPlayer.find('.met_ma_secs'),
			minutes             = '',
			seconds             = '';

		// Clear All HTML5 Audio Elements Default Controllers
		audioPlayer[0].controls = false;

		if(audioPlayer.attr('autoplay')){
			metPlayerPlay.children('i').removeClass('fa-caret-right').addClass('fa-pause');
		}

		metPlayerPlay.bind('click', function(e){
			e.preventDefault();
			if(audioPlayer[0].paused || audioPlayer[0].ended){
				audioPlayer[0].play();
				metPlayerPlay.children('i').removeClass('fa-caret-right').addClass('fa-pause');
			}else{
				audioPlayer[0].pause();
				metPlayerPlay.children('i').removeClass('fa-pause').addClass('fa-caret-right');
			}
		});

		metPlayerAudio.bind('click', function(e){
			e.preventDefault();
			var vol = $(this).children('i');
			var volumeStatus = vol.attr('class');

			if(volumeStatus == 'fa fa-volume-up'){
				audioPlayer[0].volume = 0.5;
				vol.attr('class', 'fa fa-volume-down');
			}else if(volumeStatus == 'fa fa-volume-down'){
				audioPlayer[0].volume = 0;
				vol.attr('class', 'fa fa-volume-off');
			}else{
				audioPlayer[0].volume = 1;
				vol.attr('class', 'fa fa-volume-up');
			}
		});

		metPlayer.children('.met_ma_progress').bind('click', function(e){
			var x       = e.pageX - $(this).offset().left;
			var width   = $(this).width();
			var percent = Math.floor((x / width) * 100);
			$(this).children().css('width', percent+'%');

			audioPlayer[0].currentTime = Math.floor((percent * audioPlayer[0].duration) / 100);
		});


		audioPlayer[0].addEventListener('timeupdate', function(){

			progress = (100 / audioPlayer[0].duration) * audioPlayer[0].currentTime;
			progress = progress > 100 ? 100 : progress;
			if (audioPlayer[0].currentTime > 0) {

				minutes = Math.floor(audioPlayer[0].currentTime / 60);
				seconds = Math.floor(audioPlayer[0].currentTime % 60);

				if(minutes < 10) minutes = '0'+minutes;
				if(seconds < 10) seconds = '0'+seconds;

				if(minutesContainer.html() != minutes) minutesContainer.html(minutes);
				if(secondsContainer.html() != seconds) secondsContainer.html(seconds);
			}
			metPlayerProgress.css('width', progress+'%');

		}, false);

		audioPlayer[0].addEventListener('ended', function(){

			metPlayerPlay.children('i').removeClass('fa-pause').addClass('fa-caret-right');

		}, false);

	},

	// Index Portfolio Item Controls
	mainpagePortfolio: function(){
		$('.met_fp_item').mouseenter(function(){
			$(this).css('z-index', '3');
			if(!$(this).hasClass('mouseOver')){
				$(this).addClass('mouseOver');
			}
		});

		$('.met_fp_item').mouseleave(function(){
			$(this).css('z-index', '2');
			if($(this).hasClass('mouseOver')){
				$(this).removeClass('mouseOver');
				$(this).stop().animate({
					//opacity: 0.7
				},400,'easeOutQuad', function(){
					$(this).css('z-index', '1');
				});
			}
		});
	},

	// Isotope for Index Items
	mainpageIsotope: function(){
		var $container = $('.met_full_portfolio');

		$container.imagesLoaded(function(){
			$container.mixitup();
		});

		$('.met_portfolio_filter li').click(function(){
			var container = $('.met_portfolio_filter');
			container.children('span').html($(this).html());
		});
	},

	// Isotope/Masonry for Index 4
	masonryBlog: function(){
		var $container = $('.met_blog_list_masonry_style');

		$container.imagesLoaded(function(){
			$container.isotope({masonry: {columnWidth: 1}});
		});
	},

	// Carousel Plugin for Blog Page items
	blogListCarousel: function(){
		$('.crsl-items').carousel();
	},

	// GMaps plugin for Map on Contact Page
	contactMap: function(){
		if($('#map').get(0)){
			var map = new GMaps({
				div: '#map',
				lat: -12.043333,
				lng: -77.028333
			});
			map.addMarker({
				lat: -12.043333,
				lng: -77.028333,
				title: 'MetCreative Office'
			});
		}
	},

	// Contact Form Controls
	ajaxContactForm: function(){
		$('.met_ajax_contact').bind('submit', function(){
			var form    = $(this);
			var me      = $(this).children('button[type=submit]');

			me.attr('disabled','disabled');

			$.ajax({
				type: "POST",
				url: "mail.php",
				data: form.serialize(),
				success: function(returnedInfo){

					var message = $('.met_contact_thank_you');
					returnedInfo == 1 ? message.show() : message.html('Our Mail Servers Are Currently Down<br>Please Try Again Later').show();
					setInterval(function(){message.fadeOut()},5000);
					me.removeAttr('disabled');

				}
			});
			return false;
		});
	},

	// Accordion Element Controls
	accordion: function(){
		$('.met_accordion.met_accordion_on .met_accordion_content').slideDown();
		$('.met_accordion.met_accordion_on').find('.plus').removeClass('plus').addClass('minus').html('-');

		$('.met_accordion_head').click(function(){
			var thisAccordion         = $(this);
			var thisAccordionParent   = thisAccordion.parent();
			var accordionContainer   = thisAccordionParent.parent();

			if(thisAccordionParent.hasClass('met_accordion_on')){
				thisAccordionParent.removeClass('met_accordion_on');
				thisAccordion.next().slideUp();
				thisAccordion.find('.minus').removeClass('minus').addClass('plus').html('+');
			}else{
				accordionContainer.find('.met_accordion_on').removeClass('met_accordion_on').children('.met_accordion_content').slideUp().parent().find('.minus').removeClass('minus').addClass('plus').html('+');
				thisAccordionParent.addClass('met_accordion_on').children('.met_accordion_content').slideDown().parent().find('.plus').removeClass('plus').addClass('minus').html('-');
			}
		});
	},

	// Partners Carousel in Services Page
	brandsCarousel: function(){
		var met_brands_carousel = $(".met_brands_carousel");
		if(met_brands_carousel.get(0)){
			met_brands_carousel.imagesLoaded(function(){
				met_brands_carousel.carouFredSel({
					responsive: false,
					auto: false,
					prev: {
						button : function(){
							return $(this).parents('.met_brands_carousel_wrapper').find('.met_brands_carousel_prev')
						}
					},
					next:{
						button : function(){
							return $(this).parents('.met_brands_carousel_wrapper').find('.met_brands_carousel_next')
						}
					},
					items: {
						visible: 8,
						height: 'variable'
					},
					scroll: {
						items: 1
					},
					width: '100%'
				});
			});
			$(window).load(function(){met_brands_carousel.trigger('updateSizes')});
			$(window).on('debouncedresize',function(){met_brands_carousel.trigger('updateSizes')});

		}
	},

	// Index 3 Vertical Carousel Controls
	verticalCarousel: function(){
		var full_content_carousel = $('.met_full_content_carousel');
		full_content_carousel.carouFredSel({
			responsive: true,
			direction: 'up',
			height: '100%',
			items: {
				height: 80,
				width: '160%',
				visible: {
					min: 2,
					max: 12
				}
			},
			scroll: {
				items: 1,
				duration: 1000,
				onBefore: function(data){
					var oldSlide = $('.met_full_content_portfolio > div:nth-child('+data.items.old.attr('href').replace('#','')+')');
					var newSlide = $('.met_full_content_portfolio > div:nth-child('+data.items.visible.attr('href').replace('#','')+')');

					oldSlide.fadeOut();
					newSlide.fadeIn();
				}
			}
		});

		$('.met_full_content_carousel a').click(function(e) {
			e.preventDefault();
			full_content_carousel.trigger('slideTo', $(this));
		});

		$('.met_full_content_carousel_wrapper .frame-nav-backward').bind('click', function(e){e.preventDefault();full_content_carousel.trigger('prev');});
		$('.met_full_content_carousel_wrapper .frame-nav-forward').bind('click', function(e){e.preventDefault();full_content_carousel.trigger('next');});

		$('.met_full_content_carousel_wrapper .frame-trigger').bind('click', function(e){
			e.preventDefault();
			if($(this).children('i').hasClass('fa-angle-right')){
				CoreJS.verticalCarouselHider('hide');
			}else{
				CoreJS.verticalCarouselHider('show');
			}
		});

		$('.met_full_content_carousel_wrapper .frame-nav-play').bind('click', function(e){
			e.preventDefault();
			if($(this).children('i').hasClass('fa-pause')){
				CoreJS.verticalCarouselAction('stop');
			}else{
				CoreJS.verticalCarouselAction('play');
			}
		});

		$(window).on('debouncedresize', function(){
			full_content_carousel.trigger('updateSizes');
		});

	},

	// Index 3 Vertical Carousel Hiding&Showing Controls
	verticalCarouselHider: function(action){
		if(action == 'hide'){
			$('.met_full_content_carousel_wrapper').addClass('hidden-frame');
			$('.met_full_content_carousel_wrapper .frame-trigger').children('i').removeClass('fa-angle-right').addClass('fa-angle-left');
		}else if('show'){
			$('.met_full_content_carousel_wrapper').removeClass('hidden-frame');
			$('.met_full_content_carousel_wrapper .frame-trigger').children('i').removeClass('fa-angle-left').addClass('fa-angle-right');
		}
	},

	// Index 3 Vertical Carousel Play&Pause Controls
	verticalCarouselAction: function(action){
		if(action == 'play'){
			$('.met_full_content_carousel').trigger('play', true);
			$('.met_full_content_carousel_wrapper .frame-nav-play').children('i').removeClass('fa-play').addClass('fa-pause');
		}else if('stop'){
			$('.met_full_content_carousel').trigger('stop');
			$('.met_full_content_carousel_wrapper .frame-nav-play').children('i').removeClass('fa-pause').addClass('fa-play');
		}
	},

	// Index 3 Size Adjustment
	fullContentPortfolioDimensions: function(){
		if($(window).width() > 1024){
			var theHeight = $(window).height() - 45;
			$(".met_full_content_portfolio").css('height', theHeight+'px');

			$(window).on("debouncedresize", function() {
				var theHeight = $(window).height() - 45;
				$(".met_full_content_portfolio").css('height', theHeight+'px');
			});
		}else{
			var theHeight = $(window).width() / 1.703891708967851;
			$(".met_full_content_portfolio").css('height', theHeight+'px');

			$(window).on("debouncedresize", function() {
				var theHeight = $(window).width() / 1.703891708967851;
				$(".met_full_content_portfolio").css('height', theHeight+'px');
			});
		}

	},

	// Index 3 Content&Vertical Portfolio Positioning/Sizing
	fullContentPortfolioPagePositions: function(){
		if($('.met_full_content_portfolio,.met_portfolio_striped_wrapper.vertical_stripes').get(0)){
			$(window).on('debouncedresize', function(){
				if($(window).width() > 1024){
					$('header').css({
						width: '100%',
						position: 'fixed'
					});

					$('.met_left_bar').css('margin-top', '45px');

					$('.met_content').css({
						position: 'fixed',
						top: '45px'
					});

					$('.met_content').css('width', $('.met_content_wrapper').width()+'px');
				}else{
					$('header').css({
						width: 'auto',
						position: 'relative'
					});

					$('.met_left_bar').css('margin-top', 'auto');

					$('.met_content').css({
						position: 'inherit',
						top: 'auto'
					});

					$('.met_content_wrapper').css('width', '100%');
					$('.met_content').css('width', 'auto');
				}
			});
		}
	},

	// Box Page Show/Hide Controls
	boxPageTrigger: function(){
		var boxPage = $('.met_box_page');
		var boxContent = $('.met_box_content');
		var trigger = $('.met_box_page_trigger');
		var status = trigger.children('i');
		if(boxPage.get(0)){
			trigger.click(function(e){
				e.preventDefault();
				if(status.hasClass('fa-angle-down') && !status.hasClass('sliding')){
					status.removeClass('fa-angle-down').addClass('fa-angle-up sliding');
					boxContent.animate({
						opacity: 1,
						height: 'toggle'
					},'slow', function(){
						status.removeClass('sliding');
					});
				}else if(status.hasClass('fa-angle-up') && !status.hasClass('sliding')){
					status.removeClass('fa-angle-up').addClass('fa-angle-down sliding');
					boxContent.animate({
						opacity: 0,
						height: 'toggle'
					},'slow', function(){
						status.removeClass('sliding');
					});
				}
			});
		}
	},

	// Tab Controls on Index 2 Sidebar
	sidebarTabs: function(){
		if($('.met_rightSide_inner.tabbed').get(0)){
			$('.met_sidebar_tabs nav a').click(function(e){
				e.preventDefault();

				if(!$(this).hasClass('on')){
					$('.met_sidebar_tabs nav a.on').removeClass('on');
					$('.met_sidebar_tabs_content.on').removeClass('on');

					$(this).addClass('on');
					$('#'+$(this).data('tab-content')).addClass('on');
				}
			});
		}
	},

	// Vertical Portfolio Sizing & Custom Scrollbar for it
	portfolioStripeSizes: function(){
		$(window).on('debouncedresize', function(){
			if($(window).width() > 1025){
				$('.vertical_stripes .met_portfolio_striped_item,.met_portfolio_striped_wrapper.vertical_stripes').css('height', ($(window).height() - 45)+'px');
			}else{
				$('.vertical_stripes .met_portfolio_striped_item,.met_portfolio_striped_wrapper.vertical_stripes').css('height', $(window).height()+'px');
			}
		});
		$(window).load(function(){
			$(".vertical_stripes .met_portfolio_striped").mCustomScrollbar({
				horizontalScroll: !0,
				contentTouchScroll: !0,
				scrollInertia: 250,
				advanced:{
					updateOnBrowserResize: !0
				}
			});
		});
	},

	// Internet Explorer Version Checker
	ie: function(){
		var undef,
			v = 3,
			div = document.createElement('div'),
			all = div.getElementsByTagName('i');

		while (
			div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
				all[0]
			);

		return v > 4 ? v : undef;
	}



};

CoreJS.initialize();