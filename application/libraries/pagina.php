<?php

Class Pagina {

    private $page; //Pagina actual
    private $from; //Numero de registro desde donde iniciar la busqueda
    private $quantity; //Catidad de registros por pagina
    private $totalRows; //Total de registros a paginar
    private $numPages; //Numero total de paginas
    private $puri; //Parte de la uri a agregar a la url inicial
    private $datos;

    function PasaDatos($quantity, $page) {

        //Validamos la entrada de datos
        settype($page, "integer");
        settype($quantity, "integer");
        $this->page = ($page > 0) ? $page : 0;
        $this->quantity = ($quantity > 0) ? $quantity : 0;
        $this->from = $page * $quantity;
    }

    function getFrom() {
        return $this->from;
    }

    function generaPaginacion($totalRows, $url, $FPage = "") {

        settype($totalRows, "integer");
        $this->totalRows = $totalRows;

        $url = preg_replace('[\&*\&]', '&', $url); //Quita las && = & repetidas
        $url = preg_replace('[\?\&]', '?', $url); //Quita 	?& = ?


        $this->numPages = ceil($totalRows / $this->quantity);

        if ($this->page > 0) {
            $this->puri = $this->page - 1;
            
            if($FPage!=""){
                $this->datos .= "<li class='page-item '><a class='page-link' href='javascript:void(0);' onclick='".$FPage."(".$this->puri.")' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
            }else{
                $this->datos .= "<li class='page-item '><a class='page-link' href='". $url . $this->puri ."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
            }
            
        }

        if ($this->numPages > 1) {
            for ($i = 0; $i < $this->numPages; $i++) {
                if ($i == $this->page) {
                   
                   $this->datos .= "<li class='page-item active'><a class='page-link'>" . ($i + 1) . "</a></li>";
                           

                } elseif ($i == $this->page + 1 || $i == $this->page + 2 || $i == $this->page + 3 || $i == $this->page + 4 || $i == $this->page + 5 || $i == $this->page + 6 || $i == $this->page + 7 || $i == $this->page - 1 || $i == $this->page - 2 || $i == $this->page - 3 || $i == $this->page - 4 || $i == $this->page - 5 || $i == $this->page - 6 || $i == $this->page - 7 || $i == 0 || $i == ($this->numPages - 1)) {

                    //$page + 1, $page +2 son los numeros que se desea ver por delante del actual
                    //$page -1, $page -2 son los numeros (Links) a ver por detras del actual
                    //Esto se puede modificar como se desee
                    
                    if($FPage!=""){
                        $this->datos .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='".$FPage."(".$i.")' >" . ($i + 1) . "</a></li>";
                    }else{
                        $this->datos .= "<li class='page-item'><a class='page-link' href='" . $url . $i . "' >" . ($i + 1) . "</a></li>";
                    }
                    
                   
                            
                } elseif ($i == $this->page - 5) {
                    
                  $this->datos .= "<li class='page-item' ><a class='page-link'>...</a></li>";
                      
                    
                } elseif ($i == $this->page + 5) {
                   
                   $this->datos .= "<li class='page-item'><a class='page-link'>...</a></li>";
                    
                }
            }
        }


        if ($this->page < $this->numPages - 1) {
            $this->puri = $this->page + 1;
            
            if($FPage!=""){
                $this->datos .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='".$FPage."(".$this->puri.")' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
            }else{
                $this->datos .= "<li class='page-item'><a class='page-link' href='" . $url . $this->puri . "' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
            }
               
        }

        return $this->datos;
    }

}
