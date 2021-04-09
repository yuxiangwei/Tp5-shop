<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\AccessToken;
use app\api\service\DeliveryMessage;
use app\api\validate\TemplateID;
use app\lib\exception\SuccessMessage;

class Message extends BaseController
{
    /**
     * 发送一次订阅消息
     *   姓名
     *   {{name1.DATA}}
     *   到访目的
     *   {{phrase2.DATA}}
     *   到访时间
     *  {{date3.DATA}}
     */
    public function sendSubscribeMessage()
    {
        (new TemplateID())->goCheck();
        $message = new DeliveryMessage(input('post.template_id',''));
        $message->sendDeliveryMessage();
        return new SuccessMessage();
    }

}