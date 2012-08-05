var Map = {
	active: null,
	mapping:
	'<map>\
		<city id="1" name="NICOSIA" layer="0"/>\
		<city id="2" name="LARNAKA" layer="1"/>\
		<city id="3" name="LIMASSOL" layer="2"/>\
		<city id="4" name="PAPHOS" layer="3"/>\
		<city id="5" name="AYANAPA" layer="4"/>\
	</map>',
	
	init: function(){
		$('.mapArea')
			.mouseover(function(){
				Map.over(Map.getLayer(this));
			})
			.mouseout(function(){
				Map.out(Map.getLayer(this));
			})
			.click(function(){
				Map.click(Map.getLayer(this));
			});
	},
	
	over: function(layer){
		$('#mapDiv').css('background-position-y', -220 * layer + 'px');
	},
	
	out: function(layer){
		$('#mapDiv').css('background-position-y', '220px');
	},
	
	click: function(layer){
		var id = null;
		
		if (this.active == layer) {
			this.active = null;
			$('#chooseDiv').css('background-position-y', '220px');
		} else {
			this.active = layer;
			$('#chooseDiv').css('background-position-y', -220 * layer + 'px');
			id = $('[layer=' + layer + ']', Map.mapping).attr('id');
		}
		
		$.getJSON(
			'/get/cities',
			{parent: id},
			function(data){
				$('#location DD').remove();
				$.each(data.list, function(index, city){
					$('#location DL').append(
						'<dd><input type="checkbox" name="city[]" value="'
						+ city['id'] + '"/><div>' + city['name'] + ' '
						+ (city['parent_id'] ? '' : 'area') + '</div></dd>'
					);
				});
			
				$('#location DD').click(function(){
					Selector.multiclick($(this));
				});
			}
		)
	},
	
	getLayer: function(dd){
		return parseInt($(dd).attr('id').match(/\d+/).toString());
	}
}
