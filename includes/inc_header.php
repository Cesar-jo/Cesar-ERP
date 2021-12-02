<!DOCTYPE html>
<html lang="es">
<head>
  <base href="<?php echo BASEPATH; ?>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo (isset($data['title']) ? $data['title'] : 'Bienvenido').' - '.COMPANY_NAME; ?></title>

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo CSS.'bootstrap.min.css' ?>">

  <!-- Font awesome 5 -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

  <!-- waitMe -->
  <link rel="stylesheet" href="assets/plugins/waitMe/waitMe.min.css">

  <!-- Toastr  este es el css de nuestras notificaciones personalizadas-->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>