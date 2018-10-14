<?php
	
	namespace spacenear\homework;
	
	class Explorer
	{
		public function readFolder($path)
		{
			$dir     = new \DirectoryIterator($path);
			$respond = [];
			
			foreach ($dir as $item) {
				if ($item->isDir()) {
					$type = 'dir';
				} else {
					$type = 'file';
				}
				
				array_push($respond,
					[
						'type' => $type,
						'name' => $item->getFilename(),
						'path' => $item->getPath(),
					]);
			}
			return $respond;
		}
	}

	
