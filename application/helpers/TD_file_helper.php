<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ----------------------------------------------
 * formatSizeUnits
 * 
 * Nạp các thư viện cần thiết
 * 
 * @access      public 
 * @package     File Helper
 * @category    File Helper
 * @return      Number format of Size
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       10/04/2016
 *
 * ----------------------------------------------
 */
if (!function_exists('formatSizeUnits'))
{
	function formatSizeUnits($bytes)
	{
		if ($bytes >= 1073741824)
		{
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		}
		elseif ($bytes >= 1048576)
		{
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		}
		elseif ($bytes >= 1024)
		{
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		}
		elseif ($bytes > 1)
		{
			$bytes = $bytes . ' bytes';
		}
		elseif ($bytes == 1)
		{
			$bytes = $bytes . ' byte';
		}
		else
		{
			$bytes = '0 bytes';
		}
		return $bytes;
	}
}
/**
 * ----------------------------------------------
 * genarate_file_index
 * 
 * Genarate index.html
 * 
 * @access      public 
 * @package     File
 * @category    Helper
 * @return      Genarate index.html
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       07/06/2016
 *
 * ----------------------------------------------
 */
if (!function_exists('genarate_file_index'))
{
	function genarate_file_index($file_path = '', $file_name = 'index.html')
	{
		if ($file_path != '')
		{
			// SET file Path
			if (is_dir($file_path) === FALSE)
			{
				mkdir($file_path);
				// PUT Logs
				log_message('debug', 'Genarate new Folder: ' . $file_path);
			}
			// SET file location
			$file_location = $file_path .'/'. $file_name;
			// Tạo file index.html nếu chưa có
			if (file_exists($file_location) === FALSE)
			{
				$file_content = "<!DOCTYPE html>\n<html>\n<head>\n<title>403 Forbidden</title>\n</head>\n<body>\n<p>Directory access is forbidden.</p>\n</body>\n</html>";
				write_file($file_location, $file_content);
				// PUT Logs
				log_message('debug', 'Genarate new file Index.html in Location ' . $file_location);
				// Return
				return TRUE;
			}
			else
			{
				// PUT Logs
				log_message('debug', 'File Index.html Exists in Location ' . $file_location);
				// Return
				return FALSE;
			}
		}
		else // PUT Logs
		{
			log_message('debug', 'Genarate File Index.html failed');
			// Return
			return FALSE;
		}
	}
}
/**
 * ----------------------------------------------
 * genarate_file_htaccess
 * 
 * Genarate .htaccess
 * 
 * @access      public 
 * @package     File
 * @category    Helper
 * @return      Genarate .htaccess
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       07/06/2016
 *
 * ----------------------------------------------
 */
if (!function_exists('genarate_file_htaccess'))
{
	function genarate_file_htaccess($file_path = '', $file_name = '.htaccess')
	{
		if ($file_path != '')
		{
			// SET file Path
			if (is_dir($file_path) === FALSE)
			{
				mkdir($file_path);
				// PUT Logs
				log_message('debug', 'Genarate new Folder: ' . $file_path);
			}
			// SET file location
			$file_location = $file_path .'/'. $file_name;
			// Tạo file .htaccess nếu chưa có
			if (file_exists($file_location) === FALSE)
			{
				$file_content = "RewriteEngine On\nOptions -Indexes\nAddType text/plain php3 php4 php5 php cgi asp aspx html css js";
				write_file($file_location, $file_content);
				// PUT Logs
				log_message('debug', 'Genarate new file .htaccess in Location ' . $file_location);
				// Return
				return TRUE;
			}
			else
			{
				// PUT Logs
				log_message('debug', 'File .htaccess Exists in Location ' . $file_location);
				// Return
				return FALSE;
			}
		}
		else // PUT Logs
		{
			log_message('debug', 'Genarate File .htaccess failed');
			// Return
			return FALSE;
		}
	}
}
/* End of file HUNG_file_helper.php */
/* Location: ./application/helpers/HUNG_file_helper.php */
