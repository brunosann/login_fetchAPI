<?php
session_start();

try {
  $pdo = new PDO('mysql:dbname=login_fetch', 'root', '');
} catch(PDOException $e) {
  echo "Error".$e->getMessage();
}

if(!empty($_POST['name']) && !empty($_POST['pass'])) {
  $user = addslashes($_POST['name']);
  $pass = md5(addslashes($_POST['pass']));

  $sql = $pdo->prepare('SELECT * FROM usuarios WHERE nome=:nome AND senha=:senha');
  $sql->bindValue(':nome', $user);
  $sql->bindValue(':senha', $pass);
  $sql->execute();

  if($sql->rowCount() > 0) {
    $dados = $sql->fetch();
    $_SESSION['nome'] = $dados['nome'];

    echo json_encode($dados['nome']);
  } else {
    $errorDados = [
      'key' => 'error',
      'msg' => 'Dados errados!!!'
    ];
    echo json_encode($errorDados);
  }
} else {
  $errorCampos = [
    'key' => 'error',
    'msg' => 'Preencha os campos!!!'
  ];
  echo json_encode($errorCampos);
}