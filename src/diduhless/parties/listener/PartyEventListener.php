<?php


namespace diduhless\parties\listener;


use diduhless\parties\event\PartyCreateEvent;
use diduhless\parties\event\PartyDisbandEvent;
use diduhless\parties\event\PartyInviteEvent;
use diduhless\parties\event\PartyJoinEvent;
use diduhless\parties\event\PartyLeaderPromoteEvent;
use diduhless\parties\event\PartyLeaveEvent;
use diduhless\parties\event\PartyMemberKickEvent;
use diduhless\parties\event\PartyPvpDisableEvent;
use diduhless\parties\event\PartyPvpEnableEvent;
use diduhless\parties\event\PartySetPrivateEvent;
use diduhless\parties\event\PartySetPublicEvent;
use diduhless\parties\event\PartyUpdateSlotsEvent;
use diduhless\parties\event\PartyWorldTeleportDisableEvent;
use diduhless\parties\event\PartyWorldTeleportEnableEvent;
use pocketmine\event\Listener;

class PartyEventListener implements Listener {

    /**
     * @param PartyCreateEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onCreate(PartyCreateEvent $event): void {
        $event->getSession()->message(" §l§6»§r§a {GREEN}You have created a party!");
    }

    /**
     * @param PartyDisbandEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onDisband(PartyDisbandEvent $event): void {
        $session = $event->getSession();
        $party = $event->getParty();

        $session->message(" §l§6»§r§c {RED}You have disbanded the party!");
        $party->message(" §l§6»§r§c {RED}The party has been disbanded because {YELLOW}" . $party->getLeaderName() . " {RED}left the party.", $session);
    }

    /**
     * @param PartyInviteEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onInvite(PartyInviteEvent $event): void {
        $session = $event->getSession();
        $target = $event->getTarget();

        $targetName = $target->getUsername();

        $session->message(" §l§6»§r§a {GREEN}You have invited {YELLOW}$targetName {GREEN}to the party! They have {WHITE}1 minute {GREEN}to accept the invitation.");
        $target->message(" §l§6»§r§a {GREEN}You have received an invitation to join {YELLOW}" . $session->getUsername() . "{GREEN}'s party!");
        $event->getParty()->message(" §l§6»§r§e $targetName {GREEN}has been invited to the party!", $session);
    }

    /**
     * @param PartyJoinEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onJoin(PartyJoinEvent $event): void {
        $session = $event->getSession();
        $party = $event->getParty();

        $session->message(" §l§6»§r§a {GREEN}You have joined {YELLOW}" . $party->getLeaderName() . "{GREEN}'s party!");
        $party->message(" §l§6»§r§e " . $session->getUsername() . " {GREEN}has joined the party!");
    }

    /**
     * @param PartyLeaderPromoteEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onLeaderPromote(PartyLeaderPromoteEvent $event): void {
        $session = $event->getSession();
        $newLeader = $event->getNewLeader();
        $party = $event->getParty();

        $sessionName = $session->getUsername();
        $newLeaderName = $newLeader->getUsername();

        $session->message(" §l§6»§r§a {GREEN}You have promoted {WHITE}§b$newLeaderName {GREEN}to party leader!");
        $newLeader->message(" §l§6»§r§a {GREEN}You have been promoted by {WHITE}$sessionName {GREEN}to party leader!");
        $party->message(" §l§6»§r§e $sessionName {GREEN}has promoted §b$newLeaderName {GREEN}to party leader!", $session);
    }

    /**
     * @param PartyLeaveEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onLeave(PartyLeaveEvent $event): void {
        $session = $event->getSession();
        $party = $event->getParty();

        $session->message(" §l§6»§r§a {RED}You have left {YELLOW}" . $party->getLeaderName() . "{RED}'s party!");
        $party->message(" §l§6»§r§e " . $session->getUsername() . " {RED}has left the party!", $session);
    }

    /**
     * @param PartyMemberKickEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onMemberKick(PartyMemberKickEvent $event): void {
        $member = $event->getMember();

        $member->message(" §l§6»§r§a {RED}You have been kicked from §e{YELLOW}" . $event->getSession()->getUsername() . "{RED}'s party!");
        $event->getParty()->message(" §l§6»§r§e " . $member->getUsername() . " {RED}has been kicked from the party!", $member);
    }

    /**
     * @param PartyPvpEnableEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onEnablePvp(PartyPvpEnableEvent $event): void {
        $event->getParty()->message(" §l§6»§r§a {GREEN}The party pvp has been {WHITE}enabled{GREEN}!");
    }

    /**
     * @param PartyPvpDisableEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onDisablePvp(PartyPvpDisableEvent $event): void {
        $event->getParty()->message("{GREEN}The party pvp has been {WHITE}disabled{GREEN}!");
    }

    /**
     * @param PartyWorldTeleportEnableEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onWorldTeleportEnable(PartyWorldTeleportEnableEvent $event): void {
        $event->getParty()->message("{GREEN}The party leader world teleport has been {WHITE}enabled{GREEN}!");
    }

    /**
     * @param PartyWorldTeleportDisableEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onWorldTeleportDisable(PartyWorldTeleportDisableEvent $event): void {
        $event->getParty()->message("{GREEN}The party leader world teleport has been {WHITE}disabled{GREEN}!");
    }

    /**
     * @param PartySetPrivateEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onLock(PartySetPrivateEvent $event): void {
        $event->getParty()->message(" §l§6»§r§e {GREEN}The party is now §dprivate{GREEN}!");
    }

    /**
     * @param PartySetPublicEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onUnlock(PartySetPublicEvent $event): void {
        $event->getParty()->message(" §l§6»§r§a {GREEN}The party is now {WHITE}§5public{GREEN}!");
    }

    /**
     * @param PartyUpdateSlotsEvent $event
     * @ignoreCancelled
     * @priority HIGHEST
     */
    public function onUpdateSlots(PartyUpdateSlotsEvent $event): void {
        $event->getParty()->message(" §l§6»§r§a {GREEN}The party slots have been set to §1" . $event->getSlots() . "{GREEN}!");
    }

}
