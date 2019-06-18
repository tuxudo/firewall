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
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Firewall_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `globalstate` = 0 THEN 1 END) AS 'off',
                        COUNT(CASE WHEN `globalstate` = 1 THEN 1 END) AS 'on',
                        COUNT(CASE WHEN `globalstate` = 2 THEN 1 END) AS 'limited'
                        from firewall
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE ".get_machine_group_filter('');       
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Firewall allowsignedenabled widget
    *
    * @return void
    * @author tuxudo
    **/
    public function get_allowsignedenabled()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Firewall_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `allowsignedenabled` = 0 THEN 1 END) AS 'off',
                        COUNT(CASE WHEN `allowsignedenabled` = 1 THEN 1 END) AS 'on'
                        from firewall
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE ".get_machine_group_filter('');       
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Firewall stealthenabled widget
    *
    * @return void
    * @author tuxudo
    **/
    public function get_stealthenabled()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Firewall_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `stealthenabled` = 0 THEN 1 END) AS 'off',
                        COUNT(CASE WHEN `stealthenabled` = 1 THEN 1 END) AS 'on'
                        from firewall
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE ".get_machine_group_filter('');       
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Firewall allowdownloadsignedenabled widget
    *
    * @return void
    * @author tuxudo
    **/
    public function get_allowdownloadsignedenabled()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Firewall_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `allowdownloadsignedenabled` = 0 THEN 1 END) AS 'off',
                        COUNT(CASE WHEN `allowdownloadsignedenabled` = 1 THEN 1 END) AS 'on'
                        from firewall
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE ".get_machine_group_filter('');       
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }

	/**
     * Retrieve data in json format
     *
     **/
    public function get_data($serial_number = '')
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
        
        $sql = "SELECT globalstate, stealthenabled, allowsignedenabled, allowdownloadsignedenabled, loggingenabled, loggingoption, firewallunload, services, applications
                    FROM firewall 
                    WHERE serial_number = '$serial_number'";
        
        $queryobj = new firewall_model();
        $firewall_tab = $queryobj->query($sql);
        $obj->view('json', array('msg' => current(array('msg' => $firewall_tab)))); 
    }
} // End class Firewall_controller
