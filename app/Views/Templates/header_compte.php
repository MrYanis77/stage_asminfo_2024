<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASMINFO - <?= $title ?></title>
    <link rel="stylesheet" href='<?= base_url();?>assets/css/style.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel='icon' type="image/x-icon" href='<?= base_url();?>assets/img/logo/logo.svg'>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<script src="<?= base_url();?>assets\javascript\index.js"></script>
</head>
<body>
<header class="black">

        <a  class="logo"><img src='<?= base_url();?>assets\img\logo\logo.svg' id='logo'></a>
        <nav class='desktop-bar'>
            <ul class="desktop-bar">
                <li><a href='<?= base_url('Compte/Article');?>'><span class='bold underline'>Article</span></a></li>
                    <li class="dropdown">
                    <button>Compte</button>
                        <div class="dropdown-content">
                            <a href="<?= base_url('Compte/paramètre');?>">Mon Compte</a>
                            <a href="<?= base_url('Compte/deconnexion');?>">Déconnexion</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <button class='mobile-button'><span class="material-symbols-outlined md-43">
            menu
            </span></button>
        <nav class="mobile-bar">
            <ul>
                <li class="dropdown">
                    <button class="btn-nav">EXTRANET CLIENT</button>
                    <div class="dropdown-content">
                        <div class="sub-menu">
                            <a href="<?= base_url('Compte/paramètre');?>">Mon Compte</a>
                            <a href="<?= base_url('Compte/deconnexion');?>">Déconnexion</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <body>