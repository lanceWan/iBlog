# iBlog

基于 [iAdmin](https://github.com/lanceWan/IAdmin) 个人博客网站，在 [iAdmin](https://github.com/lanceWan/IAdmin) 的基础之上增加基本的个人博客功能，本人代码完全开源，至于主题只供学习交流。如需商业应用请自行购买授权！

**预览地址**

[http://www.iwanli.me](http://www.iwanli.me)

现阶段只是实现了最基本的博客功能，后台文本编辑器为 [https://pandao.github.io/editor.md/index.html](https://pandao.github.io/editor.md/index.html) ，上传图片直接上传到七牛并返回图片路径。更多功能会在今后进行升级...


## 安装

> iAdmin后台缓存可以选择性的使用 Redis ，但在 iBlog 中必须安装 Redis，必须安装Redis，必须安装Redis！！！因为博客的浏览量和前端相关页面缓存用的是Redis

安装和`iAdmin`的基本一致，这里还是简单罗列一下

1. 下载本项目,然后在项目根目录执行 `composer install`
2. 包安装完成后,复制.env.example 文件为.env
3. 执行 `php artisan key:generate`
4. 迁移数据: `php artisan migrate`  And `php artisan db:seed`

OK,项目已经配置完成，后台地址：example.com/admin，不清楚的可以直接去看 `routes.php` 文件。默认管理员账号：`admin@admin.com` , 密码：`123456` 
如果你是在Linux或Mac下配置的请注意相关目录的权限，这里我就不多说了，enjoy！

## .env文件
.env文件有几个配置简单介绍一下
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=SomeRandomString

DB_HOST=127.0.0.1
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

CACHE_DRIVER=file		//博客中建议将直接将file改为redis
CACHE_PREFIX=laravel	//缓存在redis中的前缀
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_DATABASE=0		//选择项目数据存放在redis哪个库  一般默认0就行了

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

QINIU_DOMAINS_DEFAULT=null 	//你的七牛域名
QINIU_DOMAINS_HTTPS=null	//你的HTTPS域名
QINIU_DOMAINS_CUSTOM=null	//你的自定义域名
QINIU_AXXESS_KEY=null		//AccessKey
QINIU_SECRET_KEY=null		//SecretKey
QINIU_BUCKET=null			//Bucket名字
QINIU_NOTIFY_URL=null		//持久化处理回调地址

LOGIN_FIELD=email			//自定义用户表中的字段作为登录名，默认是 `email` ，你可以换成 `name`,想要换成其他自定义字段请在迁移数据库之前添加字段

```

## 验证码一直错误问题

如果你的验证码包(mews/captcha)版本是`2.12`,但是登录后台的时候一直出现验证码错误，请在 `vendor\mews\captcha\src\CaptchaServiceProvider.php` 中添加一下代码：

```php
// HTTP routing
if (strpos($this->app->version(), 'Lumen') !== false) {
    //Laravel Lumen
    $this->app->get('captcha[/{config}]', 'Mews\Captcha\LumenCaptchaController@getCaptcha');
} else if (starts_with($this->app->version(), '5.2.') !== false) {
    //Laravel 5.2.x
    $this->app['router']->get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha')->middleware('web');
} else {
    //Laravel 5.0.x ~ 5.1.x
    $this->app['router']->get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha');
}
```

将文件中对应的代码替换掉就可以正常登录了，github上的代码已经是修复了这个Laravel5.2的bug，但是用composer下载的时候代码却没有更新，所以只好现在手动加上去了，等作者更新一个版本后估计就没有这个问题了。

如有什么错误的地方，请指点，非常感谢！也可以直接联系我：709344897@qq.com 。(发现邮箱反馈的时候腾讯会移动到垃圾邮箱，如果我没看到加我这个QQ联系也可以，我在想一下怎么反馈最好)

本人博客地址：[i晚黎](http://www.iwanli.me)

## Change Log

**2016-05-30**

* 自定义登录配置为null是出错问题修修复(感谢 `shishi<shi******0928@qq.com>` 童鞋的反馈)