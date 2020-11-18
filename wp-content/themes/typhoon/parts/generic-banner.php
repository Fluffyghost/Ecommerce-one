<section class='genericBanner rel' style="background-image:url('<?php echo get_field('generic_banner'); ?>');">
    <div class='bannerOverlay'></div>
    <div class='grid-container full pad90W'>
        <div class='grid-x'>
            <div class='large-12 cell padT10 whitecrumbs'>
                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); } ?>
            </div>
        </div>
    </div>
    <div class='grid-container'>
        <div class='grid-x  padB30 bannerWrap'>
            <div class='large-12 cell innerwrap midW'>
                <h1 class='white marB20 center'><?php echo get_field('title'); ?></h1>
                <?php if (get_field('text')) : ?>
                    <p class='white h4 center'><?php echo get_field('text'); ?></p>
                  <?php endif; ?>
                <?php if (get_field('button_text')) : ?>
                    <a class='whiteHB alCen marT40' href="<?php echo get_field('button_link'); ?>"><?php echo get_field('button_text'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
