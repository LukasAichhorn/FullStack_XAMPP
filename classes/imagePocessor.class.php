<?php
class ImageProcessor{

   function createThumbnail($ImgPath){

        $IMGdata = getimagesize($ImgPath);
        $path_parts = pathinfo($ImgPath);
        $IMG_name=$path_parts["filename"];
        $IMG_ending=$path_parts["extension"];
        $IMG_dir=$path_parts["dirname"];
        $IMG_width =$IMGdata[0];
        $IMG_height =$IMGdata[1];
        $IMG_type = $IMGdata[2];
        //calculate new widht and hight according to max size:
        $IMG_MAX_WIDTH = 400;
        $IMG_MAX_HEIGHT = 200;

        if ($IMG_width> $IMG_MAX_WIDTH)
        {
        $factor = $IMG_MAX_WIDTH / $IMG_width;
        $IMG_new_Width = round($IMG_width * $factor);
        $IMG_new_Height = round($IMG_height * $factor);
        }
        // Höhe skalieren, falls nötig
        if ($IMG_height > $IMG_MAX_HEIGHT)
        {
        $factor = $IMG_MAX_HEIGHT / $IMG_height;
        $IMG_new_Width = round($IMG_width * $factor);
        $IMG_new_Height = round($IMG_height * $factor);
        }


        // $IMG_new_Width = $IMG_width/5;
        // $IMG_new_Height =$IMG_height/5;
        $IMG_NewPath = $IMG_dir."/".$IMG_name."_thumbnail".".".$IMG_ending;  
//1 == gif 2 == jpeg 3==png 4

        if($IMG_type == 1){
            $IMG= imagecreatefromgif($ImgPath);
            $Thumbnail=imagescale($IMG,$IMG_new_Width,$IMG_new_Height,IMG_NEAREST_NEIGHBOUR);
            //C:\xampp\htdocs\WEB_SS2020\WP\usersRoot\b\80Enzian Logo.jpeg
            imagejpeg($Thumbnail,$IMG_NewPath);
            imagedestroy($Thumbnail);

        }
        elseif($IMG_type == 2){
            $IMG = imagecreatefromjpeg($ImgPath);
            $Thumbnail=imagescale($IMG,$IMG_new_Width,$IMG_new_Height,IMG_NEAREST_NEIGHBOUR);
            //C:\xampp\htdocs\WEB_SS2020\WP\usersRoot\b\80Enzian Logo.jpeg
            imagejpeg($Thumbnail,$IMG_NewPath);
            imagedestroy($Thumbnail);

        }
        elseif($IMG_type == 3){
            
            $IMG = imagecreatefrompng($ImgPath);
            imagealphablending($IMG,false);
            $Thumbnail=imagescale($IMG,$IMG_new_Width,$IMG_new_Height,IMG_NEAREST_NEIGHBOUR);
            //C:\xampp\htdocs\WEB_SS2020\WP\usersRoot\b\80Enzian Logo.jpeg
            imagesavealpha($Thumbnail, true);
            imagepng($Thumbnail,$IMG_NewPath);
            imagedestroy($Thumbnail);
        }

   }


}
?>