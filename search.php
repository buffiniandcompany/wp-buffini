<?php 
get_header(); 
?>

<!-- Header -->
<header class="header header-xsmall bg-gradient-blue">
  <h3>Search</h3>
</header>

<main class="pt80 pb80">
  <div class="grid-x align-center">
      <div class="cell small-10 medium-9 large-7">
        <div class="primary">
    
        <!-- Search Form -->
        <form role="search" method="get" class="mb80" action="<?php echo home_url( '/' ); ?>">
          <div class="input-group">
            <input id="globalSearch" type="search" class="input-group-field" placeholder="Enter key words" value=" <?php echo esc_html( get_search_query( false ) ); ?>" name="s" title="Search for:" />
            <div class="input-group-button">
              <input type="submit" class="button" value="Search" />
            </div>
          </div>
        </form>

        <!-- Search Results -->
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="">
            <a href="<?php the_permalink(); ?>">
              <div class="">
                <h3><?php the_title(); ?></h3>
                <p><?php echo strip_tags( get_the_excerpt() ); ?></p>
              </div>
              </a>
          </div>
        <?php endwhile; ?>
        
      <!-- Pagination -->
      <div class="grid-x grid-padding-x mt60 pagination">
        <?php html5wp_pagination(); ?>
      </div>
      
      <?php else : ?>
        <h4><?php _e( 'Sorry, no pages found.' ); ?></h4>
      <?php endif; ?>
    
    </div>
  </div>

</main>





<?php get_footer(); ?>