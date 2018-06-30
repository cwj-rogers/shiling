<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29 0029
 * Time: 下午 5:32
 */
namespace common\widgets;
use Yii;
require_once (dirname ( __FILE__ )."/mediaSDK/alimedia/alimage.class.php");

class Uploader{
    const AK = '24901306';
    const SK = '797a577b83f45a18550d0e2ed251947b';
    const SPACE = 'ueditor';//'hjzhome';//
    const SPACE_PATH = '/wechat';//'/品牌logo';//

    public function index(){
        $filename = Yii::getAlias("@storage/web/image/201806/editor1529571612734724.png");
//        p($filename,1);
        $this->test_upload_file_c($filename);
    }

    /**
     * 同步单张图到顽兔
     * @param $filename
     * @return array
     */
    public function test_upload_file_c($filename){
        try{
            $ak = self::AK;
            $sk = self::SK;
            $namespace = self::SPACE;
            /*该测试方法主要是通过UploadOption设置文件上传到服务端的名称和路径*/
            /*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
            $aliImage  = new \AlibabaImage($ak, $sk);		//设置AK和SK

            /*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
            $uploadPolicy = new \UploadPolicy( $namespace );	// 上传策略。并设置空间名
            /*（可选）开发者可以在UploadPolicy设置路径和文件名，也可在上传选项UploadOption中设置用户自定义的参数*/
            $uploadOption = new \UploadOption();
            $uploadOption->dir = self::SPACE_PATH;	// 文件路径，(可选，默认根目录"/")
            $uploadOption->name = 'image_'.time();	// 文件名，(可选，不能包含"/"。若为空，则默认使用文件名)

            /*第三步：（必须）进行文件上传*/
            $res = $aliImage->upload( $filename, $uploadPolicy, $uploadOption );
            return $res;
        }catch (\Exception $e){
        }

//        [
//            [code] => OK
//            [mimeType] => image / png
//            [dir] => /wechat
//            [message] => OK
//            [uri] => /wechat / image_1530267852
//            [url] => http://ueditor.image.alimmdn.com/wechat/image_1530267852
//            [isImage] => 1
//            [fileSize] => 116370
//            [requestId] => 3pbEwRJ2X7BJZAO02jD
//            [name] => image_1530267852
//            [eTag] => 110AE8DD64B5F065B08B25D5200FE14A
//            [fileModified] => 1530267763030
//            [fileId] => 0164 - 4b110121 - 8b7ab69e - 644a9315 - 4ece
//            [isSuccess] => 1
//        ]
    }

    public function getList($page = 1, $pageSize = 100){
        /*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
        $aliImage  = new \AlibabaImage(self::AK, self::SK);

        /* 3:获取指定目录下的文件列表*/
        $res = $aliImage->listFiles(self::SPACE, self::SPACE_PATH, $page, $pageSize);
        return $res;
        /*
         * [
                [result] => Array
                    (
                        [0] => Array
                            (
                                [createStamp] => 1530288592
                                [dir] => /wechat
                                [mimeType] => application/octet-stream
                                [modifyStamp] => 1530288592
                                [name] => image_1530288592
                                [namespace] => ueditor
                                [path] => /wechat/image_1530288592
                                [region] => hangzhou
                                [size] => 0
                                [url] => http://ueditor.file.alimmdn.com/wechat/image_1530288592
                            )
                    )
                [totalCount] => 8
                [requestId] => 9ff830f5c21041928c6e2afa76e20bd9
                [totalPage] => 1
                [isSuccess] => 1
            ]
         * */
    }
}