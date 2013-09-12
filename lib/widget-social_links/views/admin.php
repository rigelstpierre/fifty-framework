<div class="social-links-wrapper">
    
    <div class="social_link_title option" style="margin-top:10px;">
        <label for="<?php echo $this->get_field_id( 'social_link_title' ); ?>"><?php _e( 'Title (Optional):', 'FFW' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'social_link_title' ); ?>" name="<?php echo $this->get_field_name( 'social_link_title' ); ?>" type="text" value="<?php echo $social_link_title; ?>"/>
    </div>

    <div class="social_link_facebook option" style="margin-top:10px;">
        <label for="<?php echo $this->get_field_id( 'social_link_facebook' ); ?>"><?php _e( 'Facebook URL:', 'FFW' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'social_link_facebook' ); ?>" name="<?php echo $this->get_field_name( 'social_link_facebook' ); ?>" type="text" value="<?php echo $social_link_facebook; ?>"/>
    </div>

    <div class="social_link_googleplus option" style="margin-top:10px;">
        <label for="<?php echo $this->get_field_id( 'social_link_googleplus' ); ?>"><?php _e( 'Google Plus URL:', 'FFW' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'social_link_googleplus' ); ?>" name="<?php echo $this->get_field_name( 'social_link_googleplus' ); ?>" type="text" value="<?php echo $social_link_googleplus; ?>"/>
    </div>

    <div class="social_link_twitter option" style="margin-top:10px;">
        <label for="<?php echo $this->get_field_id( 'social_link_twitter' ); ?>"><?php _e( 'Twitter URL:', 'FFW' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'social_link_twitter' ); ?>" name="<?php echo $this->get_field_name( 'social_link_twitter' ); ?>" type="text" value="<?php echo $social_link_twitter; ?>"/>
    </div>
    
</div><!-- /.standard-personal-image-wrapper -->