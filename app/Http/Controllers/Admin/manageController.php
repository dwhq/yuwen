<?php
/**
 * Created by PhpStorm.
 * User: diwuh
 * Date: 2018/4/25
 * Time: 15:04
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use LaravelChen\MyFlash\MyFlash;
use App\Model\admin;
use Illuminate\Support\Facades\DB;

class manageController extends Controller
{

    public function admin_list(Request $request, admin $admin)
    {
        $data = $admin->where([['status', 1]])->select('id', 'name', 'sex', 'email', 'mobile', 'time')->paginate(20);
        $name = '';
        if ($request->isMethod('post')) {
            $data = $admin->where([['status', 1], ['name', 'LIKE', $request->name]])->select('id', 'name', 'sex', 'email', 'mobile', 'time')->paginate(20);
            $name = $request->name;
        }
        return view('Admin.manage.admin_list')
            ->with('data', $data)
            ->with('name', $name);
    }

    /**
     * @param admin $admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * 删出管理员  软删除
     */
    public function delect(admin $admin, $id)
    {
        $data = $admin->where([['id', $id]])->update(['status' => 0]);
        if ($data) {
            myflash()->success('删除成功');
        } else {
            myflash()->error('删除失败');
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param admin $admin
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 添加管理员
     */
    public function add_admin(Request $request, admin $admin)
    {
        if ($request->isMethod('post')) {
            $auth_group_id = implode(',', $request->grout);
            $data['name'] = $request->name;
            $data['password'] = Hash::make($request->password);
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['sex'] = $request->sex;
            $data['time'] = time();
            $data['last_ip'] = $request->ip();
            $data['status'] = 1;
            $data['auth_group_id'] = $auth_group_id;
            $admins = $admin->create($data);
            if ($admins) {
                myflash()->success('添加成功');
                return redirect('admin/manage/admin_list');
            } else {
                myflash()->error('添加失败');
                return redirect()->back();
            }
        } else {
            //会员组列表
            $auth_group_list = DB::table('auth_group')->Where('status', 1)->select('id', 'title')->get();
            return view('Admin.manage.add_admin')
                ->with('auth_group_list', $auth_group_list);
        }
    }

    /**
     * @param Request $request
     * @param admin $admin
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 修改管理员信息
     */
    public function revamped_admin(Request $request, admin $admin, $id)
    {
        if ($request->isMethod('post')) {
            $auth_group_id = implode(',', $request->grout);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['sex'] = $request->sex;
            $data['auth_group_id'] = $auth_group_id;
            if ($request->password != '') $data['password'] = Hash::make($request->password);
            $admins = $admin->where('id', $id)->update($data);
            if ($admins) {
                myflash()->success('修改成功');
                return redirect('admin/manage/admin_list');
            } else {
                myflash()->error('修改失败');
                return redirect()->back();
            }
        } else {
            $admin_info = admin::admin_info($id, ['id', 'name', 'email', 'mobile', 'sex', 'auth_group_id'], 'id');
            $admin_info->grout = explode(',', $admin_info->auth_group_id);//把用户组字段转换为数组  方便前台调用
            //DB::enableQueryLog();
            $auth_group_list = DB::table('auth_group')->Where('status', 1)->select('id', 'title')->get();//会员组列表
            //dd(response() ->json(DB::getQueryLog())); //打印sql语句
            return view('Admin.manage.revamped_admin')
                ->with('admin_info', $admin_info)
                ->with('auth_group_list', $auth_group_list);
        }
    }

    /**
     * @param Request $request
     * @return $this
     * 模板列表
     */
    public function module_list(Request $request)
    {
        $data = DB::table('auth_list')->where('father_id', 0)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
        foreach ($data as &$vo) {
            $vo->level = DB::table('auth_list')->where('father_id', $vo->id)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
        }
        return view('Admin.manage.module_list')
            ->with('data', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 添加列表
     */
    public function add_url(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data['url'] = $request->url;
            $data['name'] = $request->name;
            $data['status'] = $request->status;
            $data['type'] = $request->type;
            $data['icon'] = $request->icon;
            $data['father_id'] = $id;
            $auth_list = DB::table('auth_list')->insertGetId($data);
            if ($auth_list) {
                myflash()->success('添加成功');
                return redirect()->back()->with('state',1);
            } else {
                myflash()->error('添加失败');
                return redirect()->back();
            }
        } else {
            //输出了一下要使用的标签
//            $array = array('glyphicon glyphicon-asterisk','glyphicon glyphicon-plus','glyphicon glyphicon-minus','glyphicon glyphicon-euro','glyphicon glyphicon-cloud','glyphicon glyphicon-envelope','glyphicon glyphicon-pencil','glyphicon glyphicon-glass','glyphicon glyphicon-music','glyphicon glyphicon-search','glyphicon glyphicon-heart','glyphicon glyphicon-star','glyphicon glyphicon-star-empty','glyphicon glyphicon-user','glyphicon glyphicon-film','glyphicon glyphicon-th-large','glyphicon glyphicon-th','glyphicon glyphicon-th-list','glyphicon glyphicon-ok','glyphicon glyphicon-remove','glyphicon glyphicon-zoom-in','glyphicon glyphicon-zoom-out','glyphicon glyphicon-off','glyphicon glyphicon-signal','glyphicon glyphicon-cog','glyphicon glyphicon-trash','glyphicon glyphicon-home','glyphicon glyphicon-file','glyphicon glyphicon-time','glyphicon glyphicon-road','glyphicon glyphicon-download-alt','glyphicon glyphicon-download','glyphicon glyphicon-upload','glyphicon glyphicon-inbox','glyphicon glyphicon-play-circle','glyphicon glyphicon-repeat','glyphicon glyphicon-refresh','glyphicon glyphicon-list-alt','glyphicon glyphicon-lock','glyphicon glyphicon-flag','glyphicon glyphicon-headphones','glyphicon glyphicon-volume-off','glyphicon glyphicon-volume-down','glyphicon glyphicon-volume-up','glyphicon glyphicon-qrcode','glyphicon glyphicon-barcode','glyphicon glyphicon-tag','glyphicon glyphicon-tags','glyphicon glyphicon-book','glyphicon glyphicon-bookmark','glyphicon glyphicon-print','glyphicon glyphicon-camera','glyphicon glyphicon-font','glyphicon glyphicon-bold','glyphicon glyphicon-italic','glyphicon glyphicon-text-height','glyphicon glyphicon-text-width','glyphicon glyphicon-align-left','glyphicon glyphicon-align-center','glyphicon glyphicon-align-right','glyphicon glyphicon-align-justify','glyphicon glyphicon-list','glyphicon glyphicon-indent-left','glyphicon glyphicon-indent-right','glyphicon glyphicon-facetime-video','glyphicon glyphicon-picture','glyphicon glyphicon-map-marker','glyphicon glyphicon-adjust','glyphicon glyphicon-tint','glyphicon glyphicon-edit','glyphicon glyphicon-share','glyphicon glyphicon-check','glyphicon glyphicon-move','glyphicon glyphicon-step-backward','glyphicon glyphicon-fast-backward','glyphicon glyphicon-backward','glyphicon glyphicon-play','glyphicon glyphicon-pause','glyphicon glyphicon-stop','glyphicon glyphicon-forward','glyphicon glyphicon-fast-forward','glyphicon glyphicon-step-forward','glyphicon glyphicon-eject','glyphicon glyphicon-chevron-left','glyphicon glyphicon-chevron-right','glyphicon glyphicon-plus-sign','glyphicon glyphicon-minus-sign','glyphicon glyphicon-remove-sign','glyphicon glyphicon-ok-sign','glyphicon glyphicon-question-sign','glyphicon glyphicon-info-sign','glyphicon glyphicon-screenshot','glyphicon glyphicon-remove-circle','glyphicon glyphicon-ok-circle','glyphicon glyphicon-ban-circle','glyphicon glyphicon-arrow-left','glyphicon glyphicon-arrow-right','glyphicon glyphicon-arrow-up','glyphicon glyphicon-arrow-down','glyphicon glyphicon-share-alt','glyphicon glyphicon-resize-full','glyphicon glyphicon-resize-small','glyphicon glyphicon-exclamation-sign','glyphicon glyphicon-gift','glyphicon glyphicon-leaf','glyphicon glyphicon-fire','glyphicon glyphicon-eye-open','glyphicon glyphicon-eye-close','glyphicon glyphicon-warning-sign','glyphicon glyphicon-plane','glyphicon glyphicon-calendar','glyphicon glyphicon-random','glyphicon glyphicon-comment','glyphicon glyphicon-magnet','glyphicon glyphicon-chevron-up','glyphicon glyphicon-chevron-down','glyphicon glyphicon-retweet','glyphicon glyphicon-shopping-cart','glyphicon glyphicon-folder-close','glyphicon glyphicon-folder-open','glyphicon glyphicon-resize-vertical','glyphicon glyphicon-resize-horizontal','glyphicon glyphicon-hdd','glyphicon glyphicon-bullhorn','glyphicon glyphicon-bell','glyphicon glyphicon-certificate','glyphicon glyphicon-thumbs-up','glyphicon glyphicon-thumbs-down','glyphicon glyphicon-hand-right','glyphicon glyphicon-hand-left','glyphicon glyphicon-hand-up','glyphicon glyphicon-hand-down','glyphicon glyphicon-circle-arrow-right','glyphicon glyphicon-circle-arrow-left','glyphicon glyphicon-circle-arrow-up','glyphicon glyphicon-circle-arrow-down','glyphicon glyphicon-globe','glyphicon glyphicon-wrench','glyphicon glyphicon-tasks','glyphicon glyphicon-filter','glyphicon glyphicon-briefcase','glyphicon glyphicon-fullscreen','glyphicon glyphicon-dashboard','glyphicon glyphicon-paperclip','glyphicon glyphicon-heart-empty','glyphicon glyphicon-link','glyphicon glyphicon-phone','glyphicon glyphicon-pushpin','glyphicon glyphicon-usd','glyphicon glyphicon-gbp','glyphicon glyphicon-sort','glyphicon glyphicon-sort-by-alphabet','glyphicon glyphicon-sort-by-alphabet-alt','glyphicon glyphicon-sort-by-order','glyphicon glyphicon-sort-by-order-alt','glyphicon glyphicon-sort-by-attributes','glyphicon glyphicon-sort-by-attributes-alt','glyphicon glyphicon-unchecked','glyphicon glyphicon-expand','glyphicon glyphicon-collapse-down','glyphicon glyphicon-collapse-up','glyphicon glyphicon-log-in','glyphicon glyphicon-flash','glyphicon glyphicon-log-out','glyphicon glyphicon-new-window','glyphicon glyphicon-record','glyphicon glyphicon-save','glyphicon glyphicon-open','glyphicon glyphicon-saved','glyphicon glyphicon-import','glyphicon glyphicon-export','glyphicon glyphicon-send','glyphicon glyphicon-floppy-disk','glyphicon glyphicon-floppy-saved','glyphicon glyphicon-floppy-remove','glyphicon glyphicon-floppy-save','glyphicon glyphicon-floppy-open','glyphicon glyphicon-credit-card','glyphicon glyphicon-transfer','glyphicon glyphicon-cutlery','glyphicon glyphicon-header','glyphicon glyphicon-compressed','glyphicon glyphicon-earphone','glyphicon glyphicon-phone-alt','glyphicon glyphicon-tower','glyphicon glyphicon-stats','glyphicon glyphicon-sd-video','glyphicon glyphicon-hd-video','glyphicon glyphicon-subtitles','glyphicon glyphicon-sound-stereo','glyphicon glyphicon-sound-dolby','glyphicon glyphicon-sound-5-1','glyphicon glyphicon-sound-6-1','glyphicon glyphicon-sound-7-1','glyphicon glyphicon-copyright-mark','glyphicon glyphicon-registration-mark','glyphicon glyphicon-cloud-download','glyphicon glyphicon-cloud-upload','glyphicon glyphicon-tree-conifer','glyphicon glyphicon-tree-deciduous');
//            foreach ($array as $vo){
//
//                $str =  '<span class="'.$vo.'" onclick="'.'iocn(\''.$vo.'\')"></span>';
//                echo htmlentities($str,ENT_QUOTES,"UTF-8").'</br>';
//            }
//            exit();
            return view('Admin.manage.add_url')
                ->with('state', session()->get('state'))//添加成功后传值到页面关闭页面
                ->with('id', $id);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 修改列表
     */
    public function alter_url(Request $request, $id){
        if ($request->isMethod('post')) {
            $data['url'] = $request->url;
            $data['name'] = $request->name;
            $data['status'] = $request->status;
            $data['type'] = $request->type;
            $data['icon'] = $request->icon;
            //$data['father_id'] = $id;
            $auth_list = DB::table('auth_list')->where('id',$id)->update($data);
            if ($auth_list) {
                myflash()->success('修改成功');
                return redirect()->back()->with('state',1);
            } else {
                myflash()->error('修改失败');
                return redirect()->back();
            }
        } else {
            $data = DB::table('auth_list')->where('id',$id)->select('id','url','type','name','status','father_id','icon')->first();
            return view('Admin.manage.alter_url')
                ->with('state', session()->get('state'))//添加成功后传值到页面关闭页面
                ->with('data', $data);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * 删除路由
     */
    public function delete_url(Request $request){
        $id = $request->id;
        $auth_list = DB::table('auth_list')->where('father_id',$id)->exists();
        //如果下级有auth则不能删除
        if (!$auth_list){
            $auth = DB::table('auth_list')->where('id',$id)->delete();
            if ($auth){
                $data['info'] = '删除成功';
                $data['state'] = 1;
            }else{
                $data['info'] = '删除失败';
                $data['state'] = 0;
            }
        }else{
            $data['info'] = '下面有控制器不能删除';
            $data['state'] = 0;
        }
        return $data;
    }

    /**
     * @param Request $request
     * @return mixed
     * 修改模板状态
     */
    public function show_url(Request $request){
        $id = $request->id;
        $status =  $request->status;
        $auth = DB::table('auth_list')->where('id',$id)->update(['status'=>$status]);
        if ($auth){
            $data['info'] = '修改成功';
            $data['state'] = 1;
        }else{
            $data['info'] = '修改失败';
            $data['state'] = 0;
        }
        return $data;
    }

    /**
     * @return $this
     * 角色列表
     */
    public function auth_group_list(Request $request){
        $data = DB::table('auth_group')->paginate(20);
        $title = '';
        if ($request->isMethod('post')) {
            $title = $request->title;
            $data = DB::table('auth_group')->where('title',$title)->paginate(20);

        }
        return view('Admin.manage.auth_group_list')
            ->with('data',$data)
            ->with('title',$title);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * 添加角色
     */
    public function add_auth_group(Request $request){
        if ($request->isMethod('post')) {
            $rulers = implode(',', $request->rulers);
            $data['title'] = $request->title;
            $data['rulers'] = $rulers;
            $data['status'] = 1;
            $data['time'] = time();
            $data['remark'] = $request->remark;
            $info = DB::table('auth_group')->insertGetId($data);
            if ($info) {
                myflash()->success('添加成功');
                return redirect('admin/manage/auth_group_list');
            } else {
                myflash()->error('添加失败');
                return redirect()->back();
            }
        }else{
            $data = DB::table('auth_list')->where('father_id', 0)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
            foreach ($data as &$vo) {
                $vo->level = DB::table('auth_list')->where('father_id', $vo->id)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
            }
            return view('Admin.manage.add_auth_group')
                ->with('data' ,$data);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * 删除角色
     */
    public function delete_auth_group(Request $request){
        $id = $request->id;
        $auth = DB::table('auth_group')->where('id',$id)->delete();
            if ($auth){
                $data['info'] = '删除成功';
                $data['state'] = 1;
            }else{
                $data['info'] = '删除失败';
                $data['state'] = 0;
            }
        return $data;
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function revamped_auth_group (Request $request,$id){
        if ($request->isMethod('post')) {
            $rulers = implode(',', $request->rulers);
            $data['title'] = $request->title;
            $data['rulers'] = $rulers;
            $data['time'] = time();
            $data['status'] = 1;
            $info = DB::table('auth_group')->where('id',$id)->update($data);
            if ($info) {
                myflash()->success('修改成功');
                return redirect('admin/manage/auth_group_list');
            } else {
                myflash()->error('修改失败');
                return redirect()->back();
            }
        }else{
            $data = DB::table('auth_list')->where('father_id', 0)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
            foreach ($data as &$vo) {
                $vo->level = DB::table('auth_list')->where('father_id', $vo->id)->select('id', 'icon', 'url', 'name', 'status', 'father_id')->get();
            }
            $info = DB::table('auth_group')->where('id',$id)->first();

            $info->rulers= (explode(',',$info->rulers));//把rulers  转换为数组  方便页面使用
            return view('Admin.manage.revamped_auth_group')
                ->with('data',$data)
                ->with('info',$info);
        }
    }
}