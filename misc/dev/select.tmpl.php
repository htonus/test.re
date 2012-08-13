<script type="text/x-tmpl" id="tmplSelect">
<div class="select" id="name">
{% if ( o.type.match(/select/) ) { %}
	<div class="title"></div>
{% } else if (o.type.match(/combo/)) { %}
	<div class="input"><input type="text" name="edit_{%=o.name%}" value="{%=o.value%}" id="edit_{%=o.name%}"/></div>
{% } else { %}
	<!-- multi select -->
{% } %}
	<dl>
{% for ( i in o.list ) { %}
		<dd rel="{%=o.list[i].name%}">{%=o.list[i].name%}</dd>
{% } %}
	</dl>
</div>
</script>
