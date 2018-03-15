<?php
include TEMPLATEPATH . "/http_host.php";
get_header(); ?>
<?php
$post_type = get_post_type();
$tax = get_queried_object();
$taxonomy = $tax->taxonomy;
$pageid = get_queried_object_id();
$term_slug2 = get_queried_object()->slug;
$termlist = get_term_by( 'id', $pageid, $taxonomy );
$excerpt = get_field( 'highlight' );

if ( $termlist->parent > 0 ) {
	$get_parents_name = get_ancestors( $pageid, $taxonomy );
	foreach ( $get_parents_name as $get_parent_name ) {
		$parent_name = get_term_by( 'id', $get_parent_name, $taxonomy );
		$parent_name = $parent_name->name;
		$header_title = "<span class='parent-name'>" . $parent_name . "</span><span class='m10 text-light-50'>|</span>";
	}
} else {
	$header_title = "<span class='parent-name'>Buffini & Company</span><span class='m10 text-light-50'>|</span>";
}
?>

<div class="main">

	<!-- Header -->
	<header class="header header-small text-center category <?php echo $term_slug2; ?>">
		<section class="grid-x grid-padding-x align-center">
			<div class="cell medium-7">
				<h2>
					<?php 			
					echo $header_title;
					echo single_term_title();
					?>
				</h2>
				<p class="text-light-70">
					<?php// echo term_description(); ?>
				</p>
			</div>
		</section>
	</header>
	<section>

<?php 
	$term_name = apply_filters( 'single_term_title', $tax->name ); 
?>


		<!-- Sub Nav -->
		<nav id="subNavContainer" class="sub-nav-container sticky-container" data-sub-nav data-sticky-container>
			<div class="sticky is-anchored is-at-top" data-sticky data-sticky-on="small" data-top-anchor="subNavContainer:top" data-margin-top="0">
				<!-- Toggle for Small Screens -->
				<div id="subNavLarge" class="sub-nav">
					<ul class="menu vertical large-horizontal align-center dropdown" data-responsive-menu="accordion large-dropdown" data-magellan data-offset="40" data-threshold="85">
						<?php
						if ( $termlist->parent > 0 ) {
							// child
							$get_parents = get_ancestors( $pageid, $taxonomy );

							foreach ( $get_parents as $parent ) {
								$term_id = get_term_by( 'id', $parent, $taxonomy );
								$get_children = get_term_children( $term_id->term_id, $taxonomy );
							}
						} else {
							//parent
							$get_children = get_term_children( get_queried_object()->term_id, $taxonomy );
						}
						if ( !empty( $get_children ) ) {
							// return new WP_Error( 'invalid_taxonomy', __( 'Invalid taxonomy.' ) );
							//echo '<ul class="menu align-center pt80">';
							foreach ( $get_children as $child ) {
								$term = get_term_by( 'id', $child, $taxonomy );
								if ( $term->name == $term_name ) {
									echo '<li class="is-active "><a href="' . get_term_link( $child, $taxonomy ) . '">' . $term->name . '</a></li>';
								} else {
									echo '<li><a href="' . get_term_link( $child, $taxonomy ) . '">' . $term->name . '</a></li>';
								}
							}
							//echo ';	
						}
						?>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Posts -->
		<div class="grid-container">

			<div class="grid-x grid-padding-x grid-padding-y pt100 pb40 small-up-1 medium-up-3 large-up-3">
				<!-- Post Grid -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="cell">
					<div class="card">
						<!-- Thumbnail -->
						
							<?php if( get_the_post_thumbnail() ) : ?>
							<div style="height:225px; overflow: hidden;position: relative;">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('large'); ?>
							</a>
							</div>
							<?php endif; ?>
						
						<!-- Title / Excerpt -->
						<div class="card-section">
							<h6>
								<?php the_time('F j, Y') ;?>
							</h6>
							<a href="<?php the_permalink(); ?>">
								<h4>
									<?php the_title(); ?>
								</h4>
							</a>
							<hr>
							<p>
								<?php echo strip_tags( get_the_excerpt() );?>
							</p>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<div class="pagination text-center mb60">
				<?php html5wp_pagination(); ?>
			</div>

			<?php else : ?>
			<p>
				<?php _e( 'Sorry, no pages found.' ); ?>
			</p>
			<?php endif; ?>


	</section>

	</div>

	<?php get_footer(); ?>


	<script type="text/javascript">
		// If URL matches HREF in subNav, add 'current' class
		jQuery( document ).ready( function () {
			jQuery( "#subNav a[href*='" + location.pathname + "']" ).parent().addClass( 'current' );
		} );
	</script>