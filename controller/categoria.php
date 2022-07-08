<?php
    require "model/CategoriaModel.php";
    require "controller/Controller.php";

    class Categoria extends Controller{
        
        function __construct(){
            session_start();
            if(!isset($_SESSION['usuario'])){
                header('Location: ?c=restrito&m=login');
            }
            $this->model = new CategoriaModel();
        }

        function index(){
            $categorias = ($this->model->buscarTodos());
            $this->load_template("categoria/listagem.php", $categorias);
            
        }

        function add(){
            include 'view/templete/cabecalho.php';
            include 'view/templete/menu.php';
            include 'view/categoria/form.php';
            include 'view/templete/rodape.php';

        }

        function editar($id){
            $categoria = $this->model->buscarPorId($id);
            include 'view/templete/cabecalho.php';
            include 'view/templete/menu.php';
            include 'view/categoria/form.php';
            include 'view/templete/rodape.php';

        }

        function excluir($id){
          $this->model->excluir($id);  
          header('Location: ?c=categoria');
        }

        function salvar(){
            if(isset($_POST['categoria']) && !empty($_POST['categoria'])){
                if(empty($_POST['idcategoria'])){
                    $this->model->inserir($_POST['categoria']);
                }else{
                    $this->model->atualizar( $_POST['categoria'], $_POST['idcategoria']);
                }
                header('Location: ?c=categoria');
            }else{
                echo "Ocorreu um erro, pois os dados não foram enviados!";
            }
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