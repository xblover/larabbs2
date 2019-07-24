<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //redis test
    public function test(){
        // Redis::set('foo', 2);
        // echo Redis::get('foo');
        // $data = \Redis::del('foo');
        // $da = \Redis::exists('foo');
        \Redis::set('str','123');
        \Redis::append('str','_123');
        \Redis::get('str');
        \Redis::strlen('str');
        \Redis::rename('str','str2');
        \Redis::expire('str2',10);
        $data = \Redis::ttl('str2');//获取缓存时间
        $data = \Redis::substr('str2',0,2);//获取第一到第三位字符，结果为123
        $data = \Redis::keys('st*');//模糊搜索
        // dd($data);
        

        //队列
        $data = [1,2,3,4,5,6,'wa','oo','op','bar1','bar0'];
        \Redis::expire('set2',10);//设置过期时间为10秒
        \Redis::rpush('list1','bar1');
        \Redis::rpush('list1','bar0');
        \Redis::rpush('list1',$data);
        $data = \Redis::lpop('list1');//随机取一个值
        $data = \Redis::llen('list1');//获取长度
        dd($data);
        // $data = \Redis::lrange('list1',0,-1);//获取队列中所以的值
        // $data = \Redis::lindex('list1',9);//返回指定下标的队列元素
        // \Redis::ltrim('list1',0,3);//只保留队列前4个元素，其余的都删掉。
        // $data = \Redis::lrange('list1',0,-1);//结果显示为0，1，2，3，4
        // \Redis::rpush('list2','ab1');
        // \Redis::rpoplpush('list1','list2');//从list1中取最后一个元素，放入list2的首位
        // \Redis::rpoplpush('list2','list2');
        // \Redis::linsert('list2','before','ab1','123');//在队列list2中的ab1之前插入123
        // \Redis::linsert('list2','after','ab1','456');//在队列list2中的ab1之后插入456
        // $data = \Redis::lrange('list2',0,-1);


    }
}
