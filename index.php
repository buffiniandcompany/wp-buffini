<?php get_header(); ?>

<!-- Header -->
<header class="header-xsmall bg-gradient-blue">
<h3><?php the_title(); ?>&nbsp;</h3>
</header>

<!-- General Loop -->
<!-- Main -->
<main class="pt80 pb80">
<div class="grid-x grid-padding-x align-center">
  <div class="cell small-11 medium-9 large-8">
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
    <h4 class="text-center mb40"><?php _e( 'Sorry, no posts found.' ); ?></h4>
    <div class="text-center">
      <a href="/" class="button large">Go to Home Page</a>
    </div>
    
    <?php endif; ?>
  </div>
</section>
</main>  


<?php get_footer(); ?>