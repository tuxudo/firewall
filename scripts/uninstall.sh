#!/bin/bash

# Remove firewall script
rm -f "${MUNKIPATH}preflight.d/firewall.py"

# Remove firewall.plist file
rm -f "${CACHEPATH}firewall.plist"
