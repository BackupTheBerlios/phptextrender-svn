<?php

/*
 Copyright 2005 $phpTextRenderProgrammingTeam 
 = array(
		 "Walter Rafelsberger");
 
 This file is part of phpTextRender.
 
 phpTextRender is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.
 
 phpTextRender is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with PhpWiki; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// v0.1a (Alpha)

/*
 This release is quite experimental.
 
 $text -> The text you want to output via phpTextRender. Usage: phpTextRender.php?text=HelloWorld
 $font -> The font you want to use. Currently Truetype fonts are supported. e.g.: $font = "Arial.ttf"; You have to use and upload your own fonts. No font files are supplied with phpTextRender.
 
 $color -> Default = Red; When $color is set, the font will be gray. This is quite costumized yet and not really usable for common projects.

 The image will be output with GIF-Format.
 
 Tested with GD 2.0 only.
 
*/

$text = $_GET["text"];
$font = "fonts/Arial.ttf";

if (isset($_GET["size"])) $getsize = $_GET["size"];
	else $getsize = 8;

$size = imagettfbbox($getsize+1, 0, $font, $text);
$image = imagecreatetruecolor(abs($size[2]) + abs($size[0]), abs($size[7]) + abs($size[1]));
if (!isset($_GET["color"])) $gold = imagecolorallocate($image, 206, 20, 20);
	else $gold = imagecolorallocate($image, 177, 177, 177);
$back = ImageColorAllocate($image,255,255,255);
ImageFilledRectangle($image,0,0,302,20,$back);
imagettftext($image, $getsize, 0, 0, $getsize+2, $gold, $font, $text);
header("Content-type: image/gif");
imagegif($image);
imagedestroy($image);
?>