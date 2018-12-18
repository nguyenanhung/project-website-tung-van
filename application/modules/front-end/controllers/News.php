<?php
/**
 * @Author: thaodt97
 * @Date:   2018-06-11 16:25:07
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-07-09 15:11:08
 */
class News extends MX_Controller
{
    /**
     * News constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'Db_config',
            'Db_photo',
            'ShowMenu',
            'seo'
        ));
        $this->load->helper(array(
            'html',
            'url',
            'assets',
            'url',
            'html',
            'form',
            'common',
            'seo_url',
            'text',
            'paginations',
            'tdp_pagination'
        ));
        $this->view_template = 'news/';
        $this->web_header    = config_item('master_layout_header');
        $this->web_footer    = config_item('master_layout_footer');
        $this->modules_link  = 'front-end/news';
    }
    /**
     * Danh sách tin ngài trang chủ
     */
    public function index()
    {
        $this->load->model('posts_model');
        $menu_slugs = 'tin-tuc';
        $data['list_item'] = $this->posts_model->get_recent_post(3,1,$menu_slugs);
        $this->load->view($this->view_template . 'index', $data);
    }
    /**
     * Danh sách tin
     */
    public function news_page()
    {
        $this->load->model(array(
            'posts_model',
            'photo_model'
        ));
        $data = array();
        $data['site_title'] = "Tin tức";
        $data['site_name']  = $this->db_config->get_data('site_name');
        $data['site_slogan'] = $this->db_config->get_data('site_slogan');
        $data['meta_equiv'] = meta(array(
            array(
                'name' => 'X-UA-Compatible',
                'content' => 'IE=edge',
                'type' => 'http-equiv'
            ),
            array(
                'name' => 'content-language',
                'content' => 'vi',
                'type' => 'http-equiv'
            ),
        ));
        $data['meta_content'] = meta(array(
            array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1',
            ),
            array(
                'name' => 'robots',
                'content' => $this->db_config->get_data('Seo_robots')
            ),
            array(
                'name' => 'revisit-after',
                'content' => $this->db_config->get_data('Seo_revisit-after')
            ),
            array(
                'name' => 'description',
                'content' => $this->db_config->get_data('Site_description')
            ),
            array(
                'name' => 'keywords',
                'content' => $this->db_config->get_data('Site_keywords')
            ),
            array(
                'name' => 'coppyright',
                'content' => $this->db_config->get_data('Site_name')
            ), 
            array(
                'name' => 'generator',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'author',
                'content' => $this->db_config->get_data('Web_author')
            ),
            array(
                'name' => 'Web author',
                'content' => $this->db_config->get_data('Web_author')
            ),
            array(
                'name' => 'dc.created',
                'content' => $this->db_config->get_data('dc.created')
            ), 
            array(
                'name' => 'db.publiser',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.right.copyright',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.creator.name',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.creator.mail',
                'content' => $this->db_config->get_data('Site_mail')
            ),
            array(
                'name' => 'db.identifier',
                'content' => base_url()
            ),
            array(
                'name' => 'dc.language',
                'content' => 'vi-Vn'
            ),
            array(
                'name' => 'geo.placename',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'placename')
            ),
            array(
                'name' => 'geo.region',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'region')
            ),
            array(
                'name' => 'seo.position',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'position')
            ),
            array(
                'name' => 'ICBM',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'ICBM')
            ),
        ));
        $data['meta_property'] = meta_property(array(
            array(
                'property' => 'fb:app_id',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'app_id')
            ),
            array(
                'property' => 'fb:admins',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'admins')
            ),
            array(
                'property' => 'og:locale',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'locale')
            ),
            array(
                'property' => 'og:type',
                'content' => 'website'
            ),
            array(
                'property' => 'og:title',
                'content' => $this->db_config->get_data('site_title')
            ),
            array(
                'property' => 'og:description',
                'content' => $this->db_config->get_data('site_description')
            ),
            array(
                'property' => 'og:url',
                'content' => base_url()
            ),
            array(
                'property' => 'og:image',
                'content' => assets_url($this->db_config->get_data('site_images'))
            ),
            array(
                'property' => 'og:image:alt',
                'content' => $this->seo->slugify($this->db_config->get_data('site_name'))
            ),
            array(
                'property' => 'og:site_name',
                'content' => $this->db_config->get_data('site_slogan')
            ),
            array(
                'property' => 'title',
                'content' => $this->db_config->get_data('site_title'),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'description',
                'content' => $this->db_config->get_data('site_slogan'),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'url',
                'content' => base_url(),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'image',
                'content' => assets_url($this->db_config->get_data('site_images')),
                'type' => 'itemprop'
            )
        ));

        $menu_slugs = $this->uri->segment(1); // slugs menu tin tức
        $page = $this->input->get('page');
        if ($page == '')
        {
            $page = 1;
        }
        $per_page            = 2;
        $total               = $this->posts_model->count_news_post($menu_slugs);
        $data['item_list']   = $this->posts_model->get_result($per_page, ($page - 1) * $per_page, $menu_slugs);
        $data['paginations'] = paginations($total, $per_page, $page);
        $data['banner_photo'] = $this->photo_model->get_data_photo('banner');
        $this->load->view(config_item('template_web_service') . config_item('master_layout_index'), array(
            'sub' => $this->view_template . 'news_page',
            'data' => $data
        ));
    }
    /**
     * Chi tiết tin
     *
     * @param string $post_code
     * @param string $post_slugs
     * @param string $cate_slugs
     */
    public function news_detail($post_code = '', $post_slugs = '', $cate_slugs = '')
    {
        $data['site_title'] = "Tin tức";
        $data['site_name']  = $this->db_config->get_data('site_name');
        $data['site_slogan'] = $this->db_config->get_data('site_slogan');
        $data['meta_equiv'] = meta(array(
            array(
                'name' => 'X-UA-Compatible',
                'content' => 'IE=edge',
                'type' => 'http-equiv'
            ),
            array(
                'name' => 'content-language',
                'content' => 'vi',
                'type' => 'http-equiv'
            ),
        ));
        $data['meta_content'] = meta(array(
            array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1',
            ),
            array(
                'name' => 'robots',
                'content' => $this->db_config->get_data('Seo_robots')
            ),
            array(
                'name' => 'revisit-after',
                'content' => $this->db_config->get_data('Seo_revisit-after')
            ),
            array(
                'name' => 'description',
                'content' => $this->db_config->get_data('Site_description')
            ),
            array(
                'name' => 'keywords',
                'content' => $this->db_config->get_data('Site_keywords')
            ),
            array(
                'name' => 'coppyright',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'generator',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'author',
                'content' => $this->db_config->get_data('Web_author')
            ),
            array(
                'name' => 'Web author',
                'content' => $this->db_config->get_data('Web_author')
            ),
            array(
                'name' => 'dc.created',
                'content' => $this->db_config->get_data('dc.created')
            ),
            array(
                'name' => 'db.publiser',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.right.copyright',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.creator.name',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.creator.mail',
                'content' => $this->db_config->get_data('Site_mail')
            ),
            array(
                'name' => 'db.identifier',
                'content' => base_url()
            ),
            array(
                'name' => 'dc.language',
                'content' => 'vi-Vn'
            ),
            array(
                'name' => 'geo.placename',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'placename')
            ),
            array(
                'name' => 'geo.region',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'region')
            ),
            array(
                'name' => 'seo.position',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'position')
            ),
            array(
                'name' => 'ICBM',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'ICBM')
            ),
        ));
        $data['meta_property'] = meta_property(array(
            array(
                'property' => 'fb:app_id',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'app_id')
            ),
            array(
                'property' => 'fb:admins',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'admins')
            ),
            array(
                'property' => 'og:locale',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'locale')
            ),
            array(
                'property' => 'og:type',
                'content' => 'website'
            ),
            array(
                'property' => 'og:title',
                'content' => $this->db_config->get_data('site_title')
            ),
            array(
                'property' => 'og:description',
                'content' => $this->db_config->get_data('site_description')
            ),
            array(
                'property' => 'og:url',
                'content' => base_url()
            ),
            array(
                'property' => 'og:image',
                'content' => assets_url($this->db_config->get_data('site_images'))
            ),
            array(
                'property' => 'og:image:alt',
                'content' => $this->seo->slugify($this->db_config->get_data('site_name'))
            ),
            array(
                'property' => 'og:site_name',
                'content' => $this->db_config->get_data('site_slogan')
            ),
            array(
                'property' => 'title',
                'content' => $this->db_config->get_data('site_title'),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'description',
                'content' => $this->db_config->get_data('site_slogan'),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'url',
                'content' => base_url(),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'image',
                'content' => assets_url($this->db_config->get_data('site_images')),
                'type' => 'itemprop'
            )
        ));
        $postid = decodeId_Url_byHungDEV($post_code);
        $this->load->model('posts_model');
        $data['item'] = $this->posts_model->get_info_post($postid);
        $this->load->view(config_item('template_web_service') . config_item('master_layout_index'), array(
            'sub' => $this->view_template . 'news_detail',
            'data' => $data
        ));
    }
    /**
     * Side bar
     *
     * @param string $post_id
     */
    public function news_sidebar($post_id = '')
    {
        if ($post_id == '')
        {
            $this->module_is_error = 'Không có dữ liệu';
        }
        else
        {
            $menu_slugs = $this->uri->segment(1);
            $this->load->model(array(
                'posts_model',
                'categories_model',
                'pages_model'
            ));
            $cat_id        = $this->posts_model->get_value($post_id, 'id', 'categories');
            $subCategories = $this->categories_model->get_list_by_parent($cat_id);
            if ($subCategories === null)
            {
                $inputCategories = $cat_id;
            }
            else
            {
                $inputCategories = $subCategories;
                array_push($inputCategories, array(
                    'id' => $cat_id
                ));
            }
            $keyCategories = is_array($inputCategories) ? array_column($inputCategories, 'id') : $cat_id;
            $data          = array();
            if ($post_id == 'recent')
            {
                $data['list_item'] = $this->posts_model->get_recent_post(3,1,$menu_slugs);
            }
            else
            {
                $data['list_item'] = $this->posts_model->get_item_related(3, 0, $post_id, $cat_id);
            }
            $data['list_category'] = $this->categories_model->get_list_category($menu_slugs);

            $recuitment_slugs = 'tuyen-dung';
            $menu_id = $this->menu_model->get_menu_id($recuitment_slugs)->id;
            $data['list_job'] = $this->pages_model->get_job($menu_id);
            //lấy tags của các bài viết gộp lại các tag thành 1 mảng
            $data['list_tag']      = $this->posts_model->get_tags(7, 1);
            foreach ($data['list_tag'] as $item) {
                $array[] =  $item->tags;
            }
            // chuỗi các tag
            $str = implode(',', $array);
            // chuyển chuỗi thành mảng
            $data['array_tag'] = explode(',', $str);
        }
        $this->load->view($this->view_template . 'news_sidebar', $data);
    }
    /**
     * Comment
     *
     * @param string $post_id
     * @param int $count
     */
    public function set_comment($post_id = '', $count = 5)
    {
        $this->load->model(array(
            'comments_model',
            'posts_model'
        ));
        if ($this->input->get_post('Create_new_Items', true) == config_item('confirm_key_create'))
        {
            $data               = array();
            $data['name']       = $this->input->get_post('name', TRUE);
            $data['email']      = $this->input->get_post('email', TRUE);
            $data['website']    = $this->input->get_post('website', TRUE);
            $data['message']    = $this->input->get_post('message', TRUE);
            $data['created_at'] = config_item('cf_datetime');
            $data['post_id']    = $post_id;
            $data['photo']      = 'assets/images/system/no_avatar_100x100.jpg';
            $data['status']     = 1;
            $create_id          = $this->comments_model->add($data);
            $count_comment      = $this->comments_model->get_result($count, $post_id, true, true);
            $comment            = array(
                'comment' => $count_comment
            );
            $update_comment_num = $this->posts_model->update($post_id, $comment);
            $redirect_url       = $this->input->server('REDIRECT_URL');
            $redirect_url       = str_replace('.html', '', $redirect_url);
            redirect($redirect_url);
        }
        else
        {
            $data                  = array();
            $data['list_comment']  = $this->comments_model->get_result($count, $post_id, true);
            $data['count_comment'] = $this->comments_model->get_result($count, $post_id, true, true);
        }
        $this->load->view($this->view_template . 'comment', $data);
    }

    public function news_list_by_categories($categories_slug = '', $page_number = 1)
    {
        $this->load->model(array(
            'posts_model',
            'categories_model'
        ));
        $data                = array();
        $data['site_title']  = "Tin tức";
        $data['site_name']   = $this->db_config->get_data('site_name');
        $data['site_slogan'] = $this->db_config->get_data('site_slogan');
        $data['meta_equiv']  = meta(array(
            array(
                'name' => 'X-UA-Compatible',
                'content' => 'IE=edge',
                'type' => 'http-equiv'
            ),
            array(
                'name' => 'content-language',
                'content' => 'vi',
                'type' => 'http-equiv'
            ),
        ));
        $data['meta_content'] = meta(array(
            array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1',
            ),
            array(
                'name' => 'robots',
                'content' => $this->db_config->get_data('Seo_robots')
            ),
            array(
                'name' => 'revisit-after',
                'content' => $this->db_config->get_data('Seo_revisit-after')
            ),
            array(
                'name' => 'description',
                'content' => $this->db_config->get_data('Site_description')
            ),
            array(
                'name' => 'keywords',
                'content' => $this->db_config->get_data('Site_keywords')
            ),
            array(
                'name' => 'coppyright',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'generator',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'author',
                'content' => $this->db_config->get_data('Web_author')
            ),
            array(
                'name' => 'Web author',
                'content' => $this->db_config->get_data('Web_author')
            ),
            array(
                'name' => 'dc.created',
                'content' => $this->db_config->get_data('dc.created')
            ),
            array(
                'name' => 'db.publiser',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.right.copyright',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.creator.name',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.creator.mail',
                'content' => $this->db_config->get_data('Site_mail')
            ),
            array(
                'name' => 'db.identifier',
                'content' => base_url()
            ),
            array(
                'name' => 'dc.language',
                'content' => 'vi-Vn'
            ),
            array(
                'name' => 'geo.placename',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'placename')
            ),
            array(
                'name' => 'geo.region',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'region')
            ),
            array(
                'name' => 'seo.position',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'position')
            ),
            array(
                'name' => 'ICBM',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'ICBM')
            ),
        ));
        $data['meta_property'] = meta_property(array(
            array(
                'property' => 'fb:app_id',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'app_id')
            ),
            array(
                'property' => 'fb:admins',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'admins')
            ),
            array(
                'property' => 'og:locale',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'locale')
            ),
            array(
                'property' => 'og:type',
                'content' => 'website'
            ),
            array(
                'property' => 'og:title',
                'content' => $this->db_config->get_data('site_title')
            ),
            array(
                'property' => 'og:description',
                'content' => $this->db_config->get_data('site_description')
            ),
            array(
                'property' => 'og:url',
                'content' => base_url()
            ),
            array(
                'property' => 'og:image',
                'content' => assets_url($this->db_config->get_data('site_images'))
            ),
            array(
                'property' => 'og:image:alt',
                'content' => $this->seo->slugify($this->db_config->get_data('site_name'))
            ),
            array(
                'property' => 'og:site_name',
                'content' => $this->db_config->get_data('site_slogan')
            ),
            array(
                'property' => 'title',
                'content' => $this->db_config->get_data('site_title'),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'description',
                'content' => $this->db_config->get_data('site_slogan'),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'url',
                'content' => base_url(),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'image',
                'content' => assets_url($this->db_config->get_data('site_images')),
                'type' => 'itemprop'
            )
        ));

        // GET Cat_id
        $cat_id        = $this->categories_model->get_value($categories_slug, 'slugs', 'id');
        $cat_name      = $this->categories_model->get_value($categories_slug, 'slugs', 'name');
        // GET Categories
        $subCategories = $this->categories_model->get_list_by_parent($cat_id);
        if ($subCategories === null)
        {
            $inputCategories = $cat_id;
        }
        else
        {
            $inputCategories = $subCategories;
            array_push($inputCategories, array(
                'id' => $cat_id
            ));
        }
        if (is_array($inputCategories))
        {
            $keyCategories = array_column($inputCategories, 'id');
        }
        else
        {
            $keyCategories = $cat_id;
        }
        $data['cat_id']        = $cat_id;
        $data['cat_name']      = $cat_name;
        $data['cat_slug']      = $categories_slug;
        $page = $this->input->get('page');
        if ($page == '')
        {
            $page = 1;
        }
        $per_page            = 2;
        $total               = $this->posts_model->count_news_post(null,$keyCategories);
        $data['item_list']   = $this->posts_model->get_result($per_page, ($page - 1) * $per_page, null,$keyCategories);
        $data['paginations'] = paginations($total, $per_page, $page);


        $this->load->view(config_item('template_web_service') . config_item('master_layout_index'), array(
            'sub' => $this->view_template . 'news_page',
            'data' => $data
        ));
    }
}
