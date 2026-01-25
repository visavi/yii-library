<?php
$yii=dirname(__FILE__).'/../framework/yii.php';
$user = new User();
$user->username = 'admin';
$user->password = CPasswordHelper::hashPassword('secret');
$user->email = 'test@example.com';
$user->created_at = time();
$user->save();
