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
		url: "game.php",
		data: data,
		success: infoCb,
		dataType: 'json'
	});
}

