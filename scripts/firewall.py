#!/usr/local/munkireport/munkireport-python3

"""
Firewall for munkireport.
By Tuxudo
Will return all details about how the firewall is configured
"""

import subprocess
import os
import sys
import platform
import re
import plistlib
import json

sys.path.insert(0,'/usr/local/munki')
sys.path.insert(0, '/usr/local/munkireport')
from munkilib import FoundationPlist


def get_firewall_info():
    '''Uses system profiler to get firewall info for the machine.'''
    cmd = ['/usr/sbin/system_profiler', 'SPFirewallDataType', '-xml']
    proc = subprocess.Popen(cmd, shell=False, bufsize=-1,
                            stdin=subprocess.PIPE,
                            stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    (output, unused_error) = proc.communicate()
    try:
        try:
            plist = plistlib.readPlistFromString(output)
        except AttributeError as e:
            plist = plistlib.loads(output)
        # system_profiler xml is an array
        firewall_dict = plist[0]
        items = firewall_dict['_items']
        return items
    except Exception:
        return {}

def flatten_firewall_info(array):
    '''Un-nest firewall info, return array with objects with relevant keys'''
    firewall = {}
    for obj in array:
        for item in obj:
            if item == '_items':
                out = out + flatten_firewall_info(obj['_items'])
            elif item == 'spfirewall_services':
                for service in obj[item]:
                    if obj[item][service] == "spfirewall_allow_all":
                        obj[item][service] = 1
                    else:
                        obj[item][service] = 0
                firewall['services'] = json.dumps(obj[item])
            elif item == 'spfirewall_applications':
                for application in obj[item]:
                    if obj[item][application] == "spfirewall_allow_all":
                        obj[item][application] = 1
                    else:
                        obj[item][application] = 0
                firewall['applications'] = json.dumps(obj[item])
           
    return firewall
 
def get_alf_preferences():
    pl = FoundationPlist.readPlist("/Library/Preferences/com.apple.alf.plist")
    firewall = {}

    for item in pl:
        if item == 'allowdownloadsignedenabled':
            firewall['allowdownloadsignedenabled'] = to_bool(pl[item])
        elif item == 'allowsignedenabled':
            firewall['allowsignedenabled'] = to_bool(pl[item])
        elif item == 'firewallunload':
            firewall['firewallunload'] = to_bool(pl[item])
        elif item == 'globalstate':
            firewall['globalstate'] = to_bool(pl[item])
        elif item == 'stealthenabled':
            firewall['stealthenabled'] = to_bool(pl[item])
        elif item == 'loggingenabled':
            firewall['loggingenabled'] = to_bool(pl[item])
        elif item == 'loggingoption':
            firewall['loggingoption'] = pl[item]
        elif item == 'version':
            firewall['version'] = pl[item]
    return firewall
    
def to_bool(s):
    if s == True:
        return 1
    else:
        return 0

def merge_two_dicts(x, y):
    z = x.copy()
    z.update(y)
    return z

def main():
    """Main"""

    # Get results
    result = dict()
    info = get_firewall_info()
    result = merge_two_dicts(flatten_firewall_info(info), get_alf_preferences())
    
    # Write firewall results to cache
    cachedir = '%s/cache' % os.path.dirname(os.path.realpath(__file__))
    output_plist = os.path.join(cachedir, 'firewall.plist')
    FoundationPlist.writePlist(result, output_plist)
    #print FoundationPlist.writePlistToString(result)

if __name__ == "__main__":
    main()
