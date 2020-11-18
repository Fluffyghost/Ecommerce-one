<?php get_header(); ?>

    <div class="content">

        <?php get_template_part('parts/cluster','map'); ?>

        <section class='stockistArchive padB70'>
            <div class='grid-container'>
                <div class='grid-x marT40'>
                    <div class='hidemed large-12 cell'>
                        <p class='noMar dtext'>Filter by country</p>
                    </div>
                </div>
                <div class='grid-x bline padB40 stockHWrap'>
                    <div class='small-12 medium-12 large-6 cell dropDown'>
                        <div class='showmed'>
                            <p class='noMar dtext'>Filter by country</p>
                        </div>
                        <div class='catBox postdropdown'>
                            <select name="size_cat" onchange="location = this.value;">
                               <option value="0">Categories</option>
                               <?php
                                   $size_cat = get_terms( array(
                                       'taxonomy' => 'stockist_cat',
                                       'hide_empty' => false,
                                       'orderby'   => 'name',
                                   ) );
                                   $sector = isset($_GET['size_cat']) ? $_GET['size_cat'] : 0;
                                   foreach ($size_cat as $key => $value) {
                                ?>
                                    <option value="<?php echo get_site_url();?>/stockist-cats/<?php echo $value->slug; ?>" <?php selected($sector, $value->term_id); ?> ><?php echo $value->name; ?></option>
                                <?php } ?>

                            </select>
                        </div>
										</div>
                    <div class='small-12 medium-12 large-6 cell flexend stockB'>
                        <a class='orangeB flexend' href="mailto:sales@typhoon-int.co.uk?subject=Stockist Enquiry">Stockist enquiry</a>
                    </div>
								</div>
                <div class='grid-x padT40'>
                    <div class='large-12 cell'>
                        <p class='marB40'>If you are interested in becoming a Typhoon stockist, please contact <a class='orange underline' href='mailto:sales@typhoon-int.co.uk'>sales@typhoon-int.co.uk</a></p>
										</div>
								</div>
								<div class='grid-x grid-margin-x'>

                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <div class='small-12 medium-6 large-3 cell stockBox whiteBg marB30'>
                        		<div class='innerBox'>
                        	      <p class='largep dtext'><?php the_title(); ?></p>
                                <div class='address'><?php echo get_field('address'); ?></div>
                                <p class='dtext'>T: <a class='underline dtext' href="tel:<?php echo get_field('phone'); ?>"><?php echo get_field('phone'); ?></a></p>
                                <p class='dtext'>E: <a class='underline dtext' href="mailto:<?php echo get_field('email'); ?>"><?php echo get_field('email'); ?></a></p>
                                <p class='dtext'>W: <a class='underline dtext' href="<?php echo get_field('website'); ?>" target='_blank'><?php echo get_field('website'); ?></a></p>
                        		</div>
                        </div>

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
