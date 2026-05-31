@extends('hyper.layouts.default')
@section('content')
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


@keyframes slideLeft {
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
            <!--            <input type="text" class="form-control" id="search" placeholder="{{ __('hyper.home_search_box') }}">-->
            <!--            <span class="uil-search"></span>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <h4 class="page-title d-none d-md-block">{{ __('hyper.home_title') }}</h4>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
            	<h4 class="header-title mb-3">{{ __('hyper.notice_announcement') }}</h4>
                <div class="notice">{!! dujiaoka_config_get('notice') !!}</div>
            </div>
        </div>
    </div>
</div>
  @if(dujiaoka_config_get('is_open_xn') == \App\Models\BaseModel::STATUS_OPEN)  
<div class="purchase-info-container">
    <div class="purchase-info">
        @foreach ($purchaseInfos as $info)
            <div>{{ $info['email'] }} 在 {{ $info['time'] }} 购买了 {{ $info['quantity'] }} 件 {{ $info['product'] }}</div>
        @endforeach
    </div>
</div>
    @endif
<div class="nav nav-list">
    <a href="#group-all" class="tab-link active" data-bs-toggle="tab" aria-expanded="false" role="tab" data-toggle="tab">
        <span class="tab-title">
        {{-- 全部 --}}
        {{ __('hyper.home_whole') }}
        </span>
        <div class="img-checkmark">
            <img src="/assets/hyper/images/check.png">
        </div>
    </a>
    @foreach($data as  $index => $group)
    <a href="#group-{{ $group['id'] }}" class="tab-link" data-bs-toggle="tab" aria-expanded="false" role="tab" data-toggle="tab">
        <span class="tab-title">
            {{ $group['gp_name'] }}
        </span>
        <div class="img-checkmark">
            <img src="/assets/hyper/images/check.png">
        </div>
    </a>
    @endforeach
</div>
<div class="tab-content">
    <div class="tab-pane active" id="group-all">
        <div class="hyper-wrapper">
            @foreach($data as $group)
                @foreach($group['goods'] as $goods)
                    @if($goods['in_stock'] > 0)
                    <a href="{{ url("/buy/{$goods['id']}") }}" class="home-card category">
                    @else
                    <a href="javascript:void(0);" onclick="sell_out_tip()" class="home-card category ribbon-box">
                        <div class="ribbon-two ribbon-two-danger">
                            {{-- 缺货 --}}
                            <span>{{ __('hyper.home_out_of_stock') }}</span>
                        </div>
                    @endif
                        <img class="home-img" src="/assets/hyper/images/loading.gif" data-src="{{ picture_ulr($goods['picture']) }}">
                        <div class="flex">
                            <p class="name">
                                {{ $goods['gd_name'] }}
                            </p>
                          <div class="price">
                                <p>
                                <b>{{ $goods['actual_price'] }}</b> {{(dujiaoka_config_get('global_currency')) }}</b>
                                </p>
                                             @if ($goods['open_rebate'] > 0 && $goods['rebate_rate'] > 0)
    <small>
        {{-- 返利 --}}
        返利{{ $goods['rebate_rate'] }}%
    </small>
@endif
                            </div>
                        </div>
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>
    @foreach($data as  $index => $group)
        <div class="tab-pane" id="group-{{ $group['id'] }}">
            <div class="hyper-wrapper">
                @foreach($group['goods'] as $goods)
                    @if($goods['in_stock'] > 0)
                    <a href="{{ url("/buy/{$goods['id']}") }}" class="home-card category">
                    @else
                    <a href="javascript:void(0);" onclick="sell_out_tip()" class="home-card category ribbon-box">
                        <div class="ribbon-two ribbon-two-danger">
                            {{-- 缺货 --}}
                            <span>{{ __('hyper.home_out_of_stock') }}</span>
                        </div>
                    @endif
                        <img class="home-img" src="/assets/hyper/images/loading.gif" data-src="{{ picture_ulr($goods['picture']) }}">
                        <div class="flex">
                            <p class="name">
                                {{ $goods['gd_name'] }}
                            </p>
                             <div class="price">
                                <p>
                                <b>{{ $goods['actual_price'] }}</b> {{(dujiaoka_config_get('global_currency')) }}</b>
                                </p>
                             @if ($goods['open_rebate'] > 0 && $goods['rebate_rate'] > 0)
    <small>
        {{-- 返利 --}}
        返利{{ $goods['rebate_rate'] }}%
    </small>
@endif

                            </div>
                        </div>
                    
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

 
@if(true)    
<!-- 使用教程：图文卡片布局（修复悬停变黑版） -->
<div class="row mt-4">
    <div class="col-12 mb-3">
        <a href="/article" style="text-decoration: none;">
            <span class="btn badge-info" style="display: block; width: 100%; font-weight: bold; background-color: #45bbe0; border: none; color: #fff;">使用教程</span>
        </a>
    </div>
    
    @foreach ($articles->shuffle()->take(6) as $article)
    @php
        // 提取文章内容中的第一张图片
        $content = $article['content'] ?? '';
        preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $content, $matches);
        $first_img = !empty($matches[1]) ? $matches[1] : '/assets/hyper/images/pay/default.png';
    @endphp
    <div class="col-md-6 mb-3">
        <a href="article/{{ !empty($article['link']) ? $article['link'] : $article['id'] }}" class="text-decoration-none custom-article-card">
            <div class="card h-100 border shadow-sm" style="background: #fff !important; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; border: 1px solid #eef2f7 !important;">
                <div class="card-body p-0 d-flex">
                    <!-- 左侧缩略图 -->
                    <div class="d-flex align-items-center justify-content-center" style="width: 140px; min-width: 140px; height: 110px; background: #f8f9fa; overflow: hidden;">
                        @if(!empty($matches[1]))
                            <img src="{{ $first_img }}" style="width: 100%; height: 100%; object-fit: cover;" alt="thumb">
                        @else
                            <i class="mdi mdi-image-filter-none" style="font-size: 30px; color: #dee2e6;"></i>
                        @endif
                    </div>
                    
                    <!-- 右侧内容 -->
                    <div class="p-3 d-flex flex-column justify-content-between" style="flex: 1; min-width: 0; background: #fff !important;">
                        <div>
                            <div class="mb-1" style="color: #45bbe0; font-size: 12px; font-weight: 600;">
                                <i class="mdi mdi-tag-outline"></i> 教程指南
                            </div>
                            <h5 class="card-title text-dark mb-1" style="font-size: 15px; line-height: 1.4; font-weight: 600; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $article['title'] }}
                            </h5>
                            <p style="color: #6c757d; font-size: 12px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 0;">
                                {{ mb_substr(strip_tags($article['content']), 0, 200) }}...
                            </p>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-2" style="font-size: 11px; color: #adb5bd;">
                            <span><i class="mdi mdi-clock-outline"></i> {{ date('Y-m-d', strtotime($article['updated_at'])) }}</span>
                            <span><i class="mdi mdi-eye-outline"></i> {{ rand(100, 999) }} 浏览</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
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

@endif
@stop 
@section('js')
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
        $.NotificationApp.send("{{ __('hyper.home_tip') }}","{{ __('hyper.home_sell_out_tip') }}","top-center","rgba(0,0,0,0.2)","info");
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
@stop