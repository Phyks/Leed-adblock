function adblock_whitelist_blacklist(id, whitelist_blacklist) {
    if(whitelist_blacklist == 0)
        document.getElementById(id).innerHTML = "Whitelist :";
    else
        document.getElementById(id).innerHTML = "Blacklist :";
}
