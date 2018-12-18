<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 18/06/2018
 * Time: 10:29 SA
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Feedback_model extends TD_VAS_Based_model
{
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
    public function get_result($size = 5, $page = 0, $begin_date = '', $end_date = '', $count_result = false, $random = false)
    {
        $this->db->select('feedback.user_name as feedback_name, feedback.user_email as feedback_email,feedback.id as feedback_id,feedback.subject as feedback_subject,feedback.msg as feedback_msg,feedback.created_at as feedback_created_at,feedback.updated_at as feedback_updated_at');
        $this->db->from($this->tableName);
        // Filter Date
        if ($begin_date != '' && $end_date != '') {
            $this->db->where("feedback." .$this->field_created_at . $this->or_higher, $begin_date);
            $this->db->where("feedback." .$this->field_created_at . $this->or_smaller, $end_date);
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