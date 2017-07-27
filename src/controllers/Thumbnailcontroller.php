<?php

use Illuminate\Http\Request;

class ThumbnailController extends App\Http\Controllers\Controller
{	
	public function resize(Request $request)
    {
		extract($request->all());

		try {
			$path = public_path() . $url;

			if(!$path) {
				throw new Exception("Failed to load image `$url`");
            }
						
			$original = imagecreatefromstring(file_get_contents(realpath($path)));
			
			$original_width = imagesx($original);
			$original_height = imagesy($original);
			
			$dst_x = $dst_y = 0;
			
			 // calculate thumbnail size
			if( $original_width > $original_height) {
				$new_width = $width;
				$new_height = floor($original_height * ($width / $original_width));
				$dst_y = floor(($height - $new_height) / 2);
			} else {
				$new_height = $height;
				$new_width = floor($original_width * ($height / $original_height));
				$dst_x = floor(($width - $new_width) / 2);
			}
			
			// create a new temporary image
			$tmp_img = imagecreatetruecolor($width, $height);
			
			$color = imagecolorallocate($tmp_img, 255, 255, 255);
			imagefill($tmp_img, 0, 0, $color);

			// copy and resize old image into new image
			imagecopyresized($tmp_img, $original, $dst_x, $dst_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
			
			ob_start();
			imagejpeg($tmp_img, null, 100);
			$blob = ob_get_contents();
			
			imagedestroy( $tmp_img );

			return Response::make( $blob, 200, array('content-type' => 'image/jpg'));
        }
        catch (\Exception $e)
        {
			return Response::make($e->getMessage(), 404);
        }
	}
	
}
