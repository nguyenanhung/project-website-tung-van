<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 4/17/17
 * Time: 10:46
 */
class Menu
{
    protected $CI;
    protected $category;
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    public function get_sub_categories($list_category, $current_parent = null, $parent_id = 0, $char = '')
    {
        if (count($list_category) > 0)
        {
            foreach ($list_category as $key => $category)
            {
                if ($category->parent == $parent_id)
                {
                    if ($current_parent == $category->id)
                    {
                        $selected = 'selected';
                    }
                    else
                    {
                        $selected = '';
                    }
                    echo '<option ' . $selected . ' value="' . $category->id . '">' . $char . ' ' . $category->title . '</option>';
                    unset($list_category[$key]);
                    self::get_sub_categories($list_category, $current_parent, $category->id, $char . '----');
                }
            }
        }
    }
    public function get_info_menu($menu_id)
    {
        $this->CI->load->model('menu_model');
        $this->menu = $this->CI->menu_model->get_info($menu_id, 'id');
        return $this->menu;
    }
}
