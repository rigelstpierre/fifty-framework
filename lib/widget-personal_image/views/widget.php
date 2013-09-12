<?php if( '' != $image_src ) { ?>	
	<?php echo $args['before_widget']; ?>
		<div class="standard-pi-pic">
		
			<?php if( 0 < strlen( trim( $image_url ) ) ) { ?>
				<a href="<?php echo $image_url; ?>">
			<?php } // end if ?>
		
			
			<img src="<?php echo $image_src; ?>" alt="" />
	
			
			<?php if( 0 < strlen( trim( $image_url ) ) ) { ?>
				</a>
			<?php } // end if ?>
		</div><!-- /.standard-pi-pic -->

		<?php if( '' != trim( $top_text ) ) : ?>		
			<span class="standard-pi-top-text">
				<?php echo $top_text; ?>
			</span>
		<?php endif; ?>

		<?php if( '' != trim( $author_name ) ) : ?>		
			<h3 class="standard-pi-author-name">
				<?php echo $author_name; ?>
			</h3>
			<div class="standard-pi-separator"></div>
		<?php endif; ?>

		<?php if( '' != trim( $image_description ) ) : ?>
			<p class="standard-pi-bio"><?php echo $image_description; ?></p>
		<?php endif; ?>
		
	<?php echo $args['after_widget']; ?>
<?php } // end if ?>