<?php $this->view('partials/head'); ?>

<?php //Initialize models needed for the table
new Machine_model;
new Reportdata_model;
new Firewall_model;
?>

<div class="container">
  <div class="row">
	<div class="col-lg-12">
	  <h3><span data-i18n="firewall.reporttitle"></span> <span id="total-count" class='label label-primary'>…</span></h3>
	  <table class="table table-striped table-condensed table-bordered">
		<thead>
		  <tr>
			<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
			<th data-i18n="serial" data-colname='reportdata.serial_number'></th>
			<th data-i18n="firewall.globalstate" data-colname='firewall.globalstate'></th>
			<th data-i18n="firewall.stealthenabled" data-colname='firewall.stealthenabled'></th>
			<th data-i18n="firewall.allowsignedenabled" data-colname='firewall.allowsignedenabled'></th>
			<th data-i18n="firewall.allowdownloadsignedenabled" data-colname='firewall.allowdownloadsignedenabled'></th>
			<th data-i18n="firewall.loggingenabled" data-colname='firewall.loggingenabled'></th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td data-i18n="listing.loading" colspan="7" class="dataTables_empty"></td>
		  </tr>
		</tbody>
	  </table>
	</div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">

	$(document).on('appUpdate', function(e){

		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;

	});

	$(document).on('appReady', function(e, lang) {

        // Get modifiers from data attribute
        var mySort = [], // Initial sort
            hideThese = [], // Hidden columns
            col = 0, // Column counter
            columnDefs = [{ visible: false, targets: hideThese }]; //Column Definitions

        $('.table th').map(function(){

            columnDefs.push({name: $(this).data('colname'), targets: col});

            if($(this).data('sort')){
              mySort.push([col, $(this).data('sort')])
            }

            if($(this).data('hide')){
              hideThese.push(col);
            }

            col++
        });

	    oTable = $('.table').dataTable( {
            ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function(d){
                    d.mrColNotEmpty = "globalstate";
                    
                    // Check for column in search
                    if(d.search.value){
                        $.each(d.columns, function(index, item){
                            if(item.name == 'firewall.' + d.search.value){
                                d.columns[index].search.value = '> 0';
                            }
                        });
                    }

                    if(d.search.value.match(/^globalstate = \d$/))
                    {
                        // Add column specific search
                        d.columns[2].search.value = d.search.value.replace(/.*(\d)$/, '= $1');
                        // Clear global search
                        d.search.value = '';
                    }

                    if(d.search.value.match(/^stealthenabled = \d$/))
                    {
                        // Add column specific search
                        d.columns[3].search.value = d.search.value.replace(/.*(\d)$/, '= $1');
                        // Clear global search
                        d.search.value = '';
                    }

                    if(d.search.value.match(/^allowsignedenabled = \d$/))
                    {
                        // Add column specific search
                        d.columns[4].search.value = d.search.value.replace(/.*(\d)$/, '= $1');
                        // Clear global search
                        d.search.value = '';
                    }

                    if(d.search.value.match(/^allowdownloadsignedenabled = \d$/))
                    {
                        // Add column specific search
                        d.columns[5].search.value = d.search.value.replace(/.*(\d)$/, '= $1');
                        // Clear global search
                        d.search.value = '';
                    }
                }
            },
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons,
            order: mySort,
            columnDefs: columnDefs,
		    createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
	        	var link = mr.getClientDetailLink(name, sn, '#tab_firewall-tab');
	        	$('td:eq(0)', nRow).html(link);
                
	        	// globalstate
	        	var colvar=$('td:eq(2)', nRow).html();
	        	colvar = colvar == '2' ? '<span class="label label-warning">'+i18n.t('firewall.block_all_listing')+'</span>' :
	        	colvar = colvar == '1' ? '<span class="label label-success">'+i18n.t('enabled')+'</span>' :
	        	(colvar === '0' ? '<span class="label label-danger">'+i18n.t('disabled')+'</span>' : '')
	        	$('td:eq(2)', nRow).html(colvar)
                
	        	// stealthenabled
	        	var colvar=$('td:eq(3)', nRow).html();
	        	colvar = colvar == '1' ? '<span class="label label-success">'+i18n.t('enabled')+'</span>' :
	        	(colvar === '0' ? '<span class="label label-danger">'+i18n.t('disabled')+'</span>' : '')
	        	$('td:eq(3)', nRow).html(colvar)
                
	        	// allowsignedenabled
	        	var colvar=$('td:eq(4)', nRow).html();
	        	colvar = colvar == '1' ? '<span class="label label-success">'+i18n.t('yes')+'</span>' :
	        	(colvar === '0' ? '<span class="label label-danger">'+i18n.t('no')+'</span>' : '')
	        	$('td:eq(4)', nRow).html(colvar)
                
	        	// allowdownloadsignedenabled
	        	var colvar=$('td:eq(5)', nRow).html();
	        	colvar = colvar == '1' ? '<span class="label label-success">'+i18n.t('yes')+'</span>' :
	        	(colvar === '0' ? '<span class="label label-danger">'+i18n.t('no')+'</span>' : '')
	        	$('td:eq(5)', nRow).html(colvar)
                
	        	// loggingenabled
	        	var colvar=$('td:eq(6)', nRow).html();
	        	colvar = colvar == '1' ? '<span class="label label-success">'+i18n.t('enabled')+'</span>' :
	        	(colvar === '0' ? '<span class="label label-danger">'+i18n.t('disabled')+'</span>' : '')
	        	$('td:eq(6)', nRow).html(colvar)
		    }
	    });

	});
</script>

<?php $this->view('partials/foot'); ?>
