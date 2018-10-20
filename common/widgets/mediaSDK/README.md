#当前SDK版本: v2.0.1

#支持PHP 5.3及以上

本sdk基于[REST API](http://baichuan.taobao.com/doc2/detail.htm?spm=0.0.0.0.h4ggyE&treeId=38&articleId=102763&docType=1)接口开发。目录介绍如下所示：

```
|—— alimedia: 该文件夹即为PHP SDK。
　　|—— alimage.class.php: 用户使用PHP SDK需要引入该文件
|—— demo: 该文件夹下包含SDK中所有接口的调用示例。
　　|—— image: 存放测试图片
　　|—— upload.php: 调用上传接口，进行文件上传的示例
　　|—— uploadData.php: 调用上传接口，进行字符串上传的示例
　　|—— uploadMutipart.php: 调用分片上传接口，创建分片上传任务的示例
　　|—— manage.php: 调用管理接口，进行资源管理和使用特色服务的示例
|—— README.md: 介绍文档
```

# 使用说明
## 约定
所有接口都是集成到AlibabaImage类中。
返回值为PHP 数组array结构。根据array中isSuccess判断是否调用成功。
如果失败具体详细信息请参考code,message字段内容
类如上传成功时返回：
```php
array(13) {
  'eTag' =>  string(32) "E523542F5F69268CC1999081B405E7DE"
  'requestId' =>  string(36) "a4de8f2b-0808-433f-ac4b-b9e4eeca5336"
  'code' =>  string(2) "OK"
  'url' =>  string(73) "http://qinning2.image.alimmdn.com/PENGUY/appTemp/phpSdk/image_c1449469480"
  'isSuccess' =>  bool(true)
}
```

如果调用返回错误：
```php
array(4) {
  ["message"]=>  string(13) "InternalError"
  ["requestId"]=>  string(36) "390671e3-d2a8-4425-be76-c081119d5813"
  ["code"]=>  string(13) "InternalError"
  ["isSuccess"]=>  bool(false)
}
```


