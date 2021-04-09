<?php


namespace app\api\validate;


class TemplateID extends BaseValidate
{
    protected $rule = [
        'template_id' => 'require',
    ];
    protected $message=[
        'template_id' => '模板ID不传入，还想推送用户消息！'
    ];
}