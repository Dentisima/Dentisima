<script>
  toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
  toastr["<?php echo $status;?>"]("<?php echo $msj;?>", "<?php echo $title;?>");
  
  <?php 
  if(isset($EsNuevo)){
     
      ?>
          
          ActualizarDatos(<?php echo $Id; ?>);
          Dominios(1,''); 
          <?php
  } 
  ?>
  
</script>