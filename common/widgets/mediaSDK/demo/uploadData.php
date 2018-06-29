<?php
/* 
 * 在使用PHP SDK之前，需要先引入AlibabaImage类：require_once('../alimedia/alimage.class.php');
 */
require_once('../alimedia/alimage.class.php');

$ak = '23045441';								// 用户的AK (user app key)
$sk = '79ad20dee5bd28178fb957aef86bfefd';		// 用户的SK (user secret key)
$namespace = 'qinning2';						// 空间名称  (user namespace)

/*
 * 下面是调用SDK进行字符串上传的测试。会根据字符串大小决定是否进行分片。
 */

test_upload_file_a( $ak, $sk, $namespace ); //上传字符串，通过UploadPolicy设置参数
//test_upload_file_b( $ak, $sk, $namespace ); //上传字符串，通过UploadOption设置参数
//test_upload_file_c( $ak, $sk, $namespace ); //读取图片内容并上传，通过UploadPolicy设置参数

/*##############################下面为上传文件的三个方法##############################*/
function test_upload_file_a( $ak, $sk, $namespace ){
	/*该测试方法通过SDK直接上传字符串。通过UploadPolicy指定文件的名称和路径*/
	/*第一步：（必须）先引入AlibabaImage类，并设置AK和SK*/
	$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK
	
	/*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
	$uploadPolicy = new UploadPolicy($namespace);	// 上传策略。并设置空间名
	$uploadPolicy->dir = '/PENGUY/appTemp/phpSdk';	// 文件路径，(可选，默认根目录"/")
	$uploadPolicy->name = 'text_a'.time();			// 文件名，(上传字符串时，需要设置文件名，且文件名不能包含"/")
	
	/*第三步：（必须）进行文件上传*/
	$res = $aliImage->uploadData( 'Hello! Ali Media Service!', $uploadPolicy );
	var_dump($res);
}
function test_upload_file_b( $ak, $sk, $namespace ){
	/*该测试方法通过SDK直接上传字符串。通过UploadOption指定文件的名称和路径*/
	/*第一步：（必须）先引入AlibabaImage类，并设置AK和SK*/
	$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK
	
	/*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
	$uploadPolicy = new UploadPolicy($namespace);	// 上传策略。并设置空间名
	/*（可选）开发者可以在UploadPolicy设置路径和文件名，也可在上传选项UploadOption中设置用户自定义的参数*/
	$uploadOption = new UploadOption();
	$uploadOption->dir = 'PENGUY/appTemp/phpSdk';	// 文件路径，(可选，默认根目录"/")
	$uploadOption->name = 'text_b'.time();			// 文件名，(上传字符串时，需要设置文件名，且文件名不能包含"/")
	
	/*第三步：（必须）进行文件上传*/
	$res = $aliImage->uploadData( 'Hello! Ali Media Service!', $uploadPolicy, $uploadOption );
	var_dump($res);
}
function test_upload_file_c( $ak, $sk, $namespace ){
	/*该测试方法通过SDK以字符串方式上传图片。通过UploadPolicy指定文件的名称和路径*/
	/*第一步：（必须）先引入AlibabaImage类，并设置AK和SK*/
	$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK
	
	/*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
	$uploadPolicy = new UploadPolicy($namespace);	// 上传策略。并设置空间名
	$uploadPolicy->dir = '/PENGUY/appTemp/phpSdk';	// 文件路径，(可选，默认根目录"/")
	$uploadPolicy->name = 'image_d'.time();			// 文件名，(上传字符串时，需要设置文件名，且文件名不能包含"/")
	
	/*第三步：进行文件上传*/
	$data = file_get_contents ( 'image/tinyImg.jpg' ); //读本地图片内容到字符串中
	$res = $aliImage->uploadData( $data, $uploadPolicy );
	var_dump($res);
}
?>
