<?php

class StudioModel extends Model
{
    public function save_img($img, $filter, $type)
    {
        if ($type == 'image/png') {
            $decodedData = base64_decode($img);
            file_put_contents('WorkImgs/working_img.png', $decodedData);

            $sourceImage = $filter['path'];
            $destImage = "WorkImgs/working_img.png";

            $src = imagecreatefrompng($sourceImage);
            $dest = imagecreatefrompng($destImage);

            list($srcWidth, $srcHeight) = getimagesize($sourceImage);

            // Start x & y
            $src_xPosition = 0;
            $src_yPosition = 0;

            // Whwe to crop
            $src_cropXposition = 0;
            $src_cropYposition = 0;

            imagecopy($dest, $src, $src_xPosition, $src_yPosition, $src_cropXposition, $src_cropYposition, $srcWidth, $srcHeight);

            // Assig unique id for img
            $uniqid = "Posts/" . uniqid() . ".png";
            imagejpeg($dest, $uniqid, 100);

            //Destroy temp img
            imagedestroy($dest);

            return $uniqid;
        } else if ($type == 'image/jpeg') {
            $decodedData = base64_decode($img);
            $uniqid = uniqid();

            file_put_contents('WorkImgs/working_img.jpg', $decodedData);
            if (file_exists('WorkImgs/working_img.jpg')) {
                $new_img = imagecreatefromjpeg('WorkImgs/working_img.jpg');
                imagepng($new_img, 'WorkImgs/working_img.png');
            }
            $sourceImage = $filter['path'];
            $destImage = "WorkImgs/working_img.png";

            $src = imagecreatefrompng($sourceImage);
            $dest = imagecreatefrompng($destImage);

            list($srcWidth, $srcHeight) = getimagesize($sourceImage);

            // Start x & y
            $src_xPosition = 0;
            $src_yPosition = 0;

            // Whwe to crop
            $src_cropXposition = 0;
            $src_cropYposition = 0;

            imagecopy($dest, $src, $src_xPosition, $src_yPosition, $src_cropXposition, $src_cropYposition, $srcWidth, $srcHeight);

            // Assig unique id for img
            $uniqid = "Posts/" . $uniqid . ".jpg";
            imagejpeg($dest, $uniqid, 100);

            //Destroy temp img
            imagedestroy($dest);

            return $uniqid;
        }
    }
}
