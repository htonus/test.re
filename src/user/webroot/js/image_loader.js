var ImageLoader = {
	trigger:	'#fileTrigger',
	button:		'#fileButton',
	container:	'#fileContainer',
	form:		'#fileupload',
	
	previewWidth:	180,
	previewHeight:	120,
	
	fileList:	[],

	init: function(){
		$(ImageLoader.trigger).click(function(){
			$(ImageLoader.button).click();
		});

		$(ImageLoader.container).bind({
			dragenter: function(){
				$(ImageLoader.container).addClass('highlite')
				return false;
			},
			dragover: function(){
				return false;
			},
			dragleave: function(){
				$(ImageLoader.container).removeClass('highlite')
				return false;
			},
			drop: function(e){
				var dt = e.originalEvent.dataTransfer;
				$(ImageLoader.container).removeClass('highlite')
				$.each(dt.files, function(i, file){
					ImageLoader.addFile(file);
				});
				return false;
			}
		});
		
		$(ImageLoader.form).fileupload({
			url:	'/property/image',
			
			progress: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('.uploadFile .bar').css(
					'width',
					progress + '%'
				);
			},
			add: function (e, data) {
				$.each(data.files, function(i, file){
					if (file.type.match(/^image.*/)) {
						ImageLoader.addFile(file);
					}
				});
			}
		});

	},

	addFile: function(file){
		file.id = ImageLoader.fileList.length;
		ImageLoader.fileList[file.id] = file;
		
		window.loadImage(
			file,
			function (img) {
				var div = $(tmpl('tmplUpload', {'file': file})).appendTo(ImageLoader.container)
				$('.preview', div)
					.css({
						'padding': ''
							+ parseInt((ImageLoader.previewHeight - img.height) / 2) + ' '
							+ parseInt((ImageLoader.previewWidth - img.width) / 2)
					})
					.html(img);
				$('.drop', div).click(function(){
					ImageLoader.fileList = $.grep(ImageLoader.fileList, function(_file){
						return _file.id != file.id;
					});
					div.remove();
					ImageLoader.updateContainer();
				});
				$('IMG', div).click(function(){
					$('DD.file :checkbox').removeAttr('checked');
					$('DD.file').removeClass('main');
					
					$(':checkbox', div).attr('checked', 'checked');
					div.addClass('main');
				});
				
				if ($('DD.file :checked').size() == 0)
					$('IMG', div).click();
				
				ImageLoader.updateContainer();
			},
			{
				maxWidth:	ImageLoader.previewWidth,
				maxHeight:	ImageLoader.previewHeight
			}
		);
	},

	updateContainer: function(){
		if ($(ImageLoader.fileList).size() > 3) {
			$('#fileContainer').height(420);
			
			if ($(ImageLoader.fileList).size() > 6) {
				$('#fileContainer').css('overflow-y', 'scroll');
			} else {
				$('#fileContainer').css('overflow', 'hidden');
			}
		} else {
			$('#fileContainer').animate({height: 220});
		}
	},
	
	uploadFiles: function(data, callback){
		$(ImageLoader.form).fileupload('send', {
			files		: ImageLoader.fileList,
			formData	: data,
			success		: callback
		})
	}
//	
//	uploadFile: function(){
//		
//	}
}


$(document).ready(function(){
	ImageLoader.init();
});
