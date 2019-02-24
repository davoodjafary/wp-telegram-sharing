	<?php 
	if ( ! defined( 'ABSPATH' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit;
	}
	?>
	<div id="wp-ts" class="wrap">
		<div class="wp-ts-container">
			<div class="wp-ts-column wp-ts-primary">
				<h2>WP Telegram Sharing</h2>
				<form id="wp-ts-settings" method="post" action="options.php">
					<?php settings_fields( 'wp_telegram_sharing' ); ?>
					<table class="form-table">
						<tr>
							<th>
								<label for="telegram_icon_position"><?php _e('Telegram Icon Position','wp-telegram-sharing');?></label>
							</th>
							<td>
								<select name="wp_telegram_sharing[telegram_icon_position]">
									<option value="after" <?php if($opts['telegram_icon_position'] == 'after') echo "selected='selected'"?>>After Content</option>
									<option value="before" <?php if($opts['telegram_icon_position'] == 'before') echo "selected='selected'"?>>Before Content</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">
								<label><?php _e('Automatically add telegram links?', 'wp-telegram-sharing'); ?></label>
							</th>
							<td>
								<ul>
								<?php foreach( $post_types as $post_type_id => $post_type ) { ?>
									<li>
										<label>
											<input type="checkbox" name="wp_telegram_sharing[auto_add_post_types][]" value="<?php echo esc_attr( $post_type_id ); ?>" <?php checked( in_array( $post_type_id, $opts['auto_add_post_types'] ), true ); ?>> <?php printf( __(' Auto display to %s', 'wp-telegram-sharing' ), $post_type->labels->name ); ?>
										</label>
									</li>
								<?php } ?>
								</ul>
								<small><?php _e('Automatically adds the telegram links to the end of the selected post types.', 'wp-telegram-sharing'); ?></small>
							</td>
						</tr>
					</table>
					<?php
						submit_button();
					?>
				</form>
			</div>
		</div>
	</div>
