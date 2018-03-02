<?php 
	if (strpos($_SERVER[HTTP_HOST], 'resources') !== false) {
    	$term_slug = "resources";
	} elseif (strpos($_SERVER[HTTP_HOST], 'blog') !== false) {
		$term_slug = "blog";
	} elseif (strpos($_SERVER[HTTP_HOST], 'press') !== false) {
		$term_slug = "press";
	}
?>