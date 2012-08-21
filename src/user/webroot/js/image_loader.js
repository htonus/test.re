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
//
//			done: function (e, data) {
//				alert('done');
//			},
//            send: function (e, data) {
//                var that = $(this).data('fileupload');
//                if (!data.isValidated) {
//                    if (!data.maxNumberOfFilesAdjusted) {
//                        that._adjustMaxNumberOfFiles(-data.files.length);
//                        data.maxNumberOfFilesAdjusted = true;
//                    }
//                    if (!that._validate(data.files)) {
//                        return false;
//                    }
//                }
//                if (data.context && data.dataType &&
//                        data.dataType.substr(0, 6) === 'iframe') {
//                    // Iframe Transport does not support progress events.
//                    // In lack of an indeterminate progress bar, we set
//                    // the progress to 100%, showing the full animated bar:
//                    data.context
//                        .find('.progress').addClass(
//                            !$.support.transition && 'progress-animated'
//                        )
//                        .attr('aria-valuenow', 100)
//                        .find('.bar').css(
//                            'width',
//                            '100%'
//                        );
//                }
//                return that._trigger('sent', e, data);
//            }
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
	
	uploadFiles: function(data){
		$(ImageLoader.form).fileupload('send', {
			files		: ImageLoader.fileList,
			formData	: data
		})
	}
//	
//	uploadFile: function(){
//		
//	}
}