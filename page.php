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
				if($termlist->parent > 0) {
					$get_parents_name = get_ancestors( $pageid, $taxonomy );
					foreach ( $get_parents_name as $get_parent_name ) {
						$parent_name = get_term_by( 'id', $get_parent_name, $taxonomy );
						echo "<span class='parent-name'>" . $parent_name->name . "&nbsp;</span> ";
						echo '<span class="m10 text-light-50">|</span>';
						echo single_term_title();
					}
				} else {
					single_term_title(); 	
				}
				?>
			</h2>
			<p class="text-light-70"><?php// echo term_description(); ?></p>
			</div>
		</section>
	</header>


	<!-- Sub-Nav -->
	<nav class="sub-nav-container" style="display: none;">
		<div id="subNav" class="sub-nav">
			<?php
			$terms = get_terms( $taxonomy, array(
				//'exclude' => array( 166 ),
				'parent' => 0
			) );
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


</div>

<section>
	<div class="grid-container">

		<div class="grid-x grid-padding-x grid-padding-y pt100 pb40 small-up-1 medium-up-3 large-up-3">

				<div class="grid-x">

					<div class="cell large-9">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div class="page-header">
							<h1>
								<?php the_title(); ?>
							</h1>
						</div>

						<?php the_content(); ?>

						<?php endwhile; else: ?>

						<div class="page-header">
							<h1>Oh no!</h1>
						</div>

						<p>No content is appearing for this page!</p>

						<?php endif; ?>


					</div>

					<?php// get_sidebar(); ?>

				</div>

		</div>
	</div>
</section>



<?php get_footer();?>