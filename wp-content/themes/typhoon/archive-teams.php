<?php get_header(); ?>

    <div class="content">

        <section class='teamBanner rel' style="background-image:url('<?php echo get_field('team_banner','options'); ?>');">
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
        								<h1 class='white marB20 center'><?php echo get_field('team_title','options'); ?></h1>
                        <p class='white h4 center'><?php echo get_field('team_intro','options'); ?></p>
        						</div>
        				</div>
        		</div>
        </section>

        <section class='teamArchive padT70 padB40'>
            <div class='grid-container full pad90W'>
                <div class='grid-x grid-margin-x'>
                    <?php
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => 'teams',
                            'orderby' => 'title',
                            'order'=>'ASC',
                       );
                       $myposts = get_posts( $args );
                       foreach ( $myposts as $post ) : setup_postdata( $post );

                    ?>

                        <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
                        <div class='small-12 medium-6 large-3 cell teamRider rel hide-for-small-only ' style="background: url('<?php echo $backgroundImg[0]; ?>')">
                             <a href="<?php echo the_permalink(); ?>">
                                 <div class='overlay'></div>
                                 <div class='innerBox'>
                                     <p class='orange tiny noMar'>Team rider</p>
                                     <p class='white h3 noMar'><?php the_title(); ?>
                                 </div>
                                 <a href="<?php echo the_permalink(); ?>">
                                   <div class='profBox'>
                                       <p class='white' href="<?php echo the_permalink(); ?>">View profile</p>
                                   </div>
                                 </a>
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
