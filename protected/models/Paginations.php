<?php

namespace app\models;

class Paginations 
{
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 4;
	public $url = '';
	public $text_first = '&laquo;';
	public $text_last = '&raquo;';
	public $text_next = '&rsaquo;';
	public $text_prev = '&lsaquo;';
	/**
     * 
     *
     * @return	texta
     */
	public function render() {
		$total = $this->total;
		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}
		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}
		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);
		//$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);
		//$query_string = isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : NULL ;
        $query_string = '';
	   $output = '';
	
		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);
				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}
				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}
			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
				    $l = $i+1;
					$output .= '<a class="btn btn-sm btn-info " href="' . $this->url . $l . $query_string . '"> Load More </a>';
				} else {
					
				}
			}
		}
		
	
		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
}