# 一、简述
这是七月老师的TP5小程序课程源代码；代码写的AOP思想值得借鉴和学习。
# 二、基本要求
> PHP <= 7.0
> MySQL <= 5.6
# 三 、部署流程 - 小程序端配置：
① utils\config.js 文件中配置  Config.restUrl = 'http://host/api/v1/';
# 四、部署流程 - TP5配置
① application\extra\wx.php 配置微信小程序 app_id app_secret
② application\api\config.php 配置小程序展示服务器图片地址 'img_prefix'=> 'http://host/images'
③ application\database.php 配置数据库连接地址