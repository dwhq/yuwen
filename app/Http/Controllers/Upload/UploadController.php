<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use OSS\Core\OssException;
use OSS\OssClient;

class UploadController extends Controller
{
    //
    public function upload(Request $request)
    {

        if ($request->isMethod('post')) {
            $file = $request->file('file');
            // 文件是否上传成功
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg
                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称
                $bool = Storage::disk('local')->put($filename, file_get_contents($realPath));
                $ossurl = $this->oss_aliyun($realPath,$filename);
                return ['url'=>asset('storage/uploads/' . $filename),'ossurl'=>$ossurl];
            }
        }
        return '上传失败';
    }

    public function oss_aliyun($pic,$name)
    {
        $config = config('filesystems.disks.oss');
        $bucket = 'yuwenb';
        try {
            $ossClient = new OssClient($config['access_id'], $config['access_key'], $config['endpoint']);
            $filePath = basename($name);
            $info = $ossClient->uploadFile($bucket, 'yuwen/images/' . $filePath, $pic);
            return $info['info']['url'];
        } catch (OssException $e) {
            return '';
        }

    }

    public function get(Request $request)
    {
        $file = $request->file('picture');
        //return(upload('file', $path = 'upload', $childPath = true));
        if ($request->isMethod('post')) {
            $file = $request->file('file');
            // 文件是否上传成功
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg
                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称
                $bool = Storage::disk('local')->put($filename, file_get_contents($realPath));
                return $filename;
            }
        }
        return '上传失败';
    }

}
