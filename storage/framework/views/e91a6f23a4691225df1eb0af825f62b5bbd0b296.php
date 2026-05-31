<div class="header-navbar" style="background: #fff; border-bottom: 1px solid #eef2f7; padding: 10px 0;">
    <div class="container header-flex">
        <!-- LOGO -->
        <a href="/" class="topnav-logo">
            <img src="<?php echo e(picture_ulr(dujiaoka_config_get('img_logo')), false); ?>" height="36">
            <div class="logo-title"><?php echo e(dujiaoka_config_get('text_logo'), false); ?></div>
        </a>
        
        <!-- 导航菜单 -->
        <div class="header-nav-menu">
            <ul class="nav-menu-list">
                <li><a href="/" class="<?php echo e(request()->is('/') ? 'active' : '', false); ?>">商品列表</a></li>
                <li><a href="/article" class="<?php echo e(request()->is('article*') ? 'active' : '', false); ?>">使用教程</a></li>
            </ul>
        </div>
    </div>
</div>


<style>
/* 基础布局 */
.header-flex {
    display: flex !important;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.header-nav-menu {
    display: flex !important; /* 强制显示 */
    justify-content: flex-end; /* 电脑端靠右显示，如果您想居中改为 center */
}

.nav-menu-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 40px; /* 电脑端默认间距 */
}

.nav-menu-list li a {
    color: #313a46;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s;
}

.nav-menu-list li a:hover,
.nav-menu-list li a.active {
    color: #45bbe0;
}

/* 响应式：手机端自适应调整 */
@media (max-width: 768px) {
    /* 1. 确保导航栏容器能撑开高度，不遮挡下方内容 */
    .header-navbar {
        height: auto !important;
        padding-bottom: 15px !important;
    }

    .header-flex {
        flex-direction: column !important;
        text-align: center;
    }
    
    .header-nav-menu {
        width: 100%;
        justify-content: center !important;
        margin-top: 15px;
        display: flex !important;
    }
    
    /* 2. 给下方的公告/内容区域增加顶部间距，防止被遮挡 */
    /* 这里的 .content-page 是独角数卡常用的内容容器类名 */
    .content-page, .wrapper {
        margin-top: 20px !important;
    }

    /* 如果是公告模块被遮挡，尝试给公告所在的 row 加间距 */
    .row.mt-3, .card.mb-3 {
        margin-top: 20px !important;
    }

    .nav-menu-list {
        gap: 10vw; 
    }
}

</style><?php /**PATH /www/wwwroot/imraneditz.org/resources/views/hyper/layouts/_nav.blade.php ENDPATH**/ ?>