<?php
/**
 * Search Form Template
 *
 * @package Wordpress
 * @subpackage Cobalt
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div><label class="screen-reader-text" for="s">Search for:</label>
        <input type="text" value="" name="s" id="s" />
        <button type="submit" id="search-button" alt="Search"><i class="fa fa-search"></i></button>
    </div>    
</form>