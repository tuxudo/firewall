Firewall Module
==============

Reports back on how the firewall is configured.


Table Schema
---
* allowdownloadsignedenabled - Boolean - If downloaded signed apps are allowed
* allowsignedenabled - Boolean - If signed apps are allowed
* applications - TEXT - JSON containing list of applications that are allowed/disallowed
* firewallunload - Boolean - If firewall has been unloaded
* globalstate - Integer - Global state of firewall
* loggingenabled - Boolean - If logging is enabled
* loggingoption - Integer - What logging option is set
* services - TEXT - JSON containing list of services that are allowed/disallowed
* stealthenabled - Boolean - If stealth is enabled
* version - VARCHAR(255) - Configuration version of firewall
