<?php

namespace console\controllers;
use common\widgets\Uploader;
use Yii;
use yii\db\Query;

/**
 * Class FakeController
 * @package console\controllers
 * @property Uploader|\common\widgets\Uploader $uploadAli
 */
class FakeController extends \yii\console\Controller
{
    private $uploadAli;
    function init()
    {
        Yii::$app->setComponents(
            [
                'db' => [
                    'class'       => 'yii\db\Connection',
                    'dsn'         => 'mysql:host=gz-cdb-ecmy83dx.sql.tencentcdb.com;port=62387;dbname=bdm314524321_db',
                    'username'    => 'root',
                    'password'    => 'hjzhome888',
                    'charset'     => 'GBK',
                    'tablePrefix' => 'ecs_',
                ],
            ]
        );
        $this->uploadAli = new Uploader();
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @param $path
     * @param int $isOrigin
     * @return array
     */
    public function upload($path,$isOrigin=0)
    {
        //获取荟家装服务器图片, 判断本地是否存在, 不存在则获取图片保存在临时文件夹, 再用临时地址上传到顽兔, 上传前验证文件目录是否存在
        // file_get_contents() gbk地址请求-no  utf8地址请求-yes
        // file_put_contents() gbk保存地址-yes  utf8保存地址-yes(地址乱码)
        // test_upload_file_c() 文件名编码必须为utf8
        // urldecode() 解决因为url编码图片不能访问的问题
        try{
            $basePath = "http://tx.hjzhome.com/";
            $localRoot = $isOrigin?"/home/image/":"E:\phpStudy\PHPTutorial\WWW\hjz\htdocs/";
            $localPutRoot = $isOrigin?"/home/image/":"E:\phpStudy\PHPTutorial\WWW\hjz\htdocs/images/alishi4/";

            $filename = $basePath.$path;//远程地址
            $localFilename = $localRoot.$path;//本地图片库
            $urldepath = mb_strpos($path, '%')!==false? iconv("utf-8","gbk", urldecode($path)):$path;//urldecode 转码,转码后为utf8,再转为gbk
            $localPutFilename = $localPutRoot.basename($urldepath);//本地临时图片地址
            $space = 'hjzimage'; //顽兔图片空间
            $spacePath = dirname($path); //空间相对路径

            if (!is_file($localFilename)){
                //保存到临时文件夹
                $filename = iconv("gbk","utf-8", $filename);
                $origin = file_get_contents($filename);
                file_put_contents($localPutFilename, $origin);
                $localFilename = iconv("gbk","utf-8", $localPutFilename);
            }
//            p($localFilename,1);
            $wtRes = $this->uploadAli->test_upload_file_c($localFilename, $space, $spacePath);
            return $wtRes;
        }catch (\Exception $e){
            p($e->getMessage());
            p(__METHOD__);
            return [];
        }
    }

    /**
     * 缩略图,封面图, 上传到百川顽兔
     * @param int $start
     * @param int $end
     * @throws \yii\db\Exception
     */
    public function actionGetData($start=0, $end=0){
//        $origin = file_get_contents("http://tx.hjzhome.com/images/201809/thumb_img/212_thumb_G_1536284906395.jpg");
//        file_put_contents("E:\phpStudy\PHPTutorial\WWW\hjz\htdocs/images/alishi4/123.jpg", $origin);
        //p($end,1);
        $db = Yii::$app->getDb();
        $data = (new Query())->select("goods_id,tuijie_img,goods_thumb,goods_img")
            ->from("ecs_goods")
//            ->where(['between', 'goods_id', $start, $end])
            ->limit($start)
            ->orderBy("goods_img desc")
            ->all($db);
//        p($data,1);
        foreach ($data as $goodimgs){
            $status = ['goods_id'=>$goodimgs['goods_id'], 'tuijie_img'=>0,'goods_thumb'=>0,'goods_img'=>0];//默认状态,'original_img'=>0
            $good_id = $goodimgs['goods_id'];
            foreach ($goodimgs as $attr => $img){
                $existHjzhome = strpos($img,'hjzhome.com');//未上传到顽兔的图片
                if ($attr!="goods_id" && $img && !$existHjzhome){
//                    p("$attr:{$img}".PHP_EOL.PHP_EOL);
                    $res = $this->upload($img);
                    if (array_key_exists('code',$res) && $res['code']=="OK"){
                        $status[$attr] = 1;
                        //更新数据库字段
                        $fullPath = 'http://image.hjzhome.com/'.$img;
                        $db->createCommand()->update('ecs_goods',[$attr=>$fullPath],['goods_id'=>$good_id])->execute();
                    }
                    p("good_id:{$good_id} -- {$attr}:{$status[$attr]}".PHP_EOL.PHP_EOL);
                }
                usleep(800);
            }
            $db->createCommand()->insert('move_ali_log',$status)->execute();
        }
    }

    /**
     * 富文本图片上传顽兔
     * @param int $start
     * @param int $end
     * @throws \yii\db\Exception
     */
    public function actionDescUpload($start=0, $end=0, $isOrigin=0){
        $db = Yii::$app->getDb();
        $data = (new Query())->select("goods_id,goods_desc_images")
            ->from("move_ali_log")
            ->where(['between', 'goods_id', $start, $end])
            ->all($db);
//        p($data,1);
        foreach ($data as $v){

            if(empty($v['goods_desc_images'])){
                continue;
            }
            $imageArr = explode(',', $v['goods_desc_images']);
            $status = 1;
            foreach ($imageArr as $vv){
                //判断图片格式
                $postfix = trim(strrchr($vv, '.'),'.');
                if (in_array($postfix, ["jpg","png","gif","jpeg"])){
                    $res = $this->upload($vv, $isOrigin);
                    if (!array_key_exists('code',$res) || $res['code']!="OK"){
                        $status = 0;
                        $res['url'] = "";
                        p($res);
                        //记录上传失败的图片地址
                        $db->createCommand()->insert('move_ali_fail_log',["url"=>$vv, "goods_id"=>$v['goods_id']])->execute();
                    }
                    p("good_id:{$v['goods_id']} -- {$vv} -- {$res['url']}".PHP_EOL.PHP_EOL);
                    usleep(1000);
                }
            }
            $db->createCommand()->update('move_ali_log',["goods_desc"=>$status],["goods_id"=>$v['goods_id']])->execute();
        }
    }

    /**
     * 商品图册图片上传
     * @param int $start
     * @param int $end
     * @throws \yii\db\Exception
     */
    public function actionGalleryUpload($start=0, $end=0){
        $db = Yii::$app->getDb();
        $data = (new Query())->select("goods_id,img_url,thumb_url")//,img_original
            ->from("ecs_goods_gallery")
            ->limit($start)
            ->orderBy("img_url desc")
//            ->where(['between', 'goods_id', $start, $end])
            ->all($db);
//        p($data,1);
        foreach ($data as $v){
            $status = 1;
            $good_id = $v['goods_id'];
            foreach ($v as $k => $vv){
                $existHjzhome = strpos($vv,'hjzhome.com');//未上传到顽兔的图片
                if ($k=="goods_id" || empty($vv) || $existHjzhome){
                    continue;
                }
                //判断图片格式
                $res = $this->upload($vv);
                if (!array_key_exists('code',$res) || $res['code']!="OK"){
                    $status = 0;
                    $res['url'] = "";
                }else{
                    //更新数据库字段
                    $fullPath = 'http://image.hjzhome.com/'.$vv;
                    $db->createCommand()->update('ecs_goods_gallery',[$k=>$fullPath],['goods_id'=>$good_id])->execute();
                }
                p("{$v['goods_id']} -- {$status} -- {$vv} -- {}".PHP_EOL.PHP_EOL);
                usleep(800);
            }
            $db->createCommand()->update('move_ali_log',["goods_gallery"=>$status],["goods_id"=>$v['goods_id']])->execute();
        }
    }

    /**
     *  主题图片
     * @param int $start
     * @param int $end
     * @param int $isOrigin
     * @throws \yii\db\Exception
     */
    public function actionTopic($start=0, $end=0, $isOrigin=0){
//        $img = iconv("utf-8","gbk","/images/upload/Image/红底新logo.jpg");
//        $res = $this->upload($img);
//        p($res,1);
        $db = Yii::$app->getDb();
        $data = (new Query())->select("goods_desc_images")
            ->from("move_ali_log")
            ->where(['goods_id'=>3])
            ->scalar($db);
        $imageArr = explode(',', $data);
        foreach ($imageArr as $vv){
            //判断图片格式
            $postfix = trim(strrchr($vv, '.'),'.');
            if (in_array($postfix, ["jpg","png","gif","jpeg"])){
                $res = $this->upload($vv);
                if (!array_key_exists('code',$res) || $res['code']!="OK"){
                    $res['url'] = "";
                    p($res);
                    //记录上传失败的图片地址
                    $db->createCommand()->insert('move_ali_fail_log',["url"=>$vv, "goods_id"=>3])->execute();
                }
                p("{$vv} -- {$res['url']}".PHP_EOL.PHP_EOL);
                usleep(1000);
            }
        }
    }

    /**
     * 上传失败记录表
     * @throws \yii\db\Exception
     */
    public function actionFailRecall(){
        $db = Yii::$app->getDb();
        $goodsId = (new Query())->select("goods_id")
            ->from("move_ali_fail_log")
            ->where(["status"=>0,"is_all"=>1])
            ->column();

        $data = (new Query())->select("goods_id,goods_desc_images")
            ->from("move_ali_log")
            ->where(['in', 'goods_id',$goodsId])
            ->all($db);

        foreach ($data as $v){
            if(empty($v['goods_desc_images'])){
                continue;
            }
            $imageArr = explode(',', $v['goods_desc_images']);
            $status = 1;
            foreach ($imageArr as $vv){
                //判断图片格式
                $postfix = trim(strrchr($vv, '.'),'.');
                if (in_array($postfix, ["jpg","png","gif","jpeg"])){
                    $res = $this->upload($vv);
                    if (!array_key_exists('code',$res) || $res['code']!="OK"){
                        $status = 0;
                        $res['url'] = "";
                        p($res);
                        //记录上传失败的图片地址
                        $db->createCommand()->insert('move_ali_fail_log',["url"=>$vv, "goods_id"=>$v['goods_id']])->execute();
                    }
                    p("good_id:{$v['goods_id']} -- {$vv} -- {$res['url']}".PHP_EOL.PHP_EOL);
                    usleep(1000);
                }
            }
            $db->createCommand()->update('move_ali_fail_log',["status"=>$status],["goods_id"=>$v['goods_id']])->execute();
        }
    }

    /**
     * 复制地址上传到顽兔
     * 坑点 1.因为控制台输入url内容编码为GBK,所以得转码为UTF8后再做urlencode
     * @param string $url
     */
    public function actionUrlUpload($item="",$type=1){
        //可获取远程内容地址
        //images/upload/Image/%E5%B0%9A%E9%AB%98%E5%8D%AB%E6%B5%B4%20%E6%B7%8B%E6%B5%B4%E5%B1%8F-2(2).jpg
        //images/upload/Image/%C9%D0%B8%DF%CE%C0%D4%A1%20%C1%DC%D4%A1%C6%C1-2%282%29.jpg
        //images/upload/Image/%E5%B0%9A%E9%AB%98%E5%8D%AB%E6%B5%B4%20%E6%B7%8B%E6%B5%B4%E5%B1%8F-2%282%29.jpg

        if ($type==1){
            $url = (new Query())->from("move_ali_log")
                ->select("goods_desc_images")
                ->where(['goods_id'=>$item])
                ->scalar();
            $url = strpos($url, 'Git')!==false? ltrim(strstr($url,"t"),'t'):$url;
            $url = strpos($url, ',')!==false? explode(',',$url) : $url;
            foreach ($url as $k=> $v){
                try{
                    $rawUrl = dirname($v).'/'.rawurlencode(iconv("gbk","utf-8", basename($v)));

                    $origin = file_get_contents("http://www.hjzhome.com/".$rawUrl);
                    $localFilename = "E:\phpStudy\PHPTutorial\WWW\hjz\htdocs\images\alishi3/".basename($v);
                    file_put_contents($localFilename, $origin);//p($rawUrl.PHP_EOL.PHP_EOL,1);
                    $localFilename = iconv("gbk","utf-8", $localFilename);
                    $res = $this->uploadAli->test_upload_file_c($localFilename, "hjzimage", dirname($v));
                    p($res);
                }catch (\Exception $e){
                    p($k);
                    p($e->getMessage());
                }
            }
        }elseif ($type==2){
            $v = $item;
            $rawUrl = dirname($v).'/'.rawurlencode(iconv("gbk","utf-8", basename($v)));
            $origin = file_get_contents("http://4d.hjzhome.com/".$rawUrl);
            $localFilename = "E:\phpStudy\PHPTutorial\WWW\hjz\htdocs\images\alishi3/".basename($v);
            file_put_contents($localFilename, $origin);
            $localFilename = iconv("gbk","utf-8", $localFilename);
            $res = $this->uploadAli->test_upload_file_c($localFilename, "hjzimage", dirname($v));
            p($res);
        }elseif ($type==3){
            $item = iconv("gbk", "utf-8", $item);
            $res = $this->upload($item);
            p($res);
        }
    }

    public function actionZw(){
//        $urlen = "/images/upload/Image/%E5%85%A8%E6%99%AF%E6%95%88%E6%9E%9C%E8%AF%A6%E7%BB%86%E9%A1%B5_03.jpg";
//        $decode = urldecode("%E5%85%A8%E6%99%AF%E6%95%88%E6%9E%9C%E8%AF%A6%E7%BB%86%E9%A1%B5_03.jpg");
//        $decode = urldecode("/images/upload/Image/%E5%85%A8%E6%99%AF%E6%95%88%E6%9E%9C%E8%AF%A6%E7%BB%86%E9%A1%B5_03.jpg");
//        $decode = iconv("utf-8","gbk", $decode);
//        $decode = mb_strpos($urlen, '%');
//        p($decode,1);
        $wtRes=$this->upload("/images/upload/Image/%E5%85%A8%E6%99%AF%E6%95%88%E6%9E%9C%E8%AF%A6%E7%BB%86%E9%A1%B5_03.jpg");
        p($wtRes,1);
        $res = Yii::$app->db->createCommand("select url from move_ali_fail_log where goods_id=9999")->queryScalar();
        $file = "http://www.hjzhome.com/".$res;
        $putFile = "E:\phpStudy\PHPTutorial\WWW\hjz\htdocs/images/alishi/".basename($res);
        $utf8 = iconv("gbk", "utf-8", $file);
        $origin = file_get_contents($utf8);
        file_put_contents($putFile, $origin);
        try{
            $putFile = iconv("GB2312", "UTF-8", $putFile);
            $wtRes = $this->uploadAli->test_upload_file_c($putFile, "hjzimage", dirname($res));
        }catch (\Exception $e){
//            p($e->getMessage());
        }
        p($wtRes);
    }

}
