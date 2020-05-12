<?php

use CFPropertyList\CFPropertyList;
use munkireport\processors\Processor;

class Firewall_processor extends Processor
{
    public function run($plist)
	{
        // If plist is empty, echo out error
        if ( ! $plist){
                throw new Exception("Error Processing Request: No property list found", 1);
        }

        $parser = new CFPropertyList();
        $parser->parse($plist, CFPropertyList::FORMAT_XML);
        $mylist = $parser->toArray();

        $model = Firewall_model::firstOrNew(['serial_number' => $this->serial_number]);

        $model->fill($mylist);
        $model->save();    

	}
}
