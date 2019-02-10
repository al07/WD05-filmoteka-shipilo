<?php

	function createThumbnail($imagePath, $cropWidth=100, $cropHeight=100) {
		$imagic = new Imagick($imagePath);
		
		$width = $imagic->getImageWidth();
		$height = $imagic->getImageHeight();
		
//		if ( $width > $height ) {
//			$imagic->thumbnailImage(0, $cropHeight);
//			
//		} else {
//			$imagic->thumbnalImage($cropWidth, 0);
//		}
		
		$width = $imagic->getImageWidth();
		$height = $imagic->getImageHeight();
		
		$centerX = round($width / 2);
		$centerY = round($height / 2);
		
		
		$cropWidthHalf = round($cropWidth/2);
		$cropHeighthHalf = round($cropWidth/2);
		
		$startX = max(0, $centerX - $cropWidthHalf);
		$startY = max(0, $centerY - $cropHeighthHalf);
		
		$imagic->cropImage($cropWidth, $cropHeight, $startX, $startY);
		
		return $imagic; 
	}
?>