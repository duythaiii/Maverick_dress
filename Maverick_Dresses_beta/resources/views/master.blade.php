<!DOCTYPE html>
<html lang="en">
	<head>
		@include('blockadmin.head')
	</head>
	<body>
		<div x-data="setup()" x-init="$refs.loading.classList.add('hidden'); setColors(color);" :class="{ 'dark': isDark}">
			<div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
				<!-- Loading screen -->
				<div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker">
						Loadding.....
				</div>

				<!-- Sidebar -->
				@include('blockadmin.sidebar')

				<div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
					<!-- Navbar -->
					@include('blockadmin.navbar')

					<!-- Main content -->
					<main>
						@yield('content')
					</main>
				</div>

				<!-- Panels -->

				<!-- Settings Panel -->
				<!-- Backdrop -->
				@include('blockadmin.settingbackdrop')
				<!-- Panel -->
				@include('blockadmin.settingpanel')

				<!-- Notification panel -->
				<!-- Backdrop -->
				@include('blockadmin.notebackdrop')
				<!-- Panel -->
				@include('blockadmin.notepanel')

				<!-- Search panel -->
				<!-- Backdrop -->
				@include('blockadmin.searchbackdrop')
				<!-- Panel -->
				@include('blockadmin.searchpanel')
			</div>
		</div>

		<!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
		@include('blockadmin.alljs')
	</body>
</html>
