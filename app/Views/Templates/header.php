<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASMINFO - <?= $title ?></title>
    <link rel="stylesheet" href='<?= base_url();?>assets/css/style.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel='icon' type="image/x-icon" href='assets/img/logo/logo.svg'>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<script src="<?= base_url();?>assets\javascript\index.js"></script>
</head>
<body>
<header class="index-bar">

        <a href='<?= base_url('Accueil');?>' class="logo"><img src='<?= base_url();?>assets\img\logo\logo.svg' id='logo'></a>
        <nav class='desktop-bar'>
            <ul class="desktop-bar">
               <li><a href='<?= base_url('Accueil');?>'><span class='bold underline'>ACCUEIL</span></a></li>
                <li><a href='<?= base_url('Histoire');?>'>NOTRE HISTOIRE</a></li>
                <li><a href='<?= base_url('Services');?>'>NOS SERVICES</a></li>
                <li><a href='<?= base_url('Contact');?>'>NOUS CONTACTER</a></li>
                <li class="dropdown">
                    <a   href="<?= base_url('Authentification');?>"><button>EXTRANET CLIENT </button></a>
                </li>
            </ul>
        </nav>
        <button class='mobile-button'><span class="material-symbols-outlined md-43">
            menu
            </span></button>
        <nav class="mobile-bar">
            <ul>
                <li><a href='<?= base_url('Accueil');?>'><span class='bold underline'>ACCUEIL</span></a></li>
                <li><a href='<?= base_url('Histoire');?>'>NOTRE HISTOIRE</a></li>
                <li><a href='<?= base_url('Services');?>'>NOS SERVICES</a></li>
                <li><a href='<?= base_url('Contact');?>'>NOUS CONTACTER</a></li>
                <li class="dropdown">
                    <a class="btn-nav" href="<?= base_url('Authentification');?>">EXTRANET CLIENT</a>
                </li>
            </ul>
        </nav>
    </header>