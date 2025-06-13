<script>
<?php 
  if($status=="ok"){
      ?>
    location.href = "<?php echo $url;?>";

<?php
  }else{
      ?>
          $("#_msg").html("<?php echo $msj;?>");
          <?php
  }
?>
</script>