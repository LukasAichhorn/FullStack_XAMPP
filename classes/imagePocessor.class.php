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
        $IMG_new_Width = $IMG_width/5;
        $IMG_new_Height =$IMG_height/5;
        $IMG_NewPath = $IMG_dir."/".$IMG_name."_thumbnail".".".$IMG_ending;  
//1 == gif 2 == jpeg 3==png 4

        if($IMG_type == 1){
            $IMG= imagecreatefromgif($ImgPath);
            $Thumbnail=imagescale($IMG,$IMG_new_Width,$IMG_new_Height,IMG_NEAREST_NEIGHBOUR);
            //C:\xampp\htdocs\WEB_SS2020\WP\usersRoot\b\80Enzian Logo.jpeg
            imagejpeg($Thumbnail,$IMG_NewPath);

        }
        elseif($IMG_type == 2){
            $IMG = imagecreatefromjpeg($ImgPath);
            $Thumbnail=imagescale($IMG,$IMG_new_Width,$IMG_new_Height,IMG_NEAREST_NEIGHBOUR);
            //C:\xampp\htdocs\WEB_SS2020\WP\usersRoot\b\80Enzian Logo.jpeg
            imagejpeg($Thumbnail,$IMG_NewPath);

        }
        elseif($IMG_type == 3){
            $IMG = imagecreatefrompng($ImgPath);
            $Thumbnail=imagescale($IMG,$IMG_new_Width,$IMG_new_Height,IMG_NEAREST_NEIGHBOUR);
            //C:\xampp\htdocs\WEB_SS2020\WP\usersRoot\b\80Enzian Logo.jpeg
            imagejpeg($Thumbnail,$IMG_NewPath);
        }

   }


}
?>