<?php

return array(
    'client_tabs' => array(
        'firewall-tab' => array('view' => 'firewall_tab', 'i18n' => 'firewall.firewall', 'badge' => 'firewall-cnt'),
    ),
    'listings' => array(
        'firewall' => array('view' => 'firewall_listing', 'i18n' => 'firewall.firewall'),
    ),
    'widgets' => array(
        'firewall_global_state' => array('view' => 'firewall_global_state_widget'),
        'firewall_allowsignedenabled' => array('view' => 'firewall_allowsignedenabled_widget'),
        'firewall_stealthenabled' => array('view' => 'firewall_stealthenabled_widget'),
        'firewall_allowdownloadsignedenabled' => array('view' => 'firewall_allowdownloadsignedenabled_widget'),
    ),
    'reports' => array(
        'firewall_report' => array('view' => 'firewall_report', 'i18n' => 'firewall.reporttitle'),
    ),
);
