<?php
    require "model/CategoriaModel.php";
    require "model/ProdutoModel.php";
    require "controller/Controller.php";
    require "model/UsuarioModel.php";

    class Restrito extends Controller{
        
        function __construct(){
            $this->usuario = new UsuarioModel();
        }

        function login($id){
           
            include 'view/templete/cabecalho.php';
            include 'view/restrito/form.php';
            include 'view/templete/rodape.php';
        }

        function entrar(){
            if(isset($_POST['login']) && isset($_POST['senha'])){
                $usuario = $this->usuario->buscarPorLogin($_POST['login']);
                if(password_verify($_POST['senha'], $usuario['senha'])){
                    session_start();
                    $_SESSION['usuario'] = $usuario['login'];
                    header('Location: ?c=categoria');
                }else{
                    header('Location: ?c=restrito&m=login');
                }
            }
        }

        function logout(){
            session_start();
            unset($_SESSION['usuario']);
            session_destroy();
            header('Location: ?c=restrito&m=login');

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