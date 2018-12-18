<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 4/17/17
 * Time: 10:46
 */
class Sub_categories
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
                    echo '<option ' . $selected . ' value="' . $category->id . '">' . $char . ' ' . $category->name . '</option>';
                    unset($list_category[$key]);
                    self::get_sub_categories($list_category, $current_parent, $category->id, $char . '----');
                }
            }
        }
    }
    public function get_info_categories($id_category)
    {
        $this->CI->load->model('categories_model');
        $this->category = $this->CI->categories_model->get_info($id_category, 'id');
        return $this->category;
    }
}
