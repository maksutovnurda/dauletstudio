<?php include 'libs.php'; ?>
<!doctype html>
<html lang="kk" prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="theme-color" content="#323335">
		<meta http-equiv="Content-Language" content="kk">
		<title>Бет табылмады!</title>
		<base <?php echo "href='{$base}'"; ?>>
		
		<meta name="robots" content="noindex">
		<!-- Links -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<script src="js/script.js"></script>
	</head>
	<body>
		<?php getMenu() ?>
		<div class="body">
			<div class="advert left"></div>
			<div class="site right">
				<div class="sidebar"><?php getSidebar() ?></div>
				<div class="continer">
						<div class="error404">
							<p>Қате!</p>
							<span><a href="index.php">Басты бетке өту</a></span>

						<div class="w100p jcc df"><span style='font-family: Arial; text-align:center; opacity: 0.4; font-size: 14px; margin: 5px; color: #000000;'>Бұл бет өшірілген немесе мүлде жоқ</span></div>
						</div>
				</div>
			</div>
			<div class="advert left"></div>
		</div>
		<?php getFooter() ?>
		<script src="js/script.js"></script>
	</body>
</html>	
