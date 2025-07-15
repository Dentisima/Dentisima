<div class="bg-primary clearfix padder m-b">
    <h3 class="m-b" > 
        <?php echo $Info->ETIQUETA; ?> 
    </h3>
</div>
<div class="text-small padder">

    <div class="container" >
        <input type="file" name="file" id="file" multiple value="" style="display:none">
        <div class="upload-area"  id="uploadfile">
            <h1 id="_txtdrag">Arrastra y suelta los archivos<br/>o<br/>Selecciona los archivos</h1>
        </div>
    </div>

</div> 

<div id="lstfiles">

</div>

<style type="text/css">
    .container{
        width: 99%;

    }
    .upload-area{
        width: 99%;
        height: 200px;
        border: 2px dashed #e0e4e8;
        border-radius: 3px;
        margin: 0 auto;

        text-align: center;
        overflow: auto;
    }

    .upload-area:hover{
        cursor: pointer;
    }

    .upload-area h1{
        text-align: center;
        font-weight: normal;
        font-family: sans-serif;
        line-height: 50px;
        color: darkslategray;
    }

    /* Thumbnail */
    .thumbnail{
        width: 150px;
        height: 150px;
        padding: 2px;
        border: 2px solid lightgray;
        border-radius: 5px;
        float: left;
        margin: 15px;
        position: relative;
    }

    .thumbnail img{
        width: 100%;
        height: 80%;
        object-fit: cover;
    }

    .thumbnail span{
        position: absolute;
        width: 100%;
        bottom: 0;
        left: 0;
        z-index: 2;
    }


</style>

<script>
    $(function () {

        // preventing page from redirecting
        $("html").on("dragover", function (e) {
            e.preventDefault();
            e.stopPropagation();
            $("#_txtdrag").html("Soltar aquí los archivos");
        });

        $("html").on("drop", function (e) {
            e.preventDefault();
            e.stopPropagation();
        });

        // Drag enter
        $('.upload-area').on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("#_txtdrag").html("Soltar");
        });

        // Drag over
        $('.upload-area').on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("#_txtdrag").html("Soltar aquí los archivos");
        });

        // Drop
        $('.upload-area').on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();

            $("#_txtdrag").html("Subiendo archivos...");

            var files = e.originalEvent.dataTransfer.files;
            var fd = new FormData();

            fd.append("Id", <?php echo $Info->ID; ?>);
            fd.append("TotArchivos", files.length);

            for (i = 0; i < files.length; i++) {
                fd.append('archivo_' + i, files[i]);
            }

            uploadData(fd);
        });

        // Open file selector on div click
        $("#uploadfile").click(function () {
            $("#file").click();
        });

        // file selected
        $("#file").change(function () {

            $("#_txtdrag").html("Subiendo los archivos...");

            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append("Id", <?php echo $Info->ID; ?>);
            fd.append("TotArchivos", files.length);

            for (i = 0; i < files.length; i++) {
                fd.append('archivo_' + i, files[i]);
            }

            uploadData(fd);

        });
    });

// Sending AJAX request and upload file
    function uploadData(formdata) {

        $.ajax({
            url: '<?php echo BASE_URL(); ?>drive/Ajax_upload',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                alert(result);
                //addThumbnail(response);
                $("#_txtdrag").html("Arrastra y suelta los archivos<br/>o<br/>Selecciona los archivos");
                ArchivosLista();
            }, error: function (result) {
                $("#_txtdrag").html("Arrastra y suelta los archivos<br/>o<br/>Selecciona los archivos");
                ArchivosLista();
            }
        });
    }

    function ArchivosLista() {
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>drive/Ajax_archivos_lista",
            data: {Id: <?php echo $Info->ID; ?>},
            cache: false,
            success: function (result) {
                $("#lstfiles").html(result);
            }
        });
    }

    setTimeout(function () {
        ArchivosLista();
    }, 100);


    function convertSize(size) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (size == 0)
            return '0 Byte';
        var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
        return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

</script>