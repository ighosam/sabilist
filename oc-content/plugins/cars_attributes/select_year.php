<?php $d_current_year = date ('Y'); ?>
			<select name= "year" id="year">
			 <option value=""><?php _e('Select Year', 'cars_attributes'); ?></option>
           <?php foreach( range(1850, $d_current_year) as $d_year) { ?>
            <option value="<?php echo $d_year; ?>" <?php if($d_year== @$detail['i_year']) { echo 'selected="selected"'; } ?>><?php echo $d_year; ?></option>
				       
			 <?php } ?>
				</select>   







