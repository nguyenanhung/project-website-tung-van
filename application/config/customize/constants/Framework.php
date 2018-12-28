<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ----------------------------------------------------------------------------------
 * MY_CUSTOM_KEY_CODE_FOR_URL_POSTS_EN_DE_CODE_BY_HUNG_DEV
 *
 * Returns KEY_CODE
 *
 * @access      public
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       21/12/2016
 * ------------------------------------------------------
 *
 * Mã hóa Url ID của bài viết, tăng tính bảo mật + tránh lộ ID gốc của bài viết
 *
 * Công thức:
 * Encode: Sử dụng 1 key mặc định, cộng thêm từ id gốc và trả về giá trị sau khi encode
 * Decode: Ngược lại chu trình trên
 * Keyname: MY_CUSTOM_KEY_CODE_FOR_URL_POSTS_EN_DE_CODE_BY_HUNG_DEV
 *
 * Chú ý:
 * Tuyệt đối KO thay đổi key trong quá trình vận hành, tránh làm giảm hạng SEO
 * Có thể custom cho các controller khác nhau
 *
 * ----------------------------------------------------------------------------------
 */
define('MY_CUSTOM_KEY_CODE_FOR_URL_POSTS_EN_DE_CODE_BY_HUNG_DEV', 23456789);
/**
 * Defaut Cache TTL
 */
define('DEFAUT_CACHE_ADAPTER', 'apc');
define('DEFAUT_CACHE_BACKUP', 'file');
define('DEFAUT_CACHE_TIME_TTL', 3600);
