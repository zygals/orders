<?php

namespace app\index\model;
use think\Model;

class Good extends model{

	public function getStatusAttr($value)
	{
		$status = [2=>'删除',1=>'正常',0=>'不显示'];
		return $status[$value];
	}
    //分页查询
    public function getAllGoods($data){
        $where = ['g.status'=>['<>',2]];

        $cate_id = isset($data['cate_id'])?$data['cate_id']:'';
        $name = isset($data['name'])?$data['name']:'';
        if(!empty($cate_id)){
            $where['cate_id'] = $cate_id;
        }
        !empty($name)?$where['g.name'] = ['like',"%$name%"]:'';


        $list=$this->order('g.create_time desc')->alias('g')->join('cate_shop_good cate','g.cate_id=cate.id','left')->where($where)->field('g.*,cate.name as cate_name')->paginate();
        //dump($list);

        return $list;
    }

}
