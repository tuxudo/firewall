#!/bin/bash

# firewall controller
CTL="${BASEURL}index.php?/module/firewall/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/firewall.py" -o "${MUNKIPATH}preflight.d/firewall.py"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/firewall.py"
    
	# Touch the cache file to prevent errors
	mkdir -p "${MUNKIPATH}preflight.d/cache"
	touch "${MUNKIPATH}preflight.d/cache/firewall.plist"

	# Set preference to include this file in the preflight check
	setreportpref "firewall" "${CACHEPATH}firewall.plist"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/firewall.py"

	# Signal that we had an error
	ERR=1
fi


