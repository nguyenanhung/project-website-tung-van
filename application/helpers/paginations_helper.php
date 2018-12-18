<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * view_paginations
 * 
 * @access      public 
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @version     1.0.2
 * @since       23/12/2016
 */
if (!function_exists('view_paginations'))
{
    function view_paginations($type, $total_rows, $per_page, $page_number, $page_links = '', $begin, $end, $title = '')
    {
        /**
         * Kiểm tra giá trị page_number truyền vào
         * Nếu ko có giá trị hoặc giá trị = 0 -> set giá trị = 1
         */
        if (!$page_number || empty($page_number))
        {
            $page_number = 1;
        }
        /**
         * Tính tổng số page có
         */
        $total = ceil($total_rows / $per_page);
        $main  = '';
        if ($total <= 1)
        {
            return '';
        }
        if ($page_number <> 1)
        {
            if ($type == 'site_page')
            {
                $main .= "\n<li class=\"waves-effect\"><a href=\"".$page_links.".html\"><i class=\"fa fa-angle-double-left\"></i></a></li>";
            }
            elseif ($type == 'search_page')
            {
                $main .= "\n<li class=\"waves-effect\"><a href=\"".$page_links."\"><i class=\"fa fa-angle-double-left\"></i></a></li>";
            }
            else
            {
                $main .= "<li class=\"left\"><a href=\"" . $page_links . "/\" title=\"" . $title . "\">&nbsp;</a></li>";
            }
        }
        for ($num = 1; $num <= $total; $num++)
        {
            if ($num < $page_number - $begin || $num > $page_number + $end)
                continue;
            if ($num == $page_number)
            {
                if ($type == 'site_page')
                {
                    $main .= "\n<li class=\"active\"><a href=\"".$page_links."/trang-".$num.".html\" title='".$title."'>".$num."</a></li>";
                }
                elseif ($type == 'search_page')
                {
                    $main .= "\n<li class=\"active\"><a href=\"".$page_links."&page=".$num."\" title='".$title."'>".$num."</a></li>";
                }
                else
                {
                    $main .= "<li class=\"selected\"><a href=\"" . $page_links . "/page/" . $num . "/\" title=\"" . $title . "\">" . $num . "</a></li>";
                }
            }
            else
            {
                if ($type == 'site_page')
                {
                    $main .= "\n<li class=\"waves-effect\"><a href=\"".$page_links."/trang-".$num.".html\">".$num."</a></li>";
                }
                elseif ($type == 'search_page')
                {
                    $main .= "\n<li class=\"waves-effect\"><a href=\"".$page_links."&page=".$num."\">".$num."</a></li>";
                }
                else
                {
                    $main .= "<li><a href=\"" . $page_links . "/page/" . $num . "/\" title=\"" . $title . " trang " . $num . "\">" . $num . "</a></li>";
                }
            }
        }
        unset($num);
        if ($page_number <> $total)
        {
            if ($type == 'site_page')
            {
                $main .= "\n<li class=\"waves-effect\"><a href=\"".$page_links."/trang-".$total.".html\"><i class=\"fa fa-angle-double-right\"></i></a></li>";
            }
            elseif ($type == 'search_page')
            {
                $main .= "\n<li class=\"waves-effect\"><a href=\"".$page_links."&page=".$total."\"><i class=\"fa fa-angle-double-right\"></i></a></li>";
            }
            else
            {
                $main .= "<li class=\"right\"><a href=\"" . $page_links . "/page/" . $total . "/\" title=\"" . $title . " trang cuối\">&nbsp;</a></li>";
            }
        }
        return $main;
    }
}
/**
 * view_more
 * 
 * @access      public 
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @version     1.0.1
 * @since       21/12/2016
 */
if (!function_exists('view_more'))
{
    function view_more($page_number, $page_total, $page_size, $url = '', $title = '', $more_type = '')
    {
        $is_total = ceil($page_total / $page_size);
        if ($is_total <= 1)
        {
            return '';
        }
        elseif ($is_total == $page_number)
        {
            $back_page = $page_number - 1;
            if ($more_type == 'search')
            {
                $main = '<a title="' . $title . ' trang ' . $back_page . '" href="' . $url . '&page=' . $back_page . '">Trang trước</a>';
            }
            else
            {
                $main = '<a title="' . $title . ' trang ' . $back_page . '" href="' . $url . '/trang-' . $back_page . '.html">Trang trước</a>';
            }
        }
        else
        {
            if (!empty($page_number) && $page_number != 0)
            {
                $next_page = $page_number + 1;
            }
            else
            {
                $next_page = $page_number + 2;
            }
            if ($more_type == 'search')
            {
                $main = '<a title="' . $title . ' trang ' . $next_page . '" href="' . $url . '&page=' . $next_page . '">Xem thêm</a>';
            }
            else
            {
                $main = '<a title="' . $title . ' trang ' . $next_page . '" href="' . $url . '/trang-' . $next_page . '.html">Xem thêm</a>';
            }
        }
        return $main;
    }
}
/**
 * select_page
 * 
 * @access      public 
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @version     1.0.1
 * @since       21/12/2016
 */
if (!function_exists('select_page'))
{
    function select_page($total_rows, $per_page, $page_number, $type = '', $page_links = '', $begin = '', $end = '', $title = '')
    {
        /**
         * ----------------------------------------------
         * Kiểm tra giá trị page_number truyền vào
         * Nếu ko có giá trị hoặc giá trị = 0 -> set giá trị = 1
         * ----------------------------------------------
         */
        if (!$page_number || empty($page_number))
        {
            $page_number = 1;
        }
        /**
         * ----------------------------------------------
         * Tính tổng số page có
         * ----------------------------------------------
         */
        $total = ceil($total_rows / $per_page);
        $main  = '';
        if ($total <= 1)
        {
            return '';
        }
        if ($page_number <> 1)
        {
            if ($type == 'select_page')
            {
                $main .= "<li class=\"left\"><a href=\"" . $page_links . ".html\" title=\"" . $title . "\">&nbsp;</a></li>";
            }
            else
            {
                $main .= "";
            }
        }
        for ($num = 1; $num <= $total; $num++)
        {
            if ($num == $page_number)
            {
                if ($type == 'select_page')
                {
                    $main .= "<li class=\"selected\"><a href=\"" . $page_links . "/trang-" . $num . ".html\" title=\"" . $title . " trang " . $num . "\">" . $num . "</a></li>";
                }
                else
                {
                    $main .= "<option selected value=\"" . $num . "\">Trang " . $num . "</option>";
                }
            }
            else
            {
                if ($type == 'select_page')
                {
                    $main .= "<li><a href=\"" . $page_links . "/trang-" . $num . ".html\" title=\"" . $title . " trang " . $num . "\">" . $num . "</a></li>";
                }
                else
                {
                    $main .= "<option value=\"" . $num . "\">Trang " . $num . "</option>";
                }
            }
        }
        unset($num);
        if ($page_number <> $total)
        {
            if ($type == 'select_page')
            {
                $main .= "<li class=\"right\"><a href=\"" . $page_links . "/trang-" . $total . ".html\" title=\"" . $title . " trang cuối\">&nbsp;</a></li>";
            }
            else
            {
                $main .= "<option value=\"" . $total . "\">Trang cuối</option>";
            }
        }
        return $main;
    }
}
/**
 * get_paginations_title
 * 
 * @access      public 
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @version     1.0.1
 * @since       21/12/2016
 */
if (!function_exists('get_paginations_title'))
{
    function get_paginations_title($str)
    {
        $str = str_replace('trang-', 'Trang ', $str);
        return $str;
    }
}
/**
 * get_paginations_number
 * 
 * @access      public 
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @version     1.0.1
 * @since       21/12/2016
 */
if (!function_exists('get_paginations_number'))
{
    function get_paginations_number($str)
    {
        $str = str_replace('trang-', '', $str);
        return intval($str);
    }
}
/* End of file paginations_helper.php */
/* Location: ./application/helpers/paginations_helper.php */
