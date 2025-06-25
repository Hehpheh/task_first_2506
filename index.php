<?php

 $pdo = new PDO('sqlite:main');


$code="";
$error='';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-link"])){
 if( empty($_POST["url"])) {
     $error='Строка не должна быть пустой';
 }else{
     $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);

     $code=bin2hex(random_bytes(5));;

     $sql=$pdo->prepare("INSERT INTO links(url, code) VALUES(:url, :code)");
     $sql->bindParam(':url', $url);
     $sql->bindParam(':code', $code);
     $sql->execute();

 }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="">
<div class="container py-5">
    <div class="col-8">
        <form class="" method="post">
            <h2 class="text-center my-3">Введите ссылку</h2>
            <div class="d-flex justify-content-center">
                <input type="text" class="form-control me-3" name="url">
                <button type="submit" class="btn btn-primary" name="btn-link">Отправить</button>
            </div>
        </form>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
        <?php endif; ?>


        <?php if(!empty($_POST['url'])): ?>
            <div class="mt-3">
                <h3>Результат:</h3>
                <a href="<?php echo $_POST['url']; ?>" class="success"><?php echo $code; ?></a>
            </div>
        <?php endif; ?>
    </div>

    <div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>