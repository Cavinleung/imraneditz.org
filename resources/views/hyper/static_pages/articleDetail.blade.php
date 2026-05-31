@extends('hyper.layouts.article')
@section('content')
<div class="row">
    <!-- 左侧：文章详情正文 -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0" style="border-radius: 10px;">
            <div class="card-body">
                <div class="card-title" style="font-size: 14px; color: #6c757d;">
                    <a href="/article" class="text-muted">首页</a> <i class="mdi mdi-chevron-right"></i>
                    <a href="/article?cat_id={{$article['category_id']}}" class="text-muted">{{$article['category']['category_name']}}</a> <i class="mdi mdi-chevron-right"></i>
                    <span style="color: #45bbe0;">{{ $article['title'] }}</span>
                </div>
                <hr>
                <div class="blog-content">
                    <div class="blog-post">
                        <h2 class="blog-post-title text-center mb-3" style="font-weight: 700; color: #313a46;">
                            {{ $article['title'] }}
                        </h2>
                        <p class="blog-post-meta text-right text-muted" style="font-size: 13px;">
                            <i class="mdi mdi-calendar-clock"></i> 更新日期：{{ $article['updated_at'] }}
                        </p>
                        <div class="article-body mt-4" style="line-height: 1.8; font-size: 15px; color: #4a5056;">
                            {!! $article['content'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 右侧：侧边栏 -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0" style="border-radius: 10px; position: sticky; top: 20px;">
            <div class="card-header bg-white border-bottom-0 pt-3">
                <h5 class="card-title mb-0" style="font-weight: 700; color: #313a46;">
                    <i class="mdi mdi-format-list-bulleted" style="color: #45bbe0;"></i> 更多教程
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-item-flush">
                    @php
                        // 使用 DB 查询构造器获取最新的10篇文章
                        $sidebarArticles = \DB::table('articles')
                                            ->where('id', '!=', $article['id'])
                                            ->orderBy('updated_at', 'desc')
                                            ->take(10)
                                            ->get();
                    @endphp

                    @foreach($sidebarArticles as $item)
                    <a href="/article/{{ !empty($item->link) ? $item->link : $item->id }}.html" class="list-group-item list-group-item-action border-0 py-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 text-dark" style="font-weight: 600; line-height: 1.4; font-size: 14px;">{{ $item->title }}</h6>
                        </div>
                        <p class="mb-1 text-muted" style="font-size: 12px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ mb_substr(strip_tags($item->content), 0, 60) }}...
                        </p>
                        <div class="text-muted" style="font-size: 11px;">
                            <i class="mdi mdi-clock-outline"></i> {{ date('Y-m-d', strtotime($item->updated_at)) }}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            <!-- 已移除底部的“查看全部文章”按钮 -->
        </div>
    </div>
</div>

<style>
    .article-body img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px;
        margin: 15px 0;
    }
    .list-group-item:hover {
        background-color: #f1f3fa !important;
    }
    .list-group-item:hover h6 {
        color: #45bbe0 !important;
    }
    .tab-content { display: none; }
</style>
@stop
