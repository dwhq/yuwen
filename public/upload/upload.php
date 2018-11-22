<?php
exit('上传成功');
//header("Content-Type: text/html;charset=utf-8");
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//	upload();
//}
//function upload() {
//	$upload = './upload/'; //文件储存路径
//	if ($_FILES["file"]["error"] > 0) {
//		$data['info'] = '上传失败错误:' . $_FILES["file"]["error"];
//		$data['code'] = 500;
//		echo json_encode($data);
//	} else {
//		//print_r($_FILES["file"]["size"]);exit();文件大小
//		$allowedExts = array("gif", "jpeg", "jpg", "png"); // 允许上传的图片后缀
//		//var_dump($_FILES);exit();
//		$temp = explode(".", $_FILES["file"]["name"]);
//		$extension = end($temp); // 获取文件后缀名
//		if (in_array($extension, $allowedExts)
//			&& ($_FILES["file"]["size"] < 1024 * 1024 * 5) // 小于 5M
//		) {
//			//echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
//			//echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
//			//echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//			//echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];
//			// 判断当期目录下的 upload 目录是否存在该文件
//			// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
//			$new_name = date('Y-m-d-H-i-s') . '-' . uniqid() . mt_rand(100, 999) . '.' . "$extension"; //生成的文件名称
//			if (file_exists($upload . $new_name)) {
//				echo " 文件已经存在 ";
//			} else {
//				// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
//				move_uploaded_file($_FILES["file"]["tmp_name"], $upload . $new_name);
//				$data['path'] = $upload . $new_name;
//				$data['info'] = '上传成功';
//				$data['code'] = 200;
//				echo json_encode($data);
//			}
//		} else {
//			echo "错误：文件格式不对哦";
//		}
//
//	}
//}