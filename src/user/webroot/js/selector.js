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
		var title = $('.title', parent);
		
		if (title.get(0).tagName.match(/input/i))
			title.val($('DIV', option).text());
		else
			title.text($('DIV', option).text());
		$('DD', parent).removeClass('checked');
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
