Adblock for Leed
================

This is a plugin for Leed written by Phyks (phyks@phyks.me) to allow a leed user to :

* Mask all embedded flash contents in the feeds (and allow him to play this content in a click to play way)
* Mask all the images in the feeds to load the pages faster

This behavior can be fully customized in a per feed way (with either a blacklist or a whitelist). You can also choose to disable images only on mobile browsers.

## Constants (_adblock_constants.php_ file)

<table>
	<tr>
    	<th>Parameter</th>
        <th>Possible values</th>
    </tr>
    <tr>
    	<td>_flash_enabled_</td>
        <td>_0_ to disable flash blocking, _1_ to enable</td>
    </tr>
    <tr>
    	<td>_flash_block_</td>
        <td>_1_ to block all flash content by default, _0_ to allow flash and block with a blacklist (per feed)</td>
    </tr>
    <tr>
    	<td>_flash_list_</td>
        <td>Comma-separated list of feeds to allow (if _flash_block_ is _1_) or to block (if _flash_block_ is _0_)</td>
    </tr>
    <tr>
    	<td>_img_enabled_</td>
        <td>_1_ to enable image blocking, _0_ to disable</td>
    </tr>
    <tr>
    	<td>_img_block_</td>
        <td>_1_ to blockall images by default, _0_ to allow images and block selectively with a blacklist (per feed)</td>
    </tr>
    <tr>
    	<td>_img_only_mobiles_</td>
        <td>_1_ to make all the rules relative to images work only on mobiles, _0_ else</td>
    </tr>
    <tr>
    	<td>_img_list_</td>
        <td>Comma-separated list of feeds to allow (if _img_block_ is _1_) or to block (if _img_block_ is _0_)</td>
    </tr>
</table>

For the _*_list_ paramaters, the comma-separated list is a comma-separated list of feed ids. You can find these ids in the address bar when viewing the feed in list. The URL in the address bar should be like this (just take the ID in the URL) :
	
    http://LEED_URL/index.php?action=selectedFeed&feed=ID

## License
Please, send me an email if you use or modify this program, just to let me know if this program is useful to anybody or how did you improve it :) You can also send me an email to tell me how lame it is ! :)

### TLDR; 
I don't give a damn to anything you can do using this code. It would just be nice to
quote where the original code comes from.


--------------------------------------------------------------------------------
"THE NO-ALCOHOL BEER-WARE LICENSE" (Revision 42) :

    Phyks (phyks@phyks.me) wrote this file. As long as you retain this notice you
    can do whatever you want with this stuff (and you can also do whatever you want
    with this stuff without retaining it, but that's not cool...). If we meet some 
    day, and you think this stuff is worth it, you can buy me a <del>beer</del> soda 
    in return.
                                                                     Phyks
---------------------------------------------------------------------------------
