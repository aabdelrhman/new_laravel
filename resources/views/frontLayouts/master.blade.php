<!DOCTYPE html>
<html lang="en">
	@include('frontLayouts.head')
<body class="home-page home-01 ">

    @include('frontLayouts.header')

	<main id="main">
		<div class="container">

			@yield('main')

		</div>

	</main>

	@include('frontLayouts.footer');
    @yield('js')
</body>
</html>
