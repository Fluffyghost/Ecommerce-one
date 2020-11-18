<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <button type="submit" value="<?php echo esc_attr_x( 'Search', 'jointswp' ) ?>"><span class="material-icons">search</span></button>
  <input type="search" class="search-field" placeholder="What are you looking for?" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />

</form>
