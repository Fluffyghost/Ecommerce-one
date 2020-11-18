<?php /* Template Name: Our story */ get_header(); ?>

  	<div class="content">

        <?php get_template_part( 'parts/generic', 'banner' ); ?>

        <section class='mainLargeCenterText'>
            <div class='grid-container full pad90W'>
                <div class='grid-x pad80 lgW'>
                    <div class='small-12 medium-12 large-12 cell maintext'>
                        <div class='center dtext'>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <?php the_content(); ?>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class='firstCol padB80'>
            <div class='grid-container'>
                <div class='grid-x midW'>
                    <div class='small-12 medium-12 large-12 cell imgTextSection'>
                        <?php echo get_field('first_col'); ?>
                    </div>
                </div>
            </div>
        </section>

        <section class='testimonials padB80'>
            <div class='grid-container'>
                <div class='grid-x midW rel'>
                    <div class='small-12 medium-12 large-12 cell'>
                        <a class="nextButton"><span class="material-icons">arrow_forward</span></a>
                        <div class='grid-x testSlider'>

                            <?php
                                $args = array(
                                    'posts_per_page' => -1,
                                    'post_type' => 'testimonials',
                                );
                                $myposts = get_posts( $args );
                                foreach ( $myposts as $post ) : setup_postdata( $post );
                            ?>
                                <div class='small-12 medium-12 large-12 cell'>
                                    <div class='innerBox'>
                                        <img clas='marB20' src="<?php echo get_template_directory_uri(); ?>/assets/images/stars.png">
                                        <div class='feedback center dtext'><?php the_content(); ?></div>
                                        <p class='tiny orange'><?php the_title(); ?>.</p>
                                    </div>
                                </div>
                            <?php endforeach; wp_reset_postdata();  ?>
                        </div>
                        <a class="prevButton"><span class="material-icons">arrow_back</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class='imgCols padB80'>
            <div class='grid-container full pad90W'>
                <div class='grid-x grid-margin-x'>
                    <div class='small-12 medium-12 large-6 cell'>
                        <img src="<?php echo get_field('img_one'); ?>"/>
                    </div>
                    <div class='small-12 medium-12 large-6 cell'>
                        <div class='grid-x grid-margin-x'>
                            <div class='small-6 medium-6 large-6 cell'>
                                <img src="<?php echo get_field('img_two'); ?>"/>
                            </div>
                            <div class='small-6 medium-6 large-6 cell'>
                                <img src="<?php echo get_field('img_three'); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class='secondCol'>
            <div class='grid-container'>
                <div class='grid-x padB80 midW'>
                    <div class='small-12 medium-12 large-12 cell imgTextSection'>
                        <?php echo get_field('second_col'); ?>
                    </div>
                </div>
            </div>
        </section>


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

        <?php get_template_part( 'parts/customer', 'info' ); ?>


  	</div>

<?php get_footer(); ?>
