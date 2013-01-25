<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <style type="text/css">
            span.highlight
            {
                background-color:yellow
            }
        </style>

        <meta name="generator" content=
              "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">
        <title>2010 President Award</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <?php include "script_head.php" ?>
		<link rel="stylesheet" href="css/black.css" type="text/css" />
		<link type="text/css" rel="stylesheet"
              href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet"
              href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet"
              href="css/nav.css" />

		<link rel="stylesheet" href="css/basic.css" type="text/css" />
		<link rel="stylesheet" href="css/galleriffic-5.css" type="text/css" />

		<!-- <link rel="stylesheet" href="css/white.css" type="text/css" /> -->


        <link type="text/css" rel="stylesheet" href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet" href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet" href="css/nav.css" />
        <meta content="Robert Stevenson" name="author">
    </head>

	<?php include 'utils.php' ?>
	<?php include 'locations.php' ?>
    <body style="color:black;" id="normalbody">
        <div id="page_wrapper">
            <div id="main">
				<?php include 'navigation.php' ?>
                
                <script type="text/javascript"  src="scripts/jquery.history.js"></script>
                <script type="text/javascript"  src="scripts/jquery.galleriffic.js"></script>
                <script type="text/javascript"  src="scripts/jquery.opacityrollover.js"></script>
                <!-- We only want the thunbnails to display when javascript is disabled -->

				<div class="bodyText articleText" style="font-size: 11pt;background-image: url(images/background2.jpg);" >


					<p>
					Below are the 2010 Driver of the Year winners (with Gerry Niedert):
					</p>

					<div style=" background-color: #6D6D48;
						 -moz-border-radius: 5px;
						 -webkit-border-radius: 5px;
						 border: 1px solid #000;
						 padding: 10px;" >
						<table style="font-size:11pt;margin-top:0px;width: 100%; ">
							<tbody>
                                <tr>
                                    <td>Jeff Aungst - Hinckley, OH - East Division</td>
                                    <td>Jose Morales - Batavia, IL - Midwest Division</td>
                                </tr>
								
							</tbody>
						</table>
					</div>
                    <p>
                        <image src="images/DriverYr2010.jpg" width="890" alt="Winning Drivers with Gerry Niedert"/>
                    </p>
                    <p>
                        <image src="images/DriverYr2010Group.jpg" width="890" alt="Driver Of the Year Group Shot"/> 
                    </p>
                    
                    <p>
					2010 Terminal Manager of the Year (with Gerry Niedert):
					</p>
					<div style=" background-color: #6D6D48;
						 -moz-border-radius: 5px;
						 -webkit-border-radius: 5px;
						 border: 1px solid #000;
						 padding: 10px;" >
						<table style="font-size:11pt;margin-top:0px;width: 100%; ">
							<tbody>
                                <tr>
                                    <td>Suzzette Schroeder - Batavia, IL</td>
                                </tr>
								
							</tbody>
						</table>
					</div>
                    <p>
                        <image src="images/TermMgr2010.jpg" width="890" alt="Winning Manager with Gerry Niedert"/>
                    </p>
                    

				</div>
            </div>
        </div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				// We only want these styles applied when javascript is enabled
				$('div.content').css('display', 'block');

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.67;
				$('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});

				// Initialize Advanced Galleriffic Gallery
				var gallery = $('#thumbs').galleriffic({
					delay:                     2500,
					numThumbs:                 10,
					preloadAhead:              10,
					enableTopPager:            false,
					enableBottomPager:         false,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              'Play Slideshow',
					pauseLinkText:             'Pause Slideshow',
					prevLinkText:              '&lsaquo; Previous Photo',
					nextLinkText:              'Next Photo &rsaquo;',
					nextPageLinkText:          'Next &rsaquo;',
					prevPageLinkText:          '&lsaquo; Prev',
					enableHistory:             false,
					autoStart:                 true,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
						.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
						.eq(nextIndex).fadeTo('fast', 1.0);

						// Update the photo index display
						this.$captionContainer.find('div.photo-index')
						.html('Photo '+ (nextIndex+1) +' of '+ this.data.length);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
						var nextPageLink = this.find('a.next').css('visibility', 'hidden');

						// Show appropriate next / prev page links
						if (this.displayedPage > 0)
							prevPageLink.css('visibility', 'visible');

						var lastPage = this.getNumPages() - 1;
						if (this.displayedPage < lastPage)
							nextPageLink.css('visibility', 'visible');

						this.fadeTo('fast', 1.0);
					}
				});

				/**************** Event handlers for custom next / prev page links **********************/

				gallery.find('a.prev').click(function(e) {
					gallery.previousPage();
					e.preventDefault();
				});

				gallery.find('a.next').click(function(e) {
					gallery.nextPage();
					e.preventDefault();
				});

				/****************************************************************************************/

				/**** Functions to support integration of galleriffic with the jquery.history plugin ****/

				// PageLoad function
				// This function is called when:
				// 1. after calling $.historyInit();
				// 2. after calling $.historyLoad();
				// 3. after pushing "Go Back" button of a browser
				function pageload(hash) {
					// alert("pageload: " + hash);
					// hash doesn't contain the first # character.
					if(hash) {
						$.galleriffic.gotoImage(hash);
					} else {
						gallery.gotoIndex(0);
					}
				}

				// Initialize history plugin.
				// The callback is called at once by present location.hash.
				$.historyInit(pageload, "advanced.html");

				// set onlick event for buttons using the jQuery 1.3 live method
				$("a[rel='history']").live('click', function(e) {
					if (e.button != 0) return true;

					var hash = this.href;
					hash = hash.replace(/^.*#/, '');

					// moves to a new page.
					// pageload is called at once.
					// hash don't contain "#", "?"
					$.historyLoad(hash);

					return false;
				});

				/****************************************************************************************/
			});
		</script>

		
    </body>
</html>
