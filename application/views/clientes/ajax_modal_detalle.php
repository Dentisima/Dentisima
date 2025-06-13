<div class="modal-header">
    <h6 class="modal-title">
        <?php echo $Info->NOMBRE_COMPLETO ." ". $Info->FOLIO_CLIENTE ." ".$Info->ABR_SEXO."-".$Info->EDAD;?>
        <br><code class="highlighter-rouge">[Alergias....]</code>
    </h6>
    
    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-3 col-lg-12 d-none d-xl-block  ">
            
                
                <div class="card custom-card our-team">
                    <div class="card-body">
                        <div class="   text-center">
                            <img alt="<?php echo $Info->NOMBRE_COMPLETO;?>" class="rounded-circle" src="<?php echo BASE_URL; ?>tema/images/<?php echo $Info->SEXO; ?>.png">
                        </div>

                        <table class="table mg-b-0"> 
                            <tbody>
                                <tr>
                                    <th>Edad:</th>
                                    <td><?php echo $Info->EDAD;?> años</td>
                                </tr> 
                                <tr>
                                    <th>Fecha Nac.:</th>
                                    <td><?php echo $Info->FNACIO2;?></td>
                                </tr> 
                                <tr>
                                    <th>Cumpleaños:</th>
                                    <td>Faltan <?php echo $Info->DIAS;?> días</td>
                                </tr> 
                                <tr>
                                    <th>Sexo:</th>
                                    <td><?php echo $Info->SEXO;?></td>
                                </tr> 
                                <tr>
                                    <th>Teléfono:</th>
                                    <td><?php echo $Info->WHATSAPP;?></td>
                                </tr> 
                                <tr>
                                    <th>Tratamientos:</th>
                                    <td></td>
                                </tr> 
                                
                            </tbody>
                        </table>     
                    </div>
                </div>
                 <div class="card custom-card our-team">
                     <div class="card-body">
                         <button class="btn ripple btn-warning btn-rounded btn-block">Estado de cuenta</button>
                     </div>
                 </div>
                <div class="card custom-card our-team">
                    <div class="card-body"> 

                        <table class="table mg-b-0"> 
                            <tbody>
                                <tr>
                                    <th>Upline nombre:</th>
                                    <td><?php echo $Info->UP_NOMBRE;?></td>
                                </tr> 
                                <tr>
                                    <th>Upline clave:</th>
                                    <td><?php echo $Info->UP_CODIGO;?></td>
                                </tr> 
                                <tr>
                                    <th>Personas invitadas:</th>
                                    <td><?php echo $Info->INVITADOS;?></td>
                                </tr> 
                                <tr>
                                    <th>Ganancias:</th>
                                    <td>$0.00</td>
                                </tr>  
                                
                            </tbody>
                        </table><br>
                        <button class="btn ripple btn-light btn-rounded btn-block">Ver detalle de comisiones</button>
                    </div>
                </div>
            
        </div>
        <div class="col-xl-9 col-lg-12"> 
            <div class="card-body">

                <div class="table-responsive">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <h6 class="card-title mb-1">ESTADO DE CUENTA</h6>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <div class="dataTables_length" id="example2_length">
                                    <label>
                                        <select name="example2_length"  
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="">Último mes</option>

                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <a class="btn  btn-success" href="#"><i class="fe fe-external-link"></i> Exportar</a>
                            </div>
                        </div>
                        <div class="row"><div class="col-sm-12">
                                <table class="table dataTable no-footer dtr-inline collapsed"  >
                                    <thead>
                                        <tr role="row">
                                            <th>Fecha</th>
                                            <th>Tratamiento</th>
                                            <th>N° Pago</th>
                                            <th>Por Pagar</th>
                                            <th>Pagado</th>
                                            <th>Forma de Pago</th>
                                            <th>Referencia</th>
                                            <th>Notas</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>