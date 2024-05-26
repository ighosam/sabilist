<div id="list-view">

  <?php 
    // PREMIUM ITEMS
    if(zara_current('zc_cat_premium') == 1) { 
      osc_get_premiums(4);
      $c = 1;

      while(osc_has_premiums()) {
        zara_draw_item($c, 'list', true, 'premium-loop');
        $c++;
      }
    } 
  ?>



  <?php $c = 1; ?>
  <?php while(osc_has_items()) { ?>

    <?php zara_draw_item($c, 'list'); ?>

    <?php if($c == 1 && (zara_banner_code('search', 3) <> '' || (osc_is_admin_user_logged_in() && function_exists('zc_current')))) { ?>
      <!-- Search List Banner #3 - Shown on 2nd position -->
      <div class="list-prod list-ad">
        <?php echo zara_banner('search', 3); ?>
      </div>
    <?php } ?>


    <?php if($c == 5 && (zara_banner_code('search', 4) <> '' || (osc_is_admin_user_logged_in() && function_exists('zc_current')))) { ?>
      <!-- Search List Banner #4 - Shown on 6th position -->
      <div class="list-prod list-ad">
        <?php echo zara_banner('search', 4); ?>
      </div>
    <?php } ?>

    <?php $c++; ?>
  <?php } ?>
</div>


