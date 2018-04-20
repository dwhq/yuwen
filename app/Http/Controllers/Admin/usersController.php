<?php
/**
 * Created by PhpStorm.
 * User: diwuh
 * Date: 2018/4/16
 * Time: 10:54
 */
namespace App\Http\Controllers\Admin;

use App\Model\word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{
    public function index(user $user){
        $data = $user->paginate(20);
        return view('Admin.users.index')
            ->with('data',$data);
    }
    public function word(word $word){
        $data = DB::table('word as a')->select('a.*','b.nickname','b.avatar','b.id as user_id')->join('users as b','b.id','=','a.name_id')->orderBy('id','desc')->paginate(20);
        return view('Admin.users.word')
            ->with('data',$data);
    }

    /**
     * @param Request $request
     * @param word $word
     * @return \Illuminate\Http\RedirectResponse
     * 删除留言
     */
    public function wordDelect(Request $request,word $word,$u_id){
        $delect = $word->where([['id',$u_id]])->delete();
        if ($delect){
            myflash()->success('删除成功');
        }else{
            myflash()->error('删除失败');
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param word $word
     * 隐藏留言  上级留言隐藏后就不显示下层的
     */
    public function wordState(Request $request,word $word){
        if ($request->isMethod('post')) {
            $id=$request->id;
            $show=$request->show;
            $a = $word->where([['id',$id]])->update(['state'=>$show]);

        }
    }
}