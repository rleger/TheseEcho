<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/all.css') }}">
    <title>@yield('page_title', 'Questionnaire')</title>
    <!-- Dirty fix For IE 9 -->
    <!‐‐[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <![endif]‐‐>
</head>
<body>
  @yield('before-container')
  <div class="container col-sm-10 col-sm-offset-1 clearfix">
    <div class="row">
      <!-- Content -->
      @yield('content')
  </div>

  <div class="row">
      <!-- Footer -->
      @include('layouts.partials.footer')
  </div>
</div>
<script src="{{ elixir('js/all.js') }}"></script>

<!-- Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57682646-1', 'auto');
  ga('send', 'pageview');
</script>
</body>
</html>
