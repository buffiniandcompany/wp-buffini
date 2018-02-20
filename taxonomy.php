<?php get_header(); ?>

<?php
$post_type = get_post_type();
$tax = get_queried_object();
$taxonomy = $tax->taxonomy;
$pageid = get_queried_object_id();
$termlist = get_term_by( 'id', $pageid, $taxonomy );
$excerpt = get_field('highlight');
?>

<div class="main">

<!-- Header -->
<header class="header header-small text-center">
<section class="grid-x grid-padding-x align-center">
	<div class="cell medium-7">
		<h2>
			<?php 
			if ($post_type == 'post') {
				echo 'Blog';
			} else if ($post_type === 'resource') {
				echo 'Resources';
			} else if ($post_type === 'story') {
				echo 'Stories';
			} else if ($post_type === 'press') {
				echo 'Press';
			} else {
				return false;
			}
			echo '<span class="m10 text-light-50">|</span>';
			if($termlist->parent > 0) {
				$get_parents_name = get_ancestors( $pageid, $taxonomy );
				foreach ( $get_parents_name as $get_parent_name ) {
					$parent_name = get_term_by( 'id', $get_parent_name, $taxonomy );
					echo "<span class='parent-name'>" . $parent_name->name . "&nbsp;</span> " . single_term_title();
				}
			} else {
				single_term_title(); 	
			}
			?>
		</h2>
		<!-- <p class="text-light-70"><?php //echo term_description(); ?></p> -->
	</div> 
</section>  
</header>


<!-- Sub-Nav -->
<nav class="sub-nav-container">
  <div id="subNav" class="sub-nav">
    <?php
    $terms = get_terms( $taxonomy, array(
    	'exclude' => array( 166 ),
			'parent' => 0
    ));
    if ( $terms && !is_wp_error( $terms ) ):
    	?>
	  <ul class="vertical large-horizontal menu align-center">
		<?php foreach ( $terms as $term ) { ?>
		<?php 
		$children = get_term_children($term->slug, $taxonomy);
		  ?>
		<li>
			<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">
				<?php 
					$term_name = $term->name; 
					echo $term_name; 
				?>
			</a>
		</li>
		<?php } ?>
	</ul>
   <?php
    endif;
    ?>
  </div>
</nav>
<section>




<?php $term_name = apply_filters( 'single_term_title', $tax->name ); ?>

<!-- If Taxonomy Includes Sub-Terms, Show Them Here -->
<?php
	if($termlist->parent > 0) { 
		// child
		$get_parents = get_ancestors( $pageid, $taxonomy );
		//var_dump ($get_parents);
		foreach ( $get_parents as $parent ) {
			$term_id = get_term_by( 'id', $parent, $taxonomy );
			$get_children = get_term_children($term_id->term_id, $taxonomy); 	
		}
	} else { 
		//parent
		$get_children = get_term_children(get_queried_object()->term_id, $taxonomy); 
	}
	if (!empty($get_children)) {
		// return new WP_Error( 'invalid_taxonomy', __( 'Invalid taxonomy.' ) );
		echo '<ul class="menu align-center pt80">';
		foreach ( $get_children as $child ) {
			$term = get_term_by( 'id', $child, $taxonomy );
			if ($term->name == $term_name){ 
				echo '<li class="active"><a href="' . get_term_link( $child, $taxonomy ) . '">' . $term->name . '</a></li>';
			} else {
				echo '<li><a href="' . get_term_link( $child, $taxonomy ) . '">' . $term->name . '</a></li>';
			}
		}
		echo '</ul>';	
	}
?> 


<!-- Posts -->
<div class="grid-container">

	<div class="grid-x grid-padding-x grid-padding-y pt100 pb40 small-up-1 medium-up-3 large-up-3">
		<!-- Post Grid -->
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="cell">
				<div class="card">
					<!-- Thumbnail -->
					<?php if( get_the_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('large'); ?>
						</a> 
					<?php endif; ?>
					<!-- Title / Excerpt -->
					<div class="card-section">
						<h6><?php if($excerpt){ echo "";} else { the_time('F j, Y') ; }?></h6>
						<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
						<hr>
						<p><?php if ($excerpt) { echo $excerpt;} else { echo strip_tags( get_the_excerpt() );} ?></p>
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
		<p><?php _e( 'Sorry, no pages found.' ); ?></p>
	<?php endif; ?>

		
</section>

</div>

<?php get_footer(); ?>


<script type="text/javascript">
// If URL matches HREF in subNav, add 'current' class
jQuery(document).ready(function(){
	jQuery("#subNav a[href*='" + location.pathname + "']").parent().addClass('current');
});
</script>
