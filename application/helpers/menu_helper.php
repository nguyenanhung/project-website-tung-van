<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-14 15:46:35
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-14 16:26:04
 */
if (!function_exists('showCategories')) 
{
	function showCategories($cat, $parent = 0, &$newString,$level=0)
	{
		if($parent==0){
			$newString .= '<ul class="open-io nav side-menu">';
		}
		else{
			$newString .= '<ul class="io">';
		}
	

		foreach ($cat as $key => $value) {

			if($value['parent']==$parent)
			{	

				$value['level'] = $level + 1;
				if(($value['level']%2)==1){
					$newString .= '<li class="chan">	<a class="my-a title-cat" href=""><div class="title-cat">'.$value['title'].'</div>';
				}
				else{
					$newString .= '<li class="le">		<a class="my-a title-cat" href=""><div class="title-cat">'.$value['title'].'</div>';
				}
				unset($cat[$key]);
				$newParent = $value['id'];
				showCategories($cat, $newParent, $newString,$level+1);
				$newString .= '</a></li>';
			}
		}
		$newString .= '</ul>';
	}
}