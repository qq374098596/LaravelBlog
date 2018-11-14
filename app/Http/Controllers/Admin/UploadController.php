<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{
	/**
	 * 继承自 vendor\symfony\http-foundation\File\UploadedFile.php
	 * get Client Original Extension  	获取客户原始扩展
	 * get Client Original Name   		获取客户原始名称
	 * get Client Mime Type    			获取客户端Mime类型
	 * guess Client Extension   		猜客户端扩展
	 * get Client Size    				获取客户端大小
	 * get Error   						得到错误
	 * is Valid    						已验证
	 * move   							移动
	 * get Max File size    			获取最大文件大小
	 * get Error Message    			获取错误消息
	 * @return [type] [description]
	 */
    public function upload()
    {
    	$file = Input::file('Filedata');
    	//var_dump(date('Ymd'));
    	if ($file->isValid()) {
    		// var_dump($file->getClientOriginalExtension());
    		//$realPath = $file->getRealPath();	//临时文件的绝对路径
    		$extension = $file->getClientOriginalExtension();	//上传文件的后缀
    		$newName = md5(date('YmdHis').mt_rand(100,999)) . '.' . $extension;	//重组文件名
    		$appPath = 'static/uploads/'.date('Ymd');
    		$path = $file->move(base_path().'/public/'.$appPath, $newName);	//移动到绝对路径
    		$urlpath = 'http://' .$_SERVER['HTTP_HOST'] . '/' . $appPath . '/' . $newName;
    		
    		// $data = [
    		// 	'url'=>$urlpath
    		// ];
    		return $urlpath;
    	}
    }
}
