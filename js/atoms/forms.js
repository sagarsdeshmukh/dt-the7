
/* #Comment form
================================================== */
// jQuery(document).ready(function($) {
	var $commentForm = $('#commentform');

	$commentForm.on('click', 'a.clear-form', function (e) {
		e.preventDefault();
		$commentForm.find('input[type="text"], textarea').val('');
		if($(".contact-form-material").length > 0){
			$commentForm.find('input[type="text"], textarea').parent().removeClass("is-focused");
		};
		return false;
	});

	$commentForm.on('click', ' a.dt-btn.dt-btn-m', function(e) {
		e.preventDefault();
		$commentForm.find('#submit').trigger('click');
		return false;
	});

	if ($.browser.msie) {
		$('input[type="text"][placeholder], textarea[placeholder]').each(function () {
			var obj = $(this);

			if (obj.attr('placeholder') != '') {
				obj.addClass('IePlaceHolder');

				if ($.trim(obj.val()) == '' && obj.attr('type') != 'password') {
					obj.val(obj.attr('placeholder'));
				}
			}
		});

		$('.IePlaceHolder').focus(function () {
			var obj = $(this);
			if (obj.val() == obj.attr('placeholder')) {
				obj.val('');
			}
		});

		$('.IePlaceHolder').blur(function () {
			var obj = $(this);
			if ($.trim(obj.val()) == '') {
				obj.val(obj.attr('placeholder'));
			}
		});
	}

	if($(".contact-form-material").length > 0){
		/*!- Material design form*/

		$(".form-fields input, textarea, .comment-form-author input, .comment-form-email input").each(function(c){
			var $this = $(this),
				$parent = $this.parent("span, p"),
				$bigParent = $this.parents(".dt-form");
			
			$bigParent.find( '.clear-form' ).on( 'click' ,function( ) {
				$parent.removeClass("is-focused").removeClass("active");
			} );
			$this.focus(function() {
				$parent.addClass("is-focused").addClass("active");
				$this.attr('placeholder','');
			});
			
			$this.change(function() {
				if(0 !== $this.val().length){
					$parent.addClass("is-focused").removeClass("active");
					$this.attr('placeholder','');
				}
			});

			$this.blur(function() {
				$parent.removeClass("active");
				if('' === $this.val()){
					$parent.removeClass("is-focused").removeClass("active");
				}
			});
		});
	}
// });