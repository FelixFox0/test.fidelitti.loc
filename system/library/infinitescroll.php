<?php
class InfiniteScroll {
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $url = '';
	
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

		$num_pages = ceil($total / $limit);

		$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

		if ($page < $num_pages) {
			$output = '<a href="' . str_replace('{page}', $page + 1, $this->url) . '" class="infinite-scroll-next-page"></a>';
		}

		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
}
