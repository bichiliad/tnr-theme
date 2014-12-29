	<div id="footer">
		<!--p>powered by <a href="http://www.wordpress.org" >wordpress</a></p-->
	</div><!-- close:footer -->
</div><!-- close:wrapper -->
<?php wp_footer(); ?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script>
		/* Browser detection patch because Stratus is old  */
		$.browser = {};
		$.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
		$.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
		$.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
		$.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
		$.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
	</script>

	<script type="text/javascript" src="http://stratus.sc/stratus.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			if (!$.browser.device) {	// Load Stratus if we're not mobile
    			$.stratus({
      				links: 'https://soundcloud.com/thudsandrumbles/sets/posted'
				});
			}
  		});
	</script>

</body>
</html>
