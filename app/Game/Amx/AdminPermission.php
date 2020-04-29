<?php

namespace App\Game\Amx;

class AdminPermission
{
   /**
     * - immunity (can't be kicked/baned/slayed/slaped and affected by other commmands)
     * @var string
     */
    const IMMUNITY_ACCESS_FLAG = 'a';

    /**
     * - reservation (can join on reserved slots)
     * @var string
     */
    const RESERVATION_ACCESS_FLAG = 'b';

    /**
     * - amx_kick command
     * @var string
     */
    const KICK_ACCESS_FLAG = 'c';

    /**
     * - amx_ban and amx_unban commands
     * @var string
     */
    const BAN_UBAN_ACCESS_FLAG = 'd';

    /**
     * - amx_slay and amx_slap commands
     * @var string
     */
    const SLAY_ACCESS_FLAG = 'e';

    /**
     * - amx_map command
     * @var string
     */
    const MAP_ACCESS_FLAG = 'f';

    /**
     * - amx_cvar command (not all cvars will be available)
     * @var string
     */
    const CVAR_ACCESS_FLAG = 'g';

    /**
     * - amx_cfg command
     * @var string
     */
    const CFG_ACCESS_FLAG = 'h';

    /**
     * - amx_chat and other chat commands
     * @var string
     */
    const CHAT_ACCESS_FLAG = 'i';

    /**
     * - amx_vote and other vote commands
     * @var string
     */
    const VOTE_ACCESS_FLAG = 'j';

    /**
     * - access to sv_password cvar (by amx_cvar command)
     * @var string
     */
    const SV_PASSWORD_ACCESS_FLAG = 'k';

    /**
     * - access to amx_rcon command and rcon_password cvar (by amx_cvar command)
     * @var string
     */
    const RCON_ACCESS_FLAG = 'l';

    /**
     * - custom level A (for additional plugins)
     * @var string
     */
    const CUSTOM_A_ACCESS_FLAG = 'm';

    /**
     * - custom level B
     * @var string
     */
    const CUSTOM_B_ACCESS_FLAG = 'n';

    /**
     * - custom level C
     * @var string
     */
    const CUSTOM_C_ACCESS_FLAG = 'o';

    /**
     * - custom level D
     * @var string
     */
    const CUSTOM_D_ACCESS_FLAG = 'p';

    /**
     * - custom level E
     * @var string
     */
    const CUSTOM_E_ACCESS_FLAG = 'q';

    /**
     * - custom level F
     * @var string
     */
    const CUSTOM_F_ACCESS_FLAG = 'r';

    /**
     * - custom level G
     * @var string
     */
    const CUSTOM_G_ACCESS_FLAG = 's';

    /**
     * - custom level H
     * @var string
     */
    const CUSTOM_H_ACCESS_FLAG = 't';

    /**
     * - menu access
     * @var string
     */
    const MENU_ACCESS_FLAG = 'u';

    /**
     * - user (no admin)
     * @var string
     */
    const USER_ACCESS_FLAG = 'z';

    /**
     * Access options.
     * @var array
     */
    const ACCESS = [
        self::IMMUNITY_ACCESS_FLAG => 'Immunity (can\'t be kicked/baned/slayed/slaped and affected by other commmands)',
        self::RESERVATION_ACCESS_FLAG => 'Reservation (can join on reserved slots)',
        self::KICK_ACCESS_FLAG => 'amx_kick command',
        self::BAN_UBAN_ACCESS_FLAG => 'amx_ban and amx_unban commands',
        self::SLAY_ACCESS_FLAG => 'amx_slay and amx_slap commands',
        self::MAP_ACCESS_FLAG => 'amx_map command',
        self::CVAR_ACCESS_FLAG => 'amx_cvar command (not all cvars will be available)',
        self::CFG_ACCESS_FLAG => 'amx_cfg command',
        self::CHAT_ACCESS_FLAG => 'amx_chat and other chat commands',
        self::VOTE_ACCESS_FLAG => 'amx_vote and other vote commands',
        self::SV_PASSWORD_ACCESS_FLAG => 'access to sv_password cvar (by amx_cvar command)',
        self::RCON_ACCESS_FLAG => 'access to amx_rcon command and rcon_password cvar (by amx_cvar command)',
        self::CUSTOM_A_ACCESS_FLAG => 'custom level A (for additional plugins)',
        self::CUSTOM_B_ACCESS_FLAG => 'custom level B',
        self::CUSTOM_C_ACCESS_FLAG => 'custom level C',
        self::CUSTOM_D_ACCESS_FLAG => 'custom level D',
        self::CUSTOM_E_ACCESS_FLAG => 'custom level E',
        self::CUSTOM_F_ACCESS_FLAG => 'custom level F',
        self::CUSTOM_G_ACCESS_FLAG => 'custom level G',
        self::CUSTOM_H_ACCESS_FLAG => 'custom level H',
        self::MENU_ACCESS_FLAG => 'menu access',
        self::USER_ACCESS_FLAG => 'user (no admin)',
    ];

    /**
     * Flag options.
     * @var array
     */
    const FLAGS = [
        'a' => 'Disconnect player on invalid password',
        'b' => 'Clan tag',
        'c' => 'This is the steamid/wonid',
        'd' => 'This is IP address',
        'e' => 'The password is not checked. Only the name/ip/steamid is needed.',
        'k' => 'The name or tag is case sensitive. For example, if the name "Ham" is protected and is case sensitive (flags "k" only), then anybody can use the names "haM", "HAM", "ham", etc, but not "Ham"',
    ];
}
