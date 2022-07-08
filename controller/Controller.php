<?php
    class Controller{

        public function load_template($url_view, $categorias){
            include "view/templete/cabecalho.php";
            include "view/templete/menu.php";
            include "view/$url_view";
            include "view/templete/rodape.php";
        }
    }
?>