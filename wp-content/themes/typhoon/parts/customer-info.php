<section class='customerInfo'>
    <div class='grid-container full pad90W'>
        <div class='grid-x grid-margin-x pad50 bTop footerCustomerInfo'>
            <div class='small-12 medium-6 large-3 cell point'>
                <span class="material-icons orange">done</span><?php echo get_field('info_one','options'); ?>
            </div>
            <div class='small-12 medium-6 large-3 cell point flexmid'>
                <span class="material-icons orange">done</span><?php echo get_field('info_two','options'); ?>
            </div>
            <div class='small-12 medium-6 large-3 cell point flexmid'>
                <span class="material-icons orange">done</span><?php echo get_field('info_three','options'); ?>
            </div>
            <div class='small-12 medium-6 large-3 cell point flexend'>
                <a href="<?php echo get_field('infoimg_link', 'options'); ?>">
                    <img src="<?php echo get_field('info_img','options'); ?>"/><?php echo get_field('info_four','options'); ?>
                </a>
            </div>
        </div>
    </div>
</div>
