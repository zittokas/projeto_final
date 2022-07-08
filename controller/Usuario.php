<?php
    require "model/UsuarioModel.php";
    require 'model/CategoriaModel.php';
    require "controller/Controller.php";

    class Usuario extends Controller{
        
        function __construct(){
            session_start();
            if(!isset($_SESSION['usuario'])){
                header('Location: ?c=restrito&m=login');
            }
            $this->model = new UsuarioModel();
        }

        function index(){
            $usuarios = ($this->model->buscarTodos());
            include 'view/templete/cabecalho.php';
            include 'view/templete/menu.php';
            include 'view/usuario/listagem.php';
            include 'view/templete/rodape.php';
            
        }

        function add(){
            include 'view/templete/cabecalho.php';
            include 'view/templete/menu.php';
            include 'view/usuario/form.php';
            include 'view/templete/rodape.php';

        }

        function editar($id){
            $usuario = $this->model->buscarPorId($id);
            include 'view/templete/cabecalho.php';
            include 'view/templete/menu.php';
            include 'view/usuario/form.php';
            include 'view/templete/rodape.php';

        }

        function excluir($id){
          $this->model->excluir($id);  
          header('Location: ?c=usuario');
        }

        function salvar(){
            if(isset($_POST['login']) && !empty($_POST['login']) && !empty($_POST['senha'])){
                if(empty($_POST['idusuario'])){

                    if(!$this->model->buscarPorLogin($_POST['login'])){
                        $this->model->inserir($_POST['login'], password_hash($_POST['senha'], PASSWORD_BCRYPT));
                    }else{
                        echo "Já existe um usuário com esse Login cadastrado";
                        die();
                    }  
                }else{
                    $this->model->atualizar( $_POST['idusuario'], $_POST['login'], password_hash($_POST['senha'], PASSWORD_BCRYPT));
                }
                header('Location: ?c=usuario');
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