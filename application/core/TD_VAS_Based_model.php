<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 3/22/2017
 * Time: 6:22 PM
 */
class TD_VAS_Based_model extends CI_Model
{
    /**
     * TD_VAS_Based_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->db          = '';
        $this->tableName   = '';
        $this->primary_key = 'id';
        $this->is_not      = ' !=';
        $this->or_higher   = ' >=';
        $this->is_higher   = ' >';
        $this->or_smaller  = ' <=';
        $this->is_smaller  = ' <';
        $this->start_time  = ' 00:00:00';
        $this->end_time    = ' 23:59:59';
    }
    /**
     * Set Database
     * @param string $db_group
     * @return $this
     */
    public function setDb($db_group = '')
    {
        $this->db = $this->load->database($db_group, TRUE, TRUE);
        return $this;
    }
    /**
     * Set Tables Name
     * @param string $tableName
     * @return $this
     */
    public function setTableName($tableName = '')
    {
        $this->tableName = $tableName;
        return $this;
    }
    /**
     * Close DB Connection
     * @return mixed
     */
    public function close()
    {
        return $this->db->close();
    }
    /**
     * Page Limit
     *
     * @param int $size
     * @param int $page
     * @return mixed
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.2
     * @since       17/06/2017
     */
    public function _page_limit($size = 500, $page = 0)
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
     * Count All Item
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       24/05/2018
     *
     * @return mixed
     */
    public function count_all()
    {
        return $this->db->count_all($this->tableName);
    }
    /**
     * Get Data
     *
     * @param null $options
     * @return mixed
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       24/05/2018
     */
    public function get_data($options = null)
    {
        $this->db->from($this->tableName);
        if ($options !== null)
        {
            if (is_array($options))
            {
                foreach ($options as $field => $value)
                {
                    if (is_array($value))
                    {
                        $this->db->where_in($field, $value);
                    }
                    else
                    {
                        $this->db->where($field, $value);
                    }
                }
            }
        }
        return $this->db->get()->result();
    }
    /**
     * Check Exists
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.2
     * @since       17/06/2017
     *
     * @param string $value
     * @param null $field
     * @return int
     */
    public function check_exists($value = '', $field = null)
    {
        $this->db->select($this->primary_key);
        $this->db->from($this->tableName);
        if ($field === null)
        {
            $this->db->where($this->primary_key, $value);
        }
        else
        {
            if (is_array($value))
            {
                $this->db->where_in($field, $value);
            }
            else
            {
                $this->db->where($field, $value);
            }
        }
        return $this->db->count_all_results();
    }
    /**
     * Get Info Item
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.2
     * @since       17/06/2017
     *
     * @param string $value
     * @param null $field
     * @param bool $array
     * @return mixed
     */
    public function get_info($value = '', $field = null, $array = false)
    {
        $this->db->from($this->tableName);
        if ($field === null)
        {
            $this->db->where($this->primary_key, $value);
        }
        else
        {
            if (is_array($value))
            {
                $this->db->where_in($field, $value);
            }
            else
            {
                $this->db->where($field, $value);
            }
        }
        $query = $this->db->get();
        return ($array === true) ? $query->row_array() : $query->row();
    }
    /**
     * Get Value Item
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.2
     * @since       17/06/2017
     *
     * @param string $value_input
     * @param null $field_input
     * @param null $field_output
     * @return null
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
            if (is_array($value_input))
            {
                $this->db->where_in($field_input, $value_input);
            }
            else
            {
                $this->db->where($field_input, $value_input);
            }
        }
        $query = $this->db->get();
        return (null !== $field_output) ? ((null === $query->row()) ? null : $query->row()->$field_output) : $query->row();
    }

    /**
     * Add new Item
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.2
     * @since       17/06/2017
     *
     * @param array $data
     * @return mixed
     */
    public function add($data = array())
    {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }
    /**
     * Update Item
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.2
     * @since       17/06/2017
     *
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function update($id = '', $data = array())
    {
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->tableName, $data);
        return $this->db->affected_rows();
    }
    /**
     * Delete Item
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.2
     * @since       17/06/2017
     *
     * @param string $id
     * @return bool
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
