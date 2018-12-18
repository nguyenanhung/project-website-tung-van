
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-14 16:19:22
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-07-06 11:55:08
 */
class ShowMenu 
{
	protected $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
	}

	public function showCategories()
	{
		$this->CI->load->model('tung-van/menu_model');

		$data               = array();
        $all_info   = $this->CI->menu_model->get_all_array();
        self::sortCategories($all_info,0,$newString);
        $newString = str_replace('<ul></ul>', '', $newString);
        return $newString;
	}

	function sortCategories($cat, $parent = 0, &$newString,$level=0)
	{	
		$current_page = $this->CI->uri->segment(1);
		// echo $current_page;die;
		if($parent==0){
			$newString .= '<ul>';
		}
		else{
			$newString .= '<ul class="sub-nav">';
		}
		foreach ($cat as $key => $value) {

			if($value['parent']==$parent)
			{	
				$menu_slugs = $value['slugs'];
				if ($menu_slugs == $current_page) {
					$class_active = 'class="active"';
				}
				else {
					$class_active = '';
				}
				$value['level'] = $level + 1;
				if(($value['level']%2)==1){
					$newString .= '<li><a '.$class_active.' href="'.$value['link'].'">'.$value['title'];
				}
				else{
					$newString .= '<li><a '.$class_active.' href="'.$value['link'].'">'.$value['title'];
				}
				unset($cat[$key]);
				$newParent = $value['id'];
				self::sortCategories($cat, $newParent, $newString,$level+1);
				$newString .= '</a></li>';
			}
		}
		$newString .= '</ul>';
	}
}

