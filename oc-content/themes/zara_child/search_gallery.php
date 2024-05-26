<div id="gallery-view" class="white">
  <div class="block">
    <div class="wrap">

      <?php 
        // PREMIUM ITEMS
        if(zara_current('zc_cat_premium') == 1) { 

          osc_get_premiums(5);
          $c = 1;

          while(osc_has_premiums()) {
            zara_draw_item($c, 'gallery', true, 'premium-loop');
            $c++;
          }
        } 
      ?>


      <?php $c = 1; ?>
      <?php while( osc_has_items() ) { ?>

        <?php zara_draw_item($c, 'gallery'); ?>

        <?php if($c == 1 && (zara_banner_code('search', 5) <> '' || (osc_is_admin_user_logged_in() && zara_current('zc_banner_highlight') == 1 && function_exists('zc_current')))) { ?>
          <!-- Search List Banner #5 - Shown on 2nd position -->
          <?php $c++; ?>

          <div class="simple-prod simple-ad o<?php echo $c; ?>">
            <?php echo zara_banner('search', 5); ?>
          </div>
        <?php } ?>



        <?php if($c == 8 && (zara_banner_code('search', 6) <> '' || (osc_is_admin_user_logged_in() && zara_current('zc_banner_highlight') == 1 && function_exists('zc_current')))) { ?>
          <!-- Search List Banner #6 - Shown on 9th position -->
          <?php $c++; ?>

          <div class="simple-prod simple-ad o<?php echo $c; ?>">
            <?php echo zara_banner('search', 6); ?>
          </div>
        <?php } ?>



        <?php if($c == 12 && (zara_banner_code('search', 7) <> '' || (osc_is_admin_user_logged_in() && zara_current('zc_banner_highlight') == 1 && function_exists('zc_current')))) { ?>
          <!-- Search List Banner #7 - Shown on 13th position -->
          <?php $c++; ?>

          <div class="simple-prod simple-ad o<?php echo $c; ?>">
            <?php echo zara_banner('search', 7); ?>
          </div>
        <?php } ?>

        <?php $c++; ?>
      <?php } ?>

    </div>
  </div>
 
  <?php View::newInstance()->_erase('items') ; ?>
</div>