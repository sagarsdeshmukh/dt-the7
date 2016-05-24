(function() {

	tinymce.PluginManager.add( 'vogue_shortcodes', function( editor, url ) {

		editor.addButton( 'vogue_chortcodes_megabutton', {

			type: 'menubutton',

			text: 'Shortcodes',
			tooltip: 'Theme shortcodes',

			icon: false,

			menu:
			[
				// Gap
				{
					text: 'Gap',
					onclick: function() {
						editor.insertContent( '[dt_gap height="10" /]' );
					}
				},

				// Divider
				{
					text: 'Divider',
					menu:
					[
						{
							text: 'thin',
							onclick: function() {
								editor.insertContent( '[dt_divider style="thin" /]' );
							}
						},

						{
							text: 'thick',
							onclick: function() {
								editor.insertContent( '[dt_divider style="thick" /]' );
							}
						}
					]
				},

				// List
				{
					text: 'List',
					menu:
					[
						{
							text: 'list',
							onclick: function() {

								var attr = ['style="1"', 'bullet_position="middle"', 'dividers="true"'],

									content = [
										'[dt_list_item image=""]CONTENT[/dt_list_item]',
										'[dt_list_item image=""]CONTENT[/dt_list_item]',
										'[dt_list_item image=""]CONTENT[/dt_list_item]'
									];

								editor.insertContent( '[dt_list ' + attr.join(' ') + ']' + content.join('') + '[/dt_list]' );
							}
						},

						{
							text: 'item',
							onclick: function() {
								editor.insertContent( '[dt_list_item image=""]CONTENT[/dt_list_item]' );
							}
						}
					]
				},

				// Button
				{
					text: 'Button',
					menu:
					[

						{
							text : 'Full button syntax',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="default"',
										'bg_color_style="custom"',
										'bg_color="#333333"',
										'bg_hover_color_style="custom"',
										'bg_hover_color="#444444"',
										'text_color_style="custom"',
										'text_color="#ffffff"',
										'text_hover_color_style="custom"',
										'text_hover_color="#dddddd"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"'
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']BUTTON_NAME[/dt_button]' );
							}
						},

						{
							text : 'Default style',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="default"',
										'bg_color_style="default"',
										'bg_hover_color_style="default"',
										'text_color_style="default"',
										'text_hover_color_style="default"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']BUTTON_NAME[/dt_button]' );
							}
						},

						{
							text : 'Outline with background',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="outline_with_bg"',
										'bg_color_style="custom"',
										'bg_color="#333333"',
										'bg_hover_color_style="custom"',
										'bg_hover_color="#333333"',
										'text_color_style="custom"',
										'text_color="#333333"',
										'text_hover_color_style="custom"',
										'text_hover_color="#ffffff"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']BUTTON_NAME[/dt_button]' );
							}
						},

						{
							text : 'Outline',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="outline"',
										'bg_color_style="custom"',
										'bg_color="rgba(51,51,51,0.25)"',
										'bg_hover_color_style="custom"',
										'bg_hover_color="#333333"',
										'text_color_style="custom"',
										'text_color="rgba(51,51,51,0.3)"',
										'text_hover_color_style="custom"',
										'text_hover_color="#333333"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']BUTTON_NAME[/dt_button]' );
							}
						},

						{
							text : 'Light with background',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="light_with_bg"',
										'bg_hover_color_style="accent"',
										'text_color_style="context"',
										'text_hover_color_style="custom"',
										'text_hover_color="#ffffff"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']BUTTON_NAME[/dt_button]' );
							}
						},

						{
							text : 'Light',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="light"',
										'text_color_style="context"',
										'text_hover_color_style="accent"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']BUTTON_NAME[/dt_button]' );
							}
						},

						{
							text : 'Link',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="link"',
										'text_color_style="context"',
										'text_hover_color_style="accent"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']BUTTON_NAME[/dt_button]' );
							}
						}
					]
				},

				// Tooltip
				{
					text: 'Tooltip',
					onclick: function() {
						editor.insertContent( '[dt_tooltip title="TITLE"]' + editor.selection.getContent() + '[/dt_tooltip]' );
					}
				},

				// Highlight
				{
					text: 'Highlight',
					onclick: function() {
						editor.insertContent( '[dt_highlight color="" text_color="" bg_color=""]' + editor.selection.getContent() + '[/dt_highlight]' );
					}
				},

				// Code
				{
					text: 'Code',
					onclick: function() {
						editor.insertContent( '[dt_code]' + editor.selection.getContent() + '[/dt_code]' );
					}
				},

				// Social icons
				{
					text: 'Social icons',
					onclick: function() {
						var items = [
								'[dt_social_icon target_blank="true" icon="facebook" link="" /]',
								'[dt_social_icon target_blank="true" icon="twitter" link="" /]',
								'[dt_social_icon target_blank="true" icon="google" link="" /]'
							];

						editor.insertContent( '[dt_social_icons animation="none" alignment="default"]' + items.join('') + '[/dt_social_icons]' );
					}
				},

				// Fancy media
				{
					text: 'Fancy media',
					onclick: function() {

						var attr = [
								'type=""',
								'style="1"',
								'lightbox="0"',
								'align=""',
								'padding="0"',
								'margin_top="0"',
								'margin_bottom="0"',
								'margin_right="0"',
								'margin_left="0"',
								'width=""',
								'animation="none"',
								'media=""',
								'image_alt=""',
								'hd_image=""',
								'image=""'
							];

						editor.insertContent( '[dt_fancy_image ' + attr.join(' ') + ']' + editor.selection.getContent() + '[/dt_fancy_image]' );
					}
				},

				// Quote
				{
					text: 'Quote',
					menu:
					[
						{
							text : 'pullquote',
							onclick : function() {

								var attr = [
										'type="pullquote"',
										'layout="left"',
										'font_size="big"',
										'animation="none"',
										'size="1"',
									];

								editor.insertContent( '[dt_quote ' + attr.join(' ') + ']CONTENT[/dt_quote]' );
							}
						},

						{
							text : 'blockquote',
							onclick : function() {

								var attr = [
										'type="blockquote"',
										'font_size="big"',
										'animation="none"',
										'background="plain"'
									];

								editor.insertContent( '[dt_quote ' + attr.join(' ') + ']CONTENT[/dt_quote]' );
							}
						}
					]
				},

				// Progress bars
				{
					text: 'Progress bars',
					menu:
					[
						{
							text : 'progress bars',
							onclick : function() {

								var attr = [
										'title="TITLE"',
										'color=""',
										'percentage=""'
									],
									attr_str = attr.join(' '),
									bars = [
										'[dt_progress_bar ' + attr_str + ' /]',
										'[dt_progress_bar ' + attr_str + ' /]',
										'[dt_progress_bar ' + attr_str + ' /]'
									];

								editor.insertContent( '[dt_progress_bars show_percentage="true"]' + bars.join('') + '[/dt_progress_bars]' );
							}
						},

						{
							text : 'progress bar',
							onclick : function() {

								var attr = [
										'title="TITLE"',
										'color=""',
										'percentage=""'
									];

								editor.insertContent( '[dt_progress_bar ' + attr.join(' ') + ' /]' );
							}
						}
					]
				},

				// Simple Login Form
				{
					text: 'Simple Login Form',
					onclick: function() {

						var attr = [
								'label_username=""',
								'label_password=""',
								'label_remember=""',
								'label_log_in=""',
							];

						editor.insertContent( '[dt_simple_login_form ' + attr.join(' ') + ']' );
					}
				},
			]

		} );

	});

})();