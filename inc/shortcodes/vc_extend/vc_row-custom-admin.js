(function ($) {

	if ( typeof window.vc.EditElementUIPanel == 'undefined' ) {
		return;
	}

	var EditElementUIPanel__buildParamsContent = window.vc.EditElementUIPanel.prototype.buildParamsContent;

	window.vc.EditElementUIPanel.prototype.buildParamsContent = function(data) {
		EditElementUIPanel__buildParamsContent.call(this, data);

		if ( 'vc_row' != this.model.attributes.shortcode ) {
			return;
		}

		var self = this;

		var commonParams = [ 'el_class' ];

		var paramsFilter = function(index, element) {
			var $element = $(element);
			if ( $element.hasClass('dt_vc_row-params_switch') ) {
				return false;
			}

			if ( commonParams.indexOf($element.data('vcShortcodeParamName')) >= 0 ) {
				return false;
			}

			return true;
		}

		var getCustomParams = function() {
			return self.$('.vc_shortcode-param.dt_vc_row-param').filter(paramsFilter);
		}

		var getNativeParams = function() {
			return self.$('.vc_shortcode-param').not('.dt_vc_row-param').filter(paramsFilter);
		}

		var switchParams = function(val) {
			var $designOptionsTab = self.$tabsMenu.find('.vc_edit-form-tab-control[data-tab-index="1"], .vc_edit-form-tab-control[data-tab-index="2"], .vc_edit-form-tab-control[data-tab-index="3"]');

			if ( 'vc_default' === val ) {
				getCustomParams().hide();
				getNativeParams().show();

				$designOptionsTab.show();
			} else {
				getCustomParams().show();
				getNativeParams().hide();

				$designOptionsTab.hide();
			}
		}

		var onChangeEvent = 'change.dt_vc_ext.vc_row.type';
		var selector = '.dropdown.type';

		switchParams(this.$(selector).val());

		this.$el
			.off(onChangeEvent, selector)
			.on(onChangeEvent, selector, function() {
				switchParams($(this).val());
			});
	}

	if ( typeof vc.atts.parseFrame != 'undefined' ) {

		var atts__parseFrame = vc.atts.parseFrame;
		vc.atts.parseFrame = function(param) {
			var res = atts__parseFrame.call(this, param);

			/**
			 * Remove vc.atts.css_editor and any other callbacks.
			 *
			 * In vc.atts.css_editor.render there was added filter that removes deprecated fields (bg_image, margin_bottom i.e). The7 use this fields so filter must be removed.
			 */
			if ( 'vc_row' == this.model.attributes.shortcode ) {
				vc.edit_form_callbacks = [];
			}
			return res;
		}

	}
})(window.jQuery);