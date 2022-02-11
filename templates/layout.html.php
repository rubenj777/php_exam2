<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Framework - <?= $pageTitle ?></title>
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
    <link rel="stylesheet" href="templates/style.css">
</head>

<body>

<nav class="navbar nav-expand-lg navbar-light bg-dark mb-5 justify-content-between">
    <a href="/phpExam2" class="navbar-brand ms-5" id="logo">php exam 2</a>
    <div>
    </div>
</nav>


<div class="container">
    <?= $pageContent ?>
</div>



</body>

</html>