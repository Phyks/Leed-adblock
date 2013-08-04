<?php
/*
@name Adblock
@author Phyks <phyks@phyks.me>
@link http://www.phyks.me
@licence BEERWARE (See README.md file)
@version 2.0.0
@description The adblock plugin for leed allows to block embedded flash contents and / or images in feeds. You can set it fine-grained for each feed. You can also disable images only for mobile devices.
 */


function adblock_plugin_treat_events(&$events) {
    foreach($events as $event) {
        $old_content = $event->getContent();
    }
}

function adblock_plugin_setting_link(&$myUser) {
    echo '
        <li class="pointer" onclick="$(\'#main section\').hide();$(\'#main #adblockSettingsBloc\').fadeToggle(200);">Adblock</li>';
}

function adblock_plugin_setting_bloc(&$myUser) {
    $adblock_constants = file_get_contents('plugins/adblock/adblock_constants.php');
    $adblock_constants = explode("\n", $adblock_constants);

    $adblock_params = array();
    foreach($adblock_constants as $adblock_constant) {
        if(trim($adblock_constant) != "") {
            $adblock_constant = explode("=", $adblock_constant);
            $adblock_params[trim($adblock_constant[0])] = trim($adblock_constant[1]);
        }
    }


    $flash_enabled = (isset($adblock_params["flash_enabled"]) && $adblock_params["flash_enabled"] == "1") ? true : false;
    $flash_block = (isset($adblock_params["flash_block"]) && $adblock_params["flash_block"] == "1") ? true : false;
    if(isset($adblock_params["flash_list"]))
        $flash_list = str_replace(",", "\n", $adblock_params["flash_list"]);
    else
        $flash_list = "";
    $img_enabled = (isset($adblock_params["img_enabled"]) && $adblock_params["img_enabled"] == "1") ? true : false;
    $img_only_mobiles = (isset($adblock_params["img_only_mobiles"]) && $adblock_params["img_only_mobiles"] == 1) ? true : false;
    $img_block = (isset($adblock_params["img_block"]) && $adblock_params["img_block"] == "1") ? true : false;
    if(isset($adblock_params["img_list"]))
        $img_list = str_replace(",", "\n", $adblock_params["img_list"]);
    else
        $img_list = "";

    echo '
        <section id="adblockSettingsBloc">
            <form action="action.php?action=adblock_update" method="POST">
                <h2>Plugin Adblock</h2>
                <p><em>Note : </em><br/>
                    You must enter a list of id of feeds in the blacklist / whitelist fields. This list must be one id per line. You can find the id of the feed you want in the address bar on the page of the feed in Leed  (http://LEED_URL/index.php?action=selectedFeed&feed=ID).</p>
                <fieldset>
                    <div class="flash_adblockSettingsBlock">
                        <h3>Flash embedded contents :</h3>
                        <p>
                            Enable / Disable blocking of flash contents in events :<br/>
                            <input type="radio" name="flash_adblock_enable" value="1" id="flash_adblock_block_enabled" '.(($flash_enabled) ? 'checked="checked"' : '').'/><label for="flash_adblock_block_enabled">Enabled</label><br/>
                            <input type="radio" name="flash_adblock_enable" value="0" id="flash_adblock_block_disable" '.((!$flash_enabled) ? 'checked="checked"' : '').'/> <label for="flash_adblock_block_disable">Disabled</label>
                        </p>

                        <p>Default behavior :<br/>
                            <input type="radio" name="flash_adblock_default_behavior" value="1" id="flash_adblock_blockall" onchange="adblock_whitelist_blacklist(\'adblock_flash_whitelist_blacklist\', 1);" '.(($flash_block) ? 'checked="checked"' : '').'/><label for="flash_adblock_blockall">Block all contents (and use a whitelist)</label><br/>
                            <input type="radio" name="flash_adblock_default_behavior" value="0" id="flash_adblock_allowall" onchange="adblock_whitelist_blacklist(\'adblock_flash_whitelist_blacklist\', 0);" '.((!$flash_block) ? 'checked="checked"' : '').'/><label for="flash_adblock_allowall">Allow all contents (and use a blacklist)</label>
                        </p>

                        <p><span id="adblock_flash_whitelist_blacklist">'.(($flash_block) ? 'Blacklist :' : 'Whitelist :').'</span></br>
                        <textarea name="flash_adblock_list" rows="7">'.$flash_list.'</textarea>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="img_adblockSettingsBlock">
                        <h3>Images :</h3>
                        <p>
                            Enable / Disable blocking of images in events :<br/>
                            <input type="radio" name="img_adblock_enable" value="1" id="img_adblock_block_enabled" '.(($img_enabled) ? 'checked="checked"' : '').'/><label for="img_adblock_block_enabled">Enabled</label><br/>
                            <input type="radio" name="img_adblock_enable" value="0" id="img_adblock_block_disable" '.((!$img_enabled) ? 'checked="checked"' : '').'/> <label for="img_adblock_block_disable">Disabled</label>
                        </p>

                        <p>Default behavior :<br/>
                            <input type="radio" name="img_adblock_default_behavior" value="1" id="img_adblock_blockall" onchange="adblock_whitelist_blacklist(\'adblock_img_whitelist_blacklist\', 1);" '.(($img_block) ? 'checked="checked"' : '').'/><label for="img_adblock_blockall">Block all contents (and use a whitelist)</label><br/>
                            <input type="radio" name="img_adblock_default_behavior" value="0" id="img_adblock_allowall" onchange="adblock_whitelist_blacklist(\'adblock_img_whitelist_blacklist\', 0);" '.((!$img_block) ? 'checked="checked"' : '').'/><label for="img_adblock_allowall">Allow all contents (and use a blacklist)</label>
                        </p>

                        <p>Block images only on mobile devices ?<br/>
                            <input type="radio" name="img_adblock_only_mobiles" value="1" id="img_adblock_only_mobiles_yes" '.(($img_only_mobiles) ? 'checked="checked"' : '').'/><label for="img_adblock_only_mobiles_yes">Only block images on mobile devices</label><br/>
                            <input type="radio" name="img_adblock_only_mobiles" value="0" id="img_adblock_only_mobiles_no" '.((!$img_only_mobiles) ? 'checked="checked"' : '').'/><label for="img_adblock_only_mobiles_no">Block images on all devices</label>
                        </p>

                        <p><span id="adblock_img_whitelist_blacklist">'.(($img_block) ? 'Blacklist :' : 'Whitelist :').'</span></br>
                        <textarea name="img_adblock_list" rows="7">'.$img_list.'</textarea>
                    </div>
                </fieldset>
                <p id="adblock_settings_submit">
                    <input type="submit" class="button" value="Save"/>
                </p>
            </form>
        </section>';
}

function adblock_plugin_setting_update($_) {
    if($_['action'] == 'adblock_update') {
        $flash_enabled = (int) $_['flash_adblock_enable'];
        $flash_block = (int) $_['flash_adblock_default_behavior'];
        $flash_list = str_replace("\n", ",", $_["flash_adblock_list"]);

        $img_enabled = (int) $_['img_adblock_enable'];
        $img_block = (int) $_['img_adblock_default_behavior'];
        $img_only_mobiles = (int) $_["img_adblock_only_mobiles"];
        $img_list = str_replace("\n", ",", $_["img_adblock_list"]);

        if(file_put_contents("plugins/adblock/adblock_constants.php", "flash_enabled = ".$flash_enabled."\nflash_block = ".$flash_block."\nflash_list = ".$flash_list."\nimg_enabled = ".$img_enabled."\nimg_block = ".$img_block."\nimg_only_mobiles = ".$img_only_mobiles."\nimg_list = ".$img_list))
            header('location: settings.php');
        else
            exit("Unable to write parameters to plugins/adblock/adblock_constants.php. Check permissions on the folders.");
    }
}

Plugin::addCSS("/css/adblock_plugin_css.css");
Plugin::addJS("/js/adblock_plugin_js.js");

Plugin::addHook("index_post_treatment", "adblock_plugin_treat_events");

Plugin::addHook("setting_post_link", "adblock_plugin_setting_link");
Plugin::addHook("setting_post_section", "adblock_plugin_setting_bloc");
Plugin::addHook("action_post_case", "adblock_plugin_setting_update");
?>
