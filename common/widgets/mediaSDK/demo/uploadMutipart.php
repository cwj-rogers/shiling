<?php
/* 
 * 在使用PHP SDK之前，需要先引入AlibabaImage类：require_once('../alimedia/alimage.class.php');
 */
require_once('../alimedia/alimage.class.php');

$ak = '23045441';								// 用户的AK (user app key)
$sk = '79ad20dee5bd28178fb957aef86bfefd';		// 用户的SK (user secret key)
$namespace = 'qinning2';						// 空间名称  (user namespace)

/*
 * 下面是直接调用SDK的分片上传接口，完成文件分片上传。
 */

/*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK

/*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
$uploadPolicy = new UploadPolicy( $namespace );	// 上传策略。并设置空间名
$uploadPolicy->dir = '/PENGUY/appTemp/phpSdk';	// 文件路径，(可选，默认根目录"/")
$uploadPolicy->name = 'image_e'.time();			// 文件名，(可选，不能包含"/"。若为空，则默认使用文件名)
/*（可选）开发者可以在UploadOption中设置文件分片的大小（范围100K < size < 10M）。如果不指定分块大小，则为默认值2M。*/
$uploadOption = new UploadOption();
$uploadOption->blockSize = 1*1024*1024;		//设置分块大小为1M

/*第三步：（必须）创建分片上传任务，完成初始化*/
$filePath = 'image/largeImg.jpg';
$httpRes = $aliImage->multipartInit( $filePath, $uploadPolicy, $uploadOption );
var_dump($httpRes);
if( $httpRes ['isSuccess'] ) {
	/*第四步：（如果初始化成功）继续分片上传任务，完成文件上传*/
	$fileSize = filesize ( iconv('UTF-8','GB2312',$filePath) );		// 文件大小
	$blockSize = $uploadOption->blockSize;	// 文件分片大小
	$blockNum = intval ( ceil ( $fileSize / $blockSize ) ); // 文件分片后的块数
	for($i = 2; $i <= $blockNum; $i ++) {
		$uploadOption->setPartNumber($i);	//待上传的文件块编号
		$httpRes = $aliImage->multipartUpload( $filePath, $uploadPolicy, $uploadOption );
		var_dump($httpRes);
		if ( !$httpRes ['isSuccess'] ) {
			/*如果分片上传失败，则取消整个任务*/
			var_dump("文件块上传失败，立即取消分片上传任务");
			$httpRes = $aliImage->multipartCancel( $uploadPolicy, $uploadOption );
			var_dump($httpRes);
			break;
		}
		if($i == $blockNum) {
			/*如果上传最后一个文件块，则完成整个任务*/
			$uploadOption->setMd5(md5_file ( iconv('UTF-8','GB2312',$filePath) ));
			$httpRes = $aliImage->multipartComplete( $uploadPolicy, $uploadOption );
			var_dump($httpRes);
		}
	}
}
?>
