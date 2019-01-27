<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=11" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="robots" content="all,follow" />
	<link href="//cdn.componentator.com/spa.min@16.css" rel="stylesheet" />
	<script src="//cdn.componentator.com/spa.min@16.js"></script>
	<script src="//cdn.componentator.com/openplatform.min@3.js"></script>

	<link href="/public/css/default.css" rel="stylesheet" />
	<link href="/public/css/ui.css" rel="stylesheet" />
	<script src="/public/js/default.js"></script>
	<script src="/public/js/ui.js"></script>
</head>
<body data-jc="exec" data-bind="common.ready__invisible:!value" class="invisible">

	<div class="mainmenu">
		<div class="scroller">
			<div data-jc="navigation__common.page__datasource:common.cl.navigation;autoselect:true"></div>
		</div>
	</div>

	<div class="body">
		<div data-jc="part__common.page__if:users;url:/public/parts/users.html;reload:users/reload" class="hidden"></div>
		<div data-jc="part__common.page__if:settings;url:/public/parts/settings.html;reload:settings/reload" class="hidden"></div>
	</div>

	<script type="application/json" id="userdata"><?php echo json_encode($user); ?></script>

	<script>

		var user = PARSE('#userdata');

		MAKE('common', function(obj) {
			obj.page = '';

			// Codelists
			obj.cl = {};
			obj.cl.navigation = [{ id: 'users', name: 'Users', title: 'List of users', icon: 'users' }, { name: 'Directory', children: [{ id: 'settings', name: 'Settings', icon: 'cog' }] }];
		});

		OP.appearance();

		// Adds auth-token to each request
		ON('request', function(options) {
			if (options.url.indexOf('.') === -1)
				options.url = OP.tokenizator(options.url);
		});

		PLUGIN('main', function(exports) {

		});

		// Hides menu
		WATCH('common.page', function() {
			$('.mainmenu').rclass('mainmenu-visible');
		});

	</script>

</body>
</html>