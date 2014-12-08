<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
	<input type="text" placeholder="Enter to search" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" size="12" />
</form>