<?php foreach ($Lista as $item) { ?>

    <tr>

        <td width="20"><?php echo $item->FOLIO; ?></td>

        <td><?php echo $item->NOMBRE_COMPLETO; ?></td>

        <td width="80"> 

            <?php echo $item->WHATSAPP; ?>

        </td>BASE_URL();

        <td width="80">

            <?php echo number_format($item->SALDO,2,'.',','); ?>

        </td>

        <td>

            

            <a href="<?php echo BASE_URL; ?>cliente/perfil/<?php echo $item->ID;?>" class="btn ripple btn-success btn-sm"><i class="fe fe-edit"></i></a>

        </td>

    </tr>

<?php } ?>