<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 26/06/2018
 * Time: 3:46 CH
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Product_model extends TD_VAS_Based_model
{
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'product';
        $this->primary_key       = 'id';
        $this->field_name        = 'name';
        $this->field_cat_id      = 'cat_id';
        $this->field_photo       = 'photo';
        $this->field_description = 'description';
        $this->field_link        = 'link';
        $this->field_summary     = 'summary';
        $this->field_created_at  = 'created_at';
        $this->field_updated_at  = 'updated_at';
        $this->is_not            = ' !=';
        $this->or_higher         = ' >=';
        $this->is_higher         = ' >';
        $this->or_smaller        = ' <=';
        $this->is_smaller        = ' <';

    }
    //lấy ra danh mục các bài viết
    public function get_list_cat($menu_id ='',$language = '',$limit = null)
    {
        $this->db->select('*');
        $this->db->where('menu_id', $menu_id);
        $this->db->where('language',$language);
        if($limit != null)
        {
            $this->db->limit($limit);
        }

        $query = $this->db->get('categories');
        return $query->result();
    }
    public function get_list_result($size = 5, $page = 0, $random = false, $count_result = false)
    {
        $this->db->select('
            categories.id as cat_id,
            categories.name as cat_name,
            categories.slugs as cat_slugs,
            categories.title as cat_title,
            product.id as product_id,
            product.photo as photos,,
            product.name as name,
            product.link as link,
            product.summary as summary,
            product.created_at as created_at,
            product.updated_at as updated_at
            ');
        $this->db->from($this->tableName);
        $this->db->join('categories', 'categories.id = product.cat_id');

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
    /*
       lấy ra số dịch vụ. nếu như truyền $limit thì sẽ lấy bài
        theo limit truyền vào ngược lại sẽ lấy mặc định
    */
    public function get_list_product($limit = null)
    {
        $this->db->select('*');
        // $this->db->where('language',$language);
        if($limit != null)
        {
            $this->db->limit($limit);
        }
        $query = $this->db->get('product');
        return $query->result();
    }

}
