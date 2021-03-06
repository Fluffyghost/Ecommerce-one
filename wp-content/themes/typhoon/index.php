<?php get_header(); ?>

    <div class="content">

        <section class='genericBanner rel' style="background-image:url('<?php echo get_field('news_banner','options'); ?>');">
            <div class='bannerOverlay'></div>
            <div class='grid-container full pad90W'>
                <div class='grid-x padB30 bannerWrap'>
                    <div class='large-12 cell whitecrumbs relcrumbs'>
                        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); } ?>
                    </div>
                    <div class='large-12 cell innerwrap'>
                        <h1 class='white marB20 center'><?php echo get_field('newsb_title' ,'options'); ?></h1>
                        <?php if (get_field('newsb_intro','options')) : ?>
                            <p class='white h4 center midW marB40'><?php echo get_field('newsb_intro','options'); ?></p>
                        <?php endif; ?>
                        <div class='bannerSignup'>
                            <?php echo do_shortcode('[contact-form-7 id="304" title="Footer newsletter"]'); ?>
                            <p class='white center tiny terms noMar'>By signing up you agree to our <a class='underline white' href="<?php echo get_site_url(); ?>/terms-conditions">Terms & Conditions</a> &amp; <a class='underline white' href="<?php echo get_site_url(); ?>/privacy-policy">Privacy Policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class='newsArchive padB70'>
            <div class='grid-container full pad90W'>
                <div class='grid-x marB40'>
                    <div class='large-12 cell'>
                        <div class='hidemed'>
                            <?php
    															$taxonomy = 'category';
    															$terms = get_terms( $taxonomy, array(
    																 'orderby' => 'name',
    																 'order'   => 'ASC',
    															));
    															if ( $terms && !is_wp_error( $terms ) ) :
    															$current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    															$i = 0;
    													?>
    															<ul class='postcats archiveCat'>
    																	<?php foreach ( $terms as $term ) { ?>
    																			<?php $term_link = get_term_link($term); if($current_link == $term_link){ ?>
    																					<li class="active cat_<?php echo $i; ?>">
    																			<?php } else { ?>
    																					<li class="cat_<?php echo $i; ?>">
    																			<?php } ?>
    																					<a href="<?php echo $term_link; ?>"><?php echo $term->name; ?></a>
    																			</li>
    																			<?php $i ++; ?>
    																	<?php } ?>
    															</ul>
    													<?php endif;?>
                          </div>
                          <div class='showmed marT30'>
                                <div class='catBox postdropdown'>
                                    <select name="news_cat" onchange="location = this.value;">
                                       <option value="0">Categories</option>
                                       <?php
                                           $news_cat = get_terms( array(
                                               'taxonomy' => 'category',
                                               'hide_empty' => false,
                                               'orderby'   => 'name',
                                           ) );
                                           $sector = isset($_GET['news_cat']) ? $_GET['news_cat'] : 0;
                                           foreach ($news_cat as $key => $value) {
                                        ?>
                                            <option value="<?php echo get_site_url();?>/category/<?php echo $value->slug; ?>" <?php selected($sector, $value->term_id); ?> ><?php echo $value->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                          </div>
										</div>
								</div>
								<div class='grid-x grid-margin-x'>
                    <?php if ( $paged < 2 ) : ?>
                        <?php get_template_part( 'parts/loop', 'featured' ); ?>
                    <?php else : endif; ?>
                    <?php if (have_posts()) : query_posts($query_string.'&cat=-123'); while (have_posts()) : the_post(); ?>
										    <?php get_template_part( 'parts/loop', 'archive' ); ?>
									  <?php endwhile; ?>
										    <?php joints_page_navi(); ?>
									  <?php else : ?>
										    <?php get_template_part( 'parts/content', 'missing' ); ?>
									  <?php endif; ?>
								</div>
						</div>
				</section>

        <?php get_template_part( 'parts/customer', 'info' ); ?>

		</div>

<?php get_footer(); ?>
