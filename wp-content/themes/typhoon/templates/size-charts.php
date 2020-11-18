<?php /* Template Name: Size chart */ get_header(); ?>

  	<div class="content">

        <section class='sizeCharts'>
            <div class='grid-container full pad90W'>
                 <div class='grid-x pad10'>
                      <div class='large-12 cell padT10'>
                          <?php if ( function_exists('yoast_breadcrumb') ) {
                              yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                          } ?>
                      </div>
                  </div>
             </div>
             <div class='grid-container'>
                <div class='grid-x padT80 midW'>
                    <div class='small-12 medium-12 large-12 cell'>
                        <h1 class='center dtext marB30'>Size Guide</h1>
                        <div class='center marB40'>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <?php the_content(); ?>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </div>
                <div class='grid-x lgW padB90'>
                    <div class='small-12 medium-12 large-12 cell'>
                        <div class='hidemed'>
                            <div class='chartCats'>
                                <?php if( have_rows('chart_cat')): ?>
                                    <?php while ( have_rows('chart_cat')) : the_row(); ?>
                                        <a class='underline dtext' href="#<?php echo get_sub_field('cat_link'); ?>"><?php echo get_sub_field('cat_name'); ?></a>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class='showmed'>
                            <div class='catBox'>
                                <ul class="vertical menu accordion-menu" data-accordion-menu>
                                    <li>
                                        <a href="#" class='weight'>Select size category <span class="material-icons catdown">keyboard_arrow_down</span><span class="material-icons catup">keyboard_arrow_up</span></a>
                                        <ul class="menu vertical nested">
                                            <?php if( have_rows('chart_cat')): ?>
                                                <?php while ( have_rows('chart_cat')) : the_row(); ?>
                                                    <li>
                                                        <a class='underline dtext' href="#<?php echo get_sub_field('cat_link'); ?>"><?php echo get_sub_field('cat_name'); ?></a>
                                                    </li>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class='grid-x lgW padB80'>
                    <div class='small-12 medium-12 large-12 cell'>

                      <?php if( have_rows('new_chart')): ?>
                          <?php while ( have_rows('new_chart')) : the_row(); ?>

                              <p class='h3 center dtext marB30' id="<?php echo get_sub_field('cat_name'); ?>"><?php echo get_sub_field('chart_name'); ?></p>
                              <img class='chartImg marB30' src="<?php echo get_sub_field('chart_img'); ?>" />
                              <p class='largep dtext center marB20'>Find your size</p>
                              <div class='buttons marB30'>
                                  <button class='cm lgreyB activeBorder'>cm</button>
                                  <button class='inch lgreyB'>Inches</button>
                              </div>

                              <div class='tableWrap'>
                                  <table class='inchesTable marB90' border="0">
                                  <thead>
                                      <tr>
                                          <?php if( have_rows('inch_title')): $i = 1; ?>
                                              <?php while ( have_rows('inch_title')) : the_row(); ?>
                                                 <td class='tit_<?php echo $i; ?>'><?php echo get_sub_field('title'); ?></td>
                                              <?php $i++; endwhile; ?>
                                          <?php endif; ?>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php if( have_rows('inch_row')): $i = 1; ?>
                                         <?php while ( have_rows('inch_row')) : the_row(); ?>
                                              <tr>
                                                  <?php if( have_rows('inch_measurement')): $i = 1; ?>
                                                      <?php while ( have_rows('inch_measurement')) : the_row(); ?>
                                                          <td class='inch_<?php echo $i; ?>'><?php echo get_sub_field('measurements'); ?></td>
                                                      <?php $i++; endwhile; ?>
                                                  <?php endif; ?>
                                              </tr>
                                          <?php $i++; endwhile; ?>
                                      <?php endif; ?>
                                  </tbody>
                              </table>
                                  <table class='cmTable marB90 showtable'>
                                  <thead class='blackBg'>
                                     <tr>
                                         <?php if( have_rows('cm_title')): $i = 1; ?>
                                             <?php while ( have_rows('cm_title')) : the_row(); ?>
                                                <td class='tit_<?php echo $i; ?>'><?php echo get_sub_field('title'); ?></td>
                                             <?php $i++; endwhile; ?>
                                         <?php endif; ?>
                                     </tr>
                                  </thead>
                                  <tbody>
                                      <?php if( have_rows('cm_row')): $i = 1; ?>
                                         <?php while ( have_rows('cm_row')) : the_row(); ?>
                                              <tr>
                                                  <?php if( have_rows('cm_measurement')): $i = 1; ?>
                                                      <?php while ( have_rows('cm_measurement')) : the_row(); ?>
                                                          <td class='cm_<?php echo $i; ?>'><?php echo get_sub_field('measurements'); ?></td>
                                                      <?php $i++; endwhile; ?>
                                                  <?php endif; ?>
                                              </tr>
                                          <?php $i++; endwhile; ?>
                                      <?php endif; ?>
                                  </tbody>
                              </table>
                              </div>


                          <?php endwhile; ?>
                      <?php endif; ?>

                    </div>
                </div>
            </div>
        </section>

        <?php get_template_part( 'parts/customer', 'info' ); ?>

  	</div>

<?php get_footer(); ?>
