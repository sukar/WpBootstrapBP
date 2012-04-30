jQuery(document).ready(function($) {
	
	// Color Picker
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');//console.log(initialColor);
		$(this).ColorPicker({
			color: initialColor,
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$(Othis).children('div').css('backgroundColor', '#' + hex);
				$(Othis).next('input').attr('value', hex);
			},
			onSubmit: function(hsb, hex, rgb, el) {
				//console.log('onSubmit');console.log(el);
				//$(el).val(hex);
				//$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				//console.log('onBeforeShow');console.log($(this));
				//initialColor = $(this).next('input').attr('value');
				//$(this).ColorPickerSetColor(initialColor);
			}
		});
	}); //end color picker

});	