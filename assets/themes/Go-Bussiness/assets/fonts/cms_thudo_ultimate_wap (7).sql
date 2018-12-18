-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 18, 2017 lúc 10:39 AM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cms_thudo_ultimate_wap`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID chính',
  `uuid` varchar(36) NOT NULL COMMENT 'Mã UUID v4',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Active Status',
  `name` varchar(256) NOT NULL COMMENT 'Name',
  `slugs` varchar(256) NOT NULL COMMENT 'Slugs',
  `title` varchar(256) NOT NULL COMMENT 'Title',
  `description` varchar(256) NOT NULL COMMENT 'Description',
  `keywords` varchar(256) NOT NULL COMMENT 'Keywords',
  `photo` varchar(256) NOT NULL COMMENT 'Photo',
  `parent` int(11) NOT NULL COMMENT 'Parent ID',
  `order_stt` int(11) NOT NULL COMMENT 'Order Stt',
  `created_at` datetime NOT NULL COMMENT 'Thời gian tạo',
  `source_url` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Thời gian cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Categories Table';

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `uuid`, `status`, `name`, `slugs`, `title`, `description`, `keywords`, `photo`, `parent`, `order_stt`, `created_at`, `source_url`, `updated_at`) VALUES
(1, '80d6d4bf-d91c-41b0-89ca-6fcba111878c', 1, 'Tin trong nước', 'Tin-trong-nuoc', 'Tin trong nước', 'Tin trong nước', 'Tin trong nước', '', 0, 0, '2017-02-21 14:07:24', 'http://hoinguoicaotuoi.vn/g/tin-tuc-su-kien-5', '2017-02-21 14:07:24'),
(2, 'bdf569a8-ca92-45c7-8004-8dd35c0acd07', 1, 'Tin quốc tế', 'Tin-quoc-te', 'Tin quốc tế', 'Tin quốc tế', 'Tin quốc tế', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/the-gioi', '2017-02-21 14:07:24'),
(3, '3fb8156b-522f-46f1-9afe-654360f50a4a', 1, 'Tin tức văn hóa', 'Tin-tuc-van-hoa', 'Tin tức văn hóa', 'Tin tức văn hóa', 'Tin tức văn hóa', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/van-hoa', '2017-02-21 14:07:24'),
(4, '9fa5585b-6d20-4425-b5d2-fc2ceca79eea', 1, 'Môi trường', 'Moi-truong', 'Môi trường', 'Môi trường', 'Môi trường', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/moi-truong', '2017-02-21 14:07:24'),
(5, '8ec58c01-f2d3-48b1-b2e8-b84e0c5176bd', 1, 'Bản tin tài chính', 'Ban-tin-tai-chinh', 'Bản tin tài chính', 'Bản tin tài chính', 'Bản tin tài chính', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/tai-chinh-ngan-hang', '2017-02-21 14:07:24'),
(6, 'e55a8f3b-8dac-4d4e-92c6-5f7d2fd54ec7', 1, 'Tin tức giải trí', 'Tin-tuc-giai-tri', 'Tin tức giải trí', 'Tin tức giải trí', 'Tin tức giải trí', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/giai-tri', '2017-02-21 14:07:24'),
(7, 'acbfd24d-d3f9-4cce-b477-9c9ce47ae9d3', 1, 'Khỏe', 'Khoe', 'Khỏe', 'Khỏe', 'Khỏe', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/suc-khoe', '2017-02-21 14:07:24'),
(8, 'c091ea8e-d314-4528-9171-ac76c36992de', 1, 'Phong thủy', 'Phong-thuy', 'Phong thủy', 'Phong thủy', 'Phong thủy', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/tag/phong-th%E1%BB%A7y', '2017-02-21 14:07:24'),
(9, 'a7dcc909-4a5c-4806-a088-51baa4db1dc0', 1, 'Quà tặng', 'Qua-tang', 'Quà tặng', 'Quà tặng', 'Quà tặng', '', 0, 0, '2017-02-21 14:07:24', 'http://hoinguoicaotuoi.vn/g/cham-soc-nct-7', '2017-02-21 14:07:24'),
(10, '4ed1b759-b064-4044-a8db-5348a586e3f2', 1, 'Video', 'Video', 'Video', 'Video', 'Video', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/video', '2017-02-21 14:07:24'),
(11, '11d02d07-6bcd-47ca-b139-aa627cde3b15', 1, 'Bóng đá Việt Nam', 'Bong-da-viet-nam', 'Bóng đá Việt Nam', 'Bóng đá Việt Nam', 'Bóng đá Việt Nam', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/bong-da-viet-nam', '2017-02-21 14:07:24'),
(12, '1ff5cd26-c76f-434d-8c15-428f12e098ca', 1, 'Bóng đá quốc tế', 'Bong-da-quoc-te', 'Bóng đá quốc tế', 'Bóng đá quốc tế', 'Bóng đá quốc tế', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/bong-da-quoc-te', '2017-02-21 14:07:24'),
(13, '48d58973-889e-4f01-9743-0c2fe087bb6a', 1, 'Hậu trường', 'Hau-truong', 'Hậu trường', 'Hậu trường', 'Hậu trường', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/hau-truong', '2017-02-21 14:07:24'),
(14, 'cb52f8be-19af-4c0f-8cbe-5cb910b98589', 1, 'Âm nhạc', 'Am-nhac', 'Âm nhạc', 'Âm nhạc', 'Âm nhạc', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/am-nhac', '2017-02-21 14:07:24'),
(15, 'b465409f-6123-4b3f-99c5-13b43247da9f', 1, 'Ngôi sao', 'Ngoi-sao', 'Ngôi sao', 'Ngôi sao', 'Ngôi sao', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/ngoi-sao', '2017-02-21 14:07:24'),
(16, '9e7df889-d336-4a70-8cd8-1f0d00a96781', 1, 'Phim ảnh', 'Phim-anh', 'Phim ảnh', 'Phim ảnh', 'Phim ảnh', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/phim-anh', '2017-02-21 14:07:24'),
(17, '4f907f47-b988-4697-8866-10dab0f34812', 1, 'Sự kiện', 'Su-kien', 'Sự kiện', 'Sự kiện', 'Sự kiện', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/tv-show', '2017-02-21 14:07:24'),
(18, '70e861cf-556b-4465-a2f1-2294fd9f5221', 1, 'Công nghệ', 'Cong-nghe', 'Công nghệ', 'Công nghệ', 'Công nghệ', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/cong-nghe', '2017-02-21 14:07:24'),
(19, '10fdd9ef-34de-4eca-b86f-9aaf691906f9', 1, 'Mobie', 'Mobile', 'Mobile', 'Mobile', 'Mobile', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/mobile', '2017-02-21 14:07:24'),
(20, 'e0ad816c-4948-4577-aa00-ecf475b27c0c', 1, 'Máy tính', 'May-tinh', 'Máy tính', 'Máy tính', 'Máy tính', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/may-tinh', '2017-02-21 14:07:24'),
(21, 'c2d52e05-a300-418b-870c-9acde744ddb4', 1, 'Ô tô xe máy', 'O-to-xe-may', 'Ô tô xe máy', 'Ô tô xe máy', 'Ô tô xe máy', '', 0, 0, '2017-02-21 14:07:24', 'http://www.nguoiduatin.vn/c/o-to-xe-may', '2017-02-21 14:07:24'),
(22, 'da371521-874e-442f-8885-2e9c0846c06c', 1, 'Tin Tức', 'tin-tuc-9155', 'tin tức', 'tin tức', 'tin tức', '', 0, 0, '2017-03-15 10:15:53', 'http://www.doisongphapluat.com/tin-tuc/', '2017-03-15 10:15:53'),
(23, 'da310833-9db0-46cd-bc1c-8a9269d7c65c', 1, 'Kinh Doanh', 'kinh-doanh-9155', 'kinh doanh', 'kinh doanh', 'kinh doanh', '', 0, 0, '2017-03-15 10:15:54', 'http://www.doisongphapluat.com/kinh-doanh/', '2017-03-15 10:15:54'),
(24, '3ab2c117-4fb5-44d1-9686-f58188c423b7', 1, 'Đời Sống', 'doi-song-9155', 'đời sống', 'đời sống', 'đời sống', '', 0, 0, '2017-03-15 10:15:54', 'http://www.doisongphapluat.com/doi-song/', '2017-03-15 10:15:54'),
(25, '72adde6c-37ad-4348-8ad1-9540416893d4', 1, 'Thể Thao', 'the-thao-9155', 'thể thao', 'thể thao', 'thể thao', '', 0, 0, '2017-03-15 10:15:54', 'http://thethaovietnam.vn/the-thao-c365-p1.html', '2017-03-15 10:15:54'),
(26, 'a89350f6-9a69-4bf5-a832-224f0be36689', 1, 'Giải Trí', 'giai-tri-9155', 'giải trí', 'giải trí', 'giải trí', '', 0, 0, '2017-03-15 10:15:54', 'http://www.doisongphapluat.com/giai-tri/', '2017-03-15 10:15:54'),
(27, '4f4dbd07-137f-47b3-acfd-bc3c7fbd5df6', 1, 'Tin tức', 'Tin-tuc-mobile', 'Tin tức', 'Tin tức', 'Tin tức', '', 0, 0, '2017-04-05 11:15:14', 'http://www.doisongphapluat.com/tin-the-gioi', '2017-04-05 11:15:14'),
(28, '51f403e2-717c-4207-8ac1-f58144a58f72', 1, 'Kinh doanh', 'Kinh-doanh-mobile', 'Kinh doanh', 'Kinh doanh', 'Kinh doanh', '', 0, 0, '2017-04-05 11:15:14', 'http://www.doisongphapluat.com/kinh-doanh/thi-truong', '2017-04-05 11:15:14'),
(29, '3004810a-8dd3-44a6-86d7-04536300e810', 1, 'Đời sống', 'Doi-song-mobile', 'Đời sống', 'Đời sống', 'Đời sống', '', 0, 0, '2017-04-05 11:15:14', 'http://www.doisongphapluat.com/cong-dong-mang', '2017-04-05 11:15:14'),
(30, '3fe338c8-45c1-45f6-b360-f3398da01ca4', 1, 'Thể thao', 'The-thao-mobile', 'Thể thao', 'Thể thao', 'Thể thao', '', 0, 0, '2017-04-05 11:15:14', 'http://thethaovietnam.vn/quan-vot', '2017-04-05 11:15:14'),
(31, 'c696f86e-cbce-45b0-b4a4-b186f902368f', 1, 'Giải trí', 'Giai-tri-mobile', 'Giải trí', 'Giải trí', 'Giải trí', '', 0, 0, '2017-04-05 11:15:14', 'http://www.doisongphapluat.com/giai-tri', '2017-04-05 11:15:14'),
(32, '84a9f9a9-f279-430c-836c-a65b1ca2067c', 1, 'Công nghệ', 'Cong-nghe-mobile', 'Công nghệ', 'Công nghệ', 'Công nghệ', '', 0, 0, '2017-04-05 11:15:14', 'http://www.doisongphapluat.com/cong-nghe', '2017-04-05 11:15:14'),
(33, '8756a1b5-475c-4292-b635-4162fb6d26eb', 1, 'Bản tin 247', 'Ban-tin-247-home', 'Bản tin 247', 'Bản tin 247', 'Bản tin 247', '', 0, 0, '2017-04-13 15:49:20', '', '2017-04-13 15:49:54'),
(34, '9a6f8164-63ca-4544-afa5-54fb67683933', 1, 'Tin tức', 'Ban-tin-247-tin-tuc', 'Tin tức', 'Tin tức', 'Tin tức', '', 33, 0, '2017-04-13 15:49:44', '', '2017-04-13 15:49:44'),
(35, '85b6b3c6-4bad-48d1-a08b-2b54100bf020', 1, 'Mua10', 'mua-10-home', 'Mua10', 'Mua10', 'Mua10', '', 0, 0, '2017-04-13 15:56:20', '', '2017-04-13 16:12:48'),
(36, '439b570d-1bf1-4917-9409-68415e59e152', 1, 'Mobile', 'mua-10-mobile', 'Mobile', 'Mobile', 'Mobile', '', 35, 0, '2017-04-13 15:57:43', '', '2017-04-13 15:57:43'),
(37, '5fe367d0-0249-4f31-a84d-3fd939bbe7ae', 1, 'Máy tính', 'mua-10-may-tinh', 'Máy tính', 'Máy tính', 'Máy tính', '', 35, 0, '2017-04-13 15:59:44', '', '2017-04-13 15:59:44'),
(38, '93c67f92-f548-490c-953a-d19cbd5f3a29', 1, 'Ô tô xe máy', 'mua-10-o-to-xe-may', 'Ô tô xe máy', 'Ô tô xe máy', 'Ô tô xe máy', '', 35, 0, '2017-04-13 16:00:24', '', '2017-04-13 16:00:24'),
(39, '5c8738c8-b338-48f9-9621-d59f41363cee', 1, 'Văn hóa', 'Ban-tin-247-van-hoa', 'Văn hóa', 'Văn hóa', 'Văn hóa', '', 33, 0, '2017-04-13 16:04:41', '', '2017-04-13 16:04:41'),
(40, '05d1a77d-447a-4b33-b9c9-1e6ff0fa99bc', 1, 'Giải trí', 'Ban-tin-247-giai-tri', 'Giải trí', 'Giải trí', 'Giải trí', '', 33, 0, '2017-04-13 16:09:59', '', '2017-04-13 16:09:59'),
(41, '51afe5d6-a324-49f0-9951-be83cee564d3', 1, 'Phong thủy', 'Ban-tin-247-phong-thuy', 'Phong thủy', 'Phong thủy', 'Phong thủy', '', 33, 0, '2017-04-13 16:10:43', '', '2017-04-13 16:10:43'),
(42, '9d2a8273-3e84-474b-85ee-fb1d828e6f02', 1, 'TV 247', 'tv-247-home', 'TV 247', 'TV 247', 'TV 247', '', 0, 0, '2017-04-13 16:13:52', '', '2017-04-13 16:13:52'),
(43, '8824bb05-4900-4b98-9921-3b1a0a83e15d', 1, 'Bóng đá Việt Nam', 'tv-247-bong-da-viet-nam', 'Bóng đá Việt Nam', 'Bóng đá Việt Nam', 'Bóng đá Việt Nam', '', 42, 0, '2017-04-13 16:14:48', '', '2017-04-13 16:14:48'),
(44, '7da11221-04d8-431e-869a-e9e1d56d9e73', 1, 'Bóng đá quốc tế', 'tv-247-bong-da-quoc-te', 'Bóng đá quốc tế', 'Bóng đá quốc tế', 'Bóng đá quốc tế', '', 42, 0, '2017-04-13 16:15:36', '', '2017-04-13 16:15:36'),
(45, '0a9c8046-35fc-493d-a6b6-335a16378490', 1, 'Hậu trường', 'tv-247-hau-truong', 'Hậu trường', 'Hậu trường', 'Hậu trường', '', 42, 0, '2017-04-13 16:16:14', '', '2017-04-13 16:16:14'),
(46, 'c0d67d54-e61a-4fc5-a9ee-b1ef060e61a9', 1, 'Tin tài chính 360', 'tin-tai-chinh-360-home', 'Tin tài chính 360', 'Tin tài chTin tài chính 360ính 360', 'Tin tài chính 360', '', 0, 0, '2017-04-13 16:17:42', '', '2017-04-13 16:17:42'),
(47, 'd1c16260-ad38-4a7f-a759-94cd14b0ea50', 1, 'Tin tài chính', 'tin-tai-chinh-360-tin-tai-chinh', 'Tin tài chính', 'Tin tài chính', 'Tin tài chính', '', 46, 0, '2017-04-13 16:18:27', '', '2017-04-13 16:18:27'),
(48, '283e8b69-4d18-4d66-8391-ae0c3bcab18a', 1, 'Tin kinh tế', 'tin-tai-chinh-360-tin-kinh-te', 'Tin kinh tế', 'Tin kinh tế', 'Tin kinh tế', '', 46, 0, '2017-04-13 16:19:02', '', '2017-04-13 16:19:02'),
(49, 'ebb9ddcb-cd15-4151-bdda-2acfa6e9405b', 1, 'Giải trí', 'tin-tai-chinh-360-giai-tri', 'Giải trí', 'Giải trí', 'Giải trí', '', 46, 0, '2017-04-13 16:19:51', '', '2017-04-13 16:19:51'),
(50, 'ea20fe0a-80c0-40dc-bf01-00810041dd19', 1, 'Văn hóa', 'tin-tai-chinh-360-van-hoa', 'Văn hóa', 'Văn hóa', 'Văn hóa', '', 46, 0, '2017-04-13 16:20:28', '', '2017-04-13 16:20:28'),
(51, '53d0a589-bbdc-44f8-82ad-9f01aadd8d59', 1, 'Sphim', 'sphim-home', 'Sphim', 'Sphim', 'Sphim', '', 0, 0, '2017-04-13 16:21:35', '', '2017-04-13 16:21:35'),
(52, 'a7194ecc-eaea-4947-afff-1c7f19934ae7', 1, 'Âm nhạc', 'sphim-am-nhac', 'Âm nhạc', 'Âm nhạc', 'Âm nhạc', '', 51, 0, '2017-04-13 16:22:08', '', '2017-04-13 16:22:08'),
(53, '353e0451-1bed-43ff-b44a-9c07d82debcb', 1, 'Ngôi sao', 'sphim-ngoi-sao', 'Ngôi sao', 'Ngôi sao', 'Ngôi sao', '', 51, 0, '2017-04-13 16:22:46', '', '2017-04-13 16:22:46'),
(54, '258b49d0-248b-4534-8519-613c2ebd7a37', 1, 'Phim ảnh', 'sphim-phim-anh', 'Phim ảnh', 'Phim ảnh', 'Phim ảnh', '', 51, 0, '2017-04-13 16:23:18', '', '2017-04-13 16:23:18'),
(55, '46ef4b3c-0269-4e8f-bcf6-bd0287ff2404', 1, 'Sự kiện', 'sphim-su-kien', 'Sự kiện', 'Sự kiện', 'Sự kiện', '', 51, 0, '2017-04-13 16:23:54', '', '2017-04-13 16:23:54'),
(56, '864fa78e-e0b1-4481-b403-b35a588b546d', 1, 'XS Online', 'xs-online-home', 'XS Online', 'XS Online', 'XS Online', '', 0, 0, '2017-04-13 16:26:02', '', '2017-04-13 16:26:02'),
(57, 'e0ac0a91-f07b-4bd5-9c86-2569e681e9eb', 1, 'Văn hóa', 'xs-online-van-hoa', 'Văn hóa', 'Văn hóa', 'Văn hóa', '', 56, 0, '2017-04-13 16:26:40', '', '2017-04-13 16:26:40'),
(58, '1035d718-8459-4038-8e38-403e62708246', 1, 'Xã hội', 'xs-online-xa-hoi', 'Xã hội', 'Xã hội', 'Xã hội', '', 56, 0, '2017-04-13 16:27:15', '', '2017-04-13 16:27:15'),
(59, '4872cb61-e152-471a-8567-d44612dca747', 1, 'Kinh tế', 'xs-online-kinh-te', 'Kinh tế', 'Kinh tế', 'Kinh tế', '', 56, 0, '2017-04-13 16:27:48', '', '2017-04-13 16:27:48'),
(60, '415d8cf7-124e-4cbf-af7a-7c15b894992d', 1, 'Tin trong nước', 'xs-online-tin-trong-nuoc', 'Tin trong nước', 'Tin trong nước', 'Tin trong nước', '', 56, 0, '2017-04-13 16:28:25', '', '2017-04-13 16:28:25'),
(61, '1f4d95d4-55e6-4068-ba46-6006efa5a525', 1, 'Tin quốc tế', 'xs-online-tin-quoc-te', 'Tin quốc tế', 'Tin quốc tế', 'Tin quốc tế', '', 56, 0, '2017-04-13 16:29:13', '', '2017-04-13 16:29:13'),
(62, '027864b1-e7a5-4691-a02f-872bb31e1628', 1, 'Môi trường', 'xs-online-moi-truong', 'Môi trường', 'Môi trường', 'Môi trường', '', 56, 0, '2017-04-13 16:29:50', '', '2017-04-13 16:29:50'),
(63, '73067728-6891-4503-abf1-669470d21793', 1, 'Phong thủy', 'xs-online-phong-thuy', 'Phong thủy', 'Phong thủy', 'Phong thủy', '', 56, 0, '2017-04-13 16:30:27', '', '2017-04-13 16:30:27'),
(64, '11f226f2-2d28-41f4-a114-79d6d1bf9bd9', 1, 'Itravels', 'itravels-home', 'Itravels', 'Itravels', 'Itravels', '', 0, 0, '2017-04-13 16:32:20', '', '2017-04-13 16:32:20'),
(65, '471ea3cb-91f5-483c-8775-4597fe7d3737', 1, 'Văn hóa', 'itravels-van-hoa', 'Văn hóa', 'Văn hóa', 'Văn hóa', '', 64, 0, '2017-04-13 16:32:56', '', '2017-04-13 16:32:56'),
(66, '2f3432a5-69c5-490a-be43-9dbf4be21375', 1, 'Sức khỏe', 'itravels-suc-khoe', 'Sức khỏe', 'Sức khỏe', 'Sức khỏe', '', 64, 0, '2017-04-13 16:33:29', '', '2017-04-13 16:33:29'),
(67, '58404131-fddc-4652-ba7d-f9196d0ac5a7', 1, 'Giải trí', 'itravels-giai-tri', 'Giải trí', 'Giải trí', 'Giải trí', '', 64, 0, '2017-04-13 16:34:06', '', '2017-04-13 16:34:06'),
(68, '3fccea77-d140-4a33-8659-993ae9beac06', 1, 'Phong thủy', 'itravels-phong-thuy', 'Phong thủy', 'Phong thủy', 'Phong thủy', '', 64, 0, '2017-04-13 16:34:37', '', '2017-04-13 16:34:37'),
(69, 'b51fabb1-3879-4548-b31b-62992c12dfa0', 1, 'Đời sống', 'itravels-doi-song', 'Đời sống', 'Đời sống', 'Đời sống', '', 64, 0, '2017-04-13 16:35:23', '', '2017-04-13 16:35:23'),
(70, 'b4cb7dc7-f4fa-42ad-aff7-17b43204e5e2', 1, 'Cung hoàng đạo', 'Cung-hoang-dao', 'Cung hoàng đạo', 'Cung hoàng đạo', 'Cung hoàng đạo', '', 68, 0, '2017-05-09 08:41:08', '', '2017-05-09 08:41:08'),
(71, 'b9df6247-eb7f-4f9b-98d6-8ff9018edef0', 1, 'Tử vi', 'Tu-vi', 'Tử vi', 'Tử vi', 'Tử vi', '', 68, 0, '2017-05-09 08:42:19', '', '2017-05-09 08:42:19'),
(72, '2f551db8-4a7d-4806-a692-c2861e605503', 1, 'Xuân tài lộc', 'Xuan-tai-loc', 'Xuân tài lộc', 'Xuân tài lộc', 'Xuân tài lộc', '', 68, 0, '2017-05-09 08:43:15', '', '2017-05-09 08:43:15'),
(73, 'ccc16db3-b752-4f3a-ab43-d16d03a64afc', 1, 'Phong thủy tài lộc', 'Phong-thuy-tai-loc', 'Phong thủy tài lộc', 'Phong thủy tài lộc', 'Phong thủy tài lộc', '', 68, 0, '2017-05-09 08:43:53', '', '2017-05-09 08:43:53'),
(74, '0506e949-d874-45b5-aca0-98b3a72c2cf0', 1, 'Vip', 'Vip', 'Vip', 'Vip', 'Vip', '', 0, 0, '2017-07-06 12:57:16', '', '2017-07-06 12:57:16'),
(75, 'a0c13659-adc3-4192-a8bf-504134b81ab5', 1, 'Hài', 'Hai', 'Hài', 'Hài', 'Hài', '', 0, 0, '2017-07-06 12:57:16', '', '2017-07-06 12:57:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(2048) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Data Options';

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `name`, `value`, `status`, `created_at`) VALUES
(1, 'website_name', 'Thudomultimedia', 1, '2016-12-20 00:00:00'),
(2, 'website_email', 'hungna@gviet.vn', 1, '2016-12-20 00:00:00'),
(3, 'url_privacy', 'http://m.gviet.io/pages/privacy.html', 1, '2016-12-23 00:00:00'),
(4, 'url_policy', 'http://m.gviet.io/pages/policy.html', 1, '2016-12-23 00:00:00'),
(5, 'url_contact', 'http://m.gviet.io/pages/contact.html', 1, '2016-12-23 00:00:00'),
(6, 'website_footer_desc', 'Nội dung mô tả, giới thiệu về dịch vụ dưới footer', 1, '2016-12-23 00:00:00'),
(7, 'website_footer_callcenter', '1900585868', 1, '2016-12-23 00:00:00'),
(8, 'website_logo', 'http://m.gviet.vn/assets/images/logo/website_logo.png', 1, '2016-12-23 00:00:00'),
(9, 'website_logo_small', 'http://m.gviet.vn/assets/images/logo/website_logo_small.png', 1, '2016-12-23 00:00:00'),
(10, 'website_logo_medium', 'http://m.gviet.vn/assets/images/logo/website_logo_medium.png', 1, '2016-12-23 00:00:00'),
(11, 'website_logo_big', 'http://m.gviet.vn/assets/images/logo/website_logo_big.png', 1, '2016-12-23 00:00:00'),
(12, 'itravels_header_hotline_value', '1900 585 868', 1, '2016-12-02 11:28:32'),
(13, 'itravels_header_hotline_name', 'Hotline', 1, '2016-12-02 11:29:06'),
(14, 'itravels_header_service_email_name', 'Email', 1, '2016-12-02 11:31:19'),
(15, 'itravels_header_service_email_value', 'cskh@gviet.vn', 1, '2016-12-02 11:31:53'),
(16, 'itravels_footer_privacy_policy', 'Privacy Policy ', 1, '2016-12-02 11:40:19'),
(17, 'itravels_footer_terms_of_service', 'Terms of Service', 1, '2016-12-02 11:41:26'),
(18, 'itravels_footer_about_us', 'Về chúng tôi', 1, '2016-12-02 14:00:05'),
(19, 'itravels_footer_partner', 'Nhà đầu tư', 1, '2016-12-02 12:34:31'),
(20, 'itravels_footer_contact', 'Liên hệ', 1, '2016-12-02 13:38:20'),
(21, 'itravels_header_youtube_link', 'youtube.com', 1, '2016-12-02 14:21:45'),
(22, 'itravels_header_facebook_link', 'facebook.com', 1, '2016-12-02 14:29:58'),
(23, 'itravels_header_twitter_link', 'twitter.com', 1, '2016-12-02 14:32:26'),
(24, 'itravels_header_googleplus_link', 'google.com', 1, '2016-12-02 14:34:19'),
(25, 'itravels_header_skype_link', 'skype.com', 1, '2016-12-02 14:35:20'),
(26, 'itravels_footer_skype_link', 'skype.com', 1, '2016-12-02 14:36:33'),
(27, 'itravels_footer_facebook_link', 'facebook.com', 1, '2016-12-02 14:37:15'),
(28, 'itravels_footer_twitter_link', 'twitter.com', 1, '2016-12-02 14:48:25'),
(29, 'itravels_footer_googleplus_link', 'google.com', 1, '2016-12-02 14:40:18'),
(30, 'itravels_footer_youtube_link', 'youtube.com', 1, '2016-12-02 15:11:24'),
(34, 'doisongonline_site_title', 'Giải Trí Tổng Hợp', 1, '2016-12-02 14:35:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = Active',
  `language` varchar(50) NOT NULL DEFAULT 'vietnamese',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `slugs` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `summary` varchar(2048) NOT NULL,
  `content` longtext NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(386) NOT NULL,
  `tags` varchar(512) NOT NULL,
  `source` varchar(255) NOT NULL COMMENT 'Nguồn',
  `viewed` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Lượt xem',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Author',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = Active',
  `language` varchar(50) NOT NULL DEFAULT 'vietnamese',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '2 = HOT',
  `categories` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `topics` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `slugs` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `summary` varchar(2048) NOT NULL,
  `content` longtext NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(386) NOT NULL,
  `tags` varchar(512) NOT NULL,
  `source` varchar(255) NOT NULL COMMENT 'Nguồn',
  `viewed` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Lượt xem',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Author',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `bodyText` longtext,
  `referer` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = Active',
  `language` varchar(50) NOT NULL DEFAULT 'vietnamese',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `categories` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `topics` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `slugs` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `auto` varchar(255) DEFAULT NULL,
  `low` varchar(255) DEFAULT NULL,
  `medium` varchar(255) DEFAULT NULL,
  `high` varchar(255) DEFAULT NULL,
  `description` varchar(2048) NOT NULL,
  `tags` varchar(386) NOT NULL,
  `source` varchar(255) NOT NULL,
  `viewed` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `resolution` varchar(50) NOT NULL DEFAULT 'HD',
  `liked` int(11) NOT NULL DEFAULT '0',
  `timed` varchar(128) NOT NULL DEFAULT '05:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `slugs` (`slugs`(255)),
  ADD KEY `parent` (`parent`),
  ADD KEY `active` (`status`),
  ADD KEY `name` (`name`(255)),
  ADD KEY `order_stt` (`order_stt`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `status` (`status`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `type` (`type`),
  ADD KEY `status` (`status`),
  ADD KEY `slugs` (`slugs`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `language` (`language`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `status` (`status`),
  ADD KEY `categories` (`categories`),
  ADD KEY `topics` (`topics`),
  ADD KEY `slugs` (`slugs`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `language` (`language`),
  ADD KEY `name` (`name`);

--
-- Chỉ mục cho bảng `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `type` (`type`),
  ADD KEY `status` (`status`),
  ADD KEY `categories` (`categories`),
  ADD KEY `topics` (`topics`),
  ADD KEY `slugs` (`slugs`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID chính', AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
