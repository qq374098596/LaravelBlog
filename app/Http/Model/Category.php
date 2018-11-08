<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;

    /**
     * 可以使用静态方法
     */
    // public static function tree()
    // {
    // 	$category = self::all();
    //     //dd($category);
    // 	return self::getTree($category,'cate_name','cate_id','cate_pid');
    // }

    public function tree()
    {
    	$category = $this->orderBy('cate_order','asc')->get();
        //dd($category);
    	return $this->getTree($category,'cate_name','cate_id','cate_pid');
    }

    /**
     * 处理分类数列排序
     * 
     */
    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        //dd($data);
        $arr = array();
        foreach ($data as $k => $v) {
            if ($v->$field_pid == $pid) {
                //echo $v->cate_name;
                $data[$k]['_'.$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $key => $value) {
                    if ($value->$field_pid == $v->$field_id) {
                        //echo $value->cate_name;
                        $data[$key]['_'.$field_name] = '╟—— ' . $data[$key][$field_name];
                        $arr[] = $data[$key];
                    }
                }
            }
        }
        //dd($arr);
        return $arr;
    }
}
