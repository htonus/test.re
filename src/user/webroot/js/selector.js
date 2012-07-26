var Selector = {
	active: null,

	init: function() {
		$('SELECT.decorate').each(function(){
			Selector.attach(this);
		});

//		$('.select INPUT').click(function(){
//			Selector.open($(this).attr('name'));
//		});
//
//		$('.selector LI').click(function(){
//			var option = $(this).attr('id').split('#');
//			$('INPUT[name="' + option[0] + '"]').val(option[1]);
//			Selector.close();
//		});
//
//		$(window).resize(function(){
//
//		});
	},

	attach: function(select){
		$(select).hide();
		var name = $(select).attr('name');

		$(select).insertAfter('\
			<div class="select" id="' + name + '">\
				<div class="title"></div>\
				<ul></ul>\
			</div>\
		');
		var ul = $('DIV[id=["' + name + '"] UL');

		$('OPTION', select).each(function(index, option){
			ul.append('<li class="option" rel="' + index + '"><div>' + $(option).text() + '</div></li>');
		});

//		if ($(select).attr('multiple') != undefined) {
//			size = 5;
//			if ($(select).attr('size') != undefined)
//				size = $(select).attr('size');
//		}
	},

	open: function(id) {
		var toClose = this.active;
		var parent = $('[id="' + id + '"]').parent();

		this.close(true);

		if (toClose != id) {
			var select = $('UL', parent);
			var offset = parent.offset();

			offset['top'] = offset['top'] + parent.height();

			select
				.css({left: offset.left, top: offset.top, width: parent.width()})
				.slideDown(100);

			this.active = id;
		}
	},

	close: function(slow) {
		if (slow == undefined)
			$('[id="' + this.active + '"]').hide();
		else
			$('[id="' + this.active + '"]').slideUp(100);

		this.active = null;
	}
}

// SELECTOR view
//				<div class="select">
//					<div id="type[1]" class="title"></div>
//					<ul id="type[1]" style="position: absolute">
//						<li class="option" rel="1"><div>Type 1</div></li>
//						<li class="option" rel="2"><div>Type 2</div></li>
//						<li class="option" rel="3"><div>Type 2</div></li>
//						<li class="option" rel="4"><div>Type 2</div></li>
//						<li class="option" rel="5"><div>Type 2</div></li>
//					</ul>
//				</div>


// AND CSS
//.select .title {
//	background: url("/i/arr_down.png") no-repeat;
//	background-position: 95% 50%;
//	cursor: pointer;
//}
//
//OPTION, .option {
//	padding: 5px;
//	cursor: pointer;
//}
//
//OPTION, .option DIV {
//	font: normal 13px sans-serif;
//	color: #666;
//}
//.option DIV {
//	width: 100%;
//	display: block;
//}
//
//.select UL {
//	display: none;
//	background-color: #FFF;
//	border: 1px #FFCD6C solid;
//}
//.option:hover {
//	color: #FFF !important;
//	background-color: #FFE6B6;
//}