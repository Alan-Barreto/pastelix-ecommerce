
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
    <div class="admin__layout">
        <?php 
            include_once __DIR__ . '/templates/adminHeader.php';
            include_once __DIR__ . '/templates/adminSidebar.php';
            echo $contenido;
        ?>
    </div>    
     <script src="/build/js/main.js" defer></script> 
</body>
</html>