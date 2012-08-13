<html>
<head>
<style>
.bar {
    height: 18px;
    background: green;
}
</style>
</head>

<body>
<?php
	if (!empty($_FILES)) {
		var_dump($_FILES);
//		exit;
	}
?>

<script src="/js/jquery/jquery-1.7.2.min.js"></script>
<script src="/js/jquery/ui-widget.min.js"></script>
<script src="/js/jquery/fileupload.min.js"></script>
<script src="/js/jquery/canvas-to-blob.min.js"></script>
<script src="/js/jquery/load-image.min.js"></script>
<!--script src="/js/jquery/fileupload-fp.min.js"></script-->
<script src="/js/tmpl.js"></script>

<br>
<br>
<br>
<img id="aaa"/><br>

<form id="fileupload" method="post" enctype="multipart/form-data">
	
<input type="file" multiple id="fff"/></br>
<input type="button" onclick="$('#fileupload').fileupload('send', {files: fileList});"/>

<div id="uploadList"></div>

</form>

<script>
var fileList = [];

$(document).ready(function(){
	$('#fileupload').fileupload({
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
					file.id = fileList.length;
					fileList[file.id] = file;
					
					window.loadImage(
						file,
						function (img) {
							var div = $(tmpl('tmplUpload', {'file': file})).appendTo('#uploadList');
							img.hspace = 50 - img.width / 2;
							img.vspace = 50 - img.height / 2;
							$('.preview', div).html(img);
						},
						{
							maxWidth: 100,
							maxHeight: 100
						}
					);
				}
			});
		},
		
        done: function (e, data) {
            alert('done');
        }
	});
});
</script>
<script type="text/x-tmpl" id="tmplUpload">
<div class="uploadFile_{%='' + o.file.id%}" style="float: left; width: 120px; display: block;">
	<div class="preview"></div>
	<div class="bar" style="width: 0%;"></div>
	<div>{%=o.file.name%} ({%=o.file.size%})</div>
</div>
</script>


</body></html>