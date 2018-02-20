jQuery(document).ready(function($) {

	$(document).foundation();
	
    // Open Nav
  $('[data-open-nav]').on('click', function(e) {
    e.preventDefault();
    $('body').addClass('nav-is-active');
    $('[data-nav-primary-item]').removeClass('is-active');
    $(this).parent().addClass('is-active');
    $('[data-nav-secondary]').addClass('is-active');
    $('[data-nav-toggle-secondary]').addClass('is-active');
    $('[data-nav-secondary]').addClass('hide');
    $(this).parent().find('[data-nav-secondary]').removeClass('hide');
  }); 

  // Toggle Nav for Mobile
  $('[data-nav-toggle-primary]').on('click', function () {
    if ($('[data-nav-toggle-primary]').hasClass('is-active')) {
      $(this).removeClass('is-active');
      $('body').removeClass('nav-is-active');
      $('[data-nav-secondary]').removeClass('is-active');
      $('[data-nav-primary]').removeClass('is-active');
      $('[data-nav-toggle-secondary]').removeClass('is-active');
    } else {
      $(this).addClass('is-active');
      $('body').addClass('nav-is-active');
      $('[data-nav-primary]').addClass('is-active');
    }
  });

  $('[data-nav-toggle-secondary]').on('click', function () {
    $('[data-nav-primary]').addClass('is-active');
    $('[data-nav-secondary]').removeClass('is-active');
    $('[data-nav-toggle-secondary]').removeClass('is-active');
  });


  // Close Nav
  $('[data-nav-primary-item].is-active').on('click', function() {
    $(this).removeClass('is-active');
    $('body').removeClass('nav-is-active');
  });
  $('[data-close-nav]').on('click', function () {
    $('body').removeClass('nav-is-active');
    $('[data-nav-secondary]').removeClass('is-active');
    $('[data-nav-toggle-secondary]').removeClass('is-active');
    $('[data-nav-primary-item]').removeClass('is-active');
  });
  $('body').on('click', function(event) { 
    if ($(event.target).closest('[data-nav-secondary].is-active, [data-nav-primary]').length === 0) {
      $('body').removeClass('nav-is-active');
      $('[data-nav-secondary]').removeClass('is-active');
      $('[data-nav-toggle-secondary]').removeClass('is-active');
      $('[data-nav-primary-item]').removeClass('is-active');
    }
  });

  // Trigger Search Modal
  $('a[title="Search"]').on('click', function(e) {
    e.preventDefault();
    $('#modalSearch').foundation('open');
  });
  
});