(function($){
	var methods = {
		attach	: function() {
			var self = this;
			var options = [];
			
			this.hide();
			$.each($('OPTION', this), function(i, option){
				options.push({
					id		: $(option).val(),
					name	: $(option).text()
				});
			});
			
			var data = {
				value:	self.parent().val(),
				name:	self.attr('name'),
				type:	self.params.type,
				list:	options
			};
			
			this.render(data);
		},
		render	: function(data) {
			var self = this;
			var fs = self.parent();
			
			$(tmpl(self.params.tmpl, data)).appendTo(fs);

			var input = $('.input', fs);
			var container = $('DL', fs);
			var offset = input.offset();

			offset['top'] = offset['top'] + input.height();

			container.css({
				left:	offset.left,
				top:	offset.top,
				width:	select.width()
			});

			$('.select', fs).click(function(){
				self.show();
			});
			$('.select DD', fs).click(function(){
				self.click($(this));
			});

			$(window)
				.resize(function(){
					self.hide();
				})
				.click(function(e){
					if ($(e.target).parents('.select').size() == 0)
						self.close();
				});
		},
		show	: function() {
			var self = this;
			if (self.active)
				return self.hide(true);

			self.active = true;
			container.slideDown(200);
			return self;
		},
		hide	: function(slow) {
			var self = this;
			if (self.active) {
				if (slow == undefined)
					$('DL', self.parent()).hide();
				else
					$('DL', self.parent()).slideUp(100);

				self.active = false;
				return self;
			}
		},
		click	: function( content ) {
//		this.select(option);
//		this.validate(option);
		},
		select	: function( content ) {
//		var parent = option.parent().parent();
//
//		$('DD', parent).removeClass('checked');
//		$('.title', parent).text($('DIV', option).text());
//		$('INPUT', option.parent()).removeAttr('checked');
//		$('INPUT', option).attr('checked', 'checked');
//		option.addClass('checked')
		},
		validate: function( content ) {
//		var name = $('INPUT', option).attr('name');
//		if (edge = name.match(/\[(min|max)\]/)) {
//			var mini = $('[name="' + name.replace('[max]', '[min]') + '"]:checked');
//			var maxi = $('[name="' + name.replace('[min]', '[max]') + '"]:checked');
//
//			mini.parents('.select').removeClass('error');
//			maxi.parents('.select').removeClass('error');
//
//			if (
//				mini.val() != 0
//				&& maxi.val() != 0
//				&& mini.val() > maxi.val()
//			) {
//				this.select($('[value="' + maxi.val() + '"]', mini.parent().parent()).parent());
//				this.select($('[value="' + mini.val() + '"]', maxi.parent().parent()).parent());
//			}
//
//		}
		},
		multiclick: function(option) {
			var input = $('INPUT', option);

			if (input.attr('checked')) {
				input.removeAttr('checked');
				option.removeClass('checked')
			} else {
				input.attr('checked', 'checked');
				option.addClass('checked')
			}
		}
	};

	$.fn.select = function(method, params){
		var active		= false;
		var options		= [];
//		var fieldset	= null;

		var params = $.extend({
			tmpl:	'#tmplSelect',
			type:	'select'
		}, params);

		if (methods[method]) {
			return methods[method]
				.apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || ! method) {
			return methods.attach.apply(this, arguments);
		} else {
			$.error( 'Method ' +  method + ' absent in jQuery.selector');
		}    
	};
})(jQuery);

//$(document).ready(function(){
//	Selector.init();
//});
