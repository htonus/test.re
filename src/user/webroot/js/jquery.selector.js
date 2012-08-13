(function($){
	$.fn.selector = function(method, params){
		var self		= this;
		var active		= false;
		var options		= [];
//		var fieldset	= null;

		var params = $.extend({
			tmpl:	'#selector'
		}, params);

		var methods = {
			attach	: function() {
				this.hide();
				$.each($('OPTION', self), function(i, option){
					self.options.push({
						id		: option.val(),
						name	: option.text()
					});
				});
				self.render();
			},
			render	: function() {
//				var value = self.val();
//				var div = $('<div class="select">').appendTo(self);
//				$('<input type="text" name="title4'+self.attr('name')+'" value="' + value + '" readonly/>').appendTo(div);
//				var dl = $()
				var fs = self.parent();
				
				var data = {
					value:	self.val(),
					name:	self.attr('name'),
					list:	self.options
				};
				
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
			show	: function( ) {
				if (self.active)
					return self.hide(true);

				self.active = true;
				container.slideDown(200);
				return self;
			},
			hide	: function(slow) {
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
};
})(jQuery);

var Selector = {
	active: null,
	
	init: function(){
		$('.select').click(function(){
			Selector.open($(this));
		});

		$('.select DD').click(function(){
			Selector.click($(this));
		});

		$('.multiselect DD').click(function(){
			Selector.multiclick($(this));
		});
		
		$(window)
			.resize(function(){
				Selector.close();
			})
			.click(function(e){
				if ($(e.target).parents('.select').size() == 0)
					Selector.close();
			});
	},

	open: function(select) {
		var toClose = this.active;
		var id = $(select).parents('FIELDSET').attr('id');

		this.close(true);

		if (toClose != id) {
			var container = $('DL', select);
			var offset = select.offset();

			offset['top'] = offset['top'] + select.height();

			container
				.css({left: offset.left, top: offset.top, width: select.width()})
				.slideDown(200);

			this.active = id;
		}
	},

	close: function(slow) {
		if (this.active != null) {
			if (slow == undefined)
				$('[id="' + this.active + '"] DL').hide();
			else
				$('[id="' + this.active + '"] DL').slideUp(100);

			this.active = null;
		}
	},

	click: function(option) {
		this.select(option);
		this.validate(option);
	},
	
	select: function(option) {
		var parent = option.parent().parent();
		
		$('DD', parent).removeClass('checked');
		$('.title', parent).text($('DIV', option).text());
		$('INPUT', option.parent()).removeAttr('checked');
		$('INPUT', option).attr('checked', 'checked');
		option.addClass('checked')
	},
	
	validate: function(option) {
		var name = $('INPUT', option).attr('name');
		if (edge = name.match(/\[(min|max)\]/)) {
			var mini = $('[name="' + name.replace('[max]', '[min]') + '"]:checked');
			var maxi = $('[name="' + name.replace('[min]', '[max]') + '"]:checked');

			mini.parents('.select').removeClass('error');
			maxi.parents('.select').removeClass('error');
			
			if (
				mini.val() != 0
				&& maxi.val() != 0
				&& mini.val() > maxi.val()
			) {
				this.select($('[value="' + maxi.val() + '"]', mini.parent().parent()).parent());
				this.select($('[value="' + mini.val() + '"]', maxi.parent().parent()).parent());
			}
			
		}
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
}

$(document).ready(function(){
	Selector.init();
});
