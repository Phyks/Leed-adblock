<?php
    if(!file_put_contents("plugins/adblock/adblock_constants.php", "flash_enabled = 0\nflash_block = 0\nflash_list = \"\"\nimg_enabled = 0\nimg_block = 0\nimg_only_mobiles = 0\nimg_list = \"\""))
        exit("An error occured while initalizing the file to store parameters (plugins/adblock/adblock_constants.php). Check the write permissions of the web server on the parent folders.");
