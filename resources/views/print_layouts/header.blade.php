<!DOCTYPE html>
<html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ "Multi Product Inventory"}}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('media/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Admin_asset/print/bootstrap.min.css') }}">
    <script src="{{ asset('Admin_asset/print/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Admin_asset/print/jquery.min.js') }}"></script>

</head>
<body>
