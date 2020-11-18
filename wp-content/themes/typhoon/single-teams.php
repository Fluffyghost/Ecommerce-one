<?php get_header(); ?>

    <div class="content teamSingle">

        <section class='sepTeamBanner rel' style="background: url('<?php echo get_field('rider_banner'); ?>')">
            <div class='bannerOverlay'></div>
        		<div class='grid-container full pad90W'>
        				<div class='grid-x'>
        						<div class='large-12 cell padT10 whitecrumbs'>
                        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); } ?>
        						</div>
                </div>
            </div>
            <div class='grid-container'>
                <div class='grid-x padB30 bannerWrap'>
        						<div class='large-12 cell innerwrap'>
											  <p class='white tiny center noMar'>Team rider</p>
        								<h1 class='white marB20 center'><?php the_title(); ?></h1>
												<div class='socialWrap'>
                            <?php if (get_field('facebook')) : ?>
                                <a href="<?php echo get_field('facebook'); ?>"><i class="fab fa-facebook-square white"></i></a>
														<?php endif; ?>
														<?php if (get_field('twitter')) : ?>
																<a href="<?php echo get_field('twitter'); ?>"><i class="fab fa-twitter white"></i></a>
														<?php endif; ?>
														<?php if (get_field('instagram')) : ?>
																<a href="<?php echo get_field('instagram'); ?>"><i class="fab fa-instagram white"></i></a>
														<?php endif; ?>
                            <?php if (get_field('youtube')) : ?>
																<a href="<?php echo get_field('youtube'); ?>"><i class="fab fa-youtube white"></i></a>
														<?php endif; ?>
												</div>
        						</div>
        				</div>
        		</div>
        </section>


				<article class='pad70'>
						<div class='grid-container'>
								<div class='grid-x'>
									  <div class='small-12 medium-12 large-12 cell'>
												<?php if (have_posts()) : query_posts($query_string.'&cat=-33,-34'); while (have_posts()) : the_post(); ?>
												    <?php echo the_content(); ?>
												<?php endwhile; else : ?>
														<?php get_template_part( 'parts/content', 'missing' ); ?>
												<?php endif; ?>
									  </div>
								</div>
						</div>
				</article>


        <section class='teamArchive padT70 padB40'>
            <div class='grid-container'>
                <div class='grid-x grid-margin-x'>
									  <div class='small-12 medium-12 large-12 cell'>
                        <p class='h3 center marB50 dtext'>Meet more Typhoon Riders</p>
										</div>
                    <?php
                        $args = array(
                            'posts_per_page' => 4,
                            'post_type' => 'teams',
														'post__not_in' => array( $post->ID ),
														'orderby' => 'rand',
                       );
                       $myposts = get_posts( $args );
                       foreach ( $myposts as $post ) : setup_postdata( $post );
                   ?>

											 <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
											 <div class='small-12 medium-6 large-3 cell teamRider rel hide-for-small-only ' style="background: url('<?php echo $backgroundImg[0]; ?>')">
														<a href="<?php echo the_permalink(); ?>">
																<div class='overlay'></div>
																<div class='innerBox'>
																		<p class='orange tiny'>Team rider</p>
																		<p class='white h3 noMar'><?php the_title(); ?>
																</div>
																<div class='profBox'>
																		<a class='white tiny' href="<?php echo the_permalink(); ?>">View profile</a>
																</div>
														</a>
												</div>

												<div class='show-for-small-only small-12 cell vLGreyBg mobileRider marB10'>
														<a href="<?php echo the_permalink(); ?>">
																<div class='grid-x align-middle'>
																		<div class='small-3 cell'>
																				 <div class='rider'><?php the_post_thumbnail('full'); ?></div>
																		</div>
																		<div class='small-9 cell rel padL10'>
																				<p class='orange tiny noMar'>Team rider</p>
																				<p class='dtexts h3 noMar'><?php the_title(); ?></p>
																				<span class="material-icons flexend">keyboard_arrow_right</span>
																		</div>
																</div>
														</a>
												</div>

                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
        </section>

        <?php get_template_part( 'parts/customer', 'info' ); ?>

		</div>

<?php get_footer(); ?>
