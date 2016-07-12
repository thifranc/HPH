function infoCb(data) {
	console.log('infoCb', data);
	if (data) {
		$('#player').text(data.player);
		$('#lives').text(data.lives);
		$('#shield').text(data.shield);
	}
}

function getInfo() {
	var data = {
		phase: "info"
	};
	$.ajax({
		type: "POST",
		url: "api.php",
		data: data,
		success: infoCb,
		dataType: 'json'
	});
}

function getData(callback){
	var data = {
		phase: "data"
	};
	$.ajax({
		type: "POST",
		url: "api.php",
		data: data,
		success: callback,
		dataType: 'json'
	});
}
