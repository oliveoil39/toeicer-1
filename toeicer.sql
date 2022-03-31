-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2022 年 3 月 31 日 11:14
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `toeicer`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `name` varchar(100) NOT NULL COMMENT '品名',
  `level` varchar(11) NOT NULL COMMENT 'レベル',
  `part` varchar(11) DEFAULT NULL COMMENT 'パート',
  `period` varchar(50) DEFAULT NULL COMMENT '取組期間',
  `image` varchar(250) DEFAULT NULL COMMENT '画像',
  `url` varchar(500) DEFAULT NULL COMMENT '販売URL',
  `review` text COMMENT '感想',
  `price` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '投稿日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `books`
--

INSERT INTO `books` (`id`, `user_id`, `name`, `level`, `part`, `period`, `image`, `url`, `review`, `price`, `created_at`) VALUES
(15, 8, '金のフレーズ', '初学者', '単語帳', '１ヶ月　三周', '1648194796kinfure.jpeg', 'https://books.rakuten.co.jp/rb/11569348/', 'とてもわかりやすくて面白い。', 999, '2022-03-25 16:53:16'),
(16, 8, '公式問題集⑧', '目標点数:850点', 'L&R', '一週間', '1648194873kousiki8.jpeg', NULL, 'とても役に立つ！！！！', NULL, '2022-03-25 16:54:33'),
(17, 8, '黒のフレーズ', '目標点数:999点', '単語帳', '一年', NULL, NULL, 'むずすぎる。', NULL, '2022-03-25 16:58:30'),
(18, 8, '文法特急', '目標点数:600点', 'part5.6', '三週間', '1648195254bunpoutokkyuu.jpeg', 'https://www.amazon.co.jp/1%E9%A7%851%E9%A1%8C%EF%BC%81-TOEIC-L%EF%BC%86R-TEST-%E6%96%87%E6%B3%95%E7%89%B9%E6%80%A5-ebook/dp/B092ZCJ6DF', 'part5.6が怖くなくなる本！', 675, '2022-03-25 17:00:54'),
(21, 8, 'vocablary book', '目標点数:750点', '単語帳', '５ヶ月', '1648298624vocablary.png', 'https://jp.mercari.com/item/m92542595365', '単語のボキャブラリーが格段に増える！！\r\ntoeicの点数に伸び悩んでいる方におすすめ。\r\n値段交渉もするので、お気軽にどうぞ', 1200, '2022-03-26 21:43:44'),
(23, 16, 'TOEIC860点奪取の方法', '目標点数:850点', 'L&R', '１ヶ月', '1648433011860.jpeg', NULL, NULL, NULL, '2022-03-28 11:03:31'),
(24, 9, 'キクタンTOEIC', '目標点数:850点', '単語帳', '半年', '1648440402kikutan.jpeg', 'https://www.sanga-fc.jp/', '音声を聞くだけで英単語を覚えられる単語集」、「キクタンTOEIC」の学習機能がさらにアップしました。\r\n米英加豪の4カ国発音で収録されているセンテンス音声に、日本語訳の読み上げ音声も追加。耳から学習が簡単になりました。\r\nこれまでの英語のみの音声もありますので、学習の進捗状況や目的に応じて、選択することができます。', 1299, '2022-03-28 13:06:42'),
(27, 8, '炎の千本ノック', '初学者', 'part1.2', '三週間', '1648444094honoo.jpeg', 'https://www.amazon.co.jp/1%E6%97%A51%E5%88%86-TOEIC-R%E3%83%86%E3%82%B9%E3%83%88-%E7%82%8E%E3%81%AE%E5%8D%83%E6%9C%AC%E3%83%8E%E3%83%83%E3%82%AF-%E3%81%93%E3%82%8C%E3%81%AA%E3%82%89%E7%B6%9A%E3%81%91%E3%82%89%E3%82%8C%E3%82%8B%E8%8B%B1%E8%AA%9E%E3%81%AE%E7%AD%8B%E3%83%88%E3%83%AC/dp/4396616678', 'とても楽しい。', 970, '2022-03-28 14:08:14');

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `book_id`) VALUES
(22, 12, 21),
(26, 12, 17),
(27, 12, 16),
(39, 8, 17),
(43, 13, 18),
(46, 14, 18),
(51, 17, 21),
(52, 16, 23),
(53, 17, 23),
(54, 9, 23),
(55, 13, 23),
(58, 8, 16),
(59, 8, 18),
(62, 9, 24),
(63, 13, 24),
(64, 14, 23),
(65, 14, 24),
(66, 15, 23),
(67, 15, 24),
(68, 17, 24),
(69, 17, 18),
(70, 8, 23),
(71, 8, 27);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(50) NOT NULL COMMENT 'ユーザ名',
  `email` varchar(100) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(100) NOT NULL COMMENT 'パスワード',
  `role` int(1) NOT NULL DEFAULT '0' COMMENT 'ログイン判定',
  `created_at` datetime DEFAULT NULL COMMENT '登録日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(8, 'testA', 'testA@icloud.com', '$2y$10$6DL1SWyQHn2EtFMXQM5wkeNjf.xTI9PW7w4A.Zn0KMFXr86PC5qqi', 0, '2022-03-24 08:53:23'),
(9, 'testB', 'testB@icloud.com', '$2y$10$xXDRAXNH0B8lqzEYz3jdZuhyO7uyBklB6YigMdKFazrYV0j3O6Ur2', 0, '2022-03-24 08:53:47'),
(13, 'testC', 'testC@icloud.com', '$2y$10$XYe0yYGfnPJbjNL1buMRUuez8qr9E1ADqWkUqhQT83bJAun3A7xx2', 0, '2022-03-28 09:31:32'),
(14, 'testD', 'testD@icloud.com', '$2y$10$Pn/sirsfRg3726wZXWxSgOSNjhXWrSJeQkQu8iVssHxvhhY5kYl5q', 0, '2022-03-28 09:31:52'),
(15, 'testE', 'testE@icloud.com', '$2y$10$fb8BCQoznsOA32v1FlnDuOky7rPFxrAzeevqw3JyQwD5FZGgtsKDe', 0, '2022-03-28 09:32:18'),
(16, 'testF', 'testF@icloud.com', '$2y$10$1sKs6eBdMkhNI83ptbXwd.wBOTNQrNZW7JtHVk2cm1TWXE81nSuu.', 0, '2022-03-28 09:32:39'),
(17, 'testG', 'testG@icloud.com', '$2y$10$6qAZRgzy5/Nvbl0j7ruAQeSgdP8voLkneJ3xxaXJJzHfoL9qmd50G', 0, '2022-03-28 09:34:52');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=28;

--
-- テーブルの AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
