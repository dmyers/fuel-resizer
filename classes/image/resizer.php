<?php

namespace Resizer;

class Image_Resizer
{
	protected $image;
	
	public function __construct($filename)
	{
		$this->image = \Image::load($filename);
	}
	
	public static function forge($filename)
	{
		return new static($filename);
	}
	
	public function resize($width, $height, $scale = null)
	{
		if (empty($scale)) {
			$scale = 'auto';
		}
		
		$sizes = $this->image->sizes();
		
		$original_height = $sizes->height;
		$original_width  = $sizes->width;
		
		// Handle auto scaling.
		if ($scale == 'auto') {
			if (empty($height)) {
				$scale = 'landscape';
			}
			elseif (empty($width)) {
				$scale = 'portrait';
			}
			elseif ($original_height < $original_width) {
				$scale = 'landscape';
			}
			elseif ($original_height > $original_width) {
				$scale = 'portrait';
			}
			elseif ($height < $width) {
				$scale  = 'exact';
				$height = $width;
			}
			else {
				$scale = 'exact';
				$width = $height;
			}
		}
		
		switch ($scale) {
			case 'exact':
				break;
			case 'portrait':
				$width = round($height * ($original_width / $original_height));
				break;
			case 'landscape':
				$height = round($width * ($original_height / $original_width));
				break;
			case 'crop':
				$given_width = $width;
				$given_height = $height;
				
				$ratio = max($height / $original_height, $width / $original_width);
				
				$height = round($original_height * $ratio);
				$width  = round($original_width * $ratio);
				break;
		}
		
		if ($scale == 'crop') {
			// Crop to the center.
			if ($width > $height) {
				$crop_start_x = ($width / 2) - ($given_width / 2);
				$crop_start_y = 0;
			}
			else {
				$crop_start_x = 0;
				$crop_start_y = ($height / 2) - ($given_height / 2);
			}
			
			return $this->image->crop($crop_start_x, $crop_start_y, $given_width, $given_height);
		}
		
		return $this->image->resize($width, $height, false);
	}
	
	public function save($filename)
	{
		return $this->image->save($filename);
	}
}
