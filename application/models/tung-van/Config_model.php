<?php
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 06/06/2018
 * Time: 8:55 SA
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Config_model extends TD_VAS_Based_model
{
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'config';
        $this->primary_key       = 'id';
        $this->field_value      = 'value';
        $this->field_label      = 'label';
        $this->field_type       = 'type';
        $this->is_not            = ' !=';
        $this->or_higher         = ' >=';
        $this->is_higher         = ' >';
        $this->or_smaller        = ' <=';
        $this->is_smaller        = ' <';
    }

    /**
     * Get Results
     *
     * @param int $size
     * @param int $page
     * @param string $begin_date
     * @param string $end_date
     * @param null $username
     * @param null $level
     * @param bool $count_result
     * @param bool $random
     * @return mixed
     */
    public function get_result($size = 5, $page = 0, $label = null, $type = null, $count_result = false, $random = false)
    {
        $this->db->from($this->tableName);
        // Filter $label
        if ($label !== null) {
            $this->db->like($this->field_label, $label);
        }
        if ($type !== null) {
            $this->db->where($this->field_type, $type);
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
    public function _page_limit($size = 500, $page = 0)
    {
        return parent::_page_limit($size, $page);
    }
}