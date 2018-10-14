<?php
	require_once __DIR__.'/Explorer.php';
	$explorer = new \spacenear\homework\Explorer();
	
	if (isset($_POST['readFolder'])) {
		$dir = $_POST['readFolder'];
		if ($dir === 'true') {
			$dir = __DIR__;
		}
		echo json_encode($explorer->readFolder($dir), JSON_UNESCAPED_UNICODE);
	}
