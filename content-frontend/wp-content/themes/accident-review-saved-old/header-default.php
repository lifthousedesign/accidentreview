<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
	<?php bloginfo('name'); ?> |
	<?php
		if(is_front_page()) bloginfo('description');
		elseif(is_search()) echo 'Search results for "'.wp_specialchars($s, 1).'"';
		else wp_title('');
	?>
	</title>
	<?php if(preg_match('/reps\/assignments\/new-assignment/',$_SERVER['REQUEST_URI'],$matches)): ?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/style-protected.css" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/lib/accident-jqueryui-theme/jquery-ui-1.8.15.custom.css?ver=3.2.1" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/lib/chosen/chosen.css?ver=3.2.1" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/lib/chosen/chosen.jquery.min.js?ver=3.2.1" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/lib/uploadify/uploadify.css?ver=3.2.1" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=3.2.1"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/js/accident-review.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/tablesorter/jquery.metadata.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/tablesorter/jquery.tablesorter.min.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/js/autoresize.jquery.min.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/uploadify/swfobject.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/uploadify/jquery.uploadify.min.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/plupload/plupload.full.js?ver=3.1.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/js/plupload.js?ver=3.2.1"></script>
		
	<?php else: ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<?php endif; ?>

	<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/style-dev.css" />
</head>
<body>
	<div id="top-panel">
		<div class="wrapper">
		<?php if(isset($_SESSION['agent_user_id'])): ?>
			Welcome, <a href="#" class="username"><?php echo $_SESSION['agent_user_name']; ?></a>
		<?php else: ?>
			<form action="/reps/login" method="post">
				<input type="text" name="username" placeholder="E-mail" />
				<input type="password" name="password" placeholder="Password" />
				<input type="hidden" name="submit_login" />
				<input type="submit" value="Login" />
			</form>
		<?php endif; ?>
		</div>
	</div>
	<div class="wrapper">
		<div id="header">
			<!--a href="#"><img src="<?php bloginfo('stylesheet_directory') ?>/images/logo.png" alt="Accident Review" title="Accident Review" /></a-->
			<a id="logo" href="#"><h1>Accident Review</h1></a>
			<div id="nav">
			<?php if(get_the_ID()==1015): ?>	
				<a href="#services">Services</a>	
				<a href="#about-us">About Us</a>	
				<a href="#customer-support">Customer Support</a>	
			<?php else: ?>
				<a href="/dev/home#services">Services</a>	
				<a href="/dev/home#about-us">About Us</a>	
				<a href="/dev/home#customer-support">Customer Support</a>
			<?php endif; ?>
			</div>
			<?php if(isset($_SESSION['agent_user_id'])): ?>
			<div id="account-options">
				<a href="/dev/reps#new-assignment">New Assignment</a>
				<a href="/dev/reps#assignments">Assignments</a>
				<a href="/dev/reps#account-info">Manage Account</a>
				<a href="/dev/login?do=logout">Logout</a>
			</div>
			<?php endif; ?>
		</div>
		<div id="content">