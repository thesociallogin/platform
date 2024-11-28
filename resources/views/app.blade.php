<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <title>{{ config('app.name') }} - Authentication as a service</title>
  <link rel="stylesheet" href="https://api.fontshare.com/css?f%5B%5D=switzer@400,500,600,700&amp;display=swap"/>

  @viteReactRefresh
  @vite(['resources/js/app.jsx', "resources/js/pages/{$page['component']}.jsx"])
  @inertiaHead
    @googlefonts
</head>

<body class="text-gray-950 antialiased">
  @inertia
</body>

</html>
