<?php include 'libs.php'; 
if (admin()) { header("Location: admin.php"); }
?>
<!doctype html>
<html lang="kk" prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="theme-color" content="#323335">
		<meta http-equiv="Content-Language" content="kk">
		<title>Кіру - Daulet Studio</title>
		<base <?php echo "href='{$base}'"; ?>>		
		<meta name="robots" content="index, follow">	
			
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
						<div class="signin" id="signin1">
							<div class="w300">	
								<p>Кіру</p>
								<input type="text" id="login" placeholder="Логин" class="sign">
								<input type="password" id="log-pass" placeholder="Пароль" class="sign">
								<input type="button" onclick="login()" class="sign-btn" value="Кіру">
								<span onclick="resetpass()" class="change">Паролды қайтару</span>
								<div class="w300" id="erroflogin"></div>
							</div>
						</div>
						<div class="signin" id="signin2">
							<div class="w300">
								<p>Пароль өзгерту</p>
								<input type="text" placeholder="Логин" class="sign">
								<input type="text" placeholder="email" class="sign">
								<input type="button" placeholder="password" class="sign-btn" value="Жіберу">
								<span onclick="resetpass()" class="change">Кіру</span>
								<div class="error">
									<span class="err">Сіз бұрынғы парольды ұмыттыңыз енді кіре алмайсыз</span>
								</div>
							</div>
						</div>
				</div>
			</div>
			<div class="advert left"></div>
		</div>
		<?php getFooter() ?>
		<script src="js/script.js"></script>
	</body>
</html>	
