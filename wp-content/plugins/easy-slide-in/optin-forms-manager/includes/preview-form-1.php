<?php ?>
						<div id="esi-optinforms-form1-container">
                            <div id="esi-optinforms-form1" style="background:<?php echo esi_optinforms_form1_default_background(); ?>; border-color:<?php echo esi_optinforms_form1_default_border(); ?>">
                                <p id="esi-optinforms-form1-title" style="font-family:<?php echo esi_optinforms_form1_default_title_font(); ?>; font-size:<?php echo esi_optinforms_form1_default_title_size(); ?>; line-height:<?php echo esi_optinforms_form1_default_title_size(); ?>; color:<?php echo esi_optinforms_form1_default_title_color(); ?>; <?php if (get_option('esi_optinforms_form1_hide_title')== '1') echo 'display:none;'; ?>"><?php echo esi_optinforms_form1_default_title(); ?></p>
        
                                <p id="esi-optinforms-form1-subtitle" style="font-family:<?php echo esi_optinforms_form1_default_subtitle_font(); ?>; font-size:<?php echo esi_optinforms_form1_default_subtitle_size(); ?>; line-height: <?php echo esi_optinforms_form1_default_subtitle_size(); ?>; <?php if (get_option('esi_optinforms_form1_hide_subtitle')== '1') echo 'display:none;'; ?>"><?php echo esi_optinforms_form1_default_subtitle(); ?></p>
                                <div id="esi-optinforms-form1-name-field-container" <?php if (get_option('esi_optinforms_form1_hide_name_field')== '1') echo 'style="display:none;"'; ?>>
                                    <input type="text" id="esi-optinforms-form1-name-field" placeholder="<?php echo esi_optinforms_form1_default_name_field(); ?>" style="font-family:<?php echo esi_optinforms_form1_default_fields_font(); ?>; font-size:<?php echo esi_optinforms_form1_default_fields_size(); ?>; color:<?php echo esi_optinforms_form1_default_fields_color(); ?>" />
                                </div><!--esi-optinforms-form1-name-field-container-->
                                <div id="esi-optinforms-form1-email-field-container" <?php if (get_option('esi_optinforms_form1_hide_name_field')== '1') echo 'style="width:78%;"'; ?>>
                                    <input type="text" id="esi-optinforms-form1-email-field" placeholder="<?php echo esi_optinforms_form1_default_email_field(); ?>" style="font-family:<?php echo esi_optinforms_form1_default_fields_font(); ?>; font-size:<?php echo esi_optinforms_form1_default_fields_size(); ?>; color:<?php echo esi_optinforms_form1_default_fields_color(); ?>" />
                                </div><!--esi-optinforms-form1-email-field-container-->
                                <div id="esi-optinforms-form1-button-container">
                                    <input type="button" id="esi-optinforms-form1-button" value="<?php echo esi_optinforms_form1_default_button_text(); ?>" style="font-family:<?php echo esi_optinforms_form1_default_button_text_font(); ?>; font-size:<?php echo esi_optinforms_form1_default_button_text_size(); ?>; color:<?php echo esi_optinforms_form1_default_button_text_color(); ?>; background-color:<?php echo esi_optinforms_form1_default_button_background(); ?>" />
                                </div><!--esi-optinforms-form1-button-container-->
                                <div class="clear"></div>
                                <p id="esi-optinforms-form1-disclaimer" style="font-family:<?php echo esi_optinforms_form1_default_disclaimer_font(); ?>; font-size:<?php echo esi_optinforms_form1_default_disclaimer_size(); ?>; line-height: <?php echo esi_optinforms_form1_default_disclaimer_size(); ?>; color:<?php echo esi_optinforms_form1_default_disclaimer_color(); ?>; <?php if (get_option('esi_optinforms_form1_hide_disclaimer')== '1') echo 'display:none;'; ?>"><?php echo esi_optinforms_form1_default_disclaimer(); ?></p>
                            </div><!--esi-optinforms-form1-->
                        </div><!--esi-optinforms-form1-container-->
                        <div class="clear"></div>			
                   

<?php ?>