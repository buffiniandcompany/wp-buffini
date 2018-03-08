	<?php
			function postFeatured( $post_cat_slug, $post_cat_name ) {
				$post_count = 1;
	?>
	<?php
			$query1 = new WP_Query(
				array(
					'category_name' => $post_cat_slug,
					'posts_per_page' => $post_count,
					'orderby' => 'modified',
					'order' => 'DESC',
				)
			);
	?>
	<div class="grid-x mb30 featured">
	<?php if ( $query1->have_posts() ) : while ( $query1->have_posts() ) : $query1->the_post(); ?>
	
	<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); $backgroundImg[0] ?>
		<?php if( get_the_post_thumbnail() ) : ?>
		<div class="cell large-8" style="background-image: url(<?php echo $backgroundImg[0]; ?>);">
		<a href="<?php the_permalink(); ?>">&nbsp;</a>			
		</div>
		<?php endif; ?>
		<div class="cell large-4">
		<div class="featured-text">
		<a href="<?php the_permalink(); ?>">
							<h3>
								<?php the_title(); ?>
							</h3>
						</a>
						<hr>
						
						<h5>
							<?php if ($excerpt) { echo $excerpt;} else { echo strip_tags( get_the_excerpt() );} ?>
						</h5>
						<br>
			<a href="<?php the_permalink(); ?>" class="button">Read more...</a>
			</div>
						
		</div>
	<?php endwhile; else : ?>
	<?php endif; wp_reset_query();?>
	</div>

	<?php	
			}
	?>
	<?php
		function postCategory( $post_cat_slug, $post_cat_name ) {
			$post_count = 6;
			?>
		<div class="grid-x grid-padding-x">
			<h3 class="cell pb30 pt30">
				<?php echo $post_cat_name ;?>
			</h3>
		</div>
		<div class="list grid-x grid-padding-x grid-padding-y small-up-2 medium-up-2 large-up-3 pb30 mb30">

			<?php
			$query1 = new WP_Query(
				array(
					'category_name' => $post_cat_slug,
					'posts_per_page' => $post_count,
					'orderby' => 'ID',
					'order' => 'DESC',
				)
			);
			// The Loop
			?>

			<?php if ( $query1->have_posts() ) : while ( $query1->have_posts() ) : $query1->the_post(); ?>

			<div class="cell">
				<div class="card">
						<?php if( get_the_post_thumbnail() ) : ?>
						<div style="height:225px; overflow: hidden;position: relative;">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('large'); ?>
						</a>
						</div>
						<?php endif; ?>
						
					<!-- Thumbnail -->
					
					<!-- Title / Excerpt -->
					<div class="card-section">
						<h6>
							<?php if($excerpt){ echo "";} else { the_time('F j, Y') ; }?>
						</h6>
						<a href="<?php the_permalink(); ?>">
							<h4>
								<?php the_title(); ?>
							</h4>
						</a>
						<hr>
						<p>
							<?php if ($excerpt) { echo $excerpt;} else { echo strip_tags( get_the_excerpt() );} ?>
						</p>
					</div>
				</div>
			</div>

			<?php endwhile; else : ?>
			<h4 class="text-center mb40">
				<?php _e( 'Sorry, no posts found.' ); ?>
			</h4>
			<div class="text-center">
				<a href="/" class="button large">Go to Home Page</a>
			</div>
		
			<?php endif; wp_reset_query();?>
		</div>
			<?php
			}
			?>
		