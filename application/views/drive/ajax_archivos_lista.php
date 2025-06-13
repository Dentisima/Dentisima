<?php
foreach ($Lista as $item) {

    $location = "./expediente/drive/" . $item->IDETIQUETA . "/" . $item->ARCHIVO;
    $UrlImg = "";

    $extension = strtolower(trim(strrchr($item->ARCHIVO, ".")));
    $extension = substr($extension, 1, strlen($extension));

    if ($extension == "pdf") {
        $UrlImg = BASE_URL . "tema/images/_page.png";

        if (file_exists("./tema/images/" . $extension . ".png")) {
            $UrlImg = BASE_URL . "tema/images/" . $extension . ".png";
        }
    } else if (is_array(getimagesize($location))) {
        $UrlImg = BASE_URL . "expediente/drive/" . $item->IDETIQUETA . "/" . $item->ARCHIVO;
    } else {

        $UrlImg = BASE_URL . "tema/images/_page.png";

        if (file_exists("./tema/images/" . $extension . ".png")) {
            $UrlImg = BASE_URL . "tema/images/" . $extension . ".png";
        }
    }
    ?>
    <div id="thumbnail_<?php echo $item->ID; ?>" class="thumbnail" align="center">
        <a href="#" onclick="InfoArchivo(<?php echo $item->ID; ?>);">
        <img src="<?php echo $UrlImg; ?>" width="100%" height="78%"></a>
        <span class="">
            <a href="#" onclick="InfoArchivo(<?php echo $item->ID; ?>);">
                <?php echo $item->ARCHIVO; ?>
            </a>
        </span><br>&nbsp;&nbsp;
    </div>
<?php } ?> 

<script>
    function InfoArchivo(Id) {

        $("#_infoacciones").html("Cargando...");

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>drive/Ajax_archivos_info",
            data: {Id: Id},
            cache: false,
            success: function (result) {
                $("#_infoacciones").html(result);
            }
        });
    }
</script>