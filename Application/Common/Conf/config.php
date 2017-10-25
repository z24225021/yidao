<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'   => 'mysql', // 数据库类型
    
    //---------------------------------服务器------------------------------------
    'DB_HOST'   => 'bdm310017136.my3w.com', // 服务器地址
    'DB_NAME'   => 'bdm310017136_db', // 数据库名
    'DB_USER'   => 'bdm310017136', // 用户名
    'DB_PWD'    => 'jxx123458', // 密码

    //---------------------------------本地----------------------------------------
//     'DB_HOST'   => 'localhost', // 服务器地址
//     'DB_NAME'   => 'yd_t', // 数据库名
//     'DB_USER'   => 'root', // 用户名
//     'DB_PWD'    => 'root', // 密码
    
    
    'DB_PORT'   => 3306, // 端口
    
    
    'DB_PREFIX' => 'yd_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
    
    'URL_HTML_SUFFIX'=>'cc',
    'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg',
    
  /*   'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名或者IP配置
    'APP_SUB_DOMAIN_RULES'    =>    array(
        /* 域名部署配置
         *格式1: '子域名或泛域名或IP'=> '模块名[/控制器名]';
    *格式2: '子域名或泛域名或IP'=> array('模块名[/控制器名]','var1=a&var2=b&var3=*');
    )
    */
    
    'LAYOUT_ON'=>true,
    'LAYOUT_NAME'=>'Layout/layout',
    /**
     * 子域名配置
     */
    
    'APP_SUB_DOMAIN_DEPLOY'   =>   1, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'    =>    array(
        
        'admin.yidaoba.cn'  => 'Admin',  //Admin模块
        'www.yidaoba.cn'  => 'Home',  // Api接口模块
        'app.yidaoba.cn'  => 'Ydapi/index',  // Api接口模块
    ),
    //*********************************** 专车价格计算配置 **********************************
    'nightstart'=>'23:00:00',
    'nightend' =>'06:00:00',
    'daysecond'=>'86400',
    'p_s_q' =>'13',//起步价
    'p_s_d' =>'2.5',//专车基础价格
    'p_s_y' =>'1',//夜间加价
    'p_s_t' =>'0.4',//时间费
    'p_s_l' =>'0.8',//远途费
    'gd_server_key' =>'bd146d076f22feb98e4f1d8b8b722113',//高德服务器key
    'url_gd_distance' =>'http://restapi.amap.com/v3/distance',
  
    //*********************************** 支付宝支付 **********************************
    'ALIPAY_CONFIG' => array(
        'appid'=>'2017072807928526',
        'notify_url' => 'http://tp3/Api/Alipay/alipay_notify', // 异步接收支付状态通知的链接
        'return_url' => 'http://tp3/Api/Alipay/alipay_return', // 页面跳转 同步通知 页面路径 支付宝处理完请求后,当前页面自 动跳转到商户网站里指定页面的 http 路径。 (扫码支付专用)
        'show_url' => 'http://tp3/User/Order/index', // 商品展示网址,收银台页面上,商品展示的超链接。 (扫码支付专用)
        'private_key' => 'MIIEpgIBAAKCAQEA36KHgBgM/YM3hh7qWrr4gLXhwcaggf42DgKb1lypyr+rMKPLMmVChgxqoXGWz7j4nX6y4JNWt4fIDdJD+REpxliTv/rGEogUfz7d2H6mQoVeonzodXGmH2315IfTYZWgs5W1YLKk1D4gVc5lNkVW058mVcUx4BGrQMfUjFSGWWW7KO1wIQKcfIq5SH6OJnClAH/w7a/g9nqdWKbpCZrhYZ05C76AJYDhpZoglmTyKQHG5IHJ3l2VXrgiKOn5OAGsa4kPBVRdi33a8N7lhS0H1kbQeCOyxCjByfWDI3oSYaRi6qwjXV3b8LMU8d9C6St4nVLILb6KFM/T6IiMXahyIQIDAQABAoIBAQCrAZtfpgR47pfMpWNLUeGoemxRQtOF05/+ApyrxFvJv9rl7Ln6pVfDLUd0gGl0Gdtyg2nBNKmA2gFuIDT+BdPN6fnBOb+weAJEcwws+lukTlvZIG6ZL/h53BnFUN+gpUwnRvlVIgXMjl0ngBYA8/C7Dd3AhHPpBVnQxX2QeSnqvOPg6eP0rItmeGVZUK0PirPdTJ+aldfWGScAcFrz1FS1E2+V8u8CCrTpRnuchO9/ltBoc8EkBx8YPNcBNixTfOTZopR85EgRr1qeZfZ8Kdcgqw1GZh2C3QLQEblaVfMlyMFXO8aMaTm7uub1rxuBzMH22Q1QQetwhAPEqZ0DgZeJAoGBAPUvnelA/3DAJcL3d29vNkTF0/KBdCOLANpKk0/P4ojlXWOa9YDjDBS+kVaGX0xFxmZAA68DCOHe5jQ5YshyAtiEdNHpzijSLtx37Xop6edYdkfqP6tZUW9iThIxmO0vXUPFtxXN9uLyZ0woRm2x5maPEN1TM5uaGDtSTxtNwTa/AoGBAOl/lGyDWCSPAKprB3nEElbz0QZYQzTIKrBxNmjzWeEV8uDN/+1tLHtP3F9s+yfFGe2TVoHNKLEsVFbfBae/qkCLXdl02u2domwO3seSY9BUHonLFOqXTTGVVIkbZ1rGL4FOeOP07+AxSMwqjZ56+X0RRsT+fS5xpcQ1bJvK+m8fAoGBAMkEgB/zxTnIn20IfOhksoaR9uH01qYpWcqep8YgtybrfbSjIDLKc2Yyk2/v/QPIlQ/R3fNHtqmQmQYqIl4ac1DWz/wmB3saT4c73/xvjrC4q0jsucSfFxAN9doexbV4RqvA1wlOcuLAQIaE4rEe0Lo3A2mhxEcHgGRqaCcHiah7AoGBANsdee8KomBMQdeqcG137a3jRzepBAg3/rdsxh5enu12Z2FGbvAjDyb4nlh+MIH1mIs1RGyyVYlNjCepSelNFztSjVNPMVLiJlU47x5g5YHOLoooJQyvxyTMeXPgX3Dzogi51wA0DhZYqXPOSu95fz46RCsAlgBLbb9eUvkv1SsJAoGBAJWlNno1RogNqLQGJWQfbKobPW1pTHREgW4P0mzuDslL7zR3i++LTZ93iB+SULv97oJv417jUptiV8X4rGZGWTXCeJZ2HKCPiNrF0++aMqeztjYgro8iLQmY6xPfFQf+H7eYtrN8897b+JDH8CF3XSjXgDE14Y2JoOgaeSaSe02r',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6UYTwz2+FQ/dS8vSO/DvqP6cEOMSDjXlzzD3io2anLTEvqnZhTzcG1LDevH4ctpmpMExX8k/4s9ikA4l1zUmw3axisn8Kx0taJhrA1C9b7Wb2gKekEsRFEfmVfVMtB8QU7xQMKDFuf1gr8L15GKY5XRaNpSQw2kyPiotaW7nUBeuZq3+397DjO8kBsEbHwrXRWPqGZ869LfkKRFK8V7W85Ccb6EHEc3u03sP12U4/iqBu65rByr7oT16Z6d6iXnGfUZLfjFfDzY+NBnKFB725nndlPIn9EAAx6V3d182/1kXqn1A9FuaFAlsfpRj01FpZiYH5pL0Lvo6oHQEMR8YoQIDAQAB', 
    ),
    
    //*********************************************短信***************************************
    
    'yzmtempcode'=>'SMS_80235035',
    'notitempcode'=>'SMS_105905147',
    
);