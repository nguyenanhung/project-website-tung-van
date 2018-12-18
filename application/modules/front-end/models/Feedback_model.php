<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 18/06/2018
 * Time: 3:07 CH
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';

class Feedback_model extends TD_VAS_Based_model{
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'feedback';
        $this->primary_key       = 'id';
        $this->field_user_name   = 'user_name';
        $this->field_user_email  = 'user_email';
        $this->field_subject     = 'subject';
        $this->field_msg         = 'msg';
        $this->field_reply       = 'reply';
        $this->field_logging     = 'logging';
        $this->field_replylogging= 'reply_logging';
        $this->field_created_at  = 'created_at';
        $this->field_updated_at  = 'updated_at';
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
    public function get_result($size = 5, $page = 0,  $count_result = false, $random = false)
    {
        $this->db->from($this->tableName);

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