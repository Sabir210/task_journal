<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Справочник</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">
        <link href="/template/css/responsive.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <style>
            .search-button {
                border: none;
                background-color: transparent;
                padding: 0;
                margin-left: -30px; /* Adjust this value as needed to align the button with the input field */
                cursor: pointer;
            }

            .search-button:focus {
                outline: none;
            }

            .custom-select {
                display: inline-block;
                position: relative;
                width: 200px;
                height: 30px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 10px;
                margin-bottom: 20px;
                overflow: hidden;
                font-family: Arial, sans-serif;
            }

            .custom-select select {
                width: 100%;
                height: 100%;
                padding: 5px;
                outline: none;
                border: none;
                font-size: 14px;
                color: #333;
                background-color: transparent;
                appearance: none;
            }

            .custom-select::after {
                content: '\25BC';
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
                font-size: 12px;
                color: #666;
                pointer-events: none;
            }
        </style>
    </head><!--/head-->

    <body>
        <div class="page-wrapper">

            <header id="header"><!--header-->

