<html>
<body>

<script src="/js/jquery/jquery-1.7.2.min.js"></script>
<script src="/js/jquery/ui-widget.min.js"></script>
<script src="/js/jquery/fileupload.min.js"></script>
<script src="/js/jquery/canvas-to-blob.min.js"></script>
<script src="/js/jquery/load-image.min.js"></script>
<!--script src="/js/jquery/fileupload-fp.min.js"></script-->
<script src="/js/tmpl.min.js"></script>

<br>
<br>
<br>
<img id="aaa"/><br>
<input type="file" multiple id="fff"/></br>
<div id="uploadList"></div>

<script>
$(document).ready(function(){

	$('#fff').change(function (e) {
		$.each(e.target.files, function(index, file){
			if (file.type.match(/^image.*/)) {
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
	});
	
});
</script>

<script type="text/x-tmpl" id="tmplUpload">
<div class="uploadFile" style="float: left; width: 120px; display: block;">
	<div class="preview"></div>
	<div>{%=o.file.name%} ({%=o.file.size%})</div>
	<div><input type="submit"/></div>
</div>
</script>

</body></html>