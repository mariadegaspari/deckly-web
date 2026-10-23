<?php 
#INICIANDO UMA SESSÃO#
 if(!isset($_SESSION))
  {
    session_start();
  }
  
  #VEFIRICANDO SE O USUÁRIO LOGADO É ADMIN#
  if($_SESSION['TYPE'] != '1')
    {
      $_SESSION['naoAdm'] = "Apenas usuários administradores podem acessar essa área!";
      header('Location: ../Admin.php');
    }

?>