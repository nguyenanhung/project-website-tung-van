<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 5/5/17
 * Time: 09:42
 */
class Recently_action_model extends CI_Model
{
    /**
     * Recently_action_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->db                   = $this->load->database('default', TRUE, TRUE);
        $this->tableName            = 'recently_action';
        $this->primary_key          = 'id';
        $this->field_user_id     = 'user_id';
        $this->field_modules     = 'modules';
        $this->field_action     = 'action';
        $this->field_created_at     = 'created_at';
        $this->is_not               = ' !=';
        $this->or_higher            = ' >=';
        $this->is_higher            = ' >';
        $this->or_smaller           = ' <=';
        $this->is_smaller           = ' <';
    }
    /**
     * @return close Database connect
     */
    public function close()
    {
        $this->db->close();
    }
    /**
     * Thuật toán phân trang
     */
    protected function _page_limit($size = 500, $page = 0)
    {
        if ($size != 'no_limit')
        {
            if ($page != 0)
            {
                if (!$page || $page <= 0 || empty($page))
                {
                    $page = 1;
                }
                $start = ($page - 1) * $size;
            }
            else
            {
                $start = $page;
            }
            return $this->db->limit($size, $start);
        }
    }
    /**
     * check_exists
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       28/12/2016
     */
    public function check_exists($value = '', $field = null)
    {
        $this->db->select('id');
        $this->db->from($this->tableName);
        if ($field === null)
        {
            $this->db->where($this->primary_key, $value);
        }
        else
        {
            $this->db->where($field, $value);
        }
        return (int) $this->db->count_all_results();
    }
    /**
     * get_info
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       28/12/2016
     */
    public function get_info($value = '', $field = null)
    {
        $this->db->from($this->tableName);
        if ($field === null)
        {
            $this->db->where($this->primary_key, $value);
        }
        else
        {
            $this->db->where($field, $value);
        }
        return $this->db->get()->row();
    }
    /**
     * get_value
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       29/12/2016
     */
    public function get_value($value_input = '', $field_input = null, $field_output = null)
    {
        if (null !== $field_output)
        {
            $this->db->select($field_output);
        }
        $this->db->from($this->tableName);
        if ($field_input === null)
        {
            $this->db->where($this->primary_key, $value_input);
        }
        else
        {
            $this->db->where($field_input, $value_input);
        }
        // Query
        $query = $this->db->get();
        if (null !== $field_output)
        {
            if (null === $query->row())
            {
                return null;
            }
            else
            {
                return $query->row()->$field_output;
            }
        }
        else
        {
            return $query->row();
        }
    }
    /**
     * add
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       21/12/2016
     * @var add new Item to DB
     */
    public function add($data = array())
    {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }
    /**
     * update
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       21/12/2016
     */
    public function update($id = '', $data = array())
    {
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->tableName, $data);
        return $this->db->affected_rows();
    }
    /**
     * delete
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       21/12/2016
     */
    public function delete($id = '')
    {
        if (empty($id))
        {
            return false;
        }
        $this->db->where($this->primary_key, $id);
        $this->db->delete($this->tableName);
        return $this->db->affected_rows();
    }
}
/* End of file Recently_action_model.php */
/* Location: ./based_core_apps_thudo/models/Ultimate/Recently_action_model.php */