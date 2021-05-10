<!-- admin/partial/ sendex-admin-sms.php. -->
 
<h2><?php esc_attr_e( 'Send message easily', 'WpAdminStyle' ); ?></h2>
 
<div class="wrap">
        <div id="icon-options-general" class="icon32"></div>
        <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                        <!-- main content -->
                        <div id="post-body-content">
                                <div class="meta-box-sortables ui-sortable">
                                        <div class="postbox">
                                                <h2 class="hndle"><span> <?php esc_attr_e( 'SEND SMS', 'WpAdminStyle' ); ?></span>
                                                </h2>
                                                <div class="inside">
                           <form method="post" name="cleanup_options" action="" >
                                                          <input type="text" name="sender" class="regular-text" placeholder="7813949782" required/><br><br>
                                                          <input type="text" name="numbers" class="regular-text" placeholder="6176579796, 617898070" required/><br><br>
                                                          <textarea name="message" cols="60" rows="10" placeholder="Message"></textarea><br><br>
                                                          <input class="button-primary" type="submit" value="SEND MESSAGE" name="send_sms_message"/>
                                                        </form>
                                                </div>
                                                <!-- .inside -->
                                        </div>
                                        <!-- .postbox -->
                                </div>
                                <!-- .meta-box-sortables .ui-sortable -->
                        </div>
                        <!-- post-body-content -->
                </div>
                <!-- #post-body .metabox-holder .columns-2 -->
                <br class="clear">
        </div>
        <!-- #poststuff -->
</div> <!-- .wrap -->