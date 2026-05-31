<?php $__env->startSection('content'); ?>
<style>
    .purchase-info-container {
    overflow: hidden;
    white-space: nowrap;
}

.purchase-info {
    display: inline-block;
    animation: slideLeft 20s linear infinite;
}
.purchase-info div {
    color: red;
    font-weight: bold;
    font-size: 18px;
}


@keyframes  slideLeft {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}

</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <!--<div class="page-title-right">-->
            <!--    <div class="app-search">-->
            <!--        <div class="position-relative">-->
            <!--            <input type="text" class="form-control" id="search" placeholder="<?php echo e(__('hyper.home_search_box'), false); ?>">-->
            <!--            <span class="uil-search"></span>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <h4 class="page-title d-none d-md-block"><?php echo e(__('hyper.home_title'), false); ?></h4>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
            	<h4 class="header-title mb-3"><?php echo e(__('hyper.notice_announcement'), false); ?></h4>
                <div class="notice"><?php echo dujiaoka_config_get('notice'); ?></div>
            </div>
        </div>
    </div>
</div>
  <?php if(dujiaoka_config_get('is_open_xn') == \App\Models\BaseModel::STATUS_OPEN): ?>  
<div class="purchase-info-container">
    <div class="purchase-info">
        <?php $__currentLoopData = $purchaseInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div><?php echo e($info['email'], false); ?> 在 <?php echo e($info['time'], false); ?> 购买了 <?php echo e($info['quantity'], false); ?> 件 <?php echo e($info['product'], false); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
    <?php endif; ?>
<div class="nav nav-list">
    <a href="#group-all" class="tab-link active" data-bs-toggle="tab" aria-expanded="false" role="tab" data-toggle="tab">
        <span class="tab-title">
        
        <?php echo e(__('hyper.home_whole'), false); ?>

        </span>
        <div class="img-checkmark">
            <img src="/assets/hyper/images/check.png">
        </div>
    </a>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="#group-<?php echo e($group['id'], false); ?>" class="tab-link" data-bs-toggle="tab" aria-expanded="false" role="tab" data-toggle="tab">
        <span class="tab-title">
            <?php echo e($group['gp_name'], false); ?>

        </span>
        <div class="img-checkmark">
            <img src="/assets/hyper/images/check.png">
        </div>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="tab-content">
    <div class="tab-pane active" id="group-all">
        <div class="hyper-wrapper">
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $group['goods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($goods['in_stock'] > 0): ?>
                    <a href="<?php echo e(url("/buy/{$goods['id']}"), false); ?>" class="home-card category">
                    <?php else: ?>
                    <a href="javascript:void(0);" onclick="sell_out_tip()" class="home-card category ribbon-box">
                        <div class="ribbon-two ribbon-two-danger">
                            
                            <span><?php echo e(__('hyper.home_out_of_stock'), false); ?></span>
                        </div>
                    <?php endif; ?>
                        <img class="home-img" src="/assets/hyper/images/loading.gif" data-src="<?php echo e(picture_ulr($goods['picture']), false); ?>">
                        <div class="flex">
                            <p class="name">
                                <?php echo e($goods['gd_name'], false); ?>

                            </p>
                          <div class="price">
                                <p>
                                <b><?php echo e($goods['actual_price'], false); ?></b> <?php echo e((dujiaoka_config_get('global_currency')), false); ?></b>
                                </p>
                                             <?php if($goods['open_rebate'] > 0 && $goods['rebate_rate'] > 0): ?>
    <small>
        
        返利<?php echo e($goods['rebate_rate'], false); ?>%
    </small>
<?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tab-pane" id="group-<?php echo e($group['id'], false); ?>">
            <div class="hyper-wrapper">
                <?php $__currentLoopData = $group['goods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($goods['in_stock'] > 0): ?>
                    <a href="<?php echo e(url("/buy/{$goods['id']}"), false); ?>" class="home-card category">
                    <?php else: ?>
                    <a href="javascript:void(0);" onclick="sell_out_tip()" class="home-card category ribbon-box">
                        <div class="ribbon-two ribbon-two-danger">
                            
                            <span><?php echo e(__('hyper.home_out_of_stock'), false); ?></span>
                        </div>
                    <?php endif; ?>
                        <img class="home-img" src="/assets/hyper/images/loading.gif" data-src="<?php echo e(picture_ulr($goods['picture']), false); ?>">
                        <div class="flex">
                            <p class="name">
                                <?php echo e($goods['gd_name'], false); ?>

                            </p>
                             <div class="price">
                                <p>
                                <b><?php echo e($goods['actual_price'], false); ?></b> <?php echo e((dujiaoka_config_get('global_currency')), false); ?></b>
                                </p>
                             <?php if($goods['open_rebate'] > 0 && $goods['rebate_rate'] > 0): ?>
    <small>
        
        返利<?php echo e($goods['rebate_rate'], false); ?>%
    </small>
<?php endif; ?>

                            </div>
                        </div>
                    
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

 
<?php if(true): ?>    
<!-- 使用教程：图文卡片布局（修复悬停变黑版） -->
<div class="row mt-4">
    <div class="col-12 mb-3">
        <a href="/article" style="text-decoration: none;">
            <span class="btn badge-info" style="display: block; width: 100%; font-weight: bold; background-color: #45bbe0; border: none; color: #fff;">使用教程</span>
        </a>
    </div>
    
    <?php $__currentLoopData = $articles->shuffle()->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        // 提取文章内容中的第一张图片
        $content = $article['content'] ?? '';
        preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $content, $matches);
        $first_img = !empty($matches[1]) ? $matches[1] : '/assets/hyper/images/pay/default.png';
    ?>
    <div class="col-md-6 mb-3">
        <a href="article/<?php echo e(!empty($article['link']) ? $article['link'] : $article['id'], false); ?>" class="text-decoration-none custom-article-card">
            <div class="card h-100 border shadow-sm" style="background: #fff !important; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; border: 1px solid #eef2f7 !important;">
                <div class="card-body p-0 d-flex">
                    <!-- 左侧缩略图 -->
                    <div class="d-flex align-items-center justify-content-center" style="width: 140px; min-width: 140px; height: 110px; background: #f8f9fa; overflow: hidden;">
                        <?php if(!empty($matches[1])): ?>
                            <img src="<?php echo e($first_img, false); ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="thumb">
                        <?php else: ?>
                            <i class="mdi mdi-image-filter-none" style="font-size: 30px; color: #dee2e6;"></i>
                        <?php endif; ?>
                    </div>
                    
                    <!-- 右侧内容 -->
                    <div class="p-3 d-flex flex-column justify-content-between" style="flex: 1; min-width: 0; background: #fff !important;">
                        <div>
                            <div class="mb-1" style="color: #45bbe0; font-size: 12px; font-weight: 600;">
                                <i class="mdi mdi-tag-outline"></i> 教程指南
                            </div>
                            <h5 class="card-title text-dark mb-1" style="font-size: 15px; line-height: 1.4; font-weight: 600; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?php echo e($article['title'], false); ?>

                            </h5>
                            <p style="color: #6c757d; font-size: 12px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 0;">
                                <?php echo e(mb_substr(strip_tags($article['content']), 0, 200), false); ?>...
                            </p>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-2" style="font-size: 11px; color: #adb5bd;">
                            <span><i class="mdi mdi-clock-outline"></i> <?php echo e(date('Y-m-d', strtotime($article['updated_at'])), false); ?></span>
                            <span><i class="mdi mdi-eye-outline"></i> <?php echo e(rand(100, 999), false); ?> 浏览</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<style>
    /* 强制锁定悬停样式，防止变黑 */
    .custom-article-card:hover .card {
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 25px rgba(69, 187, 224, 0.15) !important; /* 使用主题蓝色的淡阴影 */
        border-color: #45bbe0 !important;
        background-color: #fff !important; /* 强制背景为白色 */
    }
    .custom-article-card:hover .card-title {
        color: #45bbe0 !important; /* 标题变蓝色 */
    }
    .custom-article-card:hover .card-body {
        background-color: #fff !important;
    }
</style>

<?php endif; ?>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('js'); ?>
<script>
    $("#search").on("input",function(e){
        var txt = $("#search").val();
        if($.trim(txt)!="") {
            $(".category").hide().filter(":contains('"+txt+"')").show();
        } else {
            $(".category").show();
        }
    });
    function sell_out_tip() {
        $.NotificationApp.send("<?php echo e(__('hyper.home_tip'), false); ?>","<?php echo e(__('hyper.home_sell_out_tip'), false); ?>","top-center","rgba(0,0,0,0.2)","info");
    }
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const purchaseInfoContainer = document.querySelector('.purchase-info-container');
    const purchaseInfo = document.querySelector('.purchase-info');
    const purchaseInfoItems = document.querySelectorAll('.purchase-info div');
    let currentIndex = 0;
    let animationDuration = 0;

    function calculateAnimationDuration() {
        const containerWidth = purchaseInfoContainer.offsetWidth;
        const currentItemWidth = purchaseInfoItems[currentIndex].offsetWidth;
        const distanceToTravel = currentItemWidth + containerWidth;
        const pixelsPerSecond = distanceToTravel / 20; // 假设每秒移动的像素数为容器和当前项的宽度之和的20分之一
        animationDuration = distanceToTravel / pixelsPerSecond * 1000; // 将动画持续时间转换为毫秒
    }

    function showNextInfo() {
        // 计算当前购买信息的动画持续时间
        calculateAnimationDuration();

        // 隐藏所有购买信息
        purchaseInfoItems.forEach((item) => {
            item.style.display = 'none';
        });

        // 显示当前购买信息
        purchaseInfoItems[currentIndex].style.display = 'block';

        // 更新索引，循环显示购买信息
        currentIndex = (currentIndex + 1) % purchaseInfoItems.length;

        // 设置定时器，在动画完成后再滚动到下一条信息
        setTimeout(showNextInfo, animationDuration);
    }

    // 初始化
    showNextInfo();
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('hyper.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/imraneditz.org/resources/views/hyper/static_pages/home.blade.php ENDPATH**/ ?>