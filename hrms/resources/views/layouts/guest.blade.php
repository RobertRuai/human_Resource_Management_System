<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
    <style>
        /*
        .back-container {
            background: #f3f4f6;
            font-size: 13px
        }
        .back-btn button {
            background-color: #fff;
            padding: 3px 15px; 
            font-weight: bold;
            border: 0.2px solid #d1d1d1;
            margin: 15px
        }
        .back-btn button:hover {
            background-color: #f1f1f1;
        }
            */
    
        .guest img {
            height: 80px;
            border-radius: 100px;
            padding-left: 160px
        }
        .guest-title {
            color: #000;
            font-weight: bold;
            padding-top: 10px;
            text-align: center
        }
        .guest-form input {
            border-radius: 0;
            padding: 5px 0 5px 10px
        }
        .guest-form-btn {
            background-color: #004080;
            border-radius: 0;
        }
        .guest-form-btn:hover {
            background-color: #007bff;
        }
        .sign-in h6 {
            font-size: 20px;
            color: #000;
            font-weight: bold;
        }
        .sign-in p {
            color: #606060;
            font-size: 13px;
            margin-bottom: 20px;
            font-size: 500
        }
    </style>
        <!--
        <div class="back-container">
            <div class="back-btn">
                <button>Back</button>
            </div>
        </div> -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="w-80 sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden ">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
