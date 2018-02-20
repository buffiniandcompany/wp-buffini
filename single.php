<?php get_header(); ?>


<!-- Header -->
<header class="header-small bg-header-001 text-center text-light">
  <h2>&nbsp;</h2>
</header>


<!-- Main -->
<main class="grid-container pt80 pb80">
  <div class="grid-x grid-padding-x align-center">
    <div class="cell">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="post">                
          <h1><?php the_title(); ?> <?php echo single_term_title(); ?></h1>
          <ul class="post-meta no-bullet mb40">
            <li class="cat">
              <hr>
              Posted on <?php the_time('F j, Y'); ?> in 
              <?php the_category( ', ' ); ?>
              <hr>
            </li>
          </ul>
          <?php if( get_the_post_thumbnail() ) : ?>
            <div class="mb40">
              <?php the_post_thumbnail('large'); ?>
            </div>
          <?php endif; ?>   
          <?php the_content(); ?>
          <?php comments_template(); ?>
        </article>
      <?php endwhile; else : ?>
      <p><?php _e( 'Sorry, no posts found.' ); ?></p>
			<?php endif; ?>
    </div>
  </section>
</main>  


<!-- Related -->
<section class="bg-light-gray pt80 pb80">
  <div class="grid-container">
    <!-- Section Title -->
    <div class="grid-x grid-padding-x">
      <div class="cell">
        <h3 class="mb40">Related Posts</h3>
      </div>
    </div>
    <!-- Grid -->
    <div class="grid-x grid-padding-x grid-padding-y small-up-1 medium-up-2 large-up-3" data-equalizer>
      <!-- WP Query -->
      <?php 
      $taxonomy_names = get_object_taxonomies( $post );
      $space_terms = wp_get_post_terms( $post->ID, $taxonomy_names[0] ,  array("fields" => "names"));
        $num_posts = 6;
        $args = array(
          'tax_query' => array(
          array(
              'taxonomy' => $taxonomy_names[0],
              'field' => 'slug',
              'terms' => $space_terms,
            ),
          ),
        'posts_per_page' => $num_posts,
        'post__not_in' => array($post->ID)
        );
        $query = new WP_Query( $args );
      ?>
      <!-- WP Loop -->
      <?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>
        <div class="cell">
          <div class="card" data-equalizer-watch>
            <!-- Thumbnail -->
            <?php if( get_the_post_thumbnail() ) : ?>
              <div class="img-container">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('large'); ?>
                </a> 
              </div>
            <?php endif; ?>
            <!-- Text -->
            <a href="<?php the_permalink(); ?>">
              <div class="card-section">
                <small><?php the_time('F j, Y') ; ?></small>
                <h5><?php the_title(); ?></h5>
              </div>
            </a>
          </div>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
  </div>
</section>

<?php get_footer(); ?>