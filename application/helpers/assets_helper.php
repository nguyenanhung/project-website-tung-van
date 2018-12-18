    <?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('assets_url'))
{
    /**
     * Assets Url
     *
     * @param string $uri
     * @param null $protocol
     * @return string
     */
    function assets_url($uri = '', $protocol = NULL)
    {
        return base_url('assets/' . $uri, $protocol);
    }
}
if (!function_exists('assets_themes'))
{
    /**
     * assets themes
     *
     * @param string $themes
     * @param string $uri
     * @param string $asset_folder
     * @param null $protocol
     * @return string
     */
    function assets_themes($themes = '', $uri = '', $asset_folder = 'yes', $protocol = NULL)
    {
        $path_assets = 'assets/themes/';
        // Pattern
        $uri         = $themes != '' ? ($asset_folder === 'no' ? $themes . '/' . $uri : $themes . '/assets/' . $uri) : ($asset_folder === 'no' ? $uri : 'assets/' . $uri);
        if ($themes == 'metronic')
        {
            return 'http://vcms.gviet.vn/'.$path_assets.$uri;
        }
        else
        {
            return base_url($path_assets . $uri, $protocol);
        }
        
    }
}
if (!function_exists('favicon_url'))
{
    /**
     * Favicon Url
     *
     * @param string $uri
     * @param null $protocol
     * @return string
     */
    function favicon_url($uri = '', $protocol = NULL)
    {
        return assets_url('fav/' . $uri, $protocol);
    }
}
/**
 * ----------------------------------------------
 * editor_url
 *
 * Returns editor_url URL
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * ----------------------------------------------
 */
if (!function_exists('editor_url'))
{
    function editor_url($uri = '', $protocol = NULL)
    {
        $uri = 'editors/' . $uri;
        return assets_url($uri, $protocol);
    }
}
/**
 * ----------------------------------------------
 * images_url
 *
 * Returns Image URL
 * 
 * @access      public 
 * @package     URL Helper
 * @category    Helper
 * @return      string
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 * ----------------------------------------------
 */
if (!function_exists('images_url'))
{
    if (!function_exists('images_url'))
    {
        function images_url($input = '', $server = '', $base = 'off')
        {
            if ($input != '')
            {
                $data = parse_url($input);
                if (count($data) > 0 && isset($data['host']))
                {
                    $images_url = trim($input);
                }
                elseif (count($data) > 0 && strpos($data['path'], 'uploads') !== false && empty($data['host'])) {
                    $images_url = trim(config_item('base_url').$input);
                }
                elseif($input == 'images/system/no_avatar.jpg' OR $input == 'images/system/no_avatar_100x100.jpg' OR $input == 'images/system/no_video_available.jpg' OR $input == 'images/system/no_video_available_thumb.jpg' OR $input == 'images/system/no-image-available.jpg' OR $input == 'images/system/no-image-available_60.jpg' OR $input == 'images/system/no-image-available_100.jpg' OR $input == 'images/system/no-image-available_100x100.jpg' OR $input == 'images/system/no-image-available_330.jpg' OR $input == 'images/system/no-image-available_thumb.jpg' OR $input == 'images/system/no-image-available_x100.jpg' OR $input == 'images/system/no-image-available_x130.jpg' OR $input == 'images/system/no-image-available_x330.jpg' OR $input == 'images/system/no-image-available_x510.jpg' OR $input == 'images/system/no-image-available_x530.jpg' OR $input == 'images/system/no-image-available_x700.jpg' OR $input == 'images/system/no-image-available_x800.jpg' OR $input == 'images/system/no-image-available_x1250.jpg')
                {
                    $images_url = assets_url('images/system/no-image-available_x510.jpg');
                }
                else
                {
                    if ($base == 'assets')
                    {
                        $images_url = base_url('assets/' . $input);
                    }
                    else
                    {
                        $images_url = base_url($input);
                    }
                }
            }
            return $images_url;
        }
    }
}