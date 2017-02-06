jQuery(document).ready(function($){

	var scrollPos = $(window).scrollTop()
		, winHeight = $(window).height()
		, docHeight = $(document).height()
		, scrollItems = $('body, #main-nav')
		, bottomRule = $('#main-nav').find('.nav-rule.bottom')
		, pastIssues = $('#past-issues')
		, content = $('#content')
		, adminBarHeight = 0
		;

	size_cover();
	wrap_videos();

	$(window).bind({
		load : function(){
			scroll_nav();
			$('#cover').css('opacity',1);
		},
		resize : function(){
			setTimeout(function(){
				winHeight = $(window).height();
				size_cover();
			}, 30 );
		},
		scroll : function(){
			setTimeout(function(){
				scroll_nav();
			}, 30 );
		}
	});


if ( $('body').hasClass('admin-bar') && $('#wpadminbar') ) {
	adminBarHeight = $('#wpadminbar').height();
}
else { adminBarHeight = 0; }

function scroll_nav() {

	scrollPos = $(window).scrollTop()
	, winHeight = $(window).height()
	, winWidth = $(window).width()
	, docHeight = $(document).height();

	if ( winWidth > 600 ) {
		// different logic for the home page
		if ( $('body').hasClass('home') ) {

			// if the nav meets the top of the window
			if ( (scrollPos + adminBarHeight) >= $('#main-nav').offset().top ) {
				
				scrollItems.addClass('scrolled');
				handleSpecialNav('scrolled');

				// if the content scrolls up to meet the nav
				if ( ( $('#main-nav').height() + scrollPos ) <= content.offset().top ) {
					scrollItems.removeClass('scrolled');	
					handleSpecialNav('unscrolled');
				}	

				if ( scrollPos + $('#main-nav').height() >= pastIssues.offset().top ) {
					bottomRule.css('visibility','hidden');
				}
				else {
					bottomRule.css('visibility','visible');
				}
			}
			else {
				scrollItems.removeClass('scrolled');
				handleSpecialNav('unscrolled');
				bottomRule.css('visibility','hidden');
			}
		}
		// all other pages
		if ( $('body').hasClass('not-home') ) {
			// console.log('not home');
			// if the document is tall enough ...
			if ( docHeight > winHeight+200 ) {
				// console.log('not home','gate 1');
				if ( scrollPos >= 200 ) {
					// console.log('not home','gate 2');
					if ( !scrollItems.hasClass('scrolled') ) {
						// console.log('not home','gate 3');
						scrollItems.addClass('scrolled');
						handleSpecialNav('scrolled');
						bottomRule.css('visibility','visible');
					}
					if ( $('body').hasClass('single') ) {
						// console.log('not home, single');
						if ( ( scrollItems.height() + scrollPos ) >= $('#issue-table-of-contents').offset().top ) {
							// console.log('not home, single','gate 1');
							bottomRule.css('visibility','visible');
						}
						else {
							// console.log('not home, single','gate 1 — else');
							bottomRule.css('visibility','hidden');
						}
					}
				} 
				else {
					// console.log('not home','gate 2 — else');
					scrollItems.removeClass('scrolled');
					handleSpecialNav('unscrolled');
					bottomRule.css('visibility','hidden');
				}
			}
		}
	} else {
		scrollItems.removeClass('scrolled');
		handleSpecialNav('unscrolled');
	}

	function handleSpecialNav(state) {
		if ( scrollItems.hasClass('special') ) {
			if ( state == 'scrolled') {
				$('#main-nav').removeClass('white-bg').addClass('color-bg');
			} else {
				$('#main-nav').removeClass('color-bg').addClass('white-bg');
			}
		}
	}

}


function size_cover() {
	if ( !$('#cover').hasClass('special') ) {
		var h = $('#cover .text-wrapper').height() + $('#cover .mark-wrapper').height();
		$('#cover .inner-wrapper').css('height', h+'px');
	} else { 
		// h = winHeight - 45 - $('#main-nav').height();
		// $('#cover .wrapper').css('height', h+'px');
		// console.log( 'special', h )
	}
}


function wrap_videos() {

	var vimeoPrefs = "?color=ffffff&title=0&byline=0&portrait=0&api=1"
		, videos = $("iframe[src*='vimeo.com'], iframe[src*='youtube.com']")
		;

	// if iframes exist, go!
	if ( $("iframe").length > 0 ) {

		// if video embeds exist, and they are not wrapped
		if ( videos.length >= 1 && $(".video-container").length < 1 ) {
			// wrap them
			wrapVideos(videos);
		}

		// add vimeo preferences, if not already applied
		$(".video-container").each(function(){
			appendPreferences( $(this).find('iframe'), vimeoPrefs );
		})
		// apply responsive script to video, but not audio
		.fitVids({ignore: '#issue-audio'});

	}

	// check to see if embedded iframes contain the videos we're looking for
	function wrapVideos(videos){
		// find all the video embeds
		videos.each(function(index){
			// wrap each one in .video-container
			$(this).attr('id','frame-'+index).wrap('<div class="video-container"></div>');

		});
	}

	// append desired vimeo settings to the iframe source URL
	function appendPreferences(video, videoSettings) {
		// get the url
		videoURL = video.attr('src');
		// make sure it's vimeo, and that no settings have been declared
		if ( videoURL.indexOf("vimeo") >= 0 && videoURL.indexOf("?") < 0 ) {
			// append desired settings to the video URL
			videoURL += videoSettings;
			// apply the new settings
			video.attr('src', videoURL);
		}
	}

}


});