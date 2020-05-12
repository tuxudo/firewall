<?php

use munkireport\processors\Processor;

class Firewall_processor extends Processor
{
    public function process($plist)
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
