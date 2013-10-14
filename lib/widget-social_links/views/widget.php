<?php echo $args['before_widget']; ?>
	
	<?php if( '' != trim( $social_link_title ) ) : ?>		
		<h3 class="widget-title">
			<?php echo $social_link_title; ?>
		</h3>
	<?php endif; ?>

	<ul class="menu-social menu-social-footer">
		<?php if( '' != trim( $social_link_facebook ) ) : ?>		
			<li class="social-link">
				<a class="socialico socialico-facebook circle" href="<?php echo $social_link_facebook; ?>"></a>
			</li>
		<?php endif; ?>

		<?php if( '' != trim( $social_link_googleplus ) ) : ?>		
			<li class="social-link">
				<a class="socialico socialico-googleplus circle" href="<?php echo $social_link_googleplus; ?>"></a>
			</li>
		<?php endif; ?>

		<?php if( '' != trim( $social_link_twitter ) ) : ?>		
			<li class="social-link">
				<a class="socialico socialico-twitter circle" href="<?php echo $social_link_twitter; ?>"></a>
			</li>
		<?php endif; ?>

		<?php if( '' != trim( $social_link_linkedin ) ) : ?>		
			<li class="social-link">
				<a class="socialico socialico-linkedin circle" href="<?php echo $social_link_linkedin; ?>"></a>
			</li>
		<?php endif; ?>

		<?php if( '' != trim( $social_link_dribbble ) ) : ?>		
			<li class="social-link">
				<a class="socialico socialico-dribbble circle" href="<?php echo $social_link_dribbble; ?>"></a>
			</li>
		<?php endif; ?>

		<?php if( '' != trim( $social_link_flickr ) ) : ?>		
			<li class="social-link">
				<a class="socialico socialico-flickr circle" href="<?php echo $social_link_flickr; ?>"></a>
			</li>
		<?php endif; ?>

		<?php if( '' != trim( $social_link_youtube ) ) : ?>		
			<li class="social-link">
				<a class="socialico socialico-youtube circle" href="<?php echo $social_link_youtube; ?>"></a>
			</li>
		<?php endif; ?>

		<?php if( '' != trim( $social_link_vimeo ) ) : ?>		
			<li class="social-link">
				<a class="socialico socialico-vimeo circle" href="<?php echo $social_link_vimeo; ?>"></a>
			</li>
		<?php endif; ?>

		
	</ul>
	
<?php echo $args['after_widget']; ?>
