<?php
/**
 * Created by PhpStorm.
 * User: diwuh
 * Date: 2018/4/26
 * Time: 9:31
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Tests\Writer\BackupDumper;

/**
 * Class manage
 * @package App\Model
 * 权限管理的一些方法
 */
class manage extends Model
{
    public static function group_list(){
    }

    /**
     * 列表
     */
    public static function list($admin_id){
        $admin = admin::admin_info($admin_id,['id','auth_group_id'],'id');//查出会员信息
        $auth_group = DB::table('auth_group')->whereIn('id',explode(',',$admin->auth_group_id))->select()->get();//查出所属的角色组
        if ($admin_id ==1){
            $auth_list = DB::table('auth_list')->where([['father_id', 0],['status',1],['type','<>','1']])->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
        }else{
            $url_list = array_unique(explode(',',$auth_group->rulers));//转换为数组并去掉重复著
            $auth_list = DB::table('auth_list')->where([['father_id', 0],['status',1],['type','<>','1']])->whereIn('id',$url_list)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
        }
        $list = '';
        foreach ($auth_list as &$vo) {
            if ($admin_id ==1){
                $level = DB::table('auth_list')->where([['father_id', $vo->id]])->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
            }else{
                $level = DB::table('auth_list')->where([['father_id',$vo->id],['status',1],['type','<>','1']])->whereIn('id',$url_list)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
            }
            $li ='';
           foreach ($level as $dd){
                   $li .= " <!-- 利用data-target指定URL -->
                    <li><a href=\"url($dd->url)\" target=\"view_window\"><i class=\"{$dd->icon}\"></i>&nbsp;{$dd->name}</a></li>";
                }
            $list .= "<li class=\"has-sub\">
                        <a href=\"javascript:void(0);\"><span class=\"{$vo->icon}\"></span> &nbsp;{$vo->name}<i class=\"fa fa-caret-right fa-fw pull-right\"></i></a>
                        <ul class=\"sub-menu\">
                            {$li}
                        </ul>
                     </li>";
        }
        $data = "<div class=\"sidebar\">
        <ul class=\"nav\">
            {$list}
        </ul>
    </div>";
        return $data;
    }
}