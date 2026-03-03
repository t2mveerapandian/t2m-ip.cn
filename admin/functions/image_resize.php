<?php

class ImageResize
{
	//helper function to resize an image based on input, output and size
	function resizeImage($input, $output, $mode, $w, $h = 0)
	{
		switch($this->GetMimeType($input))
		{
			case "image/png":
				$img = ImageCreateFromPng($input);
				break;
			case "image/gif":
				$img = ImageCreateFromGif($input);
				break;
			case "image/jpeg":
			default:
				$img = ImageCreateFromJPEG ($input);
				break;
		}

		$image['sizeX'] = imagesx($img);
		$image['sizeY'] = imagesy($img);
		switch ($mode){
		case 1: //Quadratic Image
			$thumb = imagecreatetruecolor($w,$w);
			if($image['sizeX'] > $image['sizeY'])
			{
				imagecopyresampled($thumb, $img, 0,0, ($w / $image['sizeY'] * $image['sizeX'] / 2 - $w / 2),0, $w,$w, $image['sizeY'],$image['sizeY']);
			}
			else
			{
				imagecopyresampled($thumb, $img, 0,0, 0,($w / $image['sizeX'] * $image['sizeY'] / 2 - $w / 2), $w,$w, $image['sizeX'],$image['sizeX']);
			}
			break;

		case 2: //Biggest side given
			if($image['sizeX'] > $image['sizeY'])
			{
				$thumb = imagecreatetruecolor($w, $w / $image['sizeX'] * $image['sizeY']);
				imagecopyresampled($thumb, $img, 0,0, 0,0, imagesx($thumb),imagesy($thumb), $image['sizeX'],$image['sizeY']);
			}
			else
			{
				$thumb = imagecreatetruecolor($w / $image['sizeY'] * $image['sizeX'],$w);
				imagecopyresampled($thumb, $img, 0,0, 0,0, imagesx($thumb),imagesy($thumb), $image['sizeX'],$image['sizeY']);
			}
			break;
		case 3; //Both sides given (cropping)
			$thumb = imagecreatetruecolor($w,$h);
			if($h / $w > $image['sizeY'] / $image['sizeX'])
			{
				imagecopyresampled($thumb, $img, 0,0, ($image['sizeX']-$w / $h * $image['sizeY'])/2,0, $w,$h, $w / $h * $image['sizeY'],$image['sizeY']);
			}
			else
			{
				imagecopyresampled($thumb, $img, 0,0, 0,($image['sizeY']-$h / $w * $image['sizeX'])/2, $w,$h, $image['sizeX'],$h / $w * $image['sizeX']);
			}
			break;

		case 0:
			$thumb = imagecreatetruecolor($w,$w / $image['sizeX']*$image['sizeY']);
			imagecopyresampled($thumb, $img, 0,0, 0,0, $w,$w / $image['sizeX']*$image['sizeY'], $image['sizeX'],$image['sizeY']);
			break;
	}        

		if(!file_exists($output)) imagejpeg($thumb, $output, 90);
	}


	//helper function to get the mime type of a file
	function GetMimeType($file)
	{
		$forbiddenChars = array('?', '*', ':', '|', ';', '<', '>');

		if(strlen(str_replace($forbiddenChars, '', $file)) < strlen($file))
			throw new \ArgumentException("Forbidden characters!");

		$file = escapeshellarg($file);

		ob_start();
		$type = system("file --mime-type -b ".$file);
		ob_clean();

		return $type;
	}
}

?>