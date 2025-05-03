<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>

    <link rel="stylesheet" href="/build/css/style.css">
    <link rel="icon" href="/build/img/pastelix-icon.ico" type="image/x-icon">
</head>
<body>
    <?php 
        
        include_once __DIR__ . '/templates/header.php';
        echo $contenido;
        include_once __DIR__ . '/templates/footer.php';
    ?>
    
     <script src="/build/js/main.js" defer></script> 
</body>
</html>