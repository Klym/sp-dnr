<?php
	if (isset($_POST["upload"]) && !empty($_FILES["img"]["name"])) {
		$i = 0;
		$uploadedImgs = array();
		foreach($_FILES["img"]["type"] as $type) {
			$isImg = true;
			switch($type) {
				case "image/jpeg" :
					$img = imagecreatefromjpeg($_FILES["img"]["tmp_name"][$i]);
				break;
				case "image/gif" :
					$img = imagecreatefromgif($_FILES["img"]["tmp_name"][$i]);
				break;
				case "image/png" :
					$img = imagecreatefrompng($_FILES["img"]["tmp_name"][$i]);
				break;
				default:
					$isImg = false;
					echo("Ошибка. Файл ".$_FILES["img"]["name"][$i]." содержит неверный формат.<br>");
				break;
			}
			if (!$isImg) {
				$i++;
				continue;
			}
			$width = imagesx($img);
			$height = imagesy($img);
			if ($width <= 955) {
				$new_width = $width;
				$new_height = $height;
			} else {
				$new_width = 955;
				$new_height = floor( $height * ( $new_width / $width));
			}
			$tmp_img = imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$new_path = substr($_FILES["img"]["name"][$i], 0, strrpos($_FILES["img"]["name"][$i], "."));
			$new_path .= time();
			if (imagejpeg($tmp_img, "../content_imgs/news_imgs/".$new_path.".jpg", 85)) {
				array_push($uploadedImgs, $new_path);
				echo "Изображение ".$_FILES["img"]["name"][$i]." успешно загружено.<br>";
			}
			$i++;
		}
		echo "<br>";
		for ($i = 0; $i < count($uploadedImgs); $i++) {
			echo "<img src=\"../content_imgs/news_imgs/".$uploadedImgs[$i].".jpg\" width=\"75\">";
			echo "<a target=\"_blank\" href=\"../content_imgs/news_imgs/".$uploadedImgs[$i].".jpg\">../content_imgs/news_imgs/".$uploadedImgs[$i].".jpg</a><br>";
		}
		die();
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Загрузка изображений</title>
</head>
<body>
<form enctype="multipart/form-data" action="addImg.php" method="post">
	<label>Загрузить изображения: <input type="file" name="img[]" multiple></label><br><br>
    <p style="font-size:14px;">Одновременная загрузка до 5-ти фотографий. Не закрывайте это окно до вставки всех изображений в форму.</p>
    <input type="submit" name="upload" value="Загрузить">
</form>
</body>
</html>