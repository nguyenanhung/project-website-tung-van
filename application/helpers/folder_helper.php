<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('new_folder'))
{
    /**
     * Create new Folder
     *
     * @param string $pathname
     * @param int $mode
     * @param bool $recursive
     * @return bool
     *
     * example: new_folder('uploads/hungna/2017-08-02/');
     */
    function new_folder($pathname = '', $mode = 0777, $recursive = true)
    {
        if (is_null($pathname) || empty($pathname))
        {
            return false;
        }
        if (is_dir($pathname) || $pathname === "/")
        {
            return true;
        }
        if (!is_dir($pathname) && strlen($pathname) > 0)
        {
            $cms =& get_instance();
            $cms->load->helper('file');
            $result = @mkdir($pathname, $mode, $recursive);
            genarate_file_index($pathname);
            genarate_file_htaccess($pathname);
            return $result;
        }
        return false;
    }
}
if (!function_exists('makeFolder'))
{
    /**
     * make Folder
     *
     * @param $pathname
     * @param bool $is_filename
     * @param int $mode
     * @return bool
     */
    function makeFolder($pathname, $is_filename = false, $mode = 0777)
    {
        if ($is_filename)
        {
            $pathname = substr($pathname, 0, strrpos($pathname, '/'));
        }
        // Check if directory already exists
        if (is_dir($pathname) || empty($pathname))
        {
            log_message('debug', 'Folder exists: ' . $pathname);
            return true;
        }
        // Ensure a file does not already exist with the same name
        $pathname = str_replace(array(
            '/',
            '\\'
        ), DIRECTORY_SEPARATOR, $pathname);
        if (is_file($pathname))
        {
            log_message('debug', 'File exists: ' . $pathname);
            return false;
        }
        // Crawl up the directory tree
        $next_pathname = substr($pathname, 0, strrpos($pathname, DIRECTORY_SEPARATOR));
        if (makeFolder($next_pathname, false, $mode))
        {
            if (!file_exists($pathname))
            {
                $cms =& get_instance();
                $cms->load->helper('file');
                $result = mkdir($pathname, $mode);
                genarate_file_index($pathname);
                genarate_file_htaccess($pathname);
                return $result;
            }
        }
        return false;
    }
}
if (!function_exists('createDir'))
{
    /**
     * create Directory
     *
     * @param $dirName
     * @param int $mode
     * @param string $s
     * @return bool
     *
     * example: createDir('uploads/hungna/2017-08-02/');
     */
    function createDir($dirName, $mode = 0777, $s = '/')
    {
        $dirs = explode($s, $dirName);
        $dir  = '';
        foreach ($dirs as $part)
        {
            $dir .= $part . $s;
            if (!is_dir($dir) && strlen($dir) > 0)
            {
                $cms =& get_instance();
                $cms->load->helper('file');
                mkdir($dir, $mode);
                genarate_file_index($dir);
                genarate_file_htaccess($dir);
            }
        }
        return true;
    }
}