<?php
/* 
 * 在使用PHP SDK之前，需要先引入AlibabaImage类：require_once('../alimedia/alimage.class.php');
 */
if (! defined ( 'CURRENT_PATH' )) {
	define ( 'CURRENT_PATH', dirname ( __FILE__ ) );
}
require_once('../alimedia/alimage.class.php');

$ak = '23045441';								// 用户的AK (user app key)
$sk = '79ad20dee5bd28178fb957aef86bfefd';		// 用户的SK (user secret key)
$namespace = 'qinning2';						// 空间名称  (user namespace)

/*
 * 下面是调用SDK进行文件上传的测试。会根据文件大小决定是否进行分片。默认会覆盖服务端已存在的同名文件。
 */
//test_upload_file_a( $ak, $sk, $namespace ); //直接上传
test_upload_file_b( $ak, $sk, $namespace ); //通过UploadPolicy设置参数
//test_upload_file_c( $ak, $sk, $namespace ); //通过UploadOption设置参数

/*##############################下面为上传文件的三个示例方法##############################*/
function test_upload_file_a( $ak, $sk, $namespace ){
	/*该测试方法通过SDK直接上传文件。上传的文件存储在空间根目录下，服务端的文件名采用本地文件默认名称*/
	/*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
	$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK

	/*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
	$uploadPolicy = new UploadPolicy( $namespace );	// 上传策略。并设置空间名

	/*第三步：（必须）进行文件上传*/
	$res = $aliImage->upload( 'image/tinyImg.jpg', $uploadPolicy );
	var_dump($res);
}
function test_upload_file_b( $ak, $sk, $namespace ){
	/*该测试方法主要是通过UploadPolicy设置文件上传到服务端的名称和路径*/
	/*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
	$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK
	
	/*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
	$uploadPolicy = new UploadPolicy( $namespace );	// 上传策略。并设置空间名
	$uploadPolicy->dir = '/PENGUY/appTemp/phpSdk';	// 文件路径，(可选，默认根目录"/")
	//$uploadPolicy->name = 'image_b'.time();			// 文件名，(可选，不能包含"/"。若为空，则默认使用文件名)
	
	/*第三步：（必须）进行文件上传*/
	$res = $aliImage->upload( 'image/tinyImg.jpg', $uploadPolicy );
	var_dump($res);
}
function test_upload_file_c( $ak, $sk, $namespace ){
	/*该测试方法主要是通过UploadOption设置文件上传到服务端的名称和路径*/
	/*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
	$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK

	/*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
	$uploadPolicy = new UploadPolicy( $namespace );	// 上传策略。并设置空间名
	/*（可选）开发者可以在UploadPolicy设置路径和文件名，也可在上传选项UploadOption中设置用户自定义的参数*/
	$uploadOption = new UploadOption();
	$uploadOption->dir = '/PENGUY/appTemp/phpSdk';	// 文件路径，(可选，默认根目录"/")
	$uploadOption->name = 'image_c'.time();			// 文件名，(可选，不能包含"/"。若为空，则默认使用文件名)
	
	/*第三步：（必须）进行文件上传*/
	$res = $aliImage->upload( 'image/tinyImg.jpg', $uploadPolicy, $uploadOption );
	var_dump($res);
}
?>
