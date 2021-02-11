<?php include 'libs.php'; 
if (!admin()) { header("Location: 404.php"); }
?>
<!doctype html>
<html lang="kk" prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="theme-color" content="#323335">
		<meta http-equiv="Content-Language" content="kk">
		<title>Админ панель - Daulet Studio</title>
		<base <?php echo "href='{$base}'"; ?>>
		
		<meta name="robots" content="noindex">
		<!-- Links -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<script src="js/script.js"></script>
	</head>
	<body onload="getOrder(); getStats(); getStatistics(); getStatistics2(); get10(); hashes();">
		<div class="menu__1">
		<?php getMenu(); ?>
		</div>
		<div class="body">
			<input type="hidden">
			<div class="advert left"></div>
			<div class="site right">
				<div class="sidebar"><?php getSidebar() ?></div>
				<div class="continer">
					<div class="admin">
						<p onclick="shownext('stat1')" class="shownext">Статистика</p>
						<div style="display: none;" id="stat1"></div>

						<p onclick="shownext('stat2')" class="shownext">Статистика - <b>толық</b></p>
						<div style="display: none;" id="stat2"></div>
						
						<p onclick="shownext('stat3')" class="shownext">Топ <b>10</b> Жазба</p>
						<div style="display: none;" id="stat3">
							<div class="statistic" id="top10"></div>
						</div>

						<p onclick="shownext('stat4')" class="shownext">Жаңа админ тіркеу</p>
						<div style="display: none;" id="stat4" class="dfjcc">
							<div class="register">
								<input type="email" placeholder="email" class="newuser" id="new-email">
								<input type="text" placeholder="логин" class="newuser" id="new-login">
								<input type="text" placeholder="Аты-жөні" class="newuser" id="new-name">
								<input type="password" placeholder="Пароль" class="newuser" id="new-pass1">
								<input type="password" placeholder="Парольды қайталаңыз" class="newuser" id="new-pass2">
								<input type="button" value="Тіркеу" class="newuseradd" onclick="newAdmin()">
								<div id="errofnewadmin" class="w300"></div>
							</div>
						</div>

						<p onclick="shownext('stat5')" class="shownext">Профилді өзгерту</p>
						<div style="display: none;" id="stat5" class="dfjcc">
							<div class="register" id="register">
								<?php if (creator()): ?>
									<input type="text" placeholder="логин" class="newuser" onchange="getnewUser()" id="edit-login" <?php echo 'value="'; my("login"); echo '"';?>>
									<input type="text" placeholder="Аты жөні" class="newuser" id="edit-name" <?php echo 'value="'; my("name"); echo '"';?>>
								<?php else: ?>
									<input type="text" placeholder="логин" class="newuser" id="edit-login" disabled="true" <?php echo 'value="'; my("login"); echo '"';?>>
									<input type="text" placeholder="Аты жөні" class="newuser" id="edit-name" disabled="true" <?php echo 'value="'; my("name"); echo '"';?>>
								<?php endif ?>
								<input type="email" placeholder="email" class="newuser" id="edit-email" value=<?php my("email"); ?>>
								<input type="button" value="Сақтау" class="newuseradd" onclick="editProfile()">
								<div class="w300" id="errofedit"></div>

								<?php if (creator()): ?>
									<input type="text" placeholder="логин" class="newuser" onchange="getnewUser2()" id="passedit-login" <?php echo 'value="'; my("login"); echo '"';?>>
								<?php endif ?>
								<input type="password" placeholder="Пароль" id="edit-pass1" class="newuser">
								<input type="password" placeholder="Парольды қайталаңыз" id="edit-pass2" class="newuser">
								<input type="button" value="Пароль өзгерту" class="newuseradd" onclick="editPass()">
								<div class="w300" id="errofpass"></div>
							</div>
						</div>

						<p onclick="shownext('stat6')" class="shownext">Сайтты өзгерту</p>
						<div style="display: none;" id="stat6" class="dfjcc">
							<div class="editsite" id="editsite"></div>
							<div id="errodstats"></div>
						</div>

						<p onclick="shownext('stat9')" class="shownext">Тапсырыстар</p>
						<div style="display: none;" id="stat9">
							<div class="statistic" id="gotorders">
								
							</div>
						</div>
						<div class="clear_hash" id="hashes"></div>
					</div>
				</div>
			</div>
			<div class="advert left"></div>
		</div>
		<?php getFooter() ?>
		<script src="js/script.js"></script>
	</body>
</html>	
