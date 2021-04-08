<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\UserAddress;
use \app\api\model\User as UserM;
use app\api\service\Token;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class User extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'wxUpdateInfo']
    ];

    /**
     * 更新微信资料
     * @throws UserException
     * @throws \app\lib\exception\ParameterException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function wxUpdateInfo()
    {
        $uid = Token::getCurrentUid();
        $UserM = UserM::get($uid);
        if(!$UserM){
            throw new UserException([
                'msg' => '用户不存在',
                'errorCode' => 60000
            ]);
        }
        $params = input('post.');
        $UserM->save($params);
        return new SuccessMessage();
    }

}