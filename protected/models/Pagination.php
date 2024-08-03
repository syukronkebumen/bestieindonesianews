<?php

namespace app\models;

class Pagination 
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
		$output = '<ul class="styled-pagination text-center">';
		if ($page > 1) {
			$output .= '<li><a href="' . $this->url . $query_string . '">' . $this->text_first . '</a></li>';
			
			if ($page - 1 === 1) {
				$output .= '<li><a href="' . $this->url . $query_string . '">' . $this->text_prev . '</a></li>';
			} else {
				$output .= '<li><a href="' . $this->url . ($page - 1) . $query_string . '">' . $this->text_prev . '</a></li>';
			}
		}
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
					$output .= '<li><a href="#" class="active" >' . $i . '</a></li>';
				} else {
					if ($i === 1) {
						$output .= '<li><a href="' . $this->url . $i . $query_string . '">' . $i . '</a></li>';
					} else {
						$output .= '<li><a href="' . $this->url . $i . $query_string . '">' . $i . '</a></li>';
					}
				}
			}
		}
		if ($page < $num_pages) {
			$output .= '<li><a href="' . $this->url . ($page + 1) . $query_string . '">' . $this->text_next . '</a></li>';
			$output .= '<li><a href="' . $this->url . $num_pages . $query_string . '">' . $this->text_last . '</a></li>';
		}
		$output .= '</ul>';
		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
}