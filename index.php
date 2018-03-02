<?php
include TEMPLATEPATH . '/http_host.php';
get_header(); 
?> 


<!-- Header -->
<header class="header-small bg-header-001 text-center text-light <?php echo $term_slug; ?>">
	<h2>Welcome to Buffini & Company <?php echo ucwords($term_slug); ?></h2>
</header>

<!-- Nav -->
<nav class="sub-nav-container">
	<div id="subNav" class="sub-nav">
		<!-- Sub-Nav -->
		<?//php $term_name = apply_filters( 'single_term_title', $tax->name ); ?>
		<?php 
		
		include STYLESHEETPATH  . '/nav_terms.php';
		
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
			echo '<ul class="vertical large-horizontal menu align-center">';
			foreach ( $terms as $term ) {	
				echo '<li><a href="'. esc_url( get_term_link($term)) . '">' . $term->name . '</a></li>';
				
			}
			echo '<li><a href="javascript:void(0);" class="search"  data-toggle="searchBox" aria-controls="searchBox">&nbsp;</a></li>';
			echo '</ul>';
		}
		?>
	</div>
</nav>
<!-- Main -->
<main class="grid-container pt80 pb80 <?php echo $term_slug; ?>">

	<section>
		<?php
		include STYLESHEETPATH  . '/post_grid.php';
		?>
	</section>
</main>
<div class="tiny reveal" id="searchBox" data-reveal>
<!-- Search Form -->
        <form role="search" method="get" class="mb80" action="<?php echo home_url( '/' ); ?>">
          <div class="input-group">
            <input id="globalSearch" type="search" class="input-group-field" placeholder="Enter key words" value=" <?php echo esc_html( get_search_query( false ) ); ?>" name="s" title="Search for:" />
            <div class="input-group-button">
              <input type="submit" class="button" value="Search" />
            </div>
          </div>
        </form>
<button class="close-button" data-close aria-label="Close reveal" type="button">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php get_footer();?>
