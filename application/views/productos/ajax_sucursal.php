<option value="" selected>- Selecciona una Sucursal -</option>

<?php foreach ($Lista as $item) { ?>
    <option value="<?php echo $item->CODIGO; ?>"><?php echo $item->CODIGO." - ".$item->SUCURSAL; ?></option>
<?php } ?>
