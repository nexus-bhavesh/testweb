<?php
/**
 * Settings Page
 *
 * @package Fina Forte
 * @since 1.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;
?>

<div class="wrap bwswpos-settings">
    <form action="options.php" method="POST" id="finaforte-settings-form" class="finaforte-settings-form">
        <?php settings_fields('finaforte_plugin_options'); ?>
        <?php
        // Success message
        if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
            echo '<div id="message" class="updated notice notice-success is-dismissible">
                <p><strong>Your changes saved successfully</strong></p>
            </div>';
        }  ?>
    <ul class="tabs">
    <li>
        <input type="radio" name="tabs" id="tab1" class="" checked />
        <label class="tab-label" for="tab1" id="tab1">Settings</label>
        
    </li>
  
    <li>
        <input type="radio" name="tabs" id="tab2" class="tab-content2" />
        <label class="tab-label" for="tab2" id="tab2">Ajustable Texts</label>
        
    </li>
    
    <li>
        <input type="radio" name="tabs" id="tab3" class="tab-content3" />
        <label class="tab-label" for="tab3" id="tab3">Ajustable CSS</label>
        
    </li>
    
    <li>
        <input type="radio" name="tabs" id="tab4" class="tab-content4" />
        <label class="tab-label" for="tab4" id="tab4">Calculaions</label>
        
    </li>  
</ul>

<div id="tab-content1" class="tab-content">            
                       
                    <div id="finaforte-label-sett" class="post-box-container finaforte-label-sett">            

                        <!-- advisor Photo -->
                        
                        <h3 class="hndle">
                            <span><?php _e('Advisor Photo for Total Calculation', 'buttons-with-style'); ?></span>
                        </h3> <hr>
                        <div class="inside">
                            <table class="form-table finaforte-label-tbl">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('Advicer Photo', 'buttons-with-style'); ?>:</label>
                                        </th>   
                                        <td>
                                            <input type="text" name="finaforte_options[advicer_photo]" value="<?php echo finaforte_get_option('advicer_photo'); ?>" id="aigpl-default-img" class="regular-text aigpl-default-img aigpl-img-upload-input" />
                                            <input type="button" name="aigpl_advicer_photo" class="button-secondary aigpl-img-uploader" value="<?php _e('Upload Image', 'album-and-image-gallery-plus-lightbox'); ?>" />
                                            <input type="button" name="aigpl_advicer_photo_clear" id="aigpl-default-img-clear" class="button button-secondary aigpl-image-clear" value="<?php _e('Clear', 'album-and-image-gallery-plus-lightbox'); ?>" /> <br />
                                            <span class="description"><?php _e('Photo of advisor (for next to the total calculation).', 'album-and-image-gallery-plus-lightbox'); ?></span>
                                            <?php
                                            $advicer_photo = '';
                                            if (finaforte_get_option('advicer_photo')) {
                                                $advicer_photo = '<img src="' . finaforte_get_option('advicer_photo') . '" alt="" />';
                                            }
                                            ?>
                                            <div class="aigpl-imgs-preview"><?php echo $advicer_photo; ?></div>
                                        </td>                                       
                                    </tr>                                   
                                    <tr>
                                        <td colspan="2" valign="top" scope="row">
                                            <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- .inside -->

                        <!-- Text description in the total calculation (above the 'receive by e-mail' button) -->
                        <hr>
                        <!-- Settings box title -->
                        <h3 class="hndle">
                            <span><?php _e('Text description in the total calculation (above the : receive by e-mail button)', 'buttons-with-style'); ?></span>
                        </h3> <hr>
                        <div class="inside">
                            <table class="form-table finaforte-label-tbl">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('Contact for Advice', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <input type="text" class="width_50" name="finaforte_options[advice_contact]" id="advice_contact" value="<?php echo finaforte_esc_attr(finaforte_get_option('advice_contact')); ?>" 
                                                    return false;" /><br/> <!-- onkeyup="check(); -->
                                            <span class="description" id="message"><?php _e('Contact Number for Advice.', 'buttons-with-style'); ?></span> <br>
                                            <!-- <p class="error_Msg"> Error! Phone number can contain only numbers from 0-9 and + or - sign </p>  -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('E-mail from recipient of the lead', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <input type="email" class="width_50" name="finaforte_options[rol_email]" id="rol_email" value="<?php echo finaforte_esc_attr(finaforte_get_option('rol_email')); ?>"/><br/>
                                            <span class="description"><?php _e('E-mail from recipient of the lead.', 'buttons-with-style'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e(' E-mail CC1 ', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <input type="email" class="width_50" name="finaforte_options[cc1_email]" id="cc1_email" value="<?php echo finaforte_esc_attr(finaforte_get_option('cc1_email')); ?>"/><br/>
                                            <span class="description"><?php _e('E-mail CC1 receiver of the lead.', 'buttons-with-style'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('E-mail CC2', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <input type="email" class="width_50" name="finaforte_options[cc2_email]" id="cc2_email" value="<?php echo finaforte_esc_attr(finaforte_get_option('cc2_email')); ?>"/><br/>
                                            <span class="description"><?php _e(' E-mail CC2 recipient of the lead.', 'buttons-with-style'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" valign="top" scope="row">
                                            <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- .inside -->
                        <!-- SMTP Details -->
                        <hr>
                        <h3 class="hndle">
                            <span><?php _e('SMTP Details'); ?></span>
                        </h3><hr>
                        <div class="inside">
                            <table class="form-table finaforte-label-tbl">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('SMTP server address', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <input type="text" class="width_50" name="finaforte_options[smtp_server_add]" id="smtp_server_add" value="<?php echo finaforte_esc_attr(finaforte_get_option('smtp_server_add')); ?>" /><br/>
                                            <span class="description" id="message"><?php _e('Please enter SMTP server address.', 'buttons-with-style'); ?></span> <br>
                                            <p class="error_Msg"> Error! Phone number can contain only numbers from 0-9 and + or - sign </p> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('SMTP username', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <input type="text" class="width_50" name="finaforte_options[smtp_username]" id="smtp_username" value="<?php echo finaforte_esc_attr(finaforte_get_option('smtp_username')); ?>"/><br/>
                                            <span class="description"><?php _e('Please enter SMTP username', 'buttons-with-style'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('SMTP password ', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <input type="text" class="width_50" name="finaforte_options[smtp_password]" id="smtp_password" value="<?php echo finaforte_esc_attr(finaforte_get_option('smtp_password')); ?>"/><br/>
                                            <span class="description"><?php _e('Please enter SMTP password', 'buttons-with-style'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('SMTP port type', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <select name="finaforte_options[smtp_port_type]" id="smtp_port_type" class="width_50">
                                                <option value="tls" <?php selected("tls", finaforte_get_option('smtp_port_type')); ?> >TLS</option>
                                                <option value="ssl" <?php selected("ssl", finaforte_get_option('smtp_port_type')); ?> >SSL</option>
                                            </select><br/>
                                            <span class="description"><?php _e('Please select SMTP port type', 'buttons-with-style'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="finaforte-label"><?php _e('SMTP port', 'buttons-with-style'); ?>:</label>
                                        </th>
                                        <td>
                                            <input type="text" class="width_50" name="finaforte_options[smtp_port]" id="smtp_port" value="<?php echo finaforte_esc_attr(finaforte_get_option('smtp_port')); ?>"/><br/>
                                            <span class="description"><?php _e('Please enter SMTP port', 'buttons-with-style'); ?></span>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2" valign="top" scope="row">
                                            <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- .inside -->
                    </div>
                
        </div>
        <!-- tab 2 code -->
        <div id="tab-content2" class="tab-content"><!-- tab content-->

            
           
                
            <div id="finaforte-label-sett" class="post-box-container finaforte-label-sett">
                
                <!-- Settings box title -->
                <h3 class="hndle"><span>General Fields</span></h3> <hr>
                <table class="form-table finaforte-label-tbl">
                    <tbody>                         
                        <tr>
                            <th scope="row">
                                <label for="cal_sugg_text">Calculation suggestion text:</label>
                            </th>
                            <td>
                                <textarea rows="3" cols="65" name="finaforte_options[cal_sugg_text]" id="cal_sugg_text"><?php echo finaforte_esc_attr(finaforte_get_option('cal_sugg_text')); ?></textarea><br>
                                <span class="description">Enter text that suggest calculation</span>
                            </td>
                        </tr>   
                        <!--  -->                        
                        <tr>
                            <th scope="row">
                                <label for="popup_form_title_text">Form title text:</label>
                            </th>
                            <td>
                                <input type="text" class="width_50" name="finaforte_options[popup_form_title_text]" id="popup_form_title_text" value= "<?php echo finaforte_esc_attr(finaforte_get_option('popup_form_title_text')); ?>" ><br>
                                <span class="description">Enter text for title of form</span>
                            </td>
                        </tr> 
                        <tr>
                            <th scope="row">
                                <label for="form_description">Form description:</label>
                            </th>
                            <td>
                                <textarea rows="3" cols="65" name="finaforte_options[form_description]" id="form_description"><?php echo finaforte_esc_attr(finaforte_get_option('form_description')); ?></textarea><br>
                                <span class="description">Enter form description below form title</span>
                            </td>
                        </tr> 
                        <tr>
                            <th scope="row">
                                <label for="form_semi_description">Semi form description:</label>
                            </th>
                            <td>
                                <textarea rows="3" cols="65" name="finaforte_options[form_semi_description]" id="form_semi_description"><?php echo finaforte_esc_attr(finaforte_get_option('form_semi_description')); ?></textarea><br>
                                <span class="description">Enter semi description below form description</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="company_name">Company name:</label>
                            </th>
                            <td>
                                <input type="text" class="width_50" name="finaforte_options[company_name]" id="company_name" value= "<?php echo finaforte_esc_attr(finaforte_get_option('company_name')); ?>" ><br>
                                <span class="description">Enter text for company name in privacy policy</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="privacy_policy_url">Privacy Policy URL:</label>
                            </th>
                            <td>
                                <input type="url" class="width_50" name="finaforte_options[privacy_policy_url]" id="privacy_policy_url" value= "<?php echo finaforte_esc_attr(finaforte_get_option('privacy_policy_url')); ?>" ><br>
                                <span class="description">Enter url for privacy policy</span>
                            </td>
                        </tr>  
                        <tr>
                            <th scope="row">
                                <label for="popup_form_sub_text">Form Submit button name:</label>
                            </th>
                            <td>
                                <input type="text" class="width_50" name="finaforte_options[popup_form_sub_text]" id="popup_form_sub_text" value= "<?php echo finaforte_esc_attr(finaforte_get_option('popup_form_sub_text')); ?>" ><br>
                                <span class="description">Enter text for Form Submit button</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="popup_form_below_text">Below form text:</label>
                            </th>
                            <td>
                                <input type="text" class="width_50" name="finaforte_options[popup_form_below_text]" id="popup_form_below_text" value= "<?php echo finaforte_esc_attr(finaforte_get_option('popup_form_below_text')); ?>" ><br>
                                <span class="description">Enter text for below front page form </span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="view_cal_button_text">View cal button text:</label>
                            </th>
                            <td>
                                <input type="text" class="width_50" name="finaforte_options[view_cal_button_text]" id="view_cal_button_text" value= "<?php echo finaforte_esc_attr(finaforte_get_option('view_cal_button_text')); ?>" ><br>
                                <span class="description">Enter text for view calculation button </span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="free_advice_label">Free advice label:</label>
                            </th>
                            <td>
                                <input type="text" class="width_50" name="finaforte_options[free_advice_label]" id="free_advice_label" value= "<?php echo finaforte_esc_attr(finaforte_get_option('free_advice_label')); ?>" ><br>
                                <span class="description">Enter free advice label </span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="free_advice_text">Free advice text:</label>
                            </th>
                            <td>
                                <input type="text" class="width_50" name="finaforte_options[free_advice_text]" id="free_advice_text" value= "<?php echo finaforte_esc_attr(finaforte_get_option('free_advice_text')); ?>" ><br>
                                <span class="description">Enter free advice text </span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="email_button_text">Email button text:</label>
                            </th>
                            <td>
                                <input type="text" class="width_50" name="finaforte_options[email_button_text]" id="email_button_text" value= "<?php echo finaforte_esc_attr(finaforte_get_option('email_button_text')); ?>" ><br>
                                <span class="description">Enter email button text </span>
                            </td>
                        </tr>                       

                        <tr>                                        
                            <th></th>
                            <td colspan="2" valign="top" scope="row">
                                <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Notice Texts -->
                <hr><h3 class="hndle"><span>Notice Fields</span></h3> <hr>
                <div class="inside">
                    <table class="form-table finaforte-label-tbl">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="sol_liq_wrong_notice">Solvabiliteit and Liquiditeit are not entered:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_50"  name="finaforte_options[sol_liq_wrong_notice]" id="sol_liq_wrong_notice" value="<?php echo finaforte_esc_attr(finaforte_get_option('sol_liq_wrong_notice')); ?>"/><br/>
                                    <span class="description">Add notice text for this field</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="finaforte-label">Solvabiliteit is not entered:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_50"  name="finaforte_options[sol_wrong_notice]" id="sol_wrong_notice" value="<?php echo finaforte_esc_attr(finaforte_get_option('sol_wrong_notice')); ?>"/><br/>
                                    <span class="description">Add notice text for this field</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="theme_color">Liquiditeit is not entered:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_50" name="finaforte_options[liq_wrong_notice]" id="liq_wrong_notice" value="<?php echo finaforte_esc_attr(finaforte_get_option('liq_wrong_notice')); ?>"/><br/>
                                    <span class="description">Add notice text for this field</span>
                                </td>
                            </tr>   
                            <tr>
                                <th scope="row">
                                    <label for="P_sol_liq_wrong_notice">Partner's Solvabiliteit and Liquiditeit are not entered:</label>
                                </th>
                                <td>
                                    <input type="text" class="width_50" name="finaforte_options[p_sol_liq_wrong_notice]" id="p_sol_liq_wrong_notice" value="<?php echo finaforte_esc_attr(finaforte_get_option('p_sol_liq_wrong_notice')); ?>"/><br/>
                                    <span class="description">Add notice text for this field</span>
                                </td>
                            </tr>  
                            <tr>
                                <th scope="row">
                                    <label for="p_sol_wrong_notice">Partner's Solvabiliteit is not entered:</label>
                                </th>
                                <td>
                                    <input type="text" class="width_50" name="finaforte_options[p_sol_wrong_notice]" id="p_sol_wrong_notice" value="<?php echo finaforte_esc_attr(finaforte_get_option('p_sol_wrong_notice')); ?>"/><br/>
                                    <span class="description">Add notice text for this field</span>
                                </td>
                            </tr> 
                            <tr>
                                <th scope="row">
                                    <label for="P_liq_wrong_notice">Partner's Liquiditeit is not entered:</label>
                                </th>
                                <td>
                                    <input type="text" class="width_50" name="finaforte_options[p_liq_wrong_notice]" id="p_liq_wrong_notice" value="<?php echo finaforte_esc_attr(finaforte_get_option('p_liq_wrong_notice')); ?>"/><br/>
                                    <span class="description">Add notice text for this field</span>
                                </td>
                            </tr>                          
                            <tr>                                        
                                <th></th>
                                <td colspan="2" valign="top" scope="row">
                                    <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- solvency -->            
                <hr><h3 class="hndle"><span>Solvency</span> </h3> <hr>
                <div class="inside">
                    <table class="form-table finaforte-label-tbl">
                        <tbody>
                            <tr>
                                <td style="width: 20%"></td>
                                <th style="width: 45%" class="title">Insert Text</th>
                                <th style="width: 35%" class="title">Choose Color</th>
                            </tr>
                            <tr>
                                <th scope="row" class="title">
                                    <label for="solvency_green_text">Green:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[solvency_green_text]" id="solvency_green_text" value="<?php echo finaforte_esc_attr(finaforte_get_option('solvency_green_text')); ?>"/><br/>
                                    <span class="description">Enter lable for Green Text</span>
                                </td>
                                <td>
                                    <input type="text" name="finaforte_options[solvency_green_color]" id="solvency_green_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('solvency_green_color')); ?>"/><br/>
                                    <span class="description">Choose Green Text Color.</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="title">
                                    <label for="solvency_yellow_text">Yellow:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[solvency_yellow_text]" id="solvency_yellow_text" value="<?php echo finaforte_esc_attr(finaforte_get_option('solvency_yellow_text')); ?>"/><br/>
                                    <span class="description">Enter lable for Yellow Text</span>
                                </td>
                                <td>                                            
                                    <input type="text" name="finaforte_options[solvency_yellow_color]" id="solvency_yellow_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('solvency_yellow_color')); ?>"/><br/>
                                    <span class="description">Choose Yellow text Color.</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="title">
                                    <label for="solvency_red_text">Red:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" class="width_80" name="finaforte_options[solvency_red_text]" id="solvency_red_text" value="<?php echo finaforte_esc_attr(finaforte_get_option('solvency_red_text')); ?>"/><br/>
                                    <span class="description">Enter lable for Red Text.</span>
                                </td>
                                <td>

                                    <input type="text" name="finaforte_options[solvency_red_color]" id="solvency_red_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('solvency_red_color')); ?>"/><br/>
                                    <span class="description">Choose Red text Color.</span>
                                </td>
                            </tr>
                            <tr>                                        
                                <td colspan="3" valign="top" scope="row">
                                    <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- .inside -->

                <!-- liquidity -->           
                <hr><h3 class="hndle"><span><?php _e('Liquidity', 'buttons-with-style'); ?></span></h3><hr>
                <div class="inside">
                    <table class="form-table finaforte-label-tbl">
                        <tbody>
                            <tr>
                                <td style="width: 20%"></td>
                                <th style="width: 45%" class="title">Insert Text</th>
                                <th style="width: 35%" class="title">Choose Color</th>
                            </tr>
                            <tr>
                                <th scope="row" class="title">
                                    <label for="finaforte-label"><?php _e('Green text', 'buttons-with-style'); ?>:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[liquidity_green_text]" id="liquidity_green_text" value="<?php echo finaforte_esc_attr(finaforte_get_option('liquidity_green_text')); ?>"/><br/>
                                    <span class="description"><?php _e('Enter lable for Green Text.', 'buttons-with-style'); ?></span>
                                </td>
                                <td>                                            
                                    <input type="text" name="finaforte_options[liquidity_green_color]" id="liquidity_green_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('liquidity_green_color')); ?>"/><br/>
                                    <span class="description"><?php _e('Choose Green Text Color.', 'buttons-with-style'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="title">
                                    <label for="finaforte-label"><?php _e('Yellow text', 'buttons-with-style'); ?>:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[liquidity_yellow_text]" id="liquidity_yellow_text" value="<?php echo finaforte_esc_attr(finaforte_get_option('liquidity_yellow_text')); ?>"/><br/>
                                    <span class="description"><?php _e('Enter lable for Yellow Text.', 'buttons-with-style'); ?></span>
                                </td>
                                <td>                                            
                                    <input type="text" name="finaforte_options[liquidity_yellow_color]" id="liquidity_yellow_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('liquidity_yellow_color')); ?>"/><br/>
                                    <span class="description"><?php _e('Choose Yellow text Color.', 'buttons-with-style'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="title">
                                    <label for="finaforte-label"><?php _e('Red text', 'buttons-with-style'); ?>:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[liquidity_red_text]" id="liquidity_red_text" value="<?php echo finaforte_esc_attr(finaforte_get_option('liquidity_red_text')); ?>"/><br/>
                                    <span class="description"><?php _e('Enter lable for Red Text.', 'buttons-with-style'); ?></span>
                                </td>
                                <td>                                            
                                    <input type="text" name="finaforte_options[liquidity_red_color]" id="liquidity_red_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('liquidity_red_color')); ?>"/><br/>
                                    <span class="description"><?php _e('Choose Red text Color.', 'buttons-with-style'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" valign="top" scope="row">
                                    <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- .inside -->

                <!-- Settings box title -->
                <hr><h3 class="hndle"><span>Tooltip Box</span></h3><hr>
                <div class="inside">
                    <table class="form-table finaforte-label-tbl">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="tooltip_select_year">select year tooltip:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[tooltip_select_year]" id="tooltip_select_year" value="<?php echo finaforte_esc_attr(finaforte_get_option('tooltip_select_year')); ?>"/><br/>
                                    <span class="description">Enter tooltip for selct year radio button</span>
                                </td>
                            </tr>   
                            <tr>
                                <th scope="row">
                                    <label for="tooltip_salary">salary tooltip:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[tooltip_salary]" id="tooltip_salary" value="<?php echo finaforte_esc_attr(finaforte_get_option('tooltip_salary')); ?>"/><br/>
                                    <span class="description">Enter tooltip for salary textbox</span>
                                </td>
                            </tr>   
                            <tr>
                                <th scope="row">
                                    <label for="tooltip_mortgage_interest">mortgage interest tooltip:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[tooltip_mortgage_interest]" id="tooltip_mortgage_interest" value="<?php echo finaforte_esc_attr(finaforte_get_option('tooltip_mortgage_interest')); ?>"/><br/>
                                    <span class="description">Enter tooltip for salary textbox</span>
                                </td>
                            </tr>       
                            <tr>
                                <th scope="row">
                                    <label for="tooltip_total_p_incom">total partner income tooltip:</label>
                                </th>
                                <td>                                            
                                    <input type="text" class="width_80" name="finaforte_options[tooltip_total_p_incom]" id="tooltip_total_p_incom" value="<?php echo finaforte_esc_attr(finaforte_get_option('tooltip_total_p_incom')); ?>"/><br/>
                                    <span class="description">Enter tooltip for salary textbox</span>
                                </td>
                            </tr>                   
                            <tr>                                        
                                <th></th>
                                <td colspan="2" valign="top" scope="row">
                                    <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
       
    <!-- end tab content -->
    </div>

    <div id="tab-content3" class="tab-content">
          
          <!-- start tab content -->
          <div id="finaforte-label-sett" class="post-box-container finaforte-label-sett">           
           
                <!-- Settings box title -->
                <h3 class="hndle"><span>General Fields</span> </h3> <hr>
                <table class="form-table finaforte-label-tbl">
                    <tbody>
                      
                        <tr>
                            <th scope="row">
                                <label for="theme_bg_color">Theme background color:</label>
                            </th>
                            <td>                                            
                                <input type="text" class="width_50" name="finaforte_options[theme_bg_color]" id="theme_bg_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('theme_bg_color')); ?>"/><br/>
                                <span class="description">Choose theme background color.</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="btn_text_color">Button text color:</label>
                            </th>
                            <td>                                            
                                <input type="text" class="width_50" name="finaforte_options[btn_text_color]" id="btn_text_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('btn_text_color')); ?>"/><br/>
                                <span class="description">Choose button text color.</span>
                            </td>
                        </tr>  
                        <tr>
                            <th scope="row">
                                <label for="btn_bg_color">Button background color:</label>
                            </th>
                            <td>                                            
                                <input type="text" class="width_50" name="finaforte_options[btn_bg_color]" id="btn_bg_color" value="<?php echo finaforte_esc_attr(finaforte_get_option('btn_bg_color')); ?>"/><br/>
                                <span class="description">Choose button background color.</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="font_style">font style:</label>
                            </th>
                            <td>                                            
                                <input type="text"  name="finaforte_options[font_style]" id="font_style" value="<?php echo finaforte_esc_attr(finaforte_get_option('font_style')); ?>"/><br/>
                                <span class="description">Apply font style.</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="border_radious">Border radious:</label>
                            </th>
                            <td>                                            
                                <input type="number"  name="finaforte_options[border_radious]" id="border_radious" value="<?php echo finaforte_esc_attr(finaforte_get_option('border_radious')); ?>"/> px<br/>
                                <span class="description">Please enter border radious.</span>
                            </td>
                        </tr> 
                        <tr>
                            <th scope="row">
                                <label for="title_font_size">Title font size:</label>
                            </th>
                            <td>                                            
                                <input type="number"  name="finaforte_options[title_font_size]" id="title_font_size" value="<?php echo finaforte_esc_attr(finaforte_get_option('title_font_size')); ?>"/> px<br/>
                                <span class="description">Please enter title font size.</span>
                            </td>
                        </tr>  
                        <tr>
                            <th scope="row">
                                <label for="subtitle_font_size">Subtitle font size:</label>
                            </th>
                            <td>                                            
                                <input type="number"  name="finaforte_options[subtitle_font_size]" id="subtitle_font_size" value="<?php echo finaforte_esc_attr(finaforte_get_option('subtitle_font_size')); ?>"/> px<br/>
                                <span class="description">Please enter subtitle font size.</span>
                            </td>
                        </tr> 
                        <tr>
                            <th scope="row">
                                <label for="text_font_size">Text font size:</label>
                            </th>
                            <td>                                            
                                <input type="number"  name="finaforte_options[text_font_size]" id="text_font_size" value="<?php echo finaforte_esc_attr(finaforte_get_option('text_font_size')); ?>"/> px<br/>
                                <span class="description">Please enter text font size.</span>
                            </td>
                        </tr>  
                                                  
                        <tr>                                        
                            <th></th>
                            <td colspan="2" valign="top" scope="row">
                                <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        
    <!-- end tab content -->
    </div>
    <div id="tab-content4" class="tab-content">
             <div id="finaforte-label-sett" class="post-box-container finaforte-label-sett">
           
            <!-- Settings box title -->
            <h3 class="hndle"><span>General Fields</span></h3> <hr>
            <table class="form-table finaforte-label-tbl">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="number_of_periods">number of periods:</label>
                        </th>
                        <td>                                            
                            <input type="number" class="width_50" step="0.0001" name="finaforte_options[number_of_periods]" id="number_of_periods" value="<?php echo finaforte_esc_attr(finaforte_get_option('number_of_periods')); ?>"/><br/>
                            <span class="description">Enter number of periods</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="finaforte-label">Mortgage interest:</label>
                        </th>
                        <td>                                            
                            <input type="number" class="width_50" step="0.0001" name="finaforte_options[mortgage_interest]" id="mortgage_interest" value="<?php echo finaforte_esc_attr(finaforte_get_option('mortgage_interest')); ?>"/><br/>
                            <span class="description">Enter mortgage interest per year</span>
                        </td>
                    </tr>
                                           
                    <tr>                                        
                        <th></th>
                        <td colspan="2" valign="top" scope="row">
                            <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Hypotheekberekening 1 -->      
                        
            <!-- Settings box title -->
            <h3 class="hndle">
                <span>Hypotheekberekening 1</span>
            </h3> <hr>
            <div class="inside">
                <table class="form-table finaforte-label-tbl">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="max_hypo_1_per">Maximale hypotheek Per:</label>
                            </th>
                            <td>                                
                                <input type="number" step="1" name="finaforte_options[max_hypo_1_per]" id="max_hypo_1_per" value="<?php echo finaforte_esc_attr(finaforte_get_option('max_hypo_1_per')); ?>"/>%<br/>
                                <span class="description">Maximum Hypotheek percentage</span>
                            </td>
                        </tr>                                   
                        <tr>                                
                            <th scope="row">
                                <label for="calculation_1_rate">interest rate:</label>
                            </th>
                            <td>                                            
                                <input type="number" step="0.01" name="finaforte_options[calculation_1_rate]" id="calculation_1_rate" value="<?php echo finaforte_esc_attr(finaforte_get_option('calculation_1_rate')); ?>"/>%<br/>
                                <span class="description">Maximum mortgage calculation interest rate</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="calculation_1_y">Year:</label>
                            </th>
                            <td>                                
                                <input type="number" step="0.01" name="finaforte_options[calculation_1_y]" id="calculation_1_y" value="<?php echo finaforte_esc_attr(finaforte_get_option('calculation_1_y')); ?>"/><br/>
                                <span class="description">Maximum mortgage calculation year</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="belastingteruggave_1">Belastingteruggave:</label>
                            </th>
                            <td>                                
                                <input type="number" step="0.01" name="finaforte_options[belastingteruggave_1]" id="belastingteruggave_1" value="<?php echo finaforte_esc_attr(finaforte_get_option('belastingteruggave_1')); ?>"/>%<br/>
                                <span class="description">Enter per of belastingteruggave </span>
                            </td>
                        </tr>
                        <tr>                                        
                            <th></th>
                            <td colspan="2" valign="top" scope="row">
                                <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
                    
            <!-- Hypotheekberekening 2 -->
          
           <hr>
            <h3 class="hndle">
                <span>Hypotheekberekening 2</span>
            </h3><hr>
            <div class="inside">
                <table class="form-table finaforte-label-tbl">
                    <tbody> 
                        <tr>                                
                            <th scope="row">
                                <label for="min_hypo_2_per">Minimale hypotheek per:</label>
                            </th>
                            <td>                                            
                                <input type="number" step="1" name="finaforte_options[min_hypo_2_per]" id="min_hypo_2_per" value="<?php echo finaforte_esc_attr(finaforte_get_option('min_hypo_2_per')); ?>"/>%<br/>
                                <span class="description">Minimum mortgage percentage</span>
                            </td>
                        </tr>                               
                        <tr>                                
                            <th scope="row">
                                <label for="calculation_2_rate">Interest rate:</label>
                            </th>
                            <td>                                            
                                <input type="number" step="0.01" name="finaforte_options[calculation_2_rate]" id="calculation_2_rate" value="<?php echo finaforte_esc_attr(finaforte_get_option('calculation_2_rate')); ?>"/>%<br/>
                                <span class="description">Maximum mortgage calculation interest rate</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="calculation_2_rate">Year:</label>
                            </th>
                            <td>                                
                                <input type="number" step="0.01" name="finaforte_options[calculation_2_y]" id="calculation_2_y" value="<?php echo finaforte_esc_attr(finaforte_get_option('calculation_2_y')); ?>"/><br/>
                                <span class="description">Maximum mortgage calculation year</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="belastingteruggave_2">Belastingteruggave:</label>
                            </th>
                            <td>                                
                                <input type="number" step="0.01" name="finaforte_options[belastingteruggave_2]" id="belastingteruggave_2" value="<?php echo finaforte_esc_attr(finaforte_get_option('belastingteruggave_2')); ?>"/>%<br/>
                                <span class="description">Enter per of belastingteruggave </span>
                            </td>
                        </tr>
                        <tr>                                        
                            <th></th>
                            <td colspan="2" valign="top" scope="row">
                                <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
                    
            <!-- Hypotheekberekening 3 -->
           <hr>
            <!-- Settings box title -->
            <h3 class="hndle">
                <span>Hypotheekberekening 3</span>
            </h3>
            <div class="inside">
                <table class="form-table finaforte-label-tbl">
                    <tbody>                                 
                        <tr>                                
                            <th scope="row">
                                <label for="calculation_3_rate">Interest rate:</label>
                            </th>
                            <td>                                            
                                <input type="number" step="0.01" name="finaforte_options[calculation_3_rate]" id="calculation_3_rate" value="<?php echo finaforte_esc_attr(finaforte_get_option('calculation_3_rate')); ?>"/>%<br/>
                                <span class="description">Maximum mortgage calculation interest rate</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="calculation_3_y">Year:</label>
                            </th>
                            <td>                                
                                <input type="number" step="0.01" name="finaforte_options[calculation_3_y]" id="calculation_3_y" value="<?php echo finaforte_esc_attr(finaforte_get_option('calculation_3_y')); ?>"/><br/>
                                <span class="description">Maximum mortgage calculation year</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="belastingteruggave_3">Belastingteruggave:</label>
                            </th>
                            <td>                                
                                <input type="number" step="0.01" name="finaforte_options[belastingteruggave_3]" id="belastingteruggave_3" value="<?php echo finaforte_esc_attr(finaforte_get_option('belastingteruggave_3')); ?>"/>%<br/>
                                <span class="description">Enter per of belastingteruggave </span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="finaforte-label">Maximale hypotheek:</label>
                            </th>
                            <td>                                            
                                <input type="number" step="0.0001" name="finaforte_options[maximale_hypotheek_3]" id="maximale_hypotheek_3" value="<?php echo finaforte_esc_attr(finaforte_get_option('maximale_hypotheek_3')); ?>"/><br/>
                                <span class="description">Maximale hypotheek for calculation 3 based on 10 years</span>
                            </td>
                        </tr>
                        <tr>                                        
                            <th></th>
                            <td colspan="2" valign="top" scope="row">
                                <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
                   
            <!-- calculation 4 -->
            <hr>
            <!-- Settings box title -->
            <h3 class="hndle">
                <span>Hypotheekberekening 4</span>
            </h3>
            <div class="inside">
                <table class="form-table finaforte-label-tbl">
                    <tbody>
                        <tr>                                
                            <th scope="row">
                                <label for="calculation_4_rate">Interest rate:</label>
                            </th>
                            <td>                                            
                                <input type="number" step="0.01" name="finaforte_options[calculation_4_rate]" id="calculation_4_rate" value="<?php echo finaforte_esc_attr(finaforte_get_option('calculation_4_rate')); ?>"/>%<br/>
                                <span class="description">Maximum mortgage calculation interest rate</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="calculation_4_y">Year:</label>
                            </th>
                            <td>                                
                                <input type="number" step="0.01" name="finaforte_options[calculation_4_y]" id="calculation_4_y" value="<?php echo finaforte_esc_attr(finaforte_get_option('calculation_4_y')); ?>"/><br/>
                                <span class="description">Maximum mortgage calculation year</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="belastingteruggave_4">Belastingteruggave:</label>
                            </th>
                            <td>                                
                                <input type="number" step="0.01" name="finaforte_options[belastingteruggave_4]" id="belastingteruggave_4" value="<?php echo finaforte_esc_attr(finaforte_get_option('belastingteruggave_4')); ?>"/>%<br/>
                                <span class="description">Enter per of belastingteruggave </span>
                            </td>
                        </tr>
                        <tr>                                        
                            <th></th>
                            <td colspan="2" valign="top" scope="row">
                                <input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'buttons-with-style'); ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
</div> <!-- end tab content -->



</form>
</div>
<script type="text/javascript">

    jQuery(document).ready(function($) {
        
        $('#tab-content2').hide();
        $('#tab-content3').hide();
        $('#tab-content4').hide();

        $( document ).on( 'click', '.tabs .tab-label', function() {
            var lable = $(this).attr('ID'); 
            if(lable == 'tab1'){
                $('#tab-content2').hide();
                $('#tab-content3').hide();
                $('#tab-content4').hide();
                $('#tab-content1').show();  }
            if(lable == 'tab2') {
                $('#tab-content1').hide();
                $('#tab-content3').hide();
                $('#tab-content4').hide(); 
                $('#tab-content2').show();  }
            if(lable == 'tab3'){ 
                $('#tab-content2').hide();
                $('#tab-content1').hide();
                $('#tab-content4').hide();
                $('#tab-content3').show();  }
            if(lable == 'tab4'){
                $('#tab-content2').hide();
                $('#tab-content1').hide();
                $('#tab-content3').hide();
                $('#tab-content4').show(); }
        });
    });
</script>
<?php