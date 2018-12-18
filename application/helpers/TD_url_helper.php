<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ----------------------------------------------
 * share_url
 *
 * Returns share_url URL
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ----------------------------------------------
 *
 * Tạo url share lên các mạng xã hội cho Site
 * Cấu trúc lấy nguyên mẫu từ mạng xã hội
 *
 * $href = Đường dẫn cần share - bắt buộc
 * $platform = Tên mạng xã hội (fb_share, fb_send, twitter, googleplus, pinterest, linkedin ... )
 * $app_id = nếu platform là facebook thì cần khai biến này
 * $redirect = redirect đường dẫn về nếu có
 * $display = thuộc tính display (popup...)
 * $images = images nếu có
 * $title = title nếu có
 * ----------------------------------------------
 */
if (!function_exists('share_url'))
{
    function share_url($href = '', $platform = '', $app_id = '', $redirect = '', $display = '', $images = '', $title = '')
    {
        if ($href == '')
        {
            $share_link = urlencode(base_url());
        }
        else
        {
            $share_link = urlencode($href);
        }
        if ($redirect == '' || empty($redirect))
        {
            $redirect_link = urlencode(base_url());
        }
        else
        {
            $redirect_link = urlencode($redirect);
        }
        if ($platform == 'fb_share')
        {
            if ($display != '')
            {
                $share_url = 'https://www.facebook.com/dialog/share?app_id=' . $app_id . '&amp;display=' . $display . '&amp;href=' . $share_link . '&amp;redirect_uri=' . $redirect_link;
            }
            else
            {
                $share_url = 'https://www.facebook.com/dialog/share?app_id=' . $app_id . '&amp;href=' . $share_link . '&amp;redirect_uri=' . $redirect_link;
            }
        }
        elseif ($platform == 'fb_send')
        {
            if ($display != '')
            {
                $share_url = 'http://www.facebook.com/dialog/send?app_id=' . $app_id . '&amp;display=' . $display . '&amp;link=' . $share_link . '&amp;redirect_uri=' . $redirect_link;
            }
            else
            {
                $share_url = 'http://www.facebook.com/dialog/send?app_id=' . $app_id . '&amp;link=' . $share_link . '&amp;redirect_uri=' . $redirect_link;
            }
        }
        elseif ($platform == 'twitter')
        {
            $share_url = 'https://twitter.com/home?status=' . $share_link;
        }
        elseif ($platform == 'googleplus')
        {
            $share_url = 'https://plus.google.com/share?url=' . $share_link;
        }
        elseif ($platform == 'pinterest')
        {
            $share_url = 'https://pinterest.com/pin/create/button/?url=' . $share_link . '&media=' . $images . '&description=' . $title;
        }
        elseif ($platform == 'linkedin')
        {
            $share_url = 'https://www.linkedin.com/shareArticle?mini=true&url=%3Ca%20href=%22https%3A//www.linkedin.com/shareArticle?mini=true%26url=' . $share_link . '%26title=%25C3%25A1df%26summary=%25C3%25A1%26source=TV%2520News%22%3EShare%20on%20LinkedIn%3C/a%3E&title=' . $title . '&summary=&source=TV%20News';
        }
        else
        {
            $share_url = $share_link;
        }
        return $share_url;
    }
}
/**
 * ----------------------------------------------
 * encodeId_Url_byHungDEV
 *
 * Returns encodeId_Url_byHungDEV
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ----------------------------------------------
 *
 * Mã hóa Url ID của bài viết, tăng tính bảo mật
 * Sử dụng Chuỗi sau khi đã Encode để show ra Url
 * 
 * ----------------------------------------------
 */
if (!function_exists('encodeId_Url_byHungDEV'))
{
    function encodeId_Url_byHungDEV($id)
    {
        $id += MY_CUSTOM_KEY_CODE_FOR_URL_POSTS_EN_DE_CODE_BY_HUNG_DEV;
        $id = str_replace(array(
            '0',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9'
        ), array(
            'E',
            'R',
            'M',
            'N',
            'J',
            'I',
            'Z',
            'K',
            'L',
            'O'
        ), $id);
        return $id;
    }
}
/**
 * ----------------------------------------------
 * decodeId_Url_byHungDEV
 *
 * Returns decodeId_Url_byHungDEV
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ----------------------------------------------
 *
 * Giải mãi Url ID của bài viết để lấy ID gốc
 * Sử dụng ID gốc này để truy vấn vào server lấy thông tin
 * -------------------------------------------------------
 */
if (!function_exists('decodeId_Url_byHungDEV'))
{
    function decodeId_Url_byHungDEV($id)
    {
        $id = strtoupper($id);
        $id = str_replace(array(
            'E',
            'R',
            'M',
            'N',
            'J',
            'I',
            'Z',
            'K',
            'L',
            'O'
        ), array(
            '0',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9'
        ), $id);
        $id -= MY_CUSTOM_KEY_CODE_FOR_URL_POSTS_EN_DE_CODE_BY_HUNG_DEV;
        return $id;
    }
}
/**
 * ----------------------------------------------
 * codau2khongdau
 *
 * Returns codau2khongdau URL
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ---------------
 * 
 * Hàm dùng để convert các ký tự có dấu thành không dấu
 * Dùng tốt cho các chức năng SEO
 * vì nhiều engine không hiểu được dấu tiếng Việt
 * nên cần phải bỏ dấu tiếng Việt đi
 *
 * ----------------------------------------------
 */
if (!function_exists('codau2khongdau'))
{
    function codau2khongdau($string = '', $alphabetOnly = false, $tolower = true)
    {
        $output = $string;
        if ($output != '')
        {
            //Tien hanh xu ly bo dau o day
            $search  = array(
                '&#225;',
                '&#224;',
                '&#7843;',
                '&#227;',
                '&#7841;', // a' a` a? a~ a.
                '&#259;',
                '&#7855;',
                '&#7857;',
                '&#7859;',
                '&#7861;',
                '&#7863;', // a( a('
                '&#226;',
                '&#7845;',
                '&#7847;',
                '&#7849;',
                '&#7851;',
                '&#7853;', // a^ a^'..
                '&#273;', // d-
                '&#233;',
                '&#232;',
                '&#7867;',
                '&#7869;',
                '&#7865;', // e' e`..
                '&#234;',
                '&#7871;',
                '&#7873;',
                '&#7875;',
                '&#7877;',
                '&#7879;', // e^ e^'
                '&#237;',
                '&#236;',
                '&#7881;',
                '&#297;',
                '&#7883;', // i' i`..
                '&#243;',
                '&#242;',
                '&#7887;',
                '&#245;',
                '&#7885;', // o' o`..
                '&#244;',
                '&#7889;',
                '&#7891;',
                '&#7893;',
                '&#7895;',
                '&#7897;', // o^ o^'..
                '&#417;',
                '&#7899;',
                '&#7901;',
                '&#7903;',
                '&#7905;',
                '&#7907;', // o* o*'..
                '&#250;',
                '&#249;',
                '&#7911;',
                '&#361;',
                '&#7909;', // u'..
                '&#432;',
                '&#7913;',
                '&#7915;',
                '&#7917;',
                '&#7919;',
                '&#7921;', // u* u*'..
                '&#253;',
                '&#7923;',
                '&#7927;',
                '&#7929;',
                '&#7925;', // y' y`..
                '&#193;',
                '&#192;',
                '&#7842;',
                '&#195;',
                '&#7840;', // A' A` A? A~ A.
                '&#258;',
                '&#7854;',
                '&#7856;',
                '&#7858;',
                '&#7860;',
                '&#7862;', // A( A('..
                '&#194;',
                '&#7844;',
                '&#7846;',
                '&#7848;',
                '&#7850;',
                '&#7852;', // A^ A^'..
                '&#272;', // D-
                '&#201;',
                '&#200;',
                '&#7866;',
                '&#7868;',
                '&#7864;', // E' E`..
                '&#202;',
                '&#7870;',
                '&#7872;',
                '&#7874;',
                '&#7876;',
                '&#7878;', // E^ E^'..
                '&#205;',
                '&#204;',
                '&#7880;',
                '&#296;',
                '&#7882;', // I' I`..
                '&#211;',
                '&#210;',
                '&#7886;',
                '&#213;',
                '&#7884;', // O' O`..
                '&#212;',
                '&#7888;',
                '&#7890;',
                '&#7892;',
                '&#7894;',
                '&#7896;', // O^ O^'..
                '&#416;',
                '&#7898;',
                '&#7900;',
                '&#7902;',
                '&#7904;',
                '&#7906;', // O* O*'..
                '&#218;',
                '&#217;',
                '&#7910;',
                '&#360;',
                '&#7908;', // U' U`..
                '&#431;',
                '&#7912;',
                '&#7914;',
                '&#7916;',
                '&#7918;',
                '&#7920;', // U* U*'..
                '&#221;',
                '&#7922;',
                '&#7926;',
                '&#7928;',
                '&#7924;' // Y' Y`..
            );
            $search2 = array(
                'á',
                'à',
                'ả',
                'ã',
                'ạ', // a' a` a? a~ a.
                'ă',
                'ắ',
                'ằ',
                'ẳ',
                'ẵ',
                'ặ', // a( a('
                'â',
                'ấ',
                'ầ',
                'ẩ',
                'ẫ',
                'ậ', // a^ a^'..
                'đ', // d-
                'é',
                'è',
                'ẻ',
                'ẽ',
                'ẹ', // e' e`..
                'ê',
                'ế',
                'ề',
                'ể',
                'ễ',
                'ệ', // e^ e^'
                'í',
                'ì',
                'ỉ',
                'ĩ',
                'ị', // i' i`..
                'ó',
                'ò',
                'ỏ',
                'õ',
                'ọ',
                'ó ', // o' o`..
                'ô',
                'ố',
                'ồ',
                'ổ',
                'ỗ',
                'ộ', // o^ o^'..
                'ơ',
                'ớ',
                'ờ',
                'ở',
                'ỡ',
                'ợ', // o* o*'..
                'ú',
                'ù',
                'ủ',
                'ũ',
                'ụ',
                'u', // u'..
                'ư',
                'ứ',
                'ừ',
                'ử',
                'ữ',
                'ự', // u* u*'..
                'ý',
                'ỳ',
                'ỷ',
                'ỹ',
                'ỵ', // y' y`..
                'Á',
                'À',
                'Ả',
                'Ã',
                'Ạ', // A' A` A? A~ A.
                'Ă',
                'Ắ',
                'Ằ',
                'Ẳ',
                'Ẵ',
                'Ặ', // A( A('..
                'Â',
                'Ấ',
                'Ầ',
                'Ẩ',
                'Ẫ',
                'Ậ', // A^ A^'..
                'Đ', // D-
                'É',
                'È',
                'Ẻ',
                'Ẽ',
                'Ẹ', // E' E`..
                'Ê',
                'Ế',
                'Ề',
                'Ể',
                'Ễ',
                'Ệ', // E^ E^'..
                'Í',
                'Ì',
                'Ỉ',
                'Ĩ',
                'Ị', // I' I`..
                'Ó',
                'Ò',
                'Ỏ',
                'Õ',
                'Ọ', // O' O`..
                'Ô',
                'Ố',
                'Ồ',
                'Ổ',
                'Ỗ',
                'Ộ', // O^ O^'..
                'Ơ',
                'Ớ',
                'Ờ',
                'Ở',
                'Ỡ',
                'Ợ', // O* O*'..
                'Ú',
                'Ù',
                'Ủ',
                'Ũ',
                'Ụ', // U' U`..
                'Ư',
                'Ứ',
                'Ừ',
                'Ử',
                'Ữ',
                'Ự', // U* U*'..
                'Ý',
                'Ỳ',
                'Ỷ',
                'Ỹ',
                'Ỵ' // Y' Y`..
            );
            $replace = array(
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'a',
                'd',
                'e',
                'e',
                'e',
                'e',
                'e',
                'e',
                'e',
                'e',
                'e',
                'e',
                'e',
                'i',
                'i',
                'i',
                'i',
                'i',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'o',
                'u',
                'u',
                'u',
                'u',
                'u',
                'u',
                'u',
                'u',
                'u',
                'u',
                'u',
                'y',
                'y',
                'y',
                'y',
                'y',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'A',
                'D',
                'E',
                'E',
                'E',
                'E',
                'E',
                'E',
                'E',
                'E',
                'E',
                'E',
                'E',
                'I',
                'I',
                'I',
                'I',
                'I',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'O',
                'U',
                'U',
                'U',
                'U',
                'U',
                'U',
                'U',
                'U',
                'U',
                'U',
                'U',
                'Y',
                'Y',
                'Y',
                'Y',
                'Y'
            );
            $output  = str_replace($search, $replace, $output);
            $output  = str_replace($search2, $replace, $output);
            if ($alphabetOnly)
            {
                $output = alphabetonly($output);
            }
            if ($tolower)
            {
                $output = strtolower($output);
            }
        }
        return $output;
    }
}
/**
 * ----------------------------------------------
 * specialchar2normalchar
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ---------------
 * 
 * Chuyển đổi ký tự đặc biệt thành char
 *
 * ----------------------------------------------
 */
if (!function_exists('specialchar2normalchar'))
{
    function specialchar2normalchar($string = '')
    {
        $output = $string;
        if ($output != '')
        {
            //Tien hanh xu ly bo dau o day
            $search  = array(
                '&#225;',
                '&#224;',
                '&#7843;',
                '&#227;',
                '&#7841;', // a' a` a? a~ a.
                '&#259;',
                '&#7855;',
                '&#7857;',
                '&#7859;',
                '&#7861;',
                '&#7863;', // a( a('
                '&#226;',
                '&#7845;',
                '&#7847;',
                '&#7849;',
                '&#7851;',
                '&#7853;', // a^ a^'..
                '&#273;', // d-
                '&#233;',
                '&#232;',
                '&#7867;',
                '&#7869;',
                '&#7865;', // e' e`..
                '&#234;',
                '&#7871;',
                '&#7873;',
                '&#7875;',
                '&#7877;',
                '&#7879;', // e^ e^'
                '&#237;',
                '&#236;',
                '&#7881;',
                '&#297;',
                '&#7883;', // i' i`..
                '&#243;',
                '&#242;',
                '&#7887;',
                '&#245;',
                '&#7885;', // o' o`..
                '&#244;',
                '&#7889;',
                '&#7891;',
                '&#7893;',
                '&#7895;',
                '&#7897;', // o^ o^'..
                '&#417;',
                '&#7899;',
                '&#7901;',
                '&#7903;',
                '&#7905;',
                '&#7907;', // o* o*'..
                '&#250;',
                '&#249;',
                '&#7911;',
                '&#361;',
                '&#7909;', // u'..
                '&#432;',
                '&#7913;',
                '&#7915;',
                '&#7917;',
                '&#7919;',
                '&#7921;', // u* u*'..
                '&#253;',
                '&#7923;',
                '&#7927;',
                '&#7929;',
                '&#7925;', // y' y`..
                '&#193;',
                '&#192;',
                '&#7842;',
                '&#195;',
                '&#7840;', // A' A` A? A~ A.
                '&#258;',
                '&#7854;',
                '&#7856;',
                '&#7858;',
                '&#7860;',
                '&#7862;', // A( A('..
                '&#194;',
                '&#7844;',
                '&#7846;',
                '&#7848;',
                '&#7850;',
                '&#7852;', // A^ A^'..
                '&#272;', // D-
                '&#201;',
                '&#200;',
                '&#7866;',
                '&#7868;',
                '&#7864;', // E' E`..
                '&#202;',
                '&#7870;',
                '&#7872;',
                '&#7874;',
                '&#7876;',
                '&#7878;', // E^ E^'..
                '&#205;',
                '&#204;',
                '&#7880;',
                '&#296;',
                '&#7882;', // I' I`..
                '&#211;',
                '&#210;',
                '&#7886;',
                '&#213;',
                '&#7884;', // O' O`..
                '&#212;',
                '&#7888;',
                '&#7890;',
                '&#7892;',
                '&#7894;',
                '&#7896;', // O^ O^'..
                '&#416;',
                '&#7898;',
                '&#7900;',
                '&#7902;',
                '&#7904;',
                '&#7906;', // O* O*'..
                '&#218;',
                '&#217;',
                '&#7910;',
                '&#360;',
                '&#7908;', // U' U`..
                '&#431;',
                '&#7912;',
                '&#7914;',
                '&#7916;',
                '&#7918;',
                '&#7920;', // U* U*'..
                '&#221;',
                '&#7922;',
                '&#7926;',
                '&#7928;',
                '&#7924;' // Y' Y`..
            );
            $replace = array(
                'á',
                'à',
                'ả',
                'ã',
                'ạ', // a' a` a? a~ a.
                'ă',
                'ắ',
                'ằ',
                'ẳ',
                'ẵ',
                'ặ', // a( a('
                'â',
                'ấ',
                'ầ',
                'ẩ',
                'ẫ',
                'ậ', // a^ a^'..
                'đ', // d-
                'é',
                'è',
                'ẻ',
                'ẽ',
                'ẹ', // e' e`..
                'ê',
                'ế',
                'ề',
                'ể',
                'ễ',
                'ệ', // e^ e^'
                'í',
                'ì',
                'ỉ',
                'ĩ',
                'ị', // i' i`..
                'ó',
                'ò',
                'ỏ',
                'õ',
                'ọ', // o' o`..
                'ô',
                'ố',
                'ồ',
                'ổ',
                'ỗ',
                'ộ', // o^ o^'..
                'ơ',
                'ớ',
                'ờ',
                'ở',
                'ỡ',
                'ợ', // o* o*'..
                'ú',
                'ù',
                'ủ',
                'ũ',
                'ụ', // u'..
                'ư',
                'ứ',
                'ừ',
                'ử',
                'ữ',
                'ự', // u* u*'..
                'ý',
                'ỳ',
                'ỷ',
                'ỹ',
                'ỵ', // y' y`..
                'Á',
                'À',
                'Ả',
                'Ã',
                'Ạ', // A' A` A? A~ A.
                'Ă',
                'Ắ',
                'Ằ',
                'Ẳ',
                'Ẵ',
                'Ặ', // A( A('..
                'Â',
                'Ấ',
                'Ầ',
                'Ẩ',
                'Ẫ',
                'Ậ', // A^ A^'..
                'Đ', // D-
                'É',
                'È',
                'Ẻ',
                'Ẽ',
                'Ẹ', // E' E`..
                'Ê',
                'Ế',
                'Ề',
                'Ể',
                'Ễ',
                'Ệ', // E^ E^'..
                'Í',
                'Ì',
                'Ỉ',
                'Ĩ',
                'Ị', // I' I`..
                'Ó',
                'Ò',
                'Ỏ',
                'Õ',
                'Ọ', // O' O`..
                'Ô',
                'Ố',
                'Ồ',
                'Ổ',
                'Ỗ',
                'Ộ', // O^ O^'..
                'Ơ',
                'Ớ',
                'Ờ',
                'Ở',
                'Ỡ',
                'Ợ', // O* O*'..
                'Ú',
                'Ù',
                'Ủ',
                'Ũ',
                'Ụ', // U' U`..
                'Ư',
                'Ứ',
                'Ừ',
                'Ử',
                'Ữ',
                'Ự', // U* U*'..
                'Ý',
                'Ỳ',
                'Ỷ',
                'Ỹ',
                'Ỵ' // Y' Y`..
            );
            $output  = str_replace($search, $replace, $output);
        }
        return $output;
    }
}
/**
 * ----------------------------------------------
 * alphabetonly
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ---------------
 * 
 * Loại bỏ các ký tự không phải alphabet
 *
 * ----------------------------------------------
 */
if (!function_exists('alphabetonly'))
{
    function alphabetonly($string = '')
    {
        $output = $string;
        // replace no alphabet character
        $output = preg_replace("/[^a-zA-Z0-9]/", "-", $output);
        $output = preg_replace("/-+/", "-", $output);
        $output = trim($output, '-');
        return $output;
    }
}
/**
 * ----------------------------------------------
 * bodautiengviet
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ---------------
 * 
 * Tính năng chả khác mịa gì codau2khongdau()
 *
 * ----------------------------------------------
 */
if (!function_exists('bodautiengviet'))
{
    function bodautiengviet($input_string = '')
    {
        $str = $input_string;
        if ($str != '')
        {
            // Mảng tiếng Việt
            $marTViet = array(
                "à",
                "á",
                "ạ",
                "ả",
                "ã",
                "ầ",
                "ấ",
                "ậ",
                "ẩ",
                "ẫ",
                "ă",
                "â",
                "ằ",
                "ắ",
                "ặ",
                "ẳ",
                "ẵ",
                "ă",
                "è",
                "é",
                "ẹ",
                "ẻ",
                "ẽ",
                "ề",
                "ế",
                "ệ",
                "ể",
                "ễ",
                "ê",
                "ì",
                "í",
                "ị",
                "ỉ",
                "ĩ",
                "ò",
                "ó",
                "ọ",
                "ỏ",
                "õ",
                "ồ",
                "ố",
                "ộ",
                "ổ",
                "ỗ",
                "ô",
                "ờ",
                "ớ",
                "ợ",
                "ở",
                "ỡ",
                "ơ",
                "ù",
                "ú",
                "ụ",
                "ủ",
                "ũ",
                "ừ",
                "ứ",
                "ự",
                "ử",
                "ữ",
                "ư",
                "ỳ",
                "ý",
                "ỵ",
                "ỷ",
                "ỹ",
                "đ",
                "A",
                "À",
                "Á",
                "Ạ",
                "Ả",
                "Ã",
                "Ầ",
                "Ấ",
                "Ậ",
                "Ẩ",
                "Ẫ",
                "Ă",
                "Â",
                "Ằ",
                "Ắ",
                "Ặ",
                "Ẳ",
                "Ẵ",
                "Ă",
                "È",
                "É",
                "Ẹ",
                "Ẻ",
                "Ẽ",
                "E",
                "Ề",
                "Ế",
                "Ệ",
                "Ể",
                "Ễ",
                "Ê",
                "I",
                "Ì",
                "Í",
                "Ị",
                "Ỉ",
                "Ĩ",
                "O",
                "Ò",
                "Ó",
                "Ọ",
                "Ỏ",
                "Õ",
                "Ồ",
                "Ố",
                "Ộ",
                "Ổ",
                "Ỗ",
                "Ô",
                "Ờ",
                "Ớ",
                "Ợ",
                "Ở",
                "Ỡ",
                "Ơ",
                "Ù",
                "Ú",
                "Ụ",
                "Ủ",
                "Ũ",
                "U",
                "Ừ",
                "Ứ",
                "Ự",
                "Ử",
                "Ữ",
                "Ư",
                "Ỳ",
                "Ý",
                "Ỵ",
                "Ỷ",
                "Ỹ",
                "Y",
                "Đ",
                "B",
                "C",
                "D",
                "F",
                "G",
                "H",
                "I",
                "J",
                "K",
                "L",
                "M",
                "N",
                "P",
                "Q",
                "R",
                "S",
                "T",
                "V",
                "X",
                "Y",
                "Z",
                "W"
            );
            // Mảng ko dấu
            $marKoDau = array(
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "i",
                "i",
                "i",
                "i",
                "i",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "y",
                "y",
                "y",
                "y",
                "y",
                "d",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "a",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "e",
                "i",
                "i",
                "i",
                "i",
                "i",
                "i",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "o",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "u",
                "y",
                "y",
                "y",
                "y",
                "y",
                "y",
                "d",
                "b",
                "c",
                "d",
                "f",
                "g",
                "h",
                "i",
                "j",
                "k",
                "l",
                "m",
                "n",
                "p",
                "q",
                "r",
                "s",
                "t",
                "v",
                "x",
                "y",
                "z",
                "w"
            );
            // Tiến hành chuyển đổi Mảng tiếng Việt thành Mảng ko dấu
            $str      = str_replace($marTViet, $marKoDau, $str);
            // Lọc các ký tự đặc biệt
            $str      = str_replace(array(
                ',',
                ';',
                '\'',
                '"',
                '(',
                ')',
                '.',
                ':',
                '…',
                '[',
                ']',
                '|',
                '\\',
                '?',
                "/",
                "!",
                "@",
                "#",
                "$",
                "^",
                "&",
                "*",
                "+",
                "=",
                "<",
                ">",
                "–",
                '™',
                '®',
                '%',
                '“',
                '”',
                '’',
                '‘'
            ), '-', $str);
            // Bỏ khoảng trắng
            $str      = str_replace(' ', '-', $str);
            // Loại bỏ ký tự trùng lặp special (-)
            while (strpos($str, '--') > 0)
            {
                $str = str_replace('--', '-', $str);
            }
            while (strpos($str, '--') === 0)
            {
                $str = str_replace('--', '-', $str);
            }
        }
        return $str;
    }
}
/**
 * ----------------------------------------------
 * remove_special_char
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ---------------
 * 
 * Loại bỏ ký tự tiếng Việt theo phong cách phức tạp hơn
 *
 * ----------------------------------------------
 */
if (!function_exists('remove_special_char'))
{
    function remove_special_char($input_string = '')
    {
        $str = trim($input_string);
        if ($str)
        {
            $str = str_replace('#039', '', $str);
            $str = str_replace('!', '', $str);
            $str = str_replace('@', '', $str);
            $str = str_replace('#', '', $str);
            $str = str_replace('$', '', $str);
            $str = str_replace('%', '', $str);
            $str = str_replace('^', '', $str);
            $str = str_replace('&', '', $str);
            $str = str_replace('*', '', $str);
            $str = str_replace('(', '', $str);
            $str = str_replace(')', '', $str);
            $str = str_replace('_', '', $str);
            $str = str_replace('=', '', $str);
            $str = str_replace('{', '', $str);
            $str = str_replace('}', '', $str);
            $str = str_replace('[', '', $str);
            $str = str_replace(']', '', $str);
            $str = str_replace('\\', '', $str);
            $str = str_replace('/', '', $str);
            $str = str_replace('|', '', $str);
            $str = str_replace(':', '', $str);
            $str = str_replace(';', '', $str);
            $str = str_replace('"', '', $str);
            $str = str_replace("'", '', $str);
            $str = str_replace('=', '', $str);
            $str = str_replace("<", '', $str);
            $str = str_replace(",", '', $str);
            $str = str_replace(">", '', $str);
            $str = str_replace(".", '', $str);
            $str = str_replace('=', '', $str);
            $str = str_replace('?', '', $str);
        }
        return $str;
    }
}
/**
 * ----------------------------------------------
 * 
 * getPermalinksSEO
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * 
 * ---------------
 * 
 * Format Beautifull URL
 * 
 * Hàm dùng để convert các ký tự có dấu thành không dấu
 * Dùng tốt cho các chức năng SEO
 * vì nhiều engine không hiểu được dấu tiếng Việt
 * nên cần phải bỏ dấu tiếng Việt đi
 *
 * ----------------------------------------------
 */
if (!function_exists('getPermalinksSEO'))
{
    function getPermalinksSEO($input_string = '')
    {
        $str = $input_string;
        if ($str != '')
        {
            $str = str_replace('---', '-', str_replace(array(
                ' '
            ), array(
                '-'
            ), bodautiengviet(trim($str))));
            $str = specialchar2normalchar($str);
            $str = codau2khongdau($str);
            $str = remove_special_char($str);
            $str = trim(trim(trim($str, '-'), '?'), '!');
        }
        return $str;
    }
}
/* End of file HUNG_url_helper.php */
/* Location: ./application/helpers/HUNG_url_helper.php */
