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
		$output = '<div class="nav-links">';
		if ($page > 1) {
			$output .= '<a class="page-numbers" href="' . $this->url . $query_string . '">' . $this->text_first . '</a>';
			
			if ($page - 1 === 1) {
				$output .= '<a class="prev page-numbers" href="' . $this->url . $query_string . '">' . $this->text_prev . '</a>';
			} else {
				$output .= '<a class="prev page-numbers" href="' . $this->url . ($page - 1) . $query_string . '">' . $this->text_prev . '</a>';
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
					$output .= '<span aria-current="page" class="page-numbers current">' . $i . '</span>';
				} else {
					if ($i === 1) {
						$output .= '<a class="page-numbers" href="' . $this->url . $i . $query_string . '">' . $i . '</a>';
					} else {
						$output .= '<a class="page-numbers" href="' . $this->url . $i . $query_string . '">' . $i . '</a>';
					}
				}
			}
		}
		if ($page < $num_pages) {
			$output .= '<a class="next page-numbers" href="' . $this->url . ($page + 1) . $query_string . '">' . $this->text_next . '</a>';
			$output .= '<a class="next page-numbers" href="' . $this->url . $num_pages . $query_string . '">' . $this->text_last . '</a>';
		}
		$output .= '</div>';
		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
}