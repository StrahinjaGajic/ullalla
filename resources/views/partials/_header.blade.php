<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Ullallà | @yield('title')</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" type="images/png" href="img/icon1.png">
<link rel="stylesheet" href="{{ asset('css/formValidation.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/meanmenu.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/nivo-slider.css') }}">
<link rel="stylesheet" href="{{ asset('css/preview.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.bxslider.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ url('css/jquery-ui.css') }}">
@yield('styles')
<link href="/css/flag-icon.min.css" rel="stylesheet">
<script src="/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
	UPLOADCARE_LOCALE = '{{ app()->getLocale() }}';
	UPLOADCARE_LIVE = false;
	UPLOADCARE_CLEARABLE = true;
	UPLOADCARE_LOCALE_TRANSLATIONS = {
		buttons: {
			choose: {
				files: {
					one: '{{ __('buttons.upload_videos') }}'
				},
				images: {
					one: '{{ __('buttons.upload_photo') }}',
					other: '{{ __('buttons.upload_photos') }}'
				}
			}
		},
		// messages for widget
		errors: {
			'fileMaximumSize': '{{ __('validation.file_too_large') }}',
			'fileType': '{{ __('validation.file_type') }}',
			'minDimensions': '{{ __('validation.min_photo_dimensions') }}'
		},
		// messages for dialog’s error page
		dialog: {
			tabs: {
				preview: {
					error: {
						'fileMaximumSize': {
							title: '{{ __('validation.file_too_large_title') }}',
							text: '{{ __('validation.file_too_large') }}',
							back: '{{ __('buttons.back') }}'
						},
						'fileType': {
							title: '{{ __('validation.file_type_title') }}',
							text: '{{ __('validation.file_type') }}',
							back: '{{ __('buttons.back') }}'
						},
						'minDimensions': {
							title: '{{ __('validation.min_dimensions_title') }}',
							text: '{{ __('validation.min_photo_dimensions') }}',
							back: '{{ __('buttons.back') }}'
						}
					}
				}
			}
		},
	};
</script>
<script>UPLOADCARE_PUBLIC_KEY = "aeb2871347a8c70df675";</script>
<script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js" charset="utf-8"></script>