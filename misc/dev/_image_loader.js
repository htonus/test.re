	$(document).ready(function(){
		ImageLoader.init();
	});

var ImageLoader = {
	trigger:	null,
	button:		null,
	container:	null,
	list:		null,

	init: function(){
		this.button = $('#fileButton');
		this.trigger = $('#fileTrigger');
		this.container = $('#fileContainer');
		this.list = $('#fileList');

		this.trigger.click(function(){
			ImageLoader.button.click();
		});

		this.container.bind({
			dragenter: function(){
				ImageLoader.container.addClass('highlite')
				return false;
			},
			dragover: function(){
				return false;
			},
			dragleave: function(){
				ImageLoader.container.removeClass('highlite')
				return false;
			},
			drop: function(e){
				var dt = e.originalEvent.dataTransfer;
				ImageLoader.container.removeClass('highlite')
				ImageLoader.displayFiles(dt.files);
				return false;
			}
		});
	},

	displayFiles: function(files){
		var self = this;

		$.each(files, function(i, file) {
			if (!file.type.match(/image.*/))
				return true;

			var li = $('<li><div class="image"><img/></div><div class="progress">0%</div></li>')
				.attr('file', file)
				.appendTo(self.list);

			var reader = new FileReader();
			reader.onload = (function(image) {
				return function(e) {
					image.attr('src', e.target.result);

					image.load(function(e){
						var img = $(this);
							if (img[0].width > img[0].height) {
								img.width(120);
							} else {
								img.height(120);
							}
						img.parent().parent().show();
					});
				};
			})($('IMG', li));

			reader.readAsDataURL(file);
		});
	},

	upload: function(){

	},

	uploadFile: function(){

	}

}