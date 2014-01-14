<div class="standard-author-info-wrapper">

    <div class="option">
    
    	<label for="<?php echo $this->get_field_id( 'image_src' ); ?>"><?php _e( 'Author Image:', 'standard' ); ?></label>

		<div class="author_info_preview_image_container" style="width:100%;">
	    	<img src="<?php echo $image_src; ?>" alt="" class="preview_image"  style="width:100%;height:auto;"/>
	    </div><!-- /.preview_image_container -->
    	
    	<span class="description"><?php _e( 'Maximum width is 300 pixels.', 'standard' ); ?></span>
    	<a href="javascript:;" class="img_delete <?php echo '' == $image_src ? 'hidden' : '' ?>"><?php _e( 'Delete Image', 'standard' ); ?></a>
    	
		<!-- Hidden fields used to track the default headshot, uploaded images, and links -->
		<input type="hidden" id="author-info-default-url" value="<?php echo get_template_directory_uri() . '/lib/author-info/css/fake-personal.jpg' ?>" />
		<input type="hidden" id="<?php echo $this->get_field_id( 'image_src' ); ?>" name="<?php echo $this->get_field_name( 'image_src' ); ?>" value="<?php echo $image_src; ?>" class="img_src" />
		<input type="hidden" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" value="<?php echo $image_url; ?>" class="img_url" />

		<!-- /Hidden -->
    	
    </div><!-- /.option -->
    
    <div class="top_text option" style="margin-top:10px;">
        <label for="<?php echo $this->get_field_id( 'top_text' ); ?>"><?php _e( 'Top Text:', 'standard' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'top_text' ); ?>" name="<?php echo $this->get_field_name( 'top_text' ); ?>" type="text" value="<?php echo $top_text; ?>"/>
    </div>

    <div class="author_name option" style="margin-top:10px;">
        <label for="<?php echo $this->get_field_id( 'author_name' ); ?>"><?php _e( 'Author Name:', 'standard' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'author_name' ); ?>" name="<?php echo $this->get_field_name( 'author_name' ); ?>" type="text" value="<?php echo $author_name; ?>"/>
    </div>

    <div class="bio option" style="margin-top:10px;">
    	<label for="<?php echo $this->get_field_id( 'image_description' ); ?>"><?php _e( 'Bio (Optional):', 'standard' ); ?></label>
    	<textarea id="<?php echo $this->get_field_id( 'image_description' ); ?>" name="<?php echo $this->get_field_name( 'image_description' ); ?>" maxlength="400" rows="3" cols="30"><?php echo $image_description; ?></textarea>
    	<p class="description"><span><?php _e( '400', 'standad' ); ?></span><?php _e( ' characters remaining', 'standard' ); ?></p>
    </div><!-- /.option -->
    
</div><!-- /.standard-author-info-wrapper -->