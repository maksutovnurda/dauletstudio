<?php include 'libs.php';
	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = preg_split('#/|/#', $url);
    $uri = end($parts);
	if(admin()) {
		$getarticle = mysqli_query($conn, "SELECT * FROM `posts` WHERE `uri` = '$uri' LIMIT 1");
	} else {
		$getarticle = mysqli_query($conn, "SELECT * FROM `posts` WHERE `uri` = '$uri' AND `block` = 0 OR `block` = 2 LIMIT 1");
	}
	$article = mysqli_fetch_array($getarticle);
	if (empty($article)) { header("Location: ../404.php"); }
	$post_date = realtive_date($article['date']);

	$date = date("y m d G"); //y-Номер года, 2 цифры    m-номер месяца от01 до12    d-день месяца от01 до31    G-часыот от0 до23
	if(empty($_SERVER['HTTP_REFERER'])){ $ref = "none"; } else { $ref =  $_SERVER['HTTP_REFERER']; }
	$ip = $_SERVER['REMOTE_ADDR'];
	$agent = $_SERVER['HTTP_USER_AGENT'];

	$query = mysqli_query($conn, "SELECT * FROM `counter` WHERE `date` = '$date' LIMIT 1");
	if (mysqli_num_rows($query) == 0) {	// Если сегодня еще не было посещений
	    mysqli_query($conn, "DELETE FROM `counter`");	    // Очищаем таблицу ips и зыаносим в базу IP-адрес текущего посетителя
	    mysqli_query($conn, "INSERT INTO `counter` SET  `agent`='$agent', `uri`='$uri', `ip`='$ip', `ref`='$ref', `date` = '$date'"); 
	    mysqli_query($conn, "UPDATE posts SET views = views + 1 WHERE `uri` = '$uri'"); //Добавим +1 в счетчик
	} else { // Если посещения сегодня уже были
		$current_ip = mysqli_query($conn, "SELECT `ip` FROM `counter` WHERE `ip`='$ip' AND `uri` = '$uri'"); // Проверяем, естьв базе IP-адрес
		if (mysqli_num_rows($current_ip) == 1) {  } //Если такой IP-адрес уже сегодня был (т.е. это не уникальный посетитель)
	    else { // Если сегодня такого IP-адреса еще не было (т.е. это уникальный посетитель) Заносим в базу IP-адрес этого посетителя
	        mysqli_query($conn, "INSERT INTO `counter` SET  `agent`='$agent', `uri`='$uri', `ip`='$ip', `ref`='$ref', `date` = '$date'"); 
	        mysqli_query($conn, "UPDATE posts SET views = views + 1 WHERE `uri` = '$uri'"); //Добавим +1 в счетчик
	    }
	}
 ?>
<!doctype html>
<html lang="kk" prefix="og: http://ogp.me/ns#">
	<head>
		<base <?php echo "href='{$base}'"; ?>>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta http-equiv="Content-Language" content="kk">
		<title><?php echo $article['title']; ?></title>
		
		<meta http-equiv="Content-Language" content="kk">
		<meta name="title" <?php echo "content='{$article['title']}'"; ?>><!-- 12 сөз 70 символ -->
		<meta name="description" <?php echo "content='{$article['description']}'"; ?>> <!-- 160-200 symbol -->
		<meta name="keywords" <?php echo "content='{$article['keywords']}'"; ?>/>
		
		<meta name="Author" <?php echo "content='{$article['author']}'"; ?>>
		<meta name="robots" content="index, follow">
		<!-- <meta name="robots" content="noindex"> -->
		
		<!-- Open graph -->
		<meta name="og:title" <?php echo "content='{$article['title']}'"; ?> />
		<meta property="og:url" <?php echo "content='http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}'"; ?> />
		<meta property="og:type" content="article" />
		<meta property="og:image" <?php echo "content='{$article['img']}'"; ?> />
		<meta property="og:image:secure_url" <?php echo "content='{$article['img']}'"; ?>>
		
		<!-- Google+ -->
		<meta itemprop="name" <?php echo "content='{$article['title']}'"; ?> />
		<meta itemprop="description" <?php echo "content='{$article['description']}'"; ?> />
		<meta itemprop="image" <?php echo "content='{$article['img']}'"; ?> />
		
		<meta name="theme-color" content="#323335">
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
					<?php 
						if (admin()) {
							$ablock = $article['block'];
						if ($ablock==0) {
						  		echo '<div class="addpost"><div id="addpost__action"><span onclick="deletePost('.$article['id'].')" class="addpost-show deletepost">Бұғаттау</span></div>';
						  } elseif ($ablock==1) { 
						  	echo '<div class="addpost"><div id="addpost__action"><p class="deletedpost">Жазба бұғатталған</p><span onclick="restorePost('.$article['id'].')" class="addpost-show restorepost">Бұғаттан шығару</span></div>'; } elseif ($ablock==2) { 
						  	echo '<div class="addpost"><div id="addpost__action"><p class="deletedpost">Жазба жасырылған</p><span onclick="restorePost('.$article['id'].')" class="addpost-show restorepost">Жариялау</span></div>'; }
					        echo '
					                        <span onclick="showAddPost()" class="addpost-show"><span class="fa fa-pencil"></span></span>
					                        <div id="addpost" class="dn">
					                            <div class="dffdc">
					                                <input type="text" class="addpost-input" placeholder="Тақырып" id="post-title" value="'.$article["title"].'">
					                                <div class="commands">
					                                  <div class="group-command">
					                                    <button onclick="execCmd(\'bold\', this)" title="Қалың/жирный"><i class="fa fa-bold"></i></button>
					                                    <button onclick="execCmd(\'italic\', this)" title="Курсив"><i class="fa fa-italic"></i></button>
					                                    <button onclick="execCmd(\'underline\', this)" title="Асты сызылған/подчеркнутый"><i class="fa fa-underline"></i></button>
					                                    <button onclick="execCmd(\'strikeThrough\', this)" title="Өшірілген"><i class="fa fa-strikethrough"></i></button>
					                                  </div>
					                                  <div class="group-command">
					                                    <button onclick="execCmd(\'justifyLeft\', this)" title="Сол жаққа"><i class="fa fa-align-left"></i></button>
					                                    <button onclick="execCmd(\'justifyCenter\', this)" title="Ортаға"><i class="fa fa-align-center"></i></button>
					                                    <button onclick="execCmd(\'justifyRight\', this)" title="Оң жаққа"><i class="fa fa-align-right"></i></button>
					                                    <button onclick="execCmd(\'justifyFull\', this)" title="Бастапты күй"><i class="fa fa-align-justify"></i></button>
					                                  </div>
					                                  <div class="group-command">
					                                    <button onclick="execCmd(\'cut\')" title="Қию/Вырезать"><i class="fa fa-cut"></i></button>
					                                    <button onclick="execCmd(\'copy\')" title="Қою/Вставить"><i class="fa fa-copy"></i></button>
					                                    <button onclick="execCmd(\'SelectAll\')" title="Барлығын белгілеу/выделить все"><i class="fa fa-file-o"></i></button>
					                                  </div>
					                                  <div class="group-command">
					                                    <button onclick="execCmd(\'indent\')" title="tab"><i class="fa fa-indent"></i></button>
					                                    <button onclick="execCmd(\'outdent\')" title="shift+tab"><i class="fa fa-dedent"></i></button>
					                                  </div>
					                                  <div class="group-command">
					                                    <button onclick="execCmd(\'subscript\', this)" title="Төменгі жол"><i class="fa fa-subscript"></i></button>
					                                    <button onclick="execCmd(\'superscript\', this)" title="Жоғарғы жол"><i class="fa fa-superscript"></i></button>
					                                  </div>
					                                  <div class="group-command">
					                                    <button onclick="execCmd(\'undo\')" title="бас тарту/отменить"><i class="fa fa-undo"></i></button>
					                                    <button onclick="execCmd(\'removeFormat\')"><i class="fa fa-times"></i></button>
					                                    <button onclick="execCmd(\'redo\')" title="қайтару/вернуть"><i class="fa fa-repeat"></i></button>
					                                  </div>
					                                  <div class="group-command">
					                                    <button onclick="execCmd(\'insertUnorderedList\', this)" title="Реттелмеген тізім"><i class="fa fa-list-ul"></i></button>
					                                    <button onclick="execCmd(\'insertOrderedList\', this)" title="Реттелген тізім"><i class="fa fa-list-ol"></i></button>
					                                    <button onclick="execCmd(\'insertHorizontalRule\')" title="Горизонталь сызық/линия">hr</button>
					                                  </div>
					                                  
					                                  <div class="group-command">
					                                    <button onclick="execCmdArgument(\'createLink\', prompt(\'Сілтеме:\', \'\'))" title="Сілтеме қою"><i class="fa fa-link"></i></button>
					                                    <button onclick="execCmd(\'unlink\')"><i class="fa fa-unlink" title="Сілтемены алу"></i></button>
					                                    <button onclick="execCmdArgument(\'insertImage\', prompt(\'Суретке сілтеме:\', \'\'))"><i class="fa fa-picture-o"></i></button>
					                                  </div>
					                                  <div class="group-command">
					                                    <button onclick="toggleSource(this)"><i class="fa fa-code" title="Бастапқы код/исходный код"></i></button>
					                                    <button onclick="toggleEdit(this)" title="Көру"><i class="fa fa-eye"></i></button>
					                                  </div>
					                                  <select onchange="execCmdArgument(\'formatBlock\', this.value)">
					                                    <option>H</option>
					                                    <option value="h1">h1</option>
					                                    <option value="h2">h2</option>
					                                    <option value="h3">h3</option>
					                                    <option value="h4">h4</option>
					                                    <option value="h5">h5</option>
					                                    <option value="h6">h6</option>
					                                    <option value="P">Параграф</option>
					                                    <option value="pre">Код</option>
					                                  </select>
					                                  <select onchange="execCmdArgument(\'fontName\', this.value)">
					                                    <option value="Times New Roman">Times New Roman</option>
					                                    <option value="Comic Sans MS">Comic Sans MS</option>
					                                    <option value="Courier">Courier</option>
					                                    <option value="Georgia">Georgia</option>
					                                    <option value="Tahoma">Tahoma</option>
					                                    <option value="Verdana">Verdana</option>
					                                    <option value="Arial">Arial</option>
					                                  </select>
					                                  <select onchange="execCmdArgument(\'fontSize\', this.value)">
					                                    <option value="1">1</option>
					                                    <option value="2">2</option>
					                                    <option value="3">3</option>
					                                    <option value="4">4</option>
					                                    <option value="5">5</option>
					                                    <option value="6">6</option>
					                                  </select>
					                                  <input type="color" class="colorinput" onchange="execCmdArgument(\'foreColor\', this.value)">
					                                  <input type="color" class="colorinput" onchange="execCmdArgument(\'hiliteColor\', this.value)">
					                                </div>
					                                <div id="textField" contenteditable="true" data-text="Толық текст" class="textField" spellcheck="false">'.$article["content"].'</div>
					                                <textarea id="ftxt" class="dn">'.$article["content"].'</textarea>

					                                <input type="text" class="addpost-input" placeholder="Суретке сілтеме" id="post-img" onchange="showAlt()" value="'.$article["img"].'">
					                                <input type="text" class="addpost-input" placeholder="Alt" id="alts" value="'.$article["alt"].'">
					                                <textarea class="addpost-input" placeholder="Сипаттама" cols="25" id="post-desc">'.$article["description"].'</textarea>
					                                <input type="text" class="addpost-input" placeholder="Кілт сөздер" id="post-keys" value="'.$article["keywords"].'">
					                                <div class="df">
					                                <select id="post-block" class="block w100p">
					                                    <option value="0">Жариялау</option>
					                                    <option value="2">Жасыру</option>
					                                    <option value="1">Бұғаттау</option>
					                                </select>&nbsp;
					                                <select id="post-type" class="block w100p">
					                                    <option value="post">Жазба</option>
					                                    <option value="work">Жұмыс</option>
					                                </select>
					                                </div>
					                                <input type="button" class="addpost-button" placeholder="Блок" value="Жариялау" onclick="editPost('.$article["id"].')">
					                                <div class="df" id="errofediting"></div>
					                            </div>
					                        </div>
					                    </div>';
					                }
					 ?>
					<div class="toback">
						<a href="index.php" class="a-link">Басты бет</a> <span class="a-date">></span> <a href="post.php" class="a-link" id="toback"><?php echo $article['title']; ?></a>
					</div>
					<div class="article">
						<?php echo "<span class='a-date'>{$post_date}</span>
						<div class='a-content' id='a-content'>{$article['content']}</div>
						<span class='a-date'>Автор: <b>{$article['author']}</b></span>"; ?>
						
					</div>
					 	<div class="comments">
					 		<div class="dffdc">
					 			<input type="hidden" id="comment-uri" <?php echo "value='{$article['id']}'"; ?>>
					 			<?php 
					 				if (admin()) {
					 					echo "<input type='hidden' placeholder='Аты-жөніңіз' class='sign' id='comment-name' value=''>";
					 				} else { if(isset($_COOKIE["name"])) { $uname = $_COOKIE["name"]; } else { $uname = ""; } echo '<input type="text" placeholder="Аты-жөніңіз" class="sign" id="comment-name" value="'.$uname.'">'; }
					 			 ?>
								<textarea placeholder="Комментарий жазу..." class="sign" id="comment-content" style="resize: vertical; font-family: Arial;"></textarea>
								<div class="df">
									<button class="sign-btn" onclick="comment()"><span class="fa fa-send"></span></button>
								</div>
								<div class="df" id="errofcomment"></div>
							</div>
							<div class="c-body" id="comments">
								<span onclick="getComment()" class="showcomment">Комментарийлер</span>
					 		</div>
					 	</div>
					 	<div class='df fww'>
					 	<?php 
					 		$similar = $article["content"]." ".$article["title"]." ".$article["description"]." ".$article["keywords"];
					 		$similar = strip_tags($similar);
					 		$similarquery = "SELECT * FROM posts WHERE MATCH (content, title) AGAINST ('$similar') AND `block` = 0 AND `id` <> ".$article['id']." LIMIT 5";
					        $similarposts2 = mysqli_query($conn, $similarquery);
				        	while ($post = mysqli_fetch_array($similarposts2)) {
					            $date = realtive_date($post['date']);
					            $uri = $post['id'];

					            $commentcount = mysqli_query($conn, "SELECT COUNT(*) FROM comments WHERE `block` = 0 AND `id` = '$id'");
					            $temp2 = mysqli_fetch_array($commentcount);
					            $allcomment = $temp2[0];
					            echo "<div class='post'>
		                            <a class='gradient' href='post/{$post['uri']}'></a>
		                            <img src='data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw==' class='b-lazy' data-src='{$post['img']}' alt='{post['alt']}'>
		                            <div class='content'>
		                                <div class='dffdr' style='align-items: center;'>
		                                    <span class='info-t'>{$date}</span>&nbsp;&nbsp;
		                                    <div>
		                                        <span class='fa fa-eye info-t'></span><span class='info-t'>&nbsp;{$post['views']}&nbsp;&nbsp;</span>
		                                    </div>
		                                    <div>
		                                        <span class='fa fa-comments info-t'></span><span class='info-t'>&nbsp;{$allcomment}&nbsp;&nbsp;</span>
		                                    </div>
		                                </div>
		                                <h2><a href='post/{$post['uri']}'>{$post['title']}</a></h2>
		                                <i class='hash'>{$post['id']} жазба</i>
		                            </div>
		                        </div>";
				        	}
					        
					 	 ?>
					 	 </div>
				</div>
			</div>
			<div class="advert left"></div>
		</div>
		<?php getFooter() ?>
		<script src="js/script.js"></script>
	</body>
</html>	
