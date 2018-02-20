<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
	<?php wp_head(); ?>
	<script src="https://use.typekit.net/lbg1fkf.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
	<script>
		$.noConflict();
	</script>
</head>

<body <?php body_class(); ?>>

<!-- side nav -->
<?php include("sidenav.php")?>

<div id="modalSearch" class="reveal modal-search pt0 p40" data-reveal data-animation-in="slide-in-down" data-animation-out="fade-out">
	<h4 class="mb40">Search Buffini &amp; Company</h4>
	<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
		<div class="input-group">
			<input id="globalSearch" type="search" class="input-group-field" placeholder="Enter key words" value="" name="s" title="Search for:" />
			<div class="input-group-button">
				<input type="submit" class="button" value="Search" />
			</div>
		</div>
	</form>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
