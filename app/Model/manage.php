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
    public static function group_list()
    {
    }

    /**
     * 后台列表
     */
    public static function list($admin_id)
    {
        $admin = admin::admin_info($admin_id, ['auth_group_id'], 'id');//查出会员信息
        $auth_group = DB::table('auth_group')->whereIn('id', explode(',', $admin->auth_group_id))->value('rulers');//查出所属的角色组
        if ($admin_id == 1) {
            $auth_list = DB::table('auth_list')->where([['father_id', 0], ['status', 1], ['type', '<>', '1']])->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
        } else {
            $url_list = array_unique(explode(',', $auth_group));//转换成数组并去除重复值
            $auth_list = DB::table('auth_list')->where([['father_id', 0], ['status', 1], ['type', '<>', '1']])->whereIn('id', $url_list)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
        }
        $list = '';
        foreach ($auth_list as &$vo) {
            if ($admin_id == 1) {
                $level = DB::table('auth_list')->where([['father_id', $vo->id], ['type', 0]])->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
            } else {
                $level = DB::table('auth_list')->where([['father_id', $vo->id], ['status', 1], ['type', '<>', '1']])->whereIn('id', $url_list)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
            }
            $li = '';
            foreach ($level as $dd) {
                if ($dd->url == '#') {
                    $dd_url = 'javascript:void(0)';
                } else {
                    $dd_url = url($dd->url);
                }
                $li .= " <!-- 利用data-target指定URL -->
                    <li><a href=\"$dd_url\" target=\"view_window\"><i class=\"{$dd->icon}\"></i>&nbsp;{$dd->name}</a></li>";
            }
            if ($vo->url == '#') {
                $url = 'javascript:void(0)';
            } else {
                $url = url($vo->url);
            }
            $list .= "<li class=\"has-sub\">
                        <a href=\"$url\" target=\"view_window\"><span class=\"{$vo->icon}\"></span> &nbsp;{$vo->name}<i class=\"fa fa-caret-right fa-fw pull-right\"></i></a>
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

    /**
     * @param $admin_id
     * @return bool|string
     * 默认url
     */
    public static function defaultUrl($admin_id){
        $admin_users = admin::admin_info($admin_id, ['auth_group_id'], 'id');
        if ($admin_users->auth_group_id == ''){
            return false;
        }
        $group_list = explode(',', $admin_users->auth_group_id);
        foreach ($group_list as $vo) {
            $data[] = DB::table('auth_group')->where([['id', $vo], ['status', 1]])->value('rulers');
        }
        $url = implode(',', $data);//拼接成字符串
        $url_list = array_unique(explode(',', $url));//转换成数组并去除重复值
        $url = DB::table('auth_list')->where([['status', 1],['type', '<>', '1'],['url','<>','#']])->whereIn('id', $url_list)->value('url');
        return $url;
    }
}