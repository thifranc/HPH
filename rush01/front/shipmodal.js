
function addAttr(el) {
	$pos = $("#" + el.pos[0] + "-" + el.pos[1]);
	// set data-attr
	$pos.attr("data-motif", el.id);
	$pos.attr("data-mactive", el.active);
	$pos.attr("data-aim", el.aim);
	$pos.attr("data-lives", el.lives);
	$pos.attr("data-shield", el.shield);
	$pos.attr("data-lastmove", el.last_move);

	$pos.on("click", function (e) {
		shipmodal($(e.target));
		$( "#dialog" ).dialog( "open" );
	});
}
function eventAdd(data) {
	cleanMap();
	data.player1.armada.forEach(addAttr);
	data.player2.armada.forEach(addAttr);
}

function shipmodal($el) {
	var data = $el.data();
	console.log(data);
	$id = $('#motif');
	$active = $('#mactive');
	$aim = $('#aim');
	$lives = $('#mlives');
	$shield = $('#mshield');
	$lastMove = $('#lastMove');

	$id.text(data.motif);
	$active.text(data.mactive);
	$aim.text(data.aim);
	$lives.text(data.lives);
	$shield.text(data.shield);
	$lastMove.text(data.lastmove);
}

function cleanMap() {
	$cellGrid.find("td")
		.off()
		.removeAttr("data-motif")
		.removeAttr("data-active")
		.removeAttr("data-aim")
		.removeAttr("data-lives")
		.removeAttr("data-shield")
		.removeAttr("data-lastmove");
}


