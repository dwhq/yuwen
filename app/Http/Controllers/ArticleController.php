<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
   public function index () {
       return '这里是index方法';
   }
   public function create () {
       return '这里是create方法';
   } 
}
