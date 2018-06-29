<?php
namespace common\actions;

use Yii;
use kucha\ueditor\Uploader;
use yii\helpers\ArrayHelper;

class UEditorAction extends \kucha\ueditor\UEditorAction
{
    /**
     * 处理action
     */
    protected function handleAction()
    {
        $action = Yii::$app->request->get('action');
        switch ($action) {
            case 'config':
                $result = $this->config;
                $result = json_encode($result);
                break;
            /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                $result = $this->actionUpload();
                //处理返回的URL
//                if (substr($result['url'], 0, 1) != '/') {
//                    $result['url'] = '/' . $result['url'];
//                }
                break;
            /* 列出图片 */
            case 'listimage':
                /* 列出文件 */
            case 'listfile':
                $result = $this->actionList();
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = $this->actionCrawler();
                break;

            default:
                $result = [
                    'state' => '请求地址出错'
                ];
                break;
        }
        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                echo json_encode([
                    'state' => 'callback参数不合法'
                ]);
            }
        } else {
            echo $result;
        }
    }

    /**
     * 上传
     * @return string
     */
    protected function actionUpload()
    {
        $base64 = "upload";
        switch (htmlspecialchars($_GET['action'])) {
            case 'uploadimage':
                $config = [
                    "pathRoot"   => ArrayHelper::getValue($this->config, "imageRoot", $_SERVER['DOCUMENT_ROOT']),
                    "pathFormat" => $this->config['imagePathFormat'],
                    "maxSize"    => $this->config['imageMaxSize'],
                    "allowFiles" => $this->config['imageAllowFiles']
                ];
                $fieldName = $this->config['imageFieldName'];
                break;
            case 'uploadscrawl':
                $config = [
                    "pathRoot"   => ArrayHelper::getValue($this->config, "scrawlRoot", $_SERVER['DOCUMENT_ROOT']),
                    "pathFormat" => $this->config['scrawlPathFormat'],
                    "maxSize"    => $this->config['scrawlMaxSize'],
                    "allowFiles" => $this->config['scrawlAllowFiles'],
                    "oriName"    => "scrawl.png"
                ];
                $fieldName = $this->config['scrawlFieldName'];
                $base64 = "base64";
                break;
            case 'uploadvideo':
                $config = [
                    "pathRoot"   => ArrayHelper::getValue($this->config, "videoRoot", $_SERVER['DOCUMENT_ROOT']),
                    "pathFormat" => $this->config['videoPathFormat'],
                    "maxSize"    => $this->config['videoMaxSize'],
                    "allowFiles" => $this->config['videoAllowFiles']
                ];
                $fieldName = $this->config['videoFieldName'];
                break;
            case 'uploadfile':
            default:
                $config = [
                    "pathRoot"   => ArrayHelper::getValue($this->config, "fileRoot", $_SERVER['DOCUMENT_ROOT']),
                    "pathFormat" => $this->config['filePathFormat'],
                    "maxSize"    => $this->config['fileMaxSize'],
                    "allowFiles" => $this->config['fileAllowFiles']
                ];
                $fieldName = $this->config['fileFieldName'];
                break;
        }
        /* 生成上传实例对象并完成上传 */

        $up = new Uploader($fieldName, $config, $base64);
        /**
         * 得到上传文件所对应的各个参数,数组结构
         * array(
         *     "state" => "SUCCESS",          //上传状态，上传成功时必须返回"SUCCESS"
         *     "url" => "/image/201806/editor1530271443311961.jpg",            //返回的地址
         *     "title" => "editor1530271443311961.jpg",          //新文件名
         *     "original" => "warning.jpg",       //原始文件名
         *     "type" => ".jpg"            //文件类型
         *     "size" => "303220",         //文件大小
         * )
         */
        $info = $up->getFileInfo();
        if ($_GET['action']='uploadimage'){
            $wtUpload = new \common\widgets\Uploader();
            $filePath = $this->config['imageRoot'].$info['url'];
            $wtRes = $wtUpload->test_upload_file_c($filePath);
            $res = [
                "state"    => $info['state'],
                "url"      => $wtRes['uri'],
                "title"    => $info['title'],
                "original" => $info['original'],
                "type"     => $info['type'],
                "size"     => $info['size']
            ];
        }

        /* 返回数据 */
        return json_encode($res);
    }

    /**
     * 获取已上传的文件列表
     * @return string
     */
    protected function actionList()
    {
        /* 判断类型 */
        switch ($_GET['action']) {
            /* 列出文件 */
            case 'listfile':
                $allowFiles = $this->config['fileManagerAllowFiles'];
                $listSize = $this->config['fileManagerListSize'];
                $path = $this->config['fileManagerListPath'];
                break;
            /* 列出图片 */
            case 'listimage':
                $allowFiles = $this->config['imageManagerAllowFiles'];
                $listSize = $this->config['imageManagerListSize'];
                $path = $this->config['imageManagerListPath'];
                break;
            default:
        }
        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);
        /* 获取参数 */
        $size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
        $end = (int)$start + (int)$size;

        /* 获取文件列表 */
        $files = $this->getfiles($path, $allowFiles);
        if (!count($files)) {
            return json_encode([
                "state" => "no match file",
                "list"  => [],
                "start" => $start,
                "total" => count($files)
            ]);
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = []; $i < $len && $i >= 0 && $i >= $start; $i--) {
            $list[] = $files[$i];
        }
        //倒序
        //for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
        //    $list[] = $files[$i];
        //}

        /* 返回数据 */
        $result = json_encode([
            "state" => "SUCCESS",
            "list"  => $list,
            "start" => $start,
            "total" => count($files)
        ]);
        return $result;
    }

    /**
     * 抓取远程图片
     * @return string
     */
    protected function actionCrawler()
    {
        /* 上传配置 */
        $config = [
            "pathFormat" => $this->config['catcherPathFormat'],
            "maxSize"    => $this->config['catcherMaxSize'],
            "allowFiles" => $this->config['catcherAllowFiles'],
            "oriName"    => "remote.png",
            "pathRoot"   => $this->config['pathRoot']
        ];
        $fieldName = $this->config['catcherFieldName'];

        /* 抓取远程图片 */
        $list = [];
        if (isset($_POST[$fieldName])) {
            $source = $_POST[$fieldName];
        } else {
            $source = $_GET[$fieldName];
        }
        $wtUpload = new \common\widgets\Uploader();
        foreach ($source as $imgUrl) {
            //因为百度编辑器前端会把http://开头的当做远程地址,所以为了避免图片重复提交,得判断远程图片的来源
            if (strpos($imgUrl,'ueditor.image.alimmdn.com') !== false){
                continue;
            }

            $item = new Uploader($imgUrl, $config, "remote");
            $info = $item->getFileInfo();

            //同步到阿里顽兔
            $filePath = $this->config['pathRoot'].$info['url'];
            $wtRes = $wtUpload->test_upload_file_c($filePath);

            array_push($list, [
                "state"    => $info["state"],
                "url"      => $wtRes['uri'],
                "size"     => $info["size"],
                "title"    => htmlspecialchars($info["title"]),
                "original" => htmlspecialchars($info["original"]),
                "source"   => htmlspecialchars($imgUrl)
            ]);
        }

        /* 返回抓取数据 */
        return json_encode([
            'state' => count($list) ? 'SUCCESS' : 'ERROR',
            'list'  => $list
        ]);
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param       $path
     * @param       $allowFiles
     * @param array $files
     * @return array|null
     */
    protected function getfiles($path, $allowFiles, &$files = [])
    {
        if (!is_dir($path)) return null;
        if (substr($path, strlen($path) - 1) != '/') $path .= '/';
        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    $this->getfiles($path2, $allowFiles, $files);
                } else {
                    if (preg_match("/\.(" . $allowFiles . ")$/i", $file)) {
                        $dName = basename($path);
                        $files[] = [
                            'url'   => '/'.$dName.'/'.$file,
                            'mtime' => filemtime($path2)
                        ];
                    }
                }
            }
        }
        return $files;
    }

}