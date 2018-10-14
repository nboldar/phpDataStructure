$(function () {
	var explorer = new Explorer();
	explorer.init();
});

function Explorer() {
	
	function renderDir($dirArr) {
		for (i = 0; i < $dirArr.length; i++) {
			if ($dirArr[i]['name'] == '.') {
				continue;
			}
			var folder = $('<div>').addClass('folder');
			
			var img = $('<img>');
			if ($dirArr[i]['type'] == 'dir') {
				if ($dirArr[i]['name'] == '..') {
					img.attr({src: '/static/img/opened-folder.png', alt: 'folder'});
				} else {
					img.attr({src: '/static/img/folder.png', alt: 'folder'});
				}
				
				folder.attr({
					path: $dirArr[i]['path'] + '/' + $dirArr[i]['name'] + '/',
					type: $dirArr[i]['type']
				});
			} else if ($dirArr[i]['type'] == 'file') {
				img.attr({src: '/static/img/document.png', alt: 'file'});
				folder.attr({
					type: $dirArr[i]['type']
				});
			}
			
			var span = $('<span>').text($dirArr[i]['name']);
			folder.append(img).append(span);
			$('#explorer').append(folder);
		}
	}
	
	function cleanExplorer() {
		return $('#explorer').empty();
	}
	
	this.init = function () {
		$.post('/engine.php', {readFolder: true}, function (data) {
			renderDir(data);
		}, 'json');
		
		$('body').on('click', '.folder', function () {
			var path = $(this).attr('path');
			var type = $(this).attr('type');
			if (type != 'dir') {
				return alert('А вот файлы я пока не могу посмотреть)');
			}
			$.post('/engine.php', {readFolder: path}, function (data) {
				cleanExplorer();
				renderDir(data);
			}, 'json');
		});
	}
}