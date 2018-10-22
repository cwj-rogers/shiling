<?php
/* 设置 path 别名 */
Yii::setAlias('@base', dirname(dirname(__DIR__))); //项目根目录path
Yii::setAlias('@common', dirname(__DIR__)); //公共目录path
Yii::setAlias('@hjzhome', dirname(dirname(__DIR__)) . '/hjzhome'); //存储目录path
