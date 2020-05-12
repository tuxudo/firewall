<?php

/**
 * firewall module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Firewall_controller extends Module_controller
{

	/*** Protect methods with auth! ****/
	function __construct()
	{
		// Store module path
		$this->module_path = dirname(__FILE__);
	}

	/**
	 * Default method
	 * @author tuxudo
	 *
	 **/
	function index()
	{
		echo "You've loaded the firewall module!";
	}
    
    /**
    * Firewall state widget
    *
    * @return void
    * @author tuxudo
    **/
    public function get_global_state()
    {
        jsonView(
            Firewall_model::selectRaw("COUNT(CASE WHEN `globalstate` = '1' THEN 1 END) AS 'on'")
            ->selectRaw("COUNT(CASE WHEN `globalstate` = '0' THEN 1 END) AS 'off'")
            ->selectRaw("COUNT(CASE WHEN `globalstate` = '2' THEN 1 END) AS 'limited'")
            ->filter()
            ->first()
            ->toLabelCount()
        );
    }
    
    /**
    * Firewall allowsignedenabled widget
    *
    * @return void
    * @author tuxudo
    **/
    public function get_allowsignedenabled()
    {
        jsonView(
            Firewall_model::selectRaw("COUNT(CASE WHEN `allowsignedenabled` = '1' THEN 1 END) AS 'on'")
                ->selectRaw("COUNT(CASE WHEN `allowsignedenabled` = '0' THEN 1 END) AS 'off'")
                ->filter()
                ->first()
                ->toLabelCount()
        );
    }
    
    /**
    * Firewall stealthenabled widget
    *
    * @return void
    * @author tuxudo
    **/
    public function get_stealthenabled()
    {
        jsonView(
            Firewall_model::selectRaw("COUNT(CASE WHEN `stealthenabled` = '1' THEN 1 END) AS 'on'")
                ->selectRaw("COUNT(CASE WHEN `stealthenabled` = '0' THEN 1 END) AS 'off'")
                ->filter()
                ->first()
                ->toLabelCount()
        );
    }
    
    /**
    * Firewall allowdownloadsignedenabled widget
    *
    * @return void
    * @author tuxudo
    **/
    public function get_allowdownloadsignedenabled()
    {
        jsonView(
            Firewall_model::selectRaw("COUNT(CASE WHEN `allowdownloadsignedenabled` = '1' THEN 1 END) AS 'on'")
                ->selectRaw("COUNT(CASE WHEN `allowdownloadsignedenabled` = '0' THEN 1 END) AS 'off'")
                ->filter()
                ->first()
                ->toLabelCount()
        );
    }

	/**
     * Retrieve data in json format
     *
     **/
    public function get_firewall_data($serial_number)
    {
        jsonView(
            Firewall_model::selectRaw('globalstate, stealthenabled, allowsignedenabled, allowdownloadsignedenabled, loggingenabled, loggingoption, firewallunload, services, applications')
                ->where('firewall.serial_number', $serial_number)
                ->filter()
                ->get()
                ->toArray()
        );
    }

} // End class Firewall_controller
