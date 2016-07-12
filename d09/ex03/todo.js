var $submit = $("#submit");
var $list = $("#ft_list");

function createTodo(value) {
	var $div = $('<div></div>').append(value);
	$list.append($div);
	$div.on("click", function() {
		$div.remove();
		$.ajax({
			type: "GET",
			url: "delete.php",
			data: {todo: value},
			dataType: 'json'
		});
	});
}

$.ajax({
	type: "GET",
	url: "select.php",
	data: {},
	success: init,
	dataType: 'json'
});

function init(data) {
	for (var i = 0; i < data.length; i++) {
		createTodo(data[i][1]);
	}
}

submit.addEventListener("click", function( event ) {
	var todo = prompt("Add a Todo.");

	$.ajax({
		type: "GET",
		url: "insert.php",
		data: {todo: todo},
		dataType: 'json'
	});

	createTodo(todo);
});
