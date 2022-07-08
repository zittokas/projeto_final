<?php
    require "model/CategoriaModel.php";
    require "model/ProdutoModel.php";
    require "controller/Controller.php";

    class Home extends Controller{
        
        function __construct(){
            $this->categoria = new CategoriaModel();
            $this->produto = new ProdutoModel();
        }

        function index($id = null){
            $categorias = $this->categoria->buscarTodos();
            if(!$id){
                $produtos = $this->produto->buscarTodos();
            }else{
                $produtos = $this->produto->buscarPorCategoria($id);
            }
            include 'view/templete/cabecalho.php';
            include 'view/templete/menu_home.php';
            include 'view/home/listagem.php';
            include 'view/templete/rodape.php';
            
        }

        function ver($id){
            $categorias = $this->categoria->buscarTodos();
            $produto = $this->produto->buscarPorId($id);
            include 'view/templete/cabecalho.php';
            include 'view/templete/menu_home.php';
            include 'view/home/ver.php';
            include 'view/templete/rodape.php';
        }

        function search(){
            $categorias = $this->categoria->buscarTodos();
            $produtos = $this->produto->buscarPorLikeNome($_POST['search']);
            
            include 'view/templete/cabecalho.php';
            include 'view/templete/menu_home.php';
            include 'view/home/listagem.php';
            include 'view/templete/rodape.php';
        }
    }

    //$controller = new Categoria();
    //$controller->index();

    //$model = new CategoriaModel();
    //$model->inserir("Produto de Limpeza");
    //$model->excluir(2);
    //$model->atualizar("Smartphone", 3);
    //var_dump($model->buscarPorId(3));

?>