<?php
function resize($file_type,$tmp_name,$image_name,$width_size,$folder)
{
	if($file_type=="image/png" || $file_type=="image/x-png"){
		$images = $tmp_name;
		$new_images = $image_name;
		$width= $width_size;
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromPNG($images);

		//png
		imageSaveAlpha($images_orig, true);
		ImageAlphaBlending($images_orig, false);
		$transparentColor = imagecolorallocatealpha($images_orig, 255, 255, 255, 127);
		imagefill($images_orig, 0, 0, $transparentColor);

		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImagePNG($images_fin,$folder.$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);

	}elseif($file_type=="image/gif"){
		$images = $tmp_name;
		$new_images = $image_name;
		$width= $width_size;
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromGIF($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageGIF($images_fin,$folder.$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);

	}elseif($file_type=="image/pjpeg" || $file_type=="image/jpeg"){
		$images = $tmp_name;
		$new_images = $image_name;
		$width= $width_size;
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,$folder.$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);

	}elseif($file_type=="image/bmp"){
		$images = $tmp_name;
		$new_images = $image_name;
		$width= $width_size;
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromWBMP($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		imageWBMP($images_fin,$folder.$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
	}

}


function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);

    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}


function check_size($image_tmp,$size)
{
	$size = getimagesize($image_tmp);

	if($size[0] > $size)
	{
		?>
		<script type="text/javascript">

			swal("ขนาดภาพของคุณเกินขนาดที่กำหนดไว้ คือ <?php echo $size;?>px กรุณาเลือกรูปภาพที่มีขนาดไม่เกิน <?php echo $size;?>px หรือต่่ำกว่า");
			//window.history.back();
			return false;

		</script>
		<?php
		exit();
	}
}


?>
