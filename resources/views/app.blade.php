<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @inertiaHead

    @routes

    @vite(['resources/css/app.css','resources/js/app.js'])
    
</head>
<body class="bg-isdoc-950 text-isdoc-400 dark:bg-isdoc-200 dark:text-isdoc-950">
   <h1>Header 1</h1>
   <h2>Header 2</h2>
   <h3>Header 3</h3>
   <h4>Header 4</h4>
   <h5>Header 5</h5>
   <h6>Header 6</h6>
   <h1 class="text-ispink">Header 1</h1>
   <h1 class="text-isorange">Header 1</h1>
   <h1 class="text-isyellow">Header 1</h1>
   
    @inertia
</body>
</html>