<?php
require_once('../alimedia/alimage.class.php');

function upload_pic_alicdn($file){
	$ak = '23291456';								// 用户的AK (user app key)
	$sk = '1189ab9e691fe49a2ffb6bc2cef35f31';		// 用户的SK (user secret key)
	$namespace = 'wxzm';						// 空间名称  (user namespace)

	/*该测试方法通过SDK直接上传文件。上传的文件存储在空间根目录下，服务端的文件名采用本地文件默认名称*/
	/*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
	$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK

	/*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
	$uploadPolicy = new UploadPolicy( $namespace );	// 上传策略。并设置空间名

	/*第三步：（必须）进行文件上传*/
	$res = $aliImage->upload( $file, $uploadPolicy );
	// var_dump($res);

	return $res["url"];
}


$result = upload_pic_alicdn("image/tinyImg.jpg");

echo $result;

?>