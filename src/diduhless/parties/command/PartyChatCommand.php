<?php


namespace diduhless\parties\command;


use diduhless\parties\session\Session;

class PartyChatCommand extends SessionCommand {

    public function __construct() {
        parent::__construct("pchat", "Toggles the party chat");
    }

    public function onCommand(Session $session, array $args) {
        $party_chat = $session->hasPartyChat();
        if(!$session->hasParty()) {
            $session->message("§l§6» §r§cYou must be in a party to do this!");
            return;
        }

        $session->setPartyChat(!$party_chat);
        if($party_chat) {
            $session->message("§l§6»§r§a You have disabled party chat.");
        } else {
            $session->message("§l§6»§r§a You are now in party chat!");
        }
    }

}
