
<script>
  <?php
   
include_once 'get_maxmileage.php';


$min = get_min_year(); 
$min_year = $min['min_year'];
 
$date = new DateTime();
$max_year = $date->format('Y');




//$max_year =  date("Y");
if($min_year == '')
{
$min_year = '1857';  // prevent slider from crashing when no min value entered or car listing data is empty
}

 
?>

  $(function() {
    $( "#year-range" ).slider({
      range: true,
      //step: <?php echo round(strtotime($min_year)/1, 0); ?>,
      step: 1,
      min: <?php echo $min_year; ?>,
      max: <?php echo $max_year; ?>,

      values: [<?php echo (Params::getParam('yearMin') <> '' ? Params::getParam('yearMin') : $min_year); ?>, <?php echo (Params::getParam('yearMax') <> '' ? Params::getParam('yearMax') : $max_year); ?> ],
	
      slide: function( event, ui ) {

     /*
               if ( (ui.values[0] ) == ui.values[1] ) {
                return false;
            }
           */


      	if(((ui.values[ 0 ] == ui.values[ 1 ]) && ui.values[ 0 ] != 0))
		  {
           $( "#year-min" ).text(ui.values[ 0 ]);
           $( "#year-max" ).text( "");
		  $( "#year-del" ).hide(0); 
		  }
           else{ $( "#year-del" ).show(0);
         
          $( "#year-min" ).text( ui.values[ 0 ] );
          $( "#year-max" ).text(ui.values[ 1 ]);
           }

          $( "#yearMin" ).val(ui.values[ 0 ]);
          $( "#yearMax" ).val(ui.values[ 1 ]);


       
      }
    });
 

      if( $( "#year-range" ).slider( "values", 0 ) == $( "#year-range" ).slider( "values", 1 ) ) {
      $( "#year-min" ).text( $( "#year-range" ).slider( "values", 0 ) );
      $( "#year-max" ).text("");
      $( "#year-del" ).hide(0);
       }
      else
       {
        $( "#year-min" ).text( $( "#year-range" ).slider( "values", 0 ) );
        $( "#year-max" ).text( $( "#year-range" ).slider( "values", 1 ) );
        $( "#year-del" ).show(0);
       }
 
  });
  
 // $(".one_input #year-range .ui-slider-handle:first-of-type").css('z-index','100');
//ui-state-focus
   
</script>




<div class="row slider_input">

<div class ="slider_fllft">
<div id='ylabel' class="lnup fleft"><?php _e('Year:', 'cars_attributes'); ?></div>

 
<div id="year-min" class="lnup fleft"></div><div id="year-del" class="lnup fleft">-</div><div id="year-max" class="lnup fleft"></div>
<div class ="clear"></div>
</div> 
        
        <input type="hidden" id="yearMin" name="yearMin" value="<?php echo Params::getParam('yearMin'); ?>" size="6" maxlength="6" />
        <input type="hidden" id="yearMax" name="yearMax" value="<?php echo Params::getParam('yearMax'); ?>" size="6" maxlength="6" />
    
    <div class="slider" >
     

        <div id="year-range"></div>
    </div>

</div>


