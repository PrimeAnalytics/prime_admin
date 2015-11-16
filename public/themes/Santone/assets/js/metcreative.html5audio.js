$(document).ready(function(){

	if($('html').hasClass('no-audio') || $('html').hasClass('no-video')) return false;

	$(".met_audio_volume .noUiSlider").noUiSlider({
		range: [0, 100],
		start: 100,
		handles: 1,
		orientation: "horizontal",
		slide : function(){
			var volume           = Math.floor($(this).val());
			var audioPlayer      = $(this).parents('.met_audio_player').prev('audio,video')[0];
			var theVolumeCounter = $(this).parents('.met_audio_sound').children('.met_audio_sound_volume');
			var theVolumeIcon    = $(this).parents('.met_audio_sound').children('i');

			if(volume == 0){
				theVolumeIcon.attr('class', 'fa fa-volume-off');
			}else if(volume < 50){
				theVolumeIcon.attr('class', 'fa fa-volume-down');
			}else{
				theVolumeIcon.attr('class', 'fa fa-volume-up');
			}

			theVolumeIcon.attr('data-volume', volume);
			theVolumeCounter.html(volume);

			audioPlayer.volume = volume == 0 ? 0 : volume / 100;

			theVolumeIcon.fadeOut(function(){
				theVolumeCounter.fadeIn(function(){
					theVolumeCounter.fadeOut();
					theVolumeIcon.fadeIn();
				});
			});
		}
	});

	$('.met_html5_audio audio,.met_html5_video video').each(function(){

		var audioPlayer         = $(this);
		var metPlayer           = audioPlayer.next('.met_audio_player');
		var metPlayerPlay       = metPlayer.children('a.met_audio_play_pause');
		var metPlayerAudio      = metPlayer.children('.met_audio_sound').children('i');

		var metPlayerProgress   = metPlayer.children('.met_audio_progress_bar').children('.met_audio_current_progress');
		var progress            = 0;

		var minutesContainer    = metPlayer.children('.met_audio_current_time').children('.met_audio_current_time_minutes');
		var secondsContainer    = metPlayer.children('.met_audio_current_time').children('.met_audio_current_time_seconds');
		var minutes             = '';
		var seconds             = '';

		// Clear All HTML5 Audio Elements Default Controllers
		audioPlayer[0].controls = false;

		audioPlayer[0].addEventListener('loadedmetadata', function(){
			var durationMins        = Math.floor(audioPlayer[0].duration / 60);
			var durationSecs        = Math.floor(audioPlayer[0].duration % 60);
			durationMins            = durationMins < 10 ? '0'+durationMins : durationMins;
			durationSecs            = durationSecs < 10 ? '0'+durationSecs : durationSecs;

			metPlayer.children('.met_audio_total_time').html(durationMins+':'+durationSecs);
		});

		metPlayerPlay.bind('click', function(e){
			e.preventDefault();
			if(audioPlayer[0].paused || audioPlayer[0].ended){
				audioPlayer[0].play();
				metPlayerPlay.removeClass('met_play').children('i').removeClass('fa-play').addClass('fa-pause');
			}else{
				audioPlayer[0].pause();
				metPlayerPlay.removeClass('met_play').children('i').removeClass('fa-pause').addClass('fa-play');
			}
		});

		metPlayerAudio.bind('click', function(){

			var volumeStatus = $(this).attr('class');
			var volume       = $(this).data('volume');

			if(volumeStatus == 'fa fa-volume-up' || volumeStatus == 'fa fa-volume-down'){
				$(this).removeClass(volumeStatus).addClass('fa-volume-off');
				audioPlayer[0].volume = 0;
			}else{
				audioPlayer[0].volume = metPlayerAudio.attr('data-volume') == 0 ? 0 : metPlayerAudio.attr('data-volume') / 100;
				if(volume > 0 && volume < 50){
					$(this).removeClass(volumeStatus).addClass('fa-volume-down');
				}else{
					$(this).removeClass(volumeStatus).addClass('fa-volume-up');
				}
			}

		});

		metPlayer.children('.met_audio_progress_bar').bind('click', function(e){
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
	});

});