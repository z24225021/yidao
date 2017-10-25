















































function chMap(i){
	document.getElementById('map_fast').style.display = "block";
	AMapUI.loadUI(['misc/PositionPicker'], function(PositionPicker) {
		var map = new AMap.Map('container', {
			zoom: 11,
		})
		var positionPicker = new PositionPicker({
			mode: 'dragMap',
			map: map
		});
		positionPicker.on('success', function(positionResult) {
			if(i==0){
				document.getElementById('startXYfast').value = positionResult.position;
				document.getElementById('start_addr_fast').value = positionResult.address;
			}else if(i==1){
				document.getElementById('endXYfast').value = positionResult.position;
				document.getElementById('end_addr_fast').value = positionResult.address;
			}else if(i==2){
				document.getElementById('startXYpin').value = positionResult.position;
				document.getElementById('start_addr_pin').value = positionResult.address;
			}else if(i==3){
				document.getElementById('endXYpin').value = positionResult.position;
				document.getElementById('end_addr_pin').value = positionResult.address;
			}else if(i==4){
				document.getElementById('startXYzhuan').value = positionResult.position;
				document.getElementById('start_addr_zhuan').value = positionResult.address;
			}else if(i==5){
				document.getElementById('endXYzhuan').value = positionResult.position;
				document.getElementById('end_addr_zhuan').value = positionResult.address;
			}
		});
		positionPicker.on('fail', function(positionResult) {
			document.getElementById('startXY').value = ' ';
			document.getElementById('start_addr').value = ' ';
			document.getElementById('endXY').value = ' ';
			document.getElementById('end_addr').value = ' ';
		});
		positionPicker.start();
		map.panBy(0, 1);
		map.addControl(new AMap.ToolBar({
			liteStyle: true
		}))
	});
}

