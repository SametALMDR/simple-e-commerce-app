<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sayfa</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/iziToast.min.css">
    <link rel="stylesheet" href="public/css/main.css">

    <!-- Scripts -->
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/iziToast.min.js"></script>
</head>
<body>

<div class="step">
    <i class="bi bi-layers-half left-50"></i>
    <h4><?=$app->getAppName();?> <span class="badge bg-secondary"><?=$app->getAppVersion();?></span></h4>
    <p><?=$app->getAppDescription();?></p>
    <i class="bi bi-layers-half"></i>
</div>

