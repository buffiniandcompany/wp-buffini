<?php get_header(); ?>

<main class="pt300 pb300 bg-gradient-blue">
  <div class="grid-x align-center">
      <div class="cell small-10 medium-9 large-7">
      
      <hr>
      <h1 class="text-light text-center">404 ERROR</h1>
      <hr>
      <h5 class="text-light-60 mb40">Oh, by the way&reg;&hellip;the page or link you are looking for does not exist. Return to the <a href="/" class="link-light">home page</a> or try searching for&nbsp;something.</h5>

      <!-- Search Form -->
      <form role="search" method="get" class="mb80" action="<?php echo home_url( '/' ); ?>">
        <div class="input-group">
          <input id="globalSearch" type="search" class="input-group-field" placeholder="Enter key words" value="" name="s" title="Search for:" />
          <div class="input-group-button">
            <input type="submit" class="button sky" value="Search" />
          </div>
        </div>
      </form>

    </div>
  </div>

</main>


<?php get_footer(); ?>