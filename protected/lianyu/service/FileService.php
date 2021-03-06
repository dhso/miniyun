<?php
/**
 * 文件服务
 *
 * @author app <app@miniyun.cn>
 * @link http://www.miniyun.cn
 * @copyright 2014 Chengdu MiniYun Technology Co. Ltd.
 * @license http://www.miniyun.cn/license.html
 * @since 1.6
 */
class FileService extends MiniService{
    protected function anonymousActionList(){
        return array(
            "preViewTxt"
        );
    }
    /**
     * download file
     */
    public function download() {
        $path = MiniHttp::getParam("path","");
        $biz = new FileBiz();
        $biz->download($path);
    }
    /**
     * 目录打包下载
     */
    public function downloadToPackage(){
        $paths = MiniHttp::getParam('paths','');
        $directoryPath = MiniHttp::getParam('path','');
        $package = new FileBiz();
        $package->downloadToPackage($paths,$directoryPath);
    }

    /**
     * 根据signature下载文件
     */
    public function downloadBySignature(){
        $signature = MiniHttp::getParam("signature","");
        $filePath = MiniHttp::getParam("file_path","");
        $biz = new FileBiz();
        $biz->downloadBySignature($filePath,$signature);
    }
    /**
     * get content
     */
    public function content() {
        $path = MiniHttp::getParam("path","");
        $signature = MiniHttp::getParam("signature","");
        $biz = new FileBiz();
        $biz->content($path,$signature);
    }

    /**
     * 文本文件預覽
     * @return mixed
     */
    public function preViewTxt(){
        $path    = MiniHttp::getParam("path","");
        $signature = MiniHttp::getParam("signature","");
        $biz    = new FileBiz();
        $content = $biz->txtContent($path,$signature);
        return $content;

    }
    /**
     * 上传文件
     */
    public function upload(){
        $path = MiniHttp::getParam("path","");
        $biz = new FileBiz();
        $biz->upload($path);
    }

    /**
     * 判断文件是否被分享
     * @return bool
     */
    public function shared(){
        $path = MiniHttp::getParam("path","");
        $biz = new FileBiz();
        $isShared = $biz->shared($path);
        return $isShared;
    }
    /**
     * 清空回收站
     */
    public function cleanRecycle(){
        $biz = new FileBiz();
        $op  = $biz->cleanRecycle();
        return $op;
    }
    /**
     * 获取文件打开的方式
     */
    public function getExtendTactics(){
        $biz = new FileBiz();
        $data = $biz->getExtendTactics();
        return $data;
    }
    /**
     * 文件秒传接口
     */
    public function sec(){
        $biz = new FileBiz();
        $data = $biz->sec();
        return $data;
    }
    /**
     * 获取文件的相关信息
     */
    public function info(){
        $path = MiniHttp::getParam("path","");
        $biz = new FileBiz();
        $data = $biz->info($path);
        return $data;

    }
    /**
     * 检查新建群空间名称是否重复
     */
    public function existsGroupSpace(){ 
        $data = array();
        $user = MUserManager::getInstance()->getCurrentUser();
        $name = MiniHttp::getParam("name","");
        $exists = MiniFile::getInstance()->existsGroupSpace($user['id'],$name);
        if($exists){
            $data['status']='error';
            $data['msg']='has existed';
        }else{
            $data['status']='ok';
        }
        return $data;
    }
}