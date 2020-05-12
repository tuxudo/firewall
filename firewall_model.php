<?php

use CFPropertyList\CFPropertyList;
use munkireport\models\MRModel as Eloquent;

class Firewall_model extends Eloquent
{
    protected $table = 'Firewall';

    protected $fillable = [
		'serial_number',
		'allowdownloadsignedenabled',
		'allowsignedenabled',
		'applications',
		'firewallunload',
		'globalstate',
		'loggingenabled',
		'loggingoption',
		'services',
		'stealthenabled',
		'version',
		];		

	public $timestamps = false;
}
