@php
$config = [
	'appName' => config('app.name'),
	'locale' => $locale = app()->getLocale(),
	'locales' => config('app.locales'),
	'githubAuth' => config('services.github.client_id'),
];

$bg = array('/img/bg_rural_barns.png', '/img/bg_rural_sunflowers.png', '/img/bg_rural_pond.png' ); // array of filenames

$i = rand(0, count($bg)-1); // generate random number size of the array
$selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>{{ config('app.name') }}</title>
	
	

	<link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">

	<style type="text/css">
		body{
			background-image: url(<?php echo $selectedBg; ?>);
		}
	</style>

	<!-- FAVICONS -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#111111">
	<meta name="msapplication-TileColor" content="#111111">
	<meta name="theme-color" content="#111111">
	<!-- <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff"> -->
</head>
<body id="body">
	<div id="app"></div>

	{{-- Global configuration object --}}
	<script>
		window.config = @json($config);
	</script>

	{{-- Load the application scripts --}}
	<script src="{{ mix('dist/js/app.js') }}"></script>
</body>
</html>
