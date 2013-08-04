<?php
/*
@name Adblock
@author Phyks <phyks@phyks.me>
@link http://www.phyks.me
@licence BEERWARE
@version 2.0.0
@description Le plugin adblock permet d'empêcher le lancement automatique de contenus embed de type "flash" et notamment des pubs dans les flux RSS. Par défaut, tous les contenus sont bloqués. Il est possible de modifier ce comportement et de régler finement par flux.
 */


function adblock_plugin_treatment(&$events) {
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

    foreach($adblock_constants as $adblock_constant) {
        if(trim($adblock_constant) != "") {
            $adblock_constant = explode("=", $adblock_constant);
            $adblock_params[trim($adblock_constant[0])] = trim($adblock_constant[1]);
        }
    }

    $flash_enabled = ($adblock_params["flash_enabled"] == "1") ? true : false;
    $flash_block = ($adblock_params["flash_block"] == "1") ? true : false;
    $flash_list = "";
    $img_enabled = ($adblock_params["img_enabled"] == "1") ? true : false;
    $img_block = ($adblock_params["img_block"] == "1") ? true : false;
    $img_list = "";

    echo '
        <section id="adblockSettingsBloc">
            <form action="action.php?action=adblock_update" method="POST">
                <h2>Plugin Adblock</h2>
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

}

Plugin::addCSS("/css/adblock_plugin_css.css");
Plugin::addJS("/js/adblock_plugin_js.js");

Plugin::addHook("index_post_treatment", "adblock_plugin_treatment");

Plugin::addHook("setting_post_link", "adblock_plugin_setting_link");
Plugin::addHook("setting_post_section", "adblock_plugin_setting_bloc");
Plugin::addHook("action_post_case", "adblock_plugin_setting_update");
?>
