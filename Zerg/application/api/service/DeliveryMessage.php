<?php
/**
 * Created by 七月
 * Author: 七月
 * 微信公号: 小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/3/7
 * Time: 13:27
 */

namespace app\api\service;


use app\api\model\Order as OrderModel;
use app\api\model\User;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;

class DeliveryMessage extends WxMessage
{
    protected static $template_id = 'your wx template ID';// 小程序模板消息ID号

    public function __construct($template_id = '')
    {
        parent::__construct();
        if($template_id){
            self::$template_id = $template_id;
        }
    }

    public function sendDeliveryMessage($obj = null, $tplJumpPage = '')
    {
        if ($obj instanceof OrderModel){
           return  $this->handleOrder($obj, $tplJumpPage = '');
        }else{
            return  $this->handleVisitor($obj, $tplJumpPage = 'my');
        }
    }

    private function handleVisitor($obj = null, $tplJumpPage = '')
    {
        $dt = new \DateTime();
        $this->tplID = self::$template_id;
        $this->page = $tplJumpPage;
        $data = [
            'name1' => [
                'value' => '姓名',
            ],
            'phrase2' => [
                'value' => '到访目的',
            ],

            'date3' => [
                'value' => $dt->format("Y-m-d H:i")
            ]
        ];
        $this->data = $data;
        return parent::sendMessage($this->getUserOpenID(Token::getCurrentUid()));
    }

    /**
     * 订单付款通知
     * @param $order
     * @param string $tplJumpPage
     * @return bool
     * @throws OrderException
     * @throws UserException
     * @throws \think\Exception
     */
    private function handleOrder($order, $tplJumpPage = '')
    {
        if (!$order) {
            throw new OrderException();
        }
        $this->tplID = self::$template_id;
        $this->page = $tplJumpPage;
        $this->prepareMessageData($order);
        $this->emphasisKeyWord='keyword2.DATA';
        return parent::sendMessage($this->getUserOpenID($order->user_id));
    }


    private function prepareMessageData($order)
    {
        $dt = new \DateTime();
        $data = [
            'keyword1' => [
                'value' => '顺风速运',
            ],
            'keyword2' => [
                'value' => $order->snap_name,
                'color' => '#27408B'
            ],
            'keyword3' => [
                'value' => $order->order_no
            ],
            'keyword4' => [
                'value' => $dt->format("Y-m-d H:i")
            ]
        ];
        $this->data = $data;
    }

    private function getUserOpenID($uid)
    {
        $user = User::get($uid);
        if (!$user) {
            throw new UserException();
        }
        return $user->openid;
    }
}