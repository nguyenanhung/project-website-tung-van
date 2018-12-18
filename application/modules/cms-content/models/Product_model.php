<?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 27/06/2018
 * Time: 8:53 SA
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Product_model extends TD_VAS_Based_model{
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'product';
        $this->primary_key       = 'id';
        $this->field_name        = 'name';
        $this->field_photo       = 'photo';
        $this->field_categories  = 'categories';
        $this->field_description = 'description';
        $this->field_summary     = 'summary';
        $this->field_created_at  = 'created_at';
        $this->field_updated_at  = 'updated_at';
        $this->field_link        = 'link';
        $this->is_not            = ' !=';
        $this->or_higher         = ' >=';
        $this->is_higher         = ' >';
        $this->or_smaller        = ' <=';
        $this->is_smaller        = ' <';
    }
    public function get_result($size = 5, $page = 0,$begin_date = '', $end_date = '', $name = null, $categories = null, $count_result = false, $random = false)
    {
        $this->db->select('product.name as product_name,categories.name as categories_name, product.id as product_id, product.photo as photo,product.categories as categories,product.link as product_link,product.slugs as product_slugs,product.created_at as product_created_at,product.created_by as product_created_by');
        $this->db->from($this->tableName);
        $this->db->join('categories', 'categories.id = product.categories');

        // Filter Date
        if ($begin_date != '' && $end_date != '') {
            $this->db->where("product." .$this->field_created_at . $this->or_higher, $begin_date);
            $this->db->where("product." .$this->field_created_at . $this->or_smaller, $end_date);
        }
        // Filter name
        if ($name) {
            $this->db->like("product." . $this->field_name, $name);
        }

        // Filter $categories
        if ($categories) {
            $this->db->where($this->field_categories, $categories);
        }

        /** @var Filter count result */
        if ($count_result === false) {
            // Limit Result
            self::_page_limit($size, $page);
            // Order Result
            if ($random === true) {
                $this->db->order_by($this->tableName . '.' . $this->primary_key, 'RANDOM');
            } else {
                $this->db->order_by($this->tableName . '.' . $this->primary_key, 'DESC');
            }
            // Genarate result
            return $this->db->get()->result();
        } else {
            return $this->db->count_all_results();
        }
    }
    public function get_result_distinct($field = null)
    {
        $this->db->distinct();
        $this->db->select($field);
        $this->db->from($this->tableName);
        return $this->db->get()->result();
    }

}