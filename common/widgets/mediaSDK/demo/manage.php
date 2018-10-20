<?php
/*
 * 在使用PHP SDK之前，需要先引入AlibabaImage类：require_once('../alimedia/alimage.class.php');
 */
require_once('../alimedia/alimage.class.php');

$ak = '23045441';								// 用户的AK (user app key)
$sk = '79ad20dee5bd28178fb957aef86bfefd';		// 用户的SK (user secret key)
$namespace = 'qinning2';						// 空间名称  (user namespace)

/*
 * 下面是直接调用SDK接口，进行服务管理
 */
$dir = 'PENGUY/appTemp/phpSdk';
$filename = "tinyImg.jpg";
/*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
$aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK

/*第二步：调用各个管理接口，进行服务管理*/	

        /* 1:文件是否存在*/
//$res = $aliImage->existsFile($namespace, $dir, $filename );

        /* 2:获取文件的meta信息*/
// $res = $aliImage->getFileInfo($namespace, $dir, $filename);

        /* 3:获取指定目录下的文件列表*/
 $res = $aliImage->listFiles($namespace, $dir, 1, 5);
//var_dump($dir."下的文件总数:".$res['totalCount'].", 返回结果中的文件数:".count($res['result']) );

        /* 4:删除指定的文件*/
// $res = $aliImage->deleteFile($namespace, $dir, $filename );

        /* 5:文件夹是否存在*/
// $res = $aliImage->existsFolder($namespace, $dir );

        /* 6:创建文件夹*/
// $res = $aliImage->createDir($namespace, $dir );

        /* 7:获取指定目录下的子文件夹列表*/
// $res = $aliImage->listDirs($namespace, $dir, 1, 2 );
//var_dump("指定目录下的子文件夹总数:".$res['totalCount'].", 返回结果中的子文件夹数:".count($res['result']) );

        /* 8:删除文件夹*/
// $res = $aliImage->deleteDir($namespace, $dir );

        /* 新增:重命名文件*/
//$res = $aliImage->renameFile($namespace, $dir, $filename, "PENGUY/appTemp", "tinyImg.jpg");
/**###########################################################################################*/
//上面是文件资源管理接口的调用示例，下面是特色功能接口的调用示例
/**###########################################################################################*/

        /* 9:黄图扫描*/
    //下面是扫描指定空间的图片文件
/* $resourceInfos = new ManageOption();
$resourceInfos->addResource($namespace,$dir,"黄图.png"); //添加待扫描图片文件，可以添加多个
$resourceInfos->addResource("testantiporn2",null,"qinning2.jpg");
$res = $aliImage->scanPorn( $resourceInfos ); */

    //下面是扫描指定的URL
/* $resourceInfos = new ManageOption();
$resourceInfos->addUrl("http://qinning2.image.alimmdn.com/PENGUY/appTemp/phpSdk/%E9%BB%84%E5%9B%BE%E7%8B%97.jpg"); //添加待扫描黄图url。可以添加多个。
$resourceInfos->addUrl("http://testantiporn2.image.alimmdn.com/qinning2.jpg");
$res = $aliImage->scanPorn( $resourceInfos ); //注意：黄图扫描接口，文件和URL不能同时指定。
 */
        /* 10:黄图扫描结果反馈接口*/
/* $pornFbInfos = new ManageOption();
$pornFbInfos->addPornFbInfo($namespace, $dir, $filename, 0, false);
$pornFbInfos->addPornFbInfo($namespace, "PENGUY/video", "Wildlife_1.jpg", 0, false);
$res = $aliImage->pornFeedback( $pornFbInfos );
 */
        /* 11:多媒体转码接口*/
/* $encodeOption = new MediaEncodeOption();
$encodeOption->setInputResource($namespace, "PENGUY/video", "输入视频Wildlife.wmv"); //待转码的文件
$encodeOption->setOutputResource($namespace, "PENGUY/video", "输出视频.mp4"); //转码后的文件
$encodeOption->usePreset = 1;
$encodeOption->setEncodeTemplate("video-generic-AVC-360p-16_9"); //根据usePreset参数，决定使用用户模板还是系统模板
$res = $aliImage->mediaEncode($encodeOption); */

        /* 12:多媒体转码任务查询接口*/
// $taskId = "55a53a16e1720ed0c67005ae43a0a0c335d8b5a7e37e";
// $res = $aliImage->mediaEncodeQuery($taskId);

        /* 13:视频截图接口*/
/* $snapshotOption = new SnapShotOption();
$snapshotOption->setInputResource($namespace, "PENGUY/video", "Wildlife.wmv"); //待截图的视频文件
$snapshotOption->setOutputResource($namespace, "PENGUY/临时", "Wildlife_截图.jpg"); //得到的截图文件
$snapshotOption->setTime(2000);		//设置截图的位置。单位毫秒
$res = $aliImage->videoSnapshot($snapshotOption); //返回任务ID。taskId = f3150e6fa2d84eeda7ea0777474f87a1
 */
        /* 14:视频截图结果查询接口*/
// $taskId = "f3150e6fa2d84eeda7ea0777474f87a1";
// $res = $aliImage->vSnapshotQuery($taskId);

        /* 15:广告图扫描接口(beta)*/
    //下面是扫描指定空间的图片文件
/* $adInfos = new ManageOption();
$adInfos->addResource($namespace,$dir,$filename); //添加待扫描图片文件，可以添加多个
$adInfos->addResource("testantiporn2",null,"qinning2.jpg");
$res = $aliImage->scanAdvertising( $adInfos );
 */
    //下面是扫描指定的URL
/* $adInfos = new ManageOption();
$adInfos->addUrl("http://qinning2.image.alimmdn.com/PENGUY/demoLoadImg.jpg"); //添加待扫描广告图url。可以添加多个。
$adInfos->addUrl("http://testantiporn2.image.alimmdn.com/qinning2.jpg");
$res = $aliImage->scanAdvertising( $adInfos );
 */


var_dump( $res );
