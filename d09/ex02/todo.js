var submit = document.getElementById("submit");
var list = document.getElementById("ft_list");
var cookies = getCookie("todo");


function createTodo(value) {
	var div = document.createElement("div");
	div.innerHTML = value;
	list.appendChild(div);
	div.addEventListener("click", function() {
		div.parentNode.removeChild(div);
		var cookies = getCookie("todo");
		var index = cookies.indexOf(value);
		if (index > -1) {
			cookies.splice(index, 1);
			setCookie(cookies);
		}
	});
}

function setCookie(array) {
	document.cookie = "todo=" + JSON.stringify(array);
}

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2){
		return JSON.parse(parts.pop().split(";").shift());
	}
	return [];
}

for (var i = 0; i < cookies.length; i++) {
	createTodo(cookies[i]);
}

submit.addEventListener("click", function( event ) {
	var todo = prompt("Add a Todo.");

	var cookies = getCookie("todo");
	cookies.push(todo);
	setCookie(cookies);
	createTodo(todo);
});


