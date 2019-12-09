<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 10:44
 */

namespace app\api\controller;


class Common extends Base
{
    public function qiNiuAdd()
    {
        $changeImage = I('changeImage');
        if (!empty($changeImage)) {
            unFile($changeImage, 1);
        }
        if (!empty($_FILES['file'])) {
            $json = uploadFile($_FILES['file'], 1);
            if ($json['code'] == 1) {
                $json['image'] = $json['data'];
                $json['data'] = C('qiniu.url') . $json['data'];
            }
        }
        return $this->ajaxReturn($json);
    }

    public function qiNiuDel()
    {
        $cancelImage = I('cancelImage');
        if (!empty($cancelImage)) {
            $json=unFile($cancelImage, 1);
        }
        return $this->ajaxReturn($json);
    }
}