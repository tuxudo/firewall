<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="firewall_allowsignedenabled-widget">
        <div id="firewall_allowsignedenabled-widget" class="panel-heading" data-container="body">
            <h3 class="panel-title"><i class="fa fa-certificate"></i> 
                <span data-i18n="firewall.allowsignedenabled_widget"></span>
                <list-link data-url="/show/listing/firewall/firewall"></list-link>
            </h3>
        </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/firewall/get_allowsignedenabled', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#firewall_allowsignedenabled-widget div.panel-body'),
        baseUrl = appUrl + '/show/listing/firewall/firewall/#';
        panel.empty();
        // Set blocks, disable if zero
        if(data.off != "0"){
            panel.append(' <a href="'+baseUrl+'allowsignedenabled = 0" class="btn btn-danger"><span class="bigger-150">'+data.off+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('no')+'&nbsp;&nbsp;&nbsp;</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'allowsignedenabled = 0" class="btn btn-danger disabled"><span class="bigger-150">'+data.off+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('no')+'&nbsp;&nbsp;&nbsp;</a>');
        }
        if(data.on != "0"){
            panel.append(' <a href="'+baseUrl+'allowsignedenabled = 1" class="btn btn-success"><span class="bigger-150">'+data.on+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('yes')+'&nbsp;&nbsp;&nbsp;</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'allowsignedenabled = 1" class="btn btn-success disabled"><span class="bigger-150">'+data.on+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('yes')+'&nbsp;&nbsp;&nbsp;</a>');
        }
    });
});

</script>
