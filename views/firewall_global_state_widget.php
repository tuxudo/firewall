<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="firewall_global_state-widget">
        <div id="firewall_global_state-widget" class="panel-heading" data-container="body">
            <h3 class="panel-title"><i class="fa fa-fire"></i> 
                <span data-i18n="firewall.globalstate"></span>
                <list-link data-url="/show/listing/firewall/firewall"></list-link>
            </h3>
        </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/firewall/get_global_state', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#firewall_global_state-widget div.panel-body'),
        baseUrl = appUrl + '/show/listing/firewall/firewall/#';
        panel.empty();
        // Set blocks, disable if zero
        if(data.off != "0"){
            panel.append(' <a href="'+baseUrl+'globalstate = 0" class="btn btn-danger"><span class="bigger-150">'+data.off+'</span><br>'+i18n.t('disabled')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'globalstate = 0" class="btn btn-danger disabled"><span class="bigger-150">'+data.off+'</span><br>'+i18n.t('disabled')+'</a>');
        }
        if(data.limited != "0"){
            panel.append(' <a href="'+baseUrl+'globalstate = 2" class="btn btn-warning"><span class="bigger-150">'+data.limited+'</span><br>'+i18n.t('firewall.block_all_listing')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'globalstate = 2" class="btn btn-warning disabled"><span class="bigger-150">'+data.limited+'</span><br>'+i18n.t('firewall.block_all_listing')+'</a>');
        }
        if(data.on != "0"){
            panel.append(' <a href="'+baseUrl+'globalstate = 1" class="btn btn-success"><span class="bigger-150">'+data.on+'</span><br>'+i18n.t('enabled')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'globalstate = 1" class="btn btn-success disabled"><span class="bigger-150">'+data.on+'</span><br>'+i18n.t('enabled')+'</a>');
        }
    });
});

</script>
