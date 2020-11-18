<?php /* Template Name: Home */ get_header(); ?>

  	<div class="content">

        <section>
            <div class='grid-container full'>
                <div class='grid-x heroSlider'>

                    <?php if( have_rows('hero_slider')): ?>
                        <?php while ( have_rows('hero_slider')) : the_row(); ?>
                            <div class='heroBanner rel' style="background-image:url('<?php echo get_sub_field('banner_image'); ?>');">
                                <div class='bannerOverlay'></div>
                                <div class='grid-container'>
                                    <div class='grid-x midW bannerWrap'>
                                        <div class='large-12 cell'>
                                            <h1 class='white marB30'><?php echo get_sub_field('banner_title'); ?></h1>
                                            <a class='whiteHB' href="<?php echo get_sub_field('banner_url'); ?>"><?php echo get_sub_field('banner_button'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <section class='customerInfo'>
            <div class='grid-container full pad90W'>
                <div class='grid-x scrollInfo'>
                    <div class='large-12 cell scrollWidth'>
                        <div class='grid-x grid-margin-x pad50 bBottom'>
                            <div class='small-3 medium-3 large-3 cell point'>
                                <span class="material-icons orange">done</span><?php echo get_field('info_one','options'); ?>
                            </div>
                            <div class='small-3 medium-3 large-3 cell point flexmid'>
                                <span class="material-icons orange">done</span><?php echo get_field('info_two','options'); ?>
                            </div>
                            <div class='small-3 medium-3 large-3 cell point flexmid'>
                                <span class="material-icons orange">done</span><?php echo get_field('info_three','options'); ?>
                            </div>
                            <div class='small-3 medium-3 large-3 cell point flexend'>
                                <a href="<?php echo get_field('infoimg_link', 'options'); ?>">
                                    <img src="<?php echo get_field('info_img','options'); ?>"/><?php echo get_field('info_four','options'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='grid-x pad120 lgW'>
                    <div class='small-12 medium-12 large-12 cell maintext'>
                        <h2 class='center dtext noMar'><?php echo get_field('info_main_text'); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <section class='catBoxes'>
            <div class='grid-container full pad90W'>
                <div class='grid-x grid-margin-x padB120'>
                    <?php if( have_rows('cat_boxes')): ?>
                        <?php while ( have_rows('cat_boxes')) : the_row(); ?>
                            <div class='small-12 medium-6 large-4 cell cat rel' style="background-image:url('<?php echo get_sub_field('cat_image'); ?>');">
                                <div class='overlay'></div>
                                <div class='innerBox'>
                                    <p class='h2 center white marB30'><?php echo get_sub_field('cat_title'); ?></p>
                                    <a class='whiteHB' href="<?php echo get_sub_field('cat_url'); ?>"><?php echo get_sub_field('cat_button'); ?></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class='activityBoxes'>
            <div class='grid-container full pad90W'>
                <div class='grid-xW'>
                    <div class='small-12 medium-12 large-12 cell'>
                        <h2 class='center marB50 dtext'>Shop by activity</h2>
                    </div>
                </div>
                <div class='grid-x grid-margin-x padB120'>
                    <?php if( have_rows('act_boxes')): ?>
                        <?php while ( have_rows('act_boxes')) : the_row(); ?>
                            <div class='small-12 medium-6 large-3 cell actBox rel' style="background-image:url('<?php echo get_sub_field('act_image'); ?>');">
                                <div class='overlay'></div>
                                <div class='innerBox'>
                                    <p class='h2 center white marB30'><?php echo get_sub_field('act_title'); ?></p>
                                    <a class='whiteHB' href="<?php echo get_sub_field('act_url'); ?>"><?php echo get_sub_field('act_button'); ?></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class='featuredProducts'>
            <div class='grid-container full pad90W'>
                <div class='grid-xW'>
                    <div class='small-12 medium-12 large-12 cell'>
                        <h2 class='center marB50 dtext'>Featured products</h2>
                    </div>
                </div>
                <div class='grid-x grid-margin-x padB120'>
                    <div class='small-12 medium-12 large-12 cell'>
                        <?php echo do_shortcode('[products limit="4" columns="4" category="featured"]'); ?>
                        <a class='hide-for-small-only orangeB alCen' href="<?php echo get_site_url(); ?>/product-category/typhoon-leisure/">View all products</a>
                    </div>
                </div>
            </div>
        </section>

        <section class='productCtaCols'>
            <div class='grid-container full pad90W'>
                <div class='grid-x grid-margin-x padB90 spaceB'>
                    <?php if( have_rows('prod_cta')): $i = 1;  ?>
                        <?php while ( have_rows('prod_cta')) : the_row(); ?>
                            <div class='small-12 medium-6 large-6 cell procta rel pro_<?php echo $i; ?>' style="background-image:url('<?php echo get_sub_field('cta_image'); ?>');">
                                <div class='overlay'></div>
                                <div class='innerBox'>
                                    <p class='h2 center white marB30'><?php echo get_sub_field('cta_title'); ?></p>
                                    <a class='whiteHB' href="<?php echo get_sub_field('cta_url'); ?>"><?php echo get_sub_field('cta_button'); ?></a>
                                </div>
                            </div>
                        <?php $i++; endwhile;?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class='largeImgCta'>
            <div class='grid-container full pad90W'>
                <div class='grid-x'>
                    <div class='small-12 medium-12 large-12 cell lgCta rel' style="background-image:url('<?php echo get_field('lg_image'); ?>');">
                        <div class='overlay'></div>
                        <div class='innerBox'>
                            <p class='h2 center white marB30'><?php echo get_field('lg_title'); ?></p>
                            <a class='whiteHB' href="<?php echo get_field('lg_url'); ?>"><?php echo get_field('lg_button'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class='fullTextArea'>
            <div class='grid-container full pad90W'>
                <div class='grid-x pad120'>
                    <div class='small-12 medium-12 large-12 cell mainText'>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
        </section>




        <div class="reveal" id="newslettermodal" data-reveal data-close-on-click="true">
            <div class='grid-container full'>
                <div class='grid-x'>
                    <div class='medhide large-4 cell newsimg' style="background-image:url('<?php echo get_field('news_modal_img','options'); ?>');">

                    </div>
                    <div class='small-12 medium-12 large-8 cell newstextmodal'>
                        <button class="close-button" data-close aria-label="Close reveal" type="button">
                            <span class="material-icons">clear</span>
                        </button>
                        <p class='h2 dtext'>Sign up to our newsletter</p>
                        <p class='largep dtext'><?php echo get_field('news_modal_text', 'options'); ?></p>
                        <?php echo do_shortcode('[contact-form-7 id="1166" title="Newsletter modal"]'); ?>
                        <p class='tiny marT15'>By signing up you agree to our <a class='underline' href="<?php echo get_site_url(); ?>/terms-conditions">Terms & Conditions</a> &amp; <a class='underline' href="<?php echo get_site_url(); ?>/privacy-policy">Privacy Policy</a></p>
                    </div>
                </div>
            </div>
        </div>


        <?php get_template_part( 'parts/customer', 'info' ); ?>


  	</div>

<?php get_footer(); ?>
