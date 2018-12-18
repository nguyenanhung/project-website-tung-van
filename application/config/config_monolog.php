<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 7/8/2017
 * Time: 8:43 PM
 */
$config['monologServicesConfigures'] = array(
    // the default date format is "Y-m-d H:i:s"
    'dateFormat' => "Y-m-d H:i:s u",
    // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
    'outputFormat' => "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
    'monoBubble' => true,
    'monoFilePermission' => 0777,
    // Cấu hình theo chuẩn mới
    'website' => array(
        'homepage' => array(
            'debug' => false,
            'logger_path' => APPPATH . 'logs-data/Sites/Homepage/',
            'logger_file' => 'Log-' . date('Y-m-d') . '.log',
            'logger_name' => 'site'
        )
    )
);
