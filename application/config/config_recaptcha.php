<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/15/18
 * Time: 16:22
 */
$config['ReCaptchaStatus'] = true; // true nếu sử dụng ReCaptcha, false nếu bỏ qua check ReCaptcha
$config['ReCaptcha']       = array(
    /**
     * Chú ý, toàn bộ thông số ở đây cần khai báo theo đúng chuẩn Google
     * GET Key tại đây: https://www.google.com/recaptcha/admin
     * Mỗi domain chỉ tồn tại 1 key. Chú ý
     */
    'site_key' => '6LesTlkUAAAAABXdlFSgD9N2F1wn679INxsLg-nO',
    'secret_key' => '6LesTlkUAAAAADYfSbvVaAZR4vLagBI34K37y0Dr',
    // Khai báo ghi nhớ domain alowed
    'domain_allowed' => array(
        'web.tungvan.io',
        'tungvan.vn'
    ),
    'script' => '<script src="https://www.google.com/recaptcha/api.js"></script>',
    'div' => '<div class="g-recaptcha" data-sitekey="6LesTlkUAAAAABXdlFSgD9N2F1wn679INxsLg-nO"></div>'
);
