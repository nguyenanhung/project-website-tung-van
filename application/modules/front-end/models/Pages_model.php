<?php

/**
 *
 */
class Pages_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE, TRUE);
    }

    public function get_menu_id_by_slug($slugs)
    {
        $this->db->select('*');
        $this->db->where('slugs', $slugs);
        $query = $this->db->get('menu');
        return $query->row();
    }

    //lấy menu thông qua trường cat id của bảng categories
    public function get_menu_id_by_cate($categories, $language)
    {
        $this->db->select('
            menu.*,
            categories.id as cat_id,
            categories.title as title_categories,
            categories.slugs as slug_category,
            menu.id as menu,
            ');
        $this->db->from('categories');
        $this->db->join('posts', 'posts.categories = categories.id');
        $this->db->join('menu', 'categories.menu_id = menu.id');
        $this->db->where('posts.slugs', $categories);
        $this->db->where('posts.language', $language);
        $query = $this->db->get();
        return $query->row();
    }

    // lấy ra danh sách danh mục thông qua menu_id
    public function get_list_cat($menu_id = '', $language = '', $limit = 4)
    {
        $this->db->select('*');
        $this->db->where('menu_id', $menu_id);
        $this->db->where('language', $language);
        if ($limit != null) {
            $this->db->limit($limit);
        }

        $query = $this->db->get('categories');
        return $query->result();
    }

    //get list post category
    public function get_list_pages($menu_id = '', $language = '', $limit = 9)
    {
        $this->db->select('
            pages.*,
            menu.id as menu,
            ');
        $this->db->from('pages');
        $this->db->join('menu', 'pages.menu = menu.id');
        $this->db->where('menu.id', $menu_id);
        $this->db->where('pages.language', $language);
        if ($limit != null) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    //get list post by slug categories
    public function get_page_by_slug($slugs = '', $language = '')
    {
        $this->db->select('
            pages.*,
            menu.id as menu,
            ');
        $this->db->from('pages');
        // $this->db->join('categories', 'posts.categories = categories.id');
        $this->db->join('menu', 'pages.menu = menu.id');
        $this->db->where('pages.slugs', $slugs);
        $this->db->where('pages.language', $language);
        $this->db->limit(9);
        $query = $this->db->get();
        return $query->result();
    }

    //lấy chi tiết bài đăng
    public function get_page_detail($slugs = '')
    {
        $this->db->select('pages.*');
        $this->db->from('pages');
        $this->db->join('menu', 'menu.id = pages.menu');
        $this->db->where('pages.slugs', $slugs);
        $query = $this->db->get();
        return $query->row();
    }

    public function relatede_job($tags, $menu_id)
    {
        $this->db->select('pages.*');
        $this->db->from('pages');
        $this->db->like('pages.content', $tags, 'both');
        $this->db->where('menu', $menu_id);
        $query = $this->db->get();
        return $query->result();
    }

    //get total pages
    public function get_total($menu_id = '')
    {
        $this->db->select('*');
        $this->db->from('pages');
        if ($menu_id != null) {
            $this->db->where('menu', $menu_id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    //lấy ra các danh sách vị trí cần tuyển
    public function get_job($menu_id, $limit = 20)
    {
//          SELECT * FROM `pages` where pages.type=2
//          or DAY(pages.created_at)=DAY(NOW()) AND MONTH(pages.created_at) <= MONTH(NOW())
        $date = config_item('cf_date');
        $this->db->select('pages.*');
        $this->db->from('pages');
        // $this->db->join('pagemeta','pagemeta.page_id = pages.id');
        $this->db->where('menu', $menu_id);
//        $this->db->where('pages.created_at >=',$date);
        $this->db->group_by('pages.id');
//        $this->db->order_by('pages.type','ASC');
        $this->db->order_by('pages.id','DESC');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
       lấy ra số dịch vụ. nếu như truyền $limit thì sẽ lấy bài
        theo limit truyền vào ngược lại sẽ lấy mặc định
    */
    public function get_list_service($limit = null)
    {
        $this->db->select('*');
        $this->db->where('type', 'service');
        // $this->db->where('language',$language);
        if ($limit != null) {
            $this->db->limit($limit);
        }

        $query = $this->db->get('option');
        return $query->result();
    }

    public function get_tags($menu_id)
    {
        $this->db->distinct('pages.tags');
        $this->db->select('pages.tags');
        $this->db->from('pages');
        $this->db->where('menu', $menu_id);
        $query = $this->db->get();
        return $query->result();

    }

    //filter
    public function filter($string = '')
    {
        $this->db->select('*');
        $this->db->from('pages');
//        $this->db->like('pages.title', '=', '%' . $string . '%');
//        $this->db->like('pages.content', '=', '%' . $string . '%');
        $this->db->like('pages.title',$string);
        $this->db->or_like('pages.content',$string);
        $this->db->where('menu', 7);
        $query = $this->db->get();
        return $query->result();
    }
    public function list_page_by_tags($tags)
    {
        $this->db->select('pages.*');
        $this->db->from('pages');
        $this->db->like('pages.title',$tags);
        $this->db->or_like('pages.content',$tags);
        $this->db->where('menu', 7);
        $query = $this->db->get();
        return $query->result();
    }
}



