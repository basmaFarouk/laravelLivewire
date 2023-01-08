<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel-Livewire</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    @livewireStyles
    @livewireScripts
    @vite('resources/css/app.css')
</head>
<body class="flex justify-center">
{{-- @livewire('comment',['comments'=>$comments]) --}}
{{-- <livewire:comment :intialComments="$comments" /> --}}
<div class="w-10/12 my-10 flex">
    <div class="w-5/12 rounded border p-2">
        @livewire('tickets')
    </div>

    <div class="w-7/12 mx-2 rounded border p-2">
        @livewire('comment')
    </div>

</div>

</body>
</html>
