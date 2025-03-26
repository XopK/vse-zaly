<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Аренда залов в Уфе</title>
    <!-- Stylesheets -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <!-- Responsive File -->
    <link href="/css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">

    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="js/respond.js"></script><![endif]-->
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="page-wrapper text-center p-5 mt-0">
    <h1 class="text-danger display-1">500</h1>
    <p class="text-muted fs-5">Ошибка сервера. Попробуйте зайти позже.</p>
    @php
        $previousUrl = url()->previous();
        $currentUrl = url()->current();
        $redirectUrl = $previousUrl === $currentUrl ? url('/') : $previousUrl;
    @endphp
    <a href="{{ $redirectUrl }}" class="theme-btn btn-style-one"><span
            class="btn-title">Назад</span></a>
</div>

<script src="/js/jquery.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/jquery.fancybox.js"></script>
<script src="/js/owl.js"></script>
<script src="/js/scrollbar.js"></script>
<script src="/js/appear.js"></script>
<script src="/js/wow.js"></script>
<script src="/js/custom-script.js"></script>

</body>
</html>
