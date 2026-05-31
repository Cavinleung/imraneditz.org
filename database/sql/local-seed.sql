-- Local preview seed (not production data)
-- Re-run: mysql -uroot -P3307 imraneditz < database/sql/local-seed.sql

DELETE FROM `articles`;
DELETE FROM `article_category`;
DELETE FROM `goods`;
DELETE FROM `goods_group`;
DELETE FROM `admin_settings` WHERE `slug` = 'system-setting';

INSERT INTO `admin_settings` (`slug`, `value`, `created_at`, `updated_at`) VALUES
('system-setting', '{"title":"imraneditz 本地预览","template":"hyper","language":"zh_CN","notice":"<p>本地开发环境（数据来自本地 MariaDB，非线上数据库）</p>","footer":"","is_open_anti_red":"0","is_open_geetest":"0","is_open_xn":"0","is_open_wenzhang":"1","xn_products":"Instagram账号---Telegram账号","xn_quantities":"1~5"}', NOW(), NOW());

INSERT INTO `article_category` (`id`, `category_name`, `ord`, `is_open`, `created_at`, `updated_at`) VALUES
(1, '教程指南', 1, 1, NOW(), NOW());

INSERT INTO `articles` (`category_id`, `title`, `keywords`, `description`, `picture`, `content`, `created_at`, `updated_at`) VALUES
(1, 'instagram不能用怎么办?', 'instagram', 'instagram打不开解决方案', '', '<p><img src=\"https://imraneditz.org/uploads/images/5fea1cb96df6c75befe04b075385c759.png\" alt=\"demo\"></p><p>这是一篇用于本地预览的文章，测试图片是否在卡片左侧区域居中显示。</p>', NOW(), NOW()),
(1, '怎么注册instagram?', 'instagram注册', 'instagram注册教程', '', '<p><img src=\"https://imraneditz.org/uploads/images/a26b4f4677b8766c8d33d43c1261d728.png\" alt=\"demo\"></p><p>注册步骤说明，本地预览用。</p>', NOW(), NOW()),
(1, 'instagram怎么养号?', 'instagram养号', '养号技巧', '', '<p><img src=\"https://imraneditz.org/uploads/images/5c93c7d97f99832888a3167462eb012c.png\" alt=\"demo\"></p><p>养号技巧说明，本地预览用。</p>', NOW(), NOW()),
(1, 'instagram怎么下载?', 'instagram下载', '下载教程', '', '<p><img src=\"https://imraneditz.org/uploads/images/5fea1cb96df6c75befe04b075385c759.png\" alt=\"demo\"></p><p>下载教程说明，本地预览用。</p>', NOW(), NOW());

INSERT INTO `goods_group` (`id`, `gp_name`, `is_open`, `ord`, `created_at`, `updated_at`) VALUES
(1, 'Instagram账号', 1, 1, NOW(), NOW());

INSERT INTO `goods` (`group_id`, `gd_name`, `gd_description`, `gd_keywords`, `retail_price`, `picture`, `actual_price`, `in_stock`, `ord`, `type`, `is_open`, `created_at`, `updated_at`) VALUES
(1, 'ins账号, 无头像, 已开通2FA', '本地预览示例商品', 'ins', 5.99, 'https://imraneditz.org/uploads/images/082905_8940.png', 5.99, 99, 1, 1, 1, NOW(), NOW()),
(1, 'Instagram新号, 邮箱或手机号注册, 已开启2FA', '本地预览示例商品', 'ins', 13.99, 'https://imraneditz.org/uploads/images/082905_8940.png', 13.99, 99, 2, 1, 1, NOW(), NOW()),
(1, 'Instagram账号, 邮箱注册, 已开通2FA', '本地预览示例商品', 'ins', 19.99, 'https://imraneditz.org/uploads/images/082905_8940.png', 19.99, 99, 3, 1, 1, NOW(), NOW());
