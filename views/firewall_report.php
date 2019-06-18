<?php $this->view('partials/head', array(
	"scripts" => array(
		"clients/client_list.js"
	)
)); ?>

<div class="container">
    
  <div class="row">
    <?php $widget->view($this, 'firewall_global_state'); ?>
    <?php $widget->view($this, 'firewall_allowsignedenabled'); ?>
    <?php $widget->view($this, 'firewall_allowdownloadsignedenabled'); ?>
  </div> <!-- /row -->
    
  <div class="row">
    <?php $widget->view($this, 'firewall_stealthenabled'); ?>
  </div> <!-- /row -->
    
</div>  <!-- /container -->

<script src="<?php echo conf('subdirectory'); ?>assets/js/munkireport.autoupdate.js"></script>

<?php $this->view('partials/foot'); ?>
