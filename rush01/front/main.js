'use strict'

var $cellGrid = $('#cell-grid');
var gridWidth = 50;
var gridHeight = 75;
var turn = 0;

function baseMap (sizeX, sizeY) {
	var map = [];
	for (let y = 0; y < sizeY; y++) {
		var line = [];
		for (let x = 0; x < sizeX; x++) {
			line.push('.');
		}
		map.push(line);
	}
	return map;
}

function renderMap (map) {
	for (let x = 0; x < gridHeight; x++) {
		var $tableRow = $('<tr></tr>');
		for (let y = 0; y < gridWidth; y++) {
			var $cell = $('<td class="cell"></td>');
			if (x == 0 || x == gridHeight -1) {
				$cell.addClass('cell-border');
			} else {
				if (y == 0 || y == gridWidth) {
					$cell.addClass('cell-border');
				}
			}
			$cell.attr('id', x + '-' + y);
			if (map[x][y] > 'A') {
				$cell.addClass('colorA');
			} else if (map[x][y] == 'B') {
				$cell.addClass('colorB');
			} else if (map[x][y] == 'X') {
				$cell.addClass('asteroid');
			}
			$tableRow.append($cell);
		}
	$cellGrid.append($tableRow);
	}
}

function updateMap (map) {
	getInfo();
	$cellGrid.find('td').removeClass('colorA colorB');
	for (let x = 0; x < gridHeight; x++) {
		for (let y = 0; y < gridWidth; y++) {
			if (map[x][y] >= 'A' && map[x][y] <= 'Z') {
				$("#" + x + "-" + y).addClass('colorA');
			} else if (map[x][y] >= 'a' && map[x][y] <= 'z') {
				$("#" + x + "-" + y).addClass('colorB');
			} else if (map[x][y] == '*') {
				$("#" + x + "-" + y).addClass('asteroid');
			}
		}
	}
}

var $dialog = $("#dialog");
var map = baseMap(gridWidth, gridHeight);
renderMap(map);
$dialog.dialog({ autoOpen: false });
getData(function(data) {
	updateMap(data.map.space);
	eventAdd(data);
});
window.setInterval(function() {
	getData(function(data) {
		updateMap(data.map.space);
		eventAdd(data);
	});
}, 1000);
