<?php
/*
@name Adblock
@author Phyks <phyks@phyks.me>
@link http://www.phyks.me
@licence BEERWARE
@version 2.0.0
@description Le plugin adblock permet d'empêcher le lancement automatique de contenus embed de type "flash" et notamment des pubs dans les flux RSS. Par défaut, tous les contenus sont bloqués. Il est possible de modifier ce comportement et de régler finement par flux.
*/


function clean_events(&$events){
	foreach($events as $event) {
		$old_content = $event->getContent();
	}
}

Plugin::addHook("index_post_treatment", "clean_events");  
?>
