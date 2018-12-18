<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ----------------------------------------------
 * generate_uuid_v4
 *
 * Returns generate_uuid_v4
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
 * Tạo 1 đoạn mã UUID v4
 * ----------------------------------------------
 */
if (!function_exists('generate_uuid_v4'))
{
    function generate_uuid_v4()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', 
        // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), 
        // 16 bits for "time_mid"
            mt_rand(0, 0xffff), 
        // 16 bits for "time_hi_and_version",
            
        // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000, 
        // 16 bits, 8 bits for "clk_seq_hi_res",
            
        // 8 bits for "clk_seq_low",
            
        // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000, 
        // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }
}
/**
 * Translates a number to a short alhanumeric version
 *
 * Translated any number up to 9007199254740992
 * to a shorter version in letters e.g.:
 * 9007199254740989 --> PpQXn7COf
 *
 * specifiying the second argument true, it will
 * translate back e.g.:
 * PpQXn7COf --> 9007199254740989
 *
 * this function is based on any2dec && dec2any by
 * fragmer[at]mail[dot]ru
 * see: http://nl3.php.net/manual/en/function.base-convert.php#52450
 *
 * If you want the alphaID to be at least 3 letter long, use the
 * $pad_up = 3 argument
 *
 * In most cases this is better than totally random ID generators
 * because this can easily avoid duplicate ID's.
 * For example if you correlate the alpha ID to an auto incrementing ID
 * in your database, you're done.
 *
 * The reverse is done because it makes it slightly more cryptic,
 * but it also makes it easier to spread lots of IDs in different
 * directories on your filesystem. Example:
 * $part1 = substr($alpha_id,0,1);
 * $part2 = substr($alpha_id,1,1);
 * $part3 = substr($alpha_id,2,strlen($alpha_id));
 * $destindir = "/".$part1."/".$part2."/".$part3;
 * // by reversing, directories are more evenly spread out. The
 * // first 26 directories already occupy 26 main levels
 *
 * more info on limitation:
 * - http://blade.nagaokaut.ac.jp/cgi-bin/scat.rb/ruby/ruby-talk/165372
 *
 * if you really need this for bigger numbers you probably have to look
 * at things like: http://theserverpages.com/php/manual/en/ref.bc.php
 * or: http://theserverpages.com/php/manual/en/ref.gmp.php
 * but I haven't really dugg into this. If you have more info on those
 * matters feel free to leave a comment.
 *
 * @author  Kevin van Zonneveld <kevin@vanzonneveld.net>
 * @author  Simon Franz
 * @author  Deadfish
 * @copyright 2008 Kevin van Zonneveld (http://kevin.vanzonneveld.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD Licence
 * @version   SVN: Release: $Id: alphaID.inc.php 344 2009-06-10 17:43:59Z kevin $
 * @link    http://kevin.vanzonneveld.net/
 *
 * @param mixed   $in      String or long input to translate
 * @param boolean $to_num  Reverses translation when true
 * @param mixed   $pad_up  Number or boolean padds the result up to a specified length
 * @param string  $passKey Supplying a password makes it harder to calculate the original ID
 *
 * @return mixed string or long
 */
if (!function_exists('generate_alphaID'))
{
    function generate_alphaID($in, $to_num = false, $pad_up = false, $passKey = null)
    {
        $index = "abcdefghijkmnpqrstuvwxyz123456789";
        if ($passKey !== null)
        {
            // Although this function's purpose is to just make the
            // ID short - and not so much secure,
            // with this patch by Simon Franz (http://blog.snaky.org/)
            // you can optionally supply a password to make it harder
            // to calculate the corresponding numeric ID
            for ($n = 0; $n < strlen($index); $n++)
            {
                $i[] = substr($index, $n, 1);
            }
            $passhash = hash('sha256', $passKey);
            $passhash = (strlen($passhash) < strlen($index)) ? hash('sha512', $passKey) : $passhash;
            for ($n = 0; $n < strlen($index); $n++)
            {
                $p[] = substr($passhash, $n, 1);
            }
            array_multisort($p, SORT_DESC, $i);
            $index = implode($i);
        }
        $base = strlen($index);
        if ($to_num)
        {
            // Digital number  <<--  alphabet letter code
            $in  = strrev($in);
            $out = 0;
            $len = strlen($in) - 1;
            for ($t = 0; $t <= $len; $t++)
            {
                $pow = pow($base, $len - $t);
                $out = $out + strpos($index, substr($in, $t, 1)) * $pow;
            }
            if (is_numeric($pad_up))
            {
                $pad_up--;
                if ($pad_up > 0)
                {
                    $out -= pow($base, $pad_up);
                }
            }
            $out = sprintf('%F', $out);
            $out = substr($out, 0, strpos($out, '.'));
        }
        else
        {
            // Digital number  -->>  alphabet letter code
            if (is_numeric($pad_up))
            {
                $pad_up--;
                if ($pad_up > 0)
                {
                    $in += pow($base, $pad_up);
                }
            }
            $out = "";
            for ($t = floor(log($in, $base)); $t >= 0; $t--)
            {
                $bcp = pow($base, $t);
                $a   = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in  = $in - ($a * $bcp);
            }
            $out = strrev($out); // reverse
        }
        return $out;
    }
}
/* End of file uuid_helper.php */
/* Location: ./application/helpers/uuid_helper.php */
