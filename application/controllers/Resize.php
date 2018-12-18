<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/30/18
 * Time: 11:13
 */
require_once APPPATH . 'third_party/Resize_image.php';
class Resize extends CI_Controller
{
    /**
     * Resize constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets');
        $this->load->helper('url');
    }
    /**
     * Resize Image
     * @link /resize/index
     * @author Hung Nguyen <dev@nguyenanhung.com>
     */
    public function index()
    {
        $link     = base64_decode($this->input->get('url', true)); // Link ảnh Input
        $width    = $this->input->get('w', true); // Chiều rộng
        $heigh    = $this->input->get('h', true); // Chiều cao
        $newWidth = empty($width) ? 100 : $width;
        $newHeigh = empty($heigh) ? 100 : $heigh;
        if (empty($link)) {
            $link = assets_url('images/system/no-image-available_100.jpg');
        }
        $resizeObj = new Resize_image($link);
        $resizeObj->resizeImage($newWidth, $newHeigh, 'auto');
        $resizeObj->showImage(100);
    }
}
