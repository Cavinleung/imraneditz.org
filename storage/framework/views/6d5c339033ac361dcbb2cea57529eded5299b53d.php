<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(__('dujiaoka.equipment.please_use_a_browser_to_open'), false); ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta name="format-detection" content="telephone=no">
    <meta content="false" name="twcClient" id="twcClient">
    <meta name="aplus-touch" content="1">
    <style>
        body,html{width:100%;height:100%}
        *{margin:0;padding:0}
        body{background-color:#fff}
        #browser img{
            width:50px;
        }
        #browser{
            margin: 0px 10px;
            text-align:center;
        }
        #contens{
            font-weight: bold;
            color: #2466f4;
            margin:-285px 0px 10px;
            text-align:center;
            font-size:20px;
            margin-bottom: 125px;
        }
        .top-bar-guidance{font-size:15px;color:#fff;height:70%;line-height:1.8;padding-left:20px;padding-top:20px;background:url(/assets/common/images/banner.png) center top/contain no-repeat}
        .top-bar-guidance .icon-safari{width:25px;height:25px;vertical-align:middle;margin:0 .2em}
        .app-download-tip{margin:0 auto;width:290px;text-align:center;font-size:15px;color:#2466f4;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAcAQMAAACak0ePAAAABlBMVEUAAAAdYfh+GakkAAAAAXRSTlMAQObYZgAAAA5JREFUCNdjwA8acEkAAAy4AIE4hQq/AAAAAElFTkSuQmCC) left center/auto 15px repeat-x}
        .app-download-tip .guidance-desc{background-color:#fff;padding:0 5px}
        .app-download-btn{display:block;width:214px;height:40px;line-height:40px;margin:18px auto 0 auto;text-align:center;font-size:18px;color:#2466f4;border-radius:20px;border:.5px #2466f4 solid;text-decoration:none}
    </style>
</head>
<body>

<div class="top-bar-guidance">
    <p><?php echo e(__('dujiaoka.equipment.click_on_the_upper_right_corner'), false); ?><img src="/assets/common/images/3dian.png" class="icon-safari"><?php echo e(__('dujiaoka.equipment.open_the_browser'), false); ?></p>
    <p><?php echo e(__('dujiaoka.equipment.apple_device'), false); ?><img src="/assets/common/images/iphone.png" class="icon-safari"><?php echo e(__('dujiaoka.equipment.android_device'), false); ?><img src="/assets/common/images/android.png" class="icon-safari">↗↗↗</p>
</div>

<div id="contens">
    <p><br/><br/></p>
    <p>1.<?php echo e(__('dujiaoka.equipment.does_not_support_wechat_or_qq_access'), false); ?></p>
    <p><br/></p>
    <p>2.<?php echo e(__('dujiaoka.equipment.please_follow_the_prompts_to_open'), false); ?></p>
</div>

<p><br/><br/></p>
<div class="app-download-tip">
    <span class="guidance-desc"><?php echo e($nowUri, false); ?></span>
</div>
<p><br/></p>
<div class="app-download-tip">
    <span class="guidance-desc"><?php echo e(__('dujiaoka.equipment.open_browser_tips'), false); ?></span>
</div>
</body>
</html>
<?php /**PATH /www/wwwroot/ek.zzfw.xyz/resources/views/common/notencent.blade.php ENDPATH**/ ?>