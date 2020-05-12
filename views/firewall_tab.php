<div id="firewall-tab"></div>
<h2 data-i18n="firewall.firewall"></h2>

<div id="firewall-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<script>
$(document).on('appReady', function(){
    // Set the tab badge to blank
    $('#firewall-cnt').html("");
    
	$.getJSON(appUrl + '/module/firewall/get_firewall_data/' + serialNumber, function(data){
        
        if( data.length == 0 ){
            $('#firewall-msg').text(i18n.t('no_data'));
            $('#firewall-cnt').text('')
        } else {
            // Hide loading message
            $('#firewall-msg').text('');
        
            var skipThese = ['id','serial_number'];
            $.each(data, function(i,d){
                // Generate rows from data
                var rows = ''
                var rows_apps = ''
                var rows_services = ''
                for (var prop in d){
                    // Skip skipThese
                    if(skipThese.indexOf(prop) == -1){
                        if (d[prop] == ''){
                            // Do nothing for empty values to blank them
                            
                        } else if(prop == 'globalstate' && d[prop] == 2){
                            // Set the tab badge
                            $('#firewall-cnt').text(i18n.t('enabled'))
                            rows = rows + '<tr><th>'+i18n.t('firewall.'+prop)+'</th><td>'+i18n.t('firewall.block_all')+'</td></tr>';
                        } else if(prop == 'globalstate' && d[prop] == 1){
                            // Set the tab badge
                            $('#firewall-cnt').text(i18n.t('enabled'))
                            rows = rows + '<tr><th>'+i18n.t('firewall.'+prop)+'</th><td>'+i18n.t('firewall.limit')+'</td></tr>';
                        } else if(prop == 'globalstate' && d[prop] == 0){
                            // Set the tab badge
                            $('#firewall-cnt').text(i18n.t('disabled'))
                            rows = rows + '<tr><th>'+i18n.t('firewall.'+prop)+'</th><td>'+i18n.t('firewall.allow_all')+'</td></tr>';
                                                    
                        } else if((prop == 'firewallunload' || prop == 'allowdownloadsignedenabled' || prop == 'allowsignedenabled') && d[prop] == 1){
                            rows = rows + '<tr><th>'+i18n.t('firewall.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                        } else if((prop == 'firewallunload' || prop == 'allowdownloadsignedenabled' || prop == 'allowsignedenabled') && d[prop] == 0){
                            rows = rows + '<tr><th>'+i18n.t('firewall.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                                                    
                        } else if((prop == 'loggingenabled' || prop == 'stealthenabled') && d[prop] == 1){
                            rows = rows + '<tr><th>'+i18n.t('firewall.'+prop)+'</th><td>'+i18n.t('enabled')+'</td></tr>';
                        } else if((prop == 'loggingenabled' || prop == 'stealthenabled') && d[prop] == 0){
                            rows = rows + '<tr><th>'+i18n.t('firewall.'+prop)+'</th><td>'+i18n.t('disabled')+'</td></tr>';
                            
                        // Else if build out the applications table
                        } else if(prop == "applications"){                            
                            var apps_data = JSON.parse(d['applications']);
                            rows_apps = '<tr><th>'+i18n.t('firewall.bundle_id')+'</th><th>'+i18n.t('firewall.globalstate')+'</th></tr>'
                            $.each(apps_data, function(i,d){
                                var bundle_id = i                                
                                if (d == 0){
                                    var app_state = i18n.t('firewall.block_all')
                                } else if (d == 1){
                                    var app_state = i18n.t('firewall.allow_all')
                                } else if (d == 2){
                                    var app_state = i18n.t('firewall.limit')
                                } else {
                                    var app_state = d
                                }
                                
                                // Generate rows from data
                                rows_apps = rows_apps + '<tr><td>'+bundle_id+'</td><td>'+app_state+'</td></tr>';
                            })
                            rows_apps = rows_apps // Close applications table framework

                        // Else if build out the services table
                        } else if(prop == "services"){                            
                            var services_data = JSON.parse(d['services']);
                            rows_services = '<tr><th>'+i18n.t('firewall.service')+'</th><th>'+i18n.t('firewall.globalstate')+'</th></tr>'
                            $.each(services_data, function(i,d){
                                var service = i                                
                                if (d == 0){
                                    var service_state = i18n.t('firewall.block_all')
                                } else if (d == 1){
                                    var service_state = i18n.t('firewall.allow_all')
                                } else if (d == 2){
                                    var service_state = i18n.t('firewall.limit')
                                } else {
                                    var service_state = d
                                } 

                                // Generate rows from data
                                rows_services = rows_services + '<tr><td>'+service+'</td><td>'+service_state+'</td></tr>';
                            })
                            rows_services = rows_services // Close services table framework
                            
                        } else {
                            rows = rows + '<tr><th>'+i18n.t('firewall.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                        }
                    }
                }
                $('#firewall-tab')
                    .append($('<div style="max-width:575px;">')
                        .append($('<table>')
                            .addClass('table table-striped table-condensed')
                            .append($('<tbody>')
                                .append(rows))))
                
                
                if (rows_services !== ''){
                    $('#firewall-tab')
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-legal'))
                            .append(" "+i18n.t('firewall.services')))
                        .append($('<div style="max-width:475px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_services))))
                }
                
                if (rows_apps !== ''){
                    $('#firewall-tab')
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-hand-paper-o'))
                            .append(" "+i18n.t('firewall.applications')))
                        .append($('<div style="max-width:575px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_apps))))
                }
            })
        }
	});
});
</script>
