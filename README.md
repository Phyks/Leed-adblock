Adblock for Leed
================

This is a plugin for Leed written by Phyks (phyks@phyks.me) to allow a leed user to :

* Mask all embedded flash contents in the feeds (and allow him to play this content in a click to play way)
* Mask all the images in the feeds to load the pages faster

The filtered contents will be replaced by orange cross on grey background (images) or white cross on orange background (flash).

This behavior can be fully customized in a per feed way (with either a blacklist or a whitelist). You can also choose to disable images only on mobile browsers.

Please report (via the issue system on github or send me an email) any problems with this plugin and the feed experiencing problems. I can't test it with every available feed (and have fun with all the html errors that may appear in them) and will improve the plugin to fit the majority of feeds. 

**Important note :** To install the plugin, just do as usual with leed plugins. The adblock folder goes in the plugins directory of your leed installation. **Don't rename** the adblock directory unless you know what you do (you will need to change some paths values in the script itself). For an elegant degradation, _ie_ replacement of the deleted content by neutral content of the same size, you will need the getimagesize available in PHP and the directive _allow_url_fopen_ set to _On_ in your php.ini config file (the plugin will verify this for you).

**Note :** This will replace all images (found by searching for &lt;img&gt; tags) and all embedded objects (found by searching for iframes, as all flash content I found in my feeds are embedded _via_ iframes). This will only mask them when you display the page (and not load them) on a server side. If you click on the replacement content, it will load the masked content. So, the content is always downloaded from the external server to your running leed instance, but is only downloaded on-demand from to your device.

## Constants (adblock_constants.php file)

<table>
	<tr>
    	<th>Parameter</th>
        <th>Possible values</th>
    </tr>
    <tr>
    	<td>flash_enabled</td>
        <td>0 to disable flash blocking, 1 to enable</td>
    </tr>
    <tr>
    	<td>flash_block</td>
        <td>1 to block all flash content by default, 0 to allow flash and block with a blacklist (per feed)</td>
    </tr>
    <tr>
    	<td>flash_list</td>
        <td>Comma-separated list of feeds to allow (if flash_block is 1) or to block (if flash_block is 0)</td>
    </tr>
    <tr>
    	<td>img_enabled</td>
        <td>1 to enable image blocking, 0 to disable</td>
    </tr>
    <tr>
    	<td>img_block</td>
        <td>1 to blockall images by default, 0 to allow images and block selectively with a blacklist (per feed)</td>
    </tr>
    <tr>
    	<td>img_only_mobiles</td>
        <td>1 to make all the rules relative to images work only on mobiles, 0 else</td>
    </tr>
    <tr>
    	<td>img_list</td>
        <td>Comma-separated list of feeds to allow (if img_block is 1) or to block (if img_block is 0)</td>
    </tr>
</table>

For the _*_list_ parameters, the comma-separated list is a comma-separated list of feed ids. You can find these ids in the address bar when viewing the feed in list. The URL in the address bar should be like this (just take the ID in the URL) :
	
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

Contributors:
* @Cobalt74 - cobalt74 at gmail dot com - www.cobestran.com