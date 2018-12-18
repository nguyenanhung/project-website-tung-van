<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-12 14:02:06
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-26 10:42:43
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Categories_model extends TD_VAS_Based_model
{
	public function __construct()
	{
		parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'categories';
        $this->primary_key       = 'id';
        $this->field_uuid        = 'uuid';
        $this->field_status      = 'status';
        $this->field_name        = 'name';
        $this->field_slugs       = 'slugs';
        $this->field_title       = 'title';
        $this->field_description = 'description';
        $this->field_keywords    = 'keywords';
        $this->field_photo       = 'photo';
        $this->field_parent      = 'parent';
        $this->field_order_stt   = 'order_stt';
        $this->field_created_at  = 'created_at';
        $this->field_updated_at  = 'updated_at';
        $this->field_menu_id     = 'menu_id';
        $this->is_not            = ' !=';
        $this->or_higher         = ' >=';
        $this->is_higher         = ' >';
        $this->or_smaller        = ' <=';
        $this->is_smaller        = ' <';
    }
	/**
     * @return close Database connect
     */
    public function close()
    {
        $this->db->close();
    }
    public function get_result($size = 5, $page = 0, $begin_date = '', $end_date = '', $name = null, $status = null, $count_result = false, $random = false)
    {
        $this->db->from($this->tableName);
        // Filter Date
        if ($begin_date != '' && $end_date != '')
        {
            $this->db->where($this->field_created_at . $this->or_higher, $begin_date);
            $this->db->where($this->field_created_at . $this->or_smaller, $end_date);
        }
        // Filter name
        if ($name)
        {
            $this->db->like($this->field_name, $name);
        }
        // Filter $status
        if ($status)
        {
            $this->db->where($this->field_status, $status);
        }
        elseif ($status === 0)
        {
            $this->db->where($this->field_status, 0);
        }
        /** @var Filter count result */
        if ($count_result === false)
        {
            // Limit Result
            self::_page_limit($size, $page);
            // Order Result
            if ($random === true)
            {
                $this->db->order_by($this->tableName . '.' . $this->primary_key, 'RANDOM');
            }
            else
            {
                $this->db->order_by($this->tableName . '.' . $this->primary_key, 'DESC');
            }
            // Genarate result
            return $this->db->get()->result();
        }
        else
        {
            return $this->db->count_all_results();
        }
    }
	/**
     * get_list_by_parent
     *
     * @access      public
     * @return      array
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       21/12/2016
     */
    public function get_list_by_parent($parent_id = '')
    {
        $this->db->select('id');
        $this->db->from($this->tableName);
        $this->db->where($this->field_parent, $parent_id);
        return $this->db->get()->result_array();
    }

    public function get_list_category($menu_slugs  = '')
    {
        $this->db->select('
            categories.id as cat_id,
            categories.name as cat_name,
            categories.slugs as cat_slugs,
            categories.title as cat_title,
        ');
        $this->db->from($this->tableName);
        $this->db->join('menu','menu.id = categories.menu_id');
        if ($menu_slugs) {
            $this->db->where('menu.slugs', $menu_slugs);
        }
        return $this->db->get()->result(); 
    }
}