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
}