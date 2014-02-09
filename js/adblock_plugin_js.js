function adblock_whitelist_blacklist(id, whitelist_blacklist) {
    if(whitelist_blacklist == 0)
        document.getElementById(id).innerHTML = "Whitelist :";
    else
        document.getElementById(id).innerHTML = "Blacklist :";
}

function adblock_unblock_img(span, url) {
    if($(span).html() != "X")
        return true;

    $(span).html("<img src='"+url+"'/>");
    $(span).removeClass("blocked_image");
    return false;
}

function adblock_unblock_flash(span, new_content) {
    if($(span).html() != "X")
        return true;

    $(span).html(new_content);
    $(span).removeClass("blocked_flash");
    return false;
}
