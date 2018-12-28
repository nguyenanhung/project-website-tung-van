<?php

/**
 * @Author: thaodt97
 * @Date  :   2018-06-13 15:41:05
 * @Last  Modified by:   thaodt97
 * @Last  Modified time: 2018-07-07 08:30:30
 */
/**
 * [paginations description]
 *
 * @param  string $total_row [Tổng số bản ghi trong bảng]
 * @param  string $per_pages [số bài trên 1 trang]
 * @param  string $page      [page hiện tại]
 *
 * @return [type]            [description]
 */
function paginations($total_row = '', $per_pages = '', $page = '')
{

    $result       = '';
    $total_list   = 5; //Khai báo số lượng phân trang: VD  1 2 3 4 5 => 5
    $redirect_url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '';
    /**
     * Đoạn này để đề phòng trường hợp khi mà up demo vào đâu đó có tạo thư mục.
     *
     */
    $full_url  = $redirect_url;
    $uri       = $full_url;
    $hafl_list = $total_list / 2;
    $hafl_list = (int) $hafl_list; // @var half_list: lấy ra 1 nửa của total list
    $var_mid   = $total_list - $page; // biến trung gian để trong trường hợp page < total list
    /**
     * [$per_pages lấy ra tổng số trang]
     *
     * @var [type]
     */
    if ($total_row % $per_pages == 0) {
        $total_page = $total_row / $per_pages;
        $total_page = (int) $total_page;
    } else {
        $total_page = (int) $total_row / $per_pages;
        $total_page = (int) $total_page;
        $total_page = $total_page + 1;
    }

    /**
     * [$header phần trên của cái HTML phân trang]
     *
     * @var string
     */
    $header = '
  <nav aria-label="Page navigation">
  <ul class="pagination">
  <li>
  <a href="' . $uri . '?page=1' . '" aria-label="Previous">
  <span aria-hidden="true">&laquo;</span>
  </a>
  </li>
  ';
    /**
     * [$footer phần dưới của HTML phân trang]
     *
     * @var string
     */
    $footer = '
  <li>
  <a href="' . $uri . '?page=' . $total_page . '" aria-label="Next">
  <span aria-hidden="true">&raquo;</span>
  </a>
  </li>
  </ul>
  </nav>
  ';

    $var_end = $total_page - $page; //biến trung gian khi page về cuối
    /**
     * TH 1: Tổng các Page nhỏ hơn tổng list
     */
    if ($total_page < $total_list) {
        for ($i = 1; $i <= $total_page; $i++) {
            $class  = ($page == $i) ? 'active' : '';
            $result = $result . '<li class="' . $class . '"><a  href="' . $uri . '?page=' . $i . '">' . $i . '</a></li>';
        }
    } /**
     * TH2: Tổng các page nhỏ hơn list và page đang lớn hơn thằng ở giữa
     */
    elseif ($page < $total_list && $var_mid > $page) {
        for ($i = 1; $i <= $total_list; $i++) {
            $class  = ($page == $i) ? 'active' : '';
            $result = $result . '<li class="' . $class . '"><a  href="' . $uri . '?page=' . $i . '">' . $i . '</a></li>';
        }
    } /**
     * TH3: Khi page về gần cuối và Page vẫn ở khoảng trước của cái page giữa.
     * ví dụ. có 20 page và hiện đang ở page 17. 15 16 [17] 18 19 thì cứ căn giữa thôi
     */
    elseif ($hafl_list > $var_end) {
        for ($i = $total_page - ($total_list - 1); $i <= $total_page; $i++) {
            $class  = ($page == $i) ? 'active' : '';
            $result = $result . '<li class="' . $class . '"><a  href="' . $uri . '?page=' . $i . '">' . $i . '</a></li>';
        }
    } /**
     * TH4: cái này là khi về cuối đây :3
     */
    else {
        for ($i = $page - $hafl_list; $i <= $page; $i++) {
            $class  = ($page == $i) ? 'active' : '';
            $result = $result . '<li class="' . $class . '"><a  href="' . $uri . '?page=' . $i . '">' . $i . '</a></li>';
        }
        for ($j = $page + 1; $j <= $page + $hafl_list; $j++) {
            $class  = ($page == $j) ? 'active' : '';
            $result = $result . '<li class="' . $class . '"><a  href="' . $uri . '?page=' . $j . '">' . $j . '</a></li>';
        }
    }

    return $header . $result . $footer;
}