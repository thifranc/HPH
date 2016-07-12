var $order = $('#submitOrder');
var $reset = $('#reset');
var $fire = $('#fire');
var $moveActions = $('#moveActions');

var orderCb = function(data) {
	if (data.messages) {
		alert(data.messages);
	}
}

var fireCb = function(data) {
	console.log("fireCb", data);
	if (data.messages) {
		alert(data.messages);
	} else if (data.message) {
		alert(data.message);
	}

	getData(function(data) {
		updateMap(data.map.space);
		eventAdd(data);
	});
}

var moveCb = function(data) {
	console.log('moveCb', data);
	if (data.message) {
		alert(data.message);
	}
	getData(function(data) {
		updateMap(data.map.space);
		eventAdd(data);
	});
}

$order.on('click', function (e) {
	e.preventDefault();
	// temp
	var maxPP = 20;

	var attack = $('#ppAttack').val();
	var speed = $('#ppSpeed').val();
	var repair = $('#ppRepair').val();
	var shield = $('#ppShield').val();
	var total = parseInt(attack, 10) + parseInt(speed, 10) + parseInt(repair, 10) + parseInt(shield, 10);

console.log("attack speed repair shield", attack, speed, repair, shield);

	if (total > maxPP) {
		alert('Vous n\'avez pas autant de pp');
	} else if (total < maxPP) {
		alert('Vous n\'avez pas attribue tout vos pp');
	} else {
		var data = {
			phase: "order",
			gun: attack,
			speed: speed,
			repair: repair,
			shield: shield
		};

		$.ajax({
			type: "POST",
			url: "api.php",
			data: data,
			success: orderCb,
			dataType: 'json'
		});
	}
});

$moveActions.on('click', 'button', function (e) {
	e.preventDefault();
//	console.log($(e.currentTarget).attr('id'));
	var data = {
		phase: "move",
		move: $(e.currentTarget).attr('id')
	};
	$.ajax({
		type: "POST",
		url: "api.php",
		data: data,
		success: moveCb,
		dataType: 'json'
	});
});

$reset.on('click', function(e) {
	cleanMap();
	e.preventDefault();
	var data = {
		phase: "clean"
	};
	$.ajax({
		type: "POST",
		url: "api.php",
		data: data,
		success: function (data) {
			console.log(data);
		},
		dataType: 'json'
	});
});

$fire.on('click', function(e) {
	e.preventDefault();
	var data = {
		phase: "gun"
	};
	$.ajax({
		type: "POST",
		url: "api.php",
		data: data,
		success: fireCb,
		dataType: 'json'
	});
});
