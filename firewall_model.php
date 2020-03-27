<?php

use CFPropertyList\CFPropertyList;

class Firewall_model extends \Model {

	function __construct($serial='')
	{
		parent::__construct('id', 'firewall'); // Primary key, tablename
		$this->rs['id'] = '';
		$this->rs['serial_number'] = $serial;
		$this->rs['allowdownloadsignedenabled'] = null; // True/False
		$this->rs['allowsignedenabled'] = null; // True/False
		$this->rs['applications'] = null;
		$this->rs['firewallunload'] = null; // True/False
		$this->rs['globalstate'] = null;
		$this->rs['loggingenabled'] = null; // True/False
		$this->rs['loggingoption'] = null;
		$this->rs['services'] = null;
		$this->rs['stealthenabled'] = null; // True/False
		$this->rs['version'] = null;
		
		if ($serial) {
			$this->retrieve_record($serial);
		}
        
		$this->serial_number = $serial;
	}

	// ------------------------------------------------------------------------
    
	/**
	 * Process data sent by postflight
	 *
	 * @param plist data
	 * @author tuxudo
	 **/
	function process($plist)
	{
        // If plist is empty, echo out error
        if (! $plist) {
			echo ("Error Processing firewall module: No data found");
		} else { 

            $parser = new CFPropertyList();
            $parser->parse($plist, CFPropertyList::FORMAT_XML);
            $myList = $parser->toArray();

            $typeList = array(
                'allowdownloadsignedenabled' => null,
                'allowsignedenabled' => null,
                'applications' => null,
                'firewallunload' => null,
                'globalstate' => null,
                'loggingenabled' => null,
                'loggingoption' => null,
                'services' => null,
                'stealthenabled' => null,
                'version' => null
            );

            // Process each key
            foreach ($typeList as $key => $value) {
                $this->rs[$key] = $value;
                if(array_key_exists($key, $myList))
                {
                    $this->rs[$key] = $myList[$key];
                }
            }

            // Save the data, save the MacDevOpsYVR hack night!
            $this->save();
		}
	}
}
