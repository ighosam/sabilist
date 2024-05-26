<!-- JAVASCRIPT FOR MILEAGE SLIDER IN SEARCH BOX -->
<script>
  <?php
   
include_once 'get_maxmileage.php';

 $max  = get_max_mileage();

    $max_kilometer = $max['max_mileage'];
    $max_kilotype = $max['kilometer'];
    $format_sep = osc_get_preference('format_sep', 'zara_theme');

    if($max_kilometer == ''){$max_kilometer = '1000000';} //prevent slider from crashing when no max_kilometer is null or no kilometer entered in car listing data
													  // or data is empty.
  ?>

  $(function() {
    $( "#mileage-range" ).slider({
      range: true,
     // step: <?php echo round($max_kilometer/25, 0); ?>,
      min: 0,
      max: <?php echo $max_kilometer; ?>,
      values: [<?php echo (Params::getParam('mileageMin') <> '' ? Params::getParam('mileageMin') : '0'); ?>, <?php echo (Params::getParam('mileageMax') <> '' ? Params::getParam('mileageMax') : $max_kilometer); ?> ],
      slide: function( event, ui ) {
        if(ui.values[ 0 ] == ui.values[ 1 ]) {
          $( "#kilo-min" ).text( ui.values[ 0 ] );
          $( "#kilo-max" ).text("");
          $( "#kilo-min" ).priceFormat({prefix: "<?php echo '' ?>", suffix: "<?php echo 'km' ?>", thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
          $( "#kilo-del" ).hide(0);
        } else {
          $( "#kilo-min" ).text( ui.values[ 0 ] );
          $( "#kilo-max" ).text( ui.values[ 1 ] );
          $( "#kilo-min" ).priceFormat({prefix: "<?php echo '' ?>", suffix: "<?php echo 'km' ?>", thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
          $( "#kilo-max" ).priceFormat({prefix: "<?php echo '' ?>", suffix: "<?php echo 'km' ?>", thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
          $( "#kilo-del" ).show(0);
         }


       /*
        if(ui.values[ 0 ] <= 0) { 
          $( "#mileageMin" ).val('');
        } else {
          $( "#mileageMin" ).val(ui.values[ 0 ]);
        }

        if(ui.values[ 1 ] >= <?php echo $max_kilometer; ?>) {
          $( "#mileageMax" ).val('');
        } else {
          $( "#mileageMax" ).val(ui.values[ 1 ]);
        }
        */
        
          $( "#mileageMin" ).val(ui.values[ 0 ]);
          $( "#mileageMax" ).val(ui.values[ 1 ]);

       $("#cookie-action-side").val('done');
      }
    });
    


    if( $( "#mileage-range" ).slider( "values", 0 ) == $( "#mileage-range" ).slider( "values", 1 ) ) {
        $( "#kilo-min" ).text( $( "#mileage-range" ).slider( "values", 0 ) );
        $( "#kilo-max" ).text( "<?php echo osc_esc_js(__('', 'zara')); ?>" );
        $( "#kilo-del" ).hide(0);
        $( "#kilo-min" ).priceFormat({prefix: "<?php echo '' ?>", suffix: "<?php echo 'km' ?>", thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
    
      } else {
        $( "#kilo-min" ).text( $( "#mileage-range" ).slider( "values", 0 ) );
        $( "#kilo-max" ).text( $( "#mileage-range" ).slider( "values", 1 ) );
        $( "#kilo-del" ).show(0);
        $( "#kilo-max" ).priceFormat({prefix: "<?php echo '' ?>", suffix: "<?php echo 'km' ?>", thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
        $( "#kilo-min" ).priceFormat({prefix: "<?php echo '' ?>", suffix: "<?php echo 'km' ?>", thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
      }

/*
    } else {

      $( "#kilo-min" ).text( $( "#mileage-range" ).slider( "values", 0 ) );
      $( "#kilo-max" ).text( $( "#mileage-range" ).slider( "values", 1 ) );
      $( "#kilo-min" ).priceFormat({prefix: "<?php echo '' ?>", suffix: "<?php echo 'km' ?>", thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
      $( "#kilo-max" ).priceFormat({prefix: "<?php echo '' ?>", suffix: "<?php echo 'km' ?>", thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
    }
*/

  });

</script>

<?php
/*
NOTE:
ui.values[ 0 ] AND ui.values[ 1 ] are values shown when the slider is moved or moving
$( "#mileage-range" ).slider( "values", 0 ) are values shown when the searched buttom is pressed.

*/
?>
<div class="row slider_input mileage">
<?php // _e('Mileage in KM:', 'cars_attributes'); ?>

<div class ="slider_fllft">
<div id='klabel' class="lnup fleft"><?php _e('KM:', 'cars_attributes'); ?></div>
<div id="kilo-min" class="lnup fleft"></div><div id="kilo-del" class = "lnup fleft">-</div><div id="kilo-max" class="lnup fleft"></div>

 <div class ="clear"></div>
</div> 
        
        <input type="hidden" id="mileageMin" name="mileageMin" value="<?php echo Params::getParam('mileageMin'); ?>" size="6" maxlength="6" />
        <input type="hidden" id="mileageMax" name="mileageMax" value="<?php echo Params::getParam('mileageMax'); ?>" size="6" maxlength="6" />
    
    <div class="slider" >
     

        <div id="mileage-range"></div>
    </div>
</div>
