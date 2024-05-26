<?php
//require_once 'incfunctio.php';

require_once 'get_maxprice.php';
?>

<!-- JAVASCRIPT FOR PRICE SLIDER IN SEARCH BOX -->
<script>
  <?php
    $search_cat_id = osc_search_category_id();
    $search_cat_id = isset($search_cat_id[0]) ? $search_cat_id[0] : '';

    $max = zara_max_price($search_cat_id, Params::getParam('sCountry'), Params::getParam('sRegion'), Params::getParam('sCity'));
    $max_price = ceil($max['max_price']/50)*50;
    $max_currency = $max['max_currency'];
    $format_sep = osc_get_preference('format_sep', 'zara_theme');
    $format_cur = osc_get_preference('format_cur', 'zara_theme');

    if($format_cur == 0) {
      $format_prefix = $max_currency;
      $format_suffix = '';
    } else if ($format_cur == 1) {
      $format_prefix = '';
      $format_suffix = $max_currency;
    } else {
      $format_prefix = '';
      $format_suffix = '';
    }
  ?>

  $(function() {
    $( "#slider-range" ).slider({
      range: true,
      //step: <?php echo round($max_price/25, 0); ?>,
      step: 1,
      min: 0,
      max: <?php echo $max_price; ?>,
     values: [<?php echo (Params::getParam('sPriceMin') <> '' ? Params::getParam('sPriceMin') : '0'); ?>, <?php echo (Params::getParam('sPriceMax') <> '' ? Params::getParam('sPriceMax') : $max_price); ?> ],
      slide: function( event, ui ) {
        if(ui.values[ 0 ] <= 0) {
          $( "#amount-min" ).text( "<?php echo osc_esc_js(__('Free', 'zara')); ?>" );
          $( "#amount-max" ).text( ui.values[ 1 ] );
          $( "#amount-max" ).priceFormat({prefix: '<?php echo $format_prefix; ?>', suffix: '<?php echo $format_suffix; ?>', thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
        } else {
          $( "#amount-min" ).text( ui.values[ 0 ] );
          $( "#amount-max" ).text( ui.values[ 1 ] );
          $( "#amount-min" ).priceFormat({prefix: '<?php echo $format_prefix; ?>', suffix: '<?php echo $format_suffix; ?>', thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
          $( "#amount-max" ).priceFormat({prefix: '<?php echo $format_prefix; ?>', suffix: '<?php echo $format_suffix; ?>', thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
        }
         //================================================================
          if((ui.values[ 0 ] == ui.values[ 1 ]) && ui.values[ 0 ] == 0) {
          $( "#amount-min" ).text( "<?php echo osc_esc_js(__('Free', 'zara')); ?>" );
           $( "#amount-max" ).text( "");
		  $( "#amount-del" ).hide(0);
          }
		  else if(((ui.values[ 0 ] == ui.values[ 1 ]) && ui.values[ 0 ] != 0))
		  {
           $( "#amount-min" ).text(ui.values[ 0 ]);
           $( "#amount-max" ).text( "");
		  $( "#amount-del" ).hide(0); 
          $( "#amount-min" ).priceFormat({prefix: '<?php echo $format_prefix; ?>', suffix: '<?php echo $format_suffix; ?>', thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
		  }
           else{ $( "#amount-del" ).show(0);}
        //===================================================================
         /*
        if(ui.values[ 0 ] <= 0) {   
          $( "#priceMin" ).val('');
        } else {
          $( "#priceMin" ).val(ui.values[ 0 ]);
        }
        
        if(ui.values[ 1 ] >= <?php echo $max_price; ?>) {
          $( "#priceMax" ).val('');
        } else {
          $( "#priceMax" ).val(ui.values[ 1 ]);
        }
        */
        

     //sam addition

	 if( (ui.values[ 0 ] == ui.values[ 1 ]) && ui.values[ 0 ]<= 0) 
			{
           // If max_price is 0, set it to 1 to avoid slider defect
			   $( "#priceMax" ).val('1');   // added by Sam avoid crashing of price slider if max price is zero it does not search for some reason
               $( "#priceMin" ).val(ui.values[ 0 ]);
                
          	}
          else{
          $( "#priceMin" ).val(ui.values[ 0 ]);
          $( "#priceMax" ).val(ui.values[ 1 ]);
          }

$("#cookie-action-side").val('done');
//end of sam addition
//========================================================================
      }
       

    });


if( $( "#slide-range" ).slider( "values", 0 ) <= 0) {
          $( "#amount-min" ).text( "<?php echo osc_esc_js(__('Free', 'zara')); ?>" );
          $( "#amount-max" ).text( $( "#slider-range" ).slider( "values", 1 ) );
          $( "#amount-max" ).priceFormat({prefix: '<?php echo $format_prefix; ?>', suffix: '<?php echo $format_suffix; ?>', thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
        } else {
          $( "#amount-min" ).text( $( "#slider-range" ).slider( "values", 0 ) );
          $( "#amount-max" ).text( $( "#slider-range" ).slider( "values", 1 ) );
          $( "#amount-min" ).priceFormat({prefix: '<?php echo $format_prefix; ?>', suffix: '<?php echo $format_suffix; ?>', thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
          $( "#amount-max" ).priceFormat({prefix: '<?php echo $format_prefix; ?>', suffix: '<?php echo $format_suffix; ?>', thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
        }
         //================================================================
          if(($( "#slider-range" ).slider( "values", 0 ) == $( "#slider-range" ).slider( "values", 1 )) && $( "#slider-range" ).slider( "values", 0 ) == 0) {
          $( "#amount-min" ).text( "<?php echo osc_esc_js(__('Free', 'zara')); ?>" );
           $( "#amount-max" ).text( "");
		  $( "#amount-del" ).hide(0);
          }
		  else if((($( "#slider-range" ).slider( "values", 0 ) == $( "#slider-range" ).slider( "values", 1 )) && $( "#slider-range" ).slider( "values", 0 ) != 0))
		  {
           $( "#amount-min" ).text($( "#slider-range" ).slider( "values", 0 ));
           $( "#amount-max" ).text( "");
		  $( "#amount-del" ).hide(0); 
          $( "#amount-min" ).priceFormat({prefix: '<?php echo $format_prefix; ?>', suffix: '<?php echo $format_suffix; ?>', thousandsSeparator: '<?php echo $format_sep; ?>', centsLimit: 0});
		  }
           else{ $( "#amount-del" ).show(0);}
 });

</script>



<div class="row one_input">

<div id='plabel' class="lnup"><h6><?php _e('Price:', 'zara'); ?></h6></div> 
  <div id="amount-min"></div><div id="amount-del">-</div><div id="amount-max"></div>     
       <input type="hidden" id="priceMin" name="sPriceMin" value="<?php echo Params::getParam('sPriceMin'); ?>" size="6" maxlength="6" />
        <input type="hidden" id="priceMax" name="sPriceMax" value="<?php echo Params::getParam('sPriceMax'); ?>" size="6" maxlength="6" />

    
    <div class="slider" >
     

        <div id="slider-range"></div>
    </div>
</div>


