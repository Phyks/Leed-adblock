<?php
    $getimagesize_available = function_exists("getimagesize") && ((ini_get("allow_url_fopen") == "1") ? true : false);
    $getimagesize_available = ($getimagesize_available) ? 1 : 0;

    if(!file_put_contents("adblock_constants.php", "flash_enabled = 0\nflash_block = 0\nflash_list = \nimg_enabled = 0\nimg_block = 0\nimg_only_mobiles = 0\nimg_list = \nelegant_degradation = ".$getimagesize_available))
        exit("An error occured while initalizing the file to store parameters (adblock_constants.php). Check the write permissions of the web server on the parent folders.");
