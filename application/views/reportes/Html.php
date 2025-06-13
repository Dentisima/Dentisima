<html>
    <head>
        <meta charset="utf-8">
        <title> </title>
        <style type="text/css">
            .tabla {
                font:10px Verdana,Arial; color:#091f30; 
                font:10px Verdana,Arial; color:#091f30; 

            }

            .head{
                background-color: #ccc;
                color:#000; 
                border:0px solid #fff; 
                border-right:none;
                font:bold;
            }
        </style>
    </head>
    <body topmargin="0" leftmargin="0">
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tabla">
            <!-- Encabezado -->

            <tr> 
                <td height="40" colspan="<?php echo (count($Header) + 1); ?>">
                    <div align="center">
                        <strong>
                            <?php
                            echo $TITULO;
                            echo "  " . $this->fechas->fecha(1) . " " . $this->fechas->fecha(3);
                            ?>
                        </strong>
                    </div>
                </td>

            </tr> 
            <tr>
                <td class="head" height="40"><div align="center"><strong>#</strong></div></td>
                <?php for ($i = 0; $i < count($Header); $i++) { ?>
                    <td height="26"class="head"><div align="center"><strong><?php echo $Header[$i]["NAME"]; ?></strong></div></td>
                            <?php } ?>
            </tr>

            <?php
            $COLOR = "#FFFFFF";
            $Fila = 0;

            $RsLista = $Rs->result_array();

            foreach ($Rs->result_array() as $row) {

                $Fila++;
                ?>
                <tr bgcolor="<?php echo $COLOR; ?>">
                    <td><div align="center"><?php echo $Fila; ?></div></td>
                    <?php
                    $Col = 0;
                    foreach ($row as $key => $val) {

                        $Signo = substr($key, 0, 1);

                        
                            if ($Signo == "$") {
                                $Header[$Col]["SALDO"] = $Header[$Col]["SALDO"] + doubleval($val);
                            }
                        
                        ?>
                        <td>
                            <div align="<?php if($Signo=="$"){ echo "right";} ?>">
                            <?php 
                            if($Signo=="$"){
                                echo "$".number_format(doubleval($val),2,'.',','); 
                            }else{
                                echo trim($val); 
                            }
                            
                            ?>
                            </div>
                        </td>
                        <?php
                        $Col++;
                    }
                    ?>
                </tr>
                    <?php
                    if ($COLOR == "#E9E9E9") {
                        $COLOR = "#FFFFFF";
                    } else {
                        $COLOR = "#E9E9E9";
                    }
                }
                ?>
                <tr>
            <?php for ($i = 0; $i < count($Header) + 1; $i++) { ?>
                    <td><hr></td>
            <?php } ?>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <?php for ($i = 0; $i < count($Header); $i++) { ?>
                <td><div align='center'>
                    <?php if ($Header[$i]["SALDO"] > 0) {
                        echo "$" . number_format($Header[$i]["SALDO"], 2, '.', ',');
                    } ?>
                   </div> </td>
                <?php } ?>
            </tr>
        </table>
    </body>
</html>