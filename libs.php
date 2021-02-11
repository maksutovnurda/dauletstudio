<?php 
include "connection.php";
$base = "http://localhost/dauletstudio/"; //http://{$_SERVER['HTTP_HOST']}/
function creator() {
    if (isset($_COOKIE["token"])) {
        global $conn;
        $token = $_COOKIE["token"];
        $creator = mysqli_query($conn, "SELECT * FROM `users` WHERE `online` = '$token' AND `block` = '1' LIMIT 1");
        $checkcreator=mysqli_fetch_array($creator);
        if (empty($checkcreator)) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}
function admin() {
    if (isset($_COOKIE["token"])) {
        global $conn;
        $token = $_COOKIE["token"];
        $admin = mysqli_query($conn, "SELECT * FROM `users` WHERE `online` = '$token' LIMIT 1");
        $checkadmin=mysqli_fetch_array($admin);
        if (empty($checkadmin)) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}
function my($article) {
    global $conn;
    $token = $_COOKIE["token"];
    $profile = mysqli_query($conn, "SELECT * FROM `users` WHERE `online` = '$token' LIMIT 1");
    $myprof=mysqli_fetch_array($profile);
    echo $myprof[$article];
}
function my2($article) {
    global $conn;
    $token = $_COOKIE["token"];
    $profile = mysqli_query($conn, "SELECT * FROM `users` WHERE `online` = '$token' LIMIT 1");
    $myprof=mysqli_fetch_array($profile);
    return $myprof[$article];
}
function getSidebar() {
    global $conn;
    $getmenu = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'menu' AND `block` = 0 ORDER BY place ");
    $getprice = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'price' AND `block` = 0 ORDER BY place ");
    $getlink = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'link' AND `block` = 0 ORDER BY place ");

    echo '<div class="side-menu">
    <p class="sidetitle">Меню</p>';
    while ($gotmenu =mysqli_fetch_array($getmenu)) { echo $gotmenu['content']; }
    echo '</div>
    <div class="price">
        <p class="sidetitle">Бағалар</p>
        <ul>';
        while ($gotprice =mysqli_fetch_array($getprice)) { echo "<li>{$gotprice['content']}</li>"; }
    echo '<a href="order.php">Тапсырыс беру</a>
        </ul>
    </div>
    <div class="social">
        <p class="sidetitle">Байланысу</p>
        <ul>
            <li>';
                while ($gotlink =mysqli_fetch_array($getlink)) { echo $gotlink['content']; }
                if (admin()) {
                    echo ' <a href="login.php" onclick="logOut()">Шығу<br>'.my2("name").'</a>';
                }
            echo '</li>
        </ul>
    </div>
    <div class="social">
        <p class="sidetitle">Соңғы жазбалар</p>
        <ul>
            <li>
                <a href="">Top Liga Janalyktary тобына - Толық дизайн</a>
                <a href="">Қазақ футболы тобына - Логотип</a>
                <a href="">Бізде жаңа логотип</a>
                <a href="">Біз инстграмдамыз</a>
            </li>
        </ul>
    </div>';
}
function getMenu() {
    global $conn;
    $getmenu = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'menu' AND `block` = 0 ORDER BY place ");
    $getmenu2 = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'menu' AND `block` = 0 ORDER BY place ");
    $getprice = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'price' AND `block` = 0 ORDER BY place ");
    $getlink = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'link' AND `block` = 0 ORDER BY place ");
    global $base;
    orders();
    echo "<div id='toTop' onclick='toTop()'><span class='fa fa-angle-up'></span>&nbsp;<span>жоғары</span></div>";
    echo '<div class="df" id="menumain">
            <div class="menu left" onclick="logotype(\''.$base.'\')"><img src="img/logo200.png" height="20px" class="logotype"></div>
            <div class="menu right pc">';
            while ($gotmenu =mysqli_fetch_array($getmenu)) { echo $gotmenu['content']; }
            echo '</div>
            <div class="menu right mobile">
                    <img src="img/logo200.png" height="20px" class="logotype" onclick="logotype(\''.$base.'\')">
                    <a onclick="burger()" id="openmenu"><span class="fa fa-bars"></span></a>
            </div>
            <div class="menuside" id="menuside">
                <div class="side-menu">
                        <p class="sidetitle">Меню</p>';
                        while ($gotmenu2 =mysqli_fetch_array($getmenu2)) { echo $gotmenu2['content']; }
                    echo '</div>
                    <div class="price">
                        <p class="sidetitle">Бағалар</p>
                        <ul>';
                            while ($gotprice =mysqli_fetch_array($getprice)) { echo "<li>{$gotprice['content']}</li>"; }
                        echo '</ul>
                    </div>
                    <div class="social">
                        <p class="sidetitle">Байланысу</p>
                        <ul>
                            <li>';
                            while ($gotlink =mysqli_fetch_array($getlink)) { echo $gotlink['content']; }
                            if (admin()) {
                                echo ' <a href="login.php" onclick="logOut()">Шығу<br>'.my2("name").'</a>';
                            }
                           echo ' </li>
                        </ul>
                    </div>
            </div>
            <div class="back" id="back"></div>
            <div class="menu left"></div>
        </div>';
}
function getFooter() {
    echo '<div class="df">
            <div class="footer left"></div>
            <div class="footer right"><a href=""><img src="data:image/gif;base64,R0lGODlhPwAUAIAAAP///wAAACH5BAEAAAEALAAAAAA/ABQAAAIijI+py+0Po5y02ouz3rz7D4biSJbmiabqyrbuC8fyTNdnAQA7" class="b-lazy" onclick="logotype(\''.$base.'\')" data-src="img/logo200.png"></a></div>
            <div class="footer left"></div>
        </div>';
}
function addPostShow() {
    if (admin()) {  
        echo '<div class="addpost">
                        <span onclick="showAddPost()" class="addpost-show">+</span>
                        <div id="addpost" class="dn">
                            <div class="dffdc">
                                <input type="text" class="addpost-input" placeholder="Тақырып" id="post-title">
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
                                <div id="textField" contenteditable="true" data-text="Толық текст" class="textField" spellcheck="false"></div>
                                <textarea id="ftxt" class="dn"></textarea>

                                <input type="text" class="addpost-input" placeholder="Суретке сілтеме" id="post-img" onchange="showAlt()">
                                <input type="text" class="addpost-input" placeholder="Alt" id="alts" style="display: none;">
                                <textarea class="addpost-input" placeholder="Сипаттама" cols="25" id="post-desc"></textarea>
                                <input type="text" class="addpost-input" placeholder="Кілт сөздер" id="post-keys">
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
                                <input type="button" class="addpost-button" placeholder="Блок" value="Жариялау" onclick="addPost()">
                                <div class="df" id="errofadding"></div>
                            </div>
                        </div>
                    </div>';
                }
}
function realtive_date($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
                    'y' => 'жыл',
                    'm' => 'ай',
                    'w' => 'апта',
                    'd' => 'күн',
                    'h' => 'сағат',
                    'i' => 'мин.',
                    's' => 'сек.');
    foreach ($string as $k => &$v) {
        if ($diff->$k) 
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        else
            unset($string[$k]);
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' бұрын' : 'жаңа ғана';
}
function translate($s) {
    $s = (string) $s; // преобразуем в строковое значение
    $s = strip_tags($s); // убираем HTML-теги
    $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр 
    $s = strtr($s, array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'a',   'Б' => 'b',   'В' => 'v',
        'Г' => 'g',   'Д' => 'd',   'Е' => 'e',
        'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',
        'И' => 'i',   'Й' => 'y',   'К' => 'k',
        'Л' => 'l',   'М' => 'm',   'Н' => 'n',
        'О' => 'o',   'П' => 'p',   'Р' => 'r',
        'С' => 's',   'Т' => 't',   'У' => 'u',
        'Ф' => 'f',   'Х' => 'h',   'Ц' => 'c',
        'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',
        'Ь' => '\'',  'Ы' => 'y',   'Ъ' => '\'',
        'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya',

        'ә' => 'a',   'Ә' => 'a',   '-' => '',
        'і' => 'i',   'І' => 'i',   
        'ң' => 'n',   'Ң' => 'n',   
        'ғ' => 'g',   'Ғ' => 'g',   
        ',' => '',    '"' => '',    
        '.' => '',    '!' => '',   
        'ү' => 'u',   'Ү' => 'u',   
        'ұ' => 'u',   'Ұ' => 'u',  
        'қ' => 'q',   'Қ' => 'q',   
        'ө' => 'o',   'Ө' => 'o',   
        'һ' => 'h',   'Һ' => 'h',   
    ));
    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
    $s = trim($s); // убираем пробелы в начале и конце строки
    $s = str_replace(" ", "_", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
}
function register () {
    if (isset($_POST['register'])) {
        if (creator()) {
            $email = htmlspecialchars($_POST['email']);
            $login = htmlspecialchars($_POST['login']);
            $name = $_POST['name'];
            $pass1 = md5(htmlspecialchars($_POST['pass1']) );
            $pass2 = md5(htmlspecialchars($_POST['pass2']) );
            $errors = array();
            if( empty($email)){
              $errors[] = 'Email-ді жазыңыз';
            }
            if( empty($login)){
              $errors[] = 'Логин жазыңыз';
            }
            if(!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
                $errors[] = 'Кириллица қабылданбайды!';
            }
            if( empty($name)){
              $errors[] = 'Аты-жөніңізді жазыңыз';
            }
            if( empty($_POST['pass1'])){
              $errors[] = 'Пароль жазылмаған!';
            }
            if( empty($_POST['pass2'])){
              $errors[] = 'Пароль сәйкес емес!';
            }
            if($pass1 != $pass2){
              $errors[] = 'Пароль сәйкес емес!';
            }
            if (empty($errors)) {
                global $conn;
                $checkemail = mysqli_query($conn, "SELECT `id` FROM `users` WHERE `email` = '$email' LIMIT 1");
                $rcheckemail=mysqli_fetch_array($checkemail);
                if (!empty($rcheckemail)) {
                    echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Email бос емес!</span>';
                } else {
                    $checklogin = mysqli_query($conn, "SELECT `id` FROM `users` WHERE `login` = '$login' LIMIT 1");
                    $rchecklogin=mysqli_fetch_array($checklogin);
                    if (empty($rchecklogin)) {
                        $r = random_int(1, 1000);
                        $online = md5($r.time());
                        $password = md5($login.$pass1);
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $registration = mysqli_query($conn, "INSERT INTO `users` (`id`, `login`, `email`, `name`, `password`, `reset`, `online`, `date`, `ip`) VALUES (NULL, '$login', '$email', '$name', '$password', md5(NOW()), '$online', NOW(), '$ip')");
                        echo '<span class="succ"><span class="fa fa-check"></span>&nbsp;Қолданушы сәтті тіркелді!</span>'; 
                    } else { echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Логин бос емес!</span>'; }
                }
            } else {
                echo '<span class="err"><span class="fa fa-times"></span>&nbsp;';
                echo array_shift($errors);
                echo '</span>';
            }
        } else { echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Сайт құрушысы тіркей алады!</span>'; }
    }
}
function login () {
    if (isset($_POST['loginin'])) {
        $login = htmlspecialchars($_POST['login']);
        $pass = md5 (htmlspecialchars($_POST['pass']) );
        if( empty($login)){
          $errors[] = 'Логин жазыңыз';
        }
        if(!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
            $errors[] = 'Пароль немесе логин қате!';
        }
        if( empty($_POST['pass'])){
          $errors[] = 'Пароль жазыңыз';
        }
        if (empty($errors)) {
            global $conn;
            $checklogin = mysqli_query($conn, "SELECT `id` FROM `users` WHERE `login` = '$login' LIMIT 1");
            $logincheck=mysqli_fetch_array($checklogin);
            if (!empty($logincheck)) {
                $password = md5($login.$pass);
                $checkpass = mysqli_query($conn, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' LIMIT 1");
                $passcheck=mysqli_fetch_array($checkpass);
                if (!empty($passcheck)) {
                    $token = $passcheck['online'];
                    setcookie("token", "$token");
                    echo "1";
                } else { echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Пароль немесе логин қате!</span>'; }
            } else { echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Пароль немесе логин қате!</span>'; }
        } else {
            echo '<span class="err"><span class="fa fa-times"></span>&nbsp;';
            echo array_shift($errors);
            echo '</span>';
        }
    }
}
function logout() {
    if (isset($_POST['logout'])) {
        setcookie("token", "");
    }
}
function orders() {
        if (creator()) {
            global $conn;
            $result = mysqli_query($conn, "SELECT COUNT(*) FROM orders WHERE `readed` = 0 AND `block` = 0");
            $temp = mysqli_fetch_array($result);
            $orders = $temp[0];
            if ($orders != 0) {
                echo '<div class="new-order">
                        <a href="admin.php"><b>('.$orders.')</b>Сізде жаңа тапсырыс!</a>
                        <span class="fa fa-times" onclick="readOrder()"></span>
                </div>';
            }
        }
}
function readOrder () {
    if (isset($_POST['readorder'])) {
        if (creator()) {
            global $conn;
            $read = mysqli_query($conn, "UPDATE `orders` SET `readed` = '1' WHERE `orders`.`readed` = '0'");
        }
    }
}
function deleteOrder () {
    if (isset($_POST['deleteorder'])) {
        if (creator()) {
            global $conn;
            $id = htmlspecialchars($_POST['id']);
            $query7 = mysqli_query($conn, "UPDATE `orders` SET `readed` = '1', `block` = '1' WHERE `id` = $id");
        }
    }
}
function getOrders () {
    if (isset($_POST['getorder'])) {
        if (creator()) {
            global $conn;
            $getorders = mysqli_query($conn, "SELECT * FROM `orders` WHERE `block` = 0 ORDER BY id DESC");
            if (empty(mysqli_fetch_array($getorders))) {
                echo "<p class='contentofcomment' style='font-family: Arial; text-align:center; opacity: 0.4; font-size: 14px; margin: 5px'>Тапсырыс жоқ!</p>";
            } else { 
                $getorders2 = mysqli_query($conn, "SELECT * FROM `orders` WHERE `block` = 0 ORDER BY id DESC");
                while ($order =mysqli_fetch_array($getorders2)) {
                    echo "  <div class='order-stat' id='order-{$order["id"]}'>
                                <p>{$order["name"]}</p>
                                <span>{$order["product"]}</span>
                                <span>{$order["date"]}</span>
                                <a href='{$order["link"]}'>VK Telegram</a>
                                <p class='shownext' onclick='deleteOrder({$order["id"]})''>Өшіру</p>
                            </div>";
                } 
            }
        }   else { echo "<p class='contentofcomment' style='font-family: Arial; text-align:center; opacity: 0.4; font-size: 14px; margin: 5px'>Сайт құрушысына көруге рұқсат!</p>"; }
    }
}
function getUser() {
    if (creator()) {
        if (isset($_POST['getuser'])) {
            global $conn;
            $login = htmlspecialchars($_POST['login']);
            $userdata = mysqli_query($conn, "SELECT * FROM `users` WHERE `login` = '$login' LIMIT 1");
            $data=mysqli_fetch_array($userdata);
            if (isset($data)) {
                echo "  <input type='text' placeholder='логин' class='newuser' onchange='getnewUser()' id='edit-login' value='{$data['login']}'>
                        <input type='text' placeholder='Аты жөні' class='newuser' id='edit-name' value='".$data['name']."'>
                        <input type='email' placeholder='email' class='newuser' id='edit-email' value='{$data['email']}'>
                        <input type='button' value='Өзгерту' class='newuseradd' onclick='editProfile()'>
                        <div class='w300' id='errofedit'></div>

                        <input type='text' placeholder='логин' class='newuser' onchange='getnewUser()' id='passedit-login' value='{$data['login']}'>
                        <input type='password' placeholder='Пароль' id='edit-pass1' class='newuser'>
                        <input type='password' placeholder='Парольды қайталаңыз' id='edit-pass2' class='newuser'>
                        <input type='button' value='Өзгерту' class='newuseradd' onclick='editPass()'>
                        <div class='w300' id='errofpass'></div>";
            } else {
                echo "1";
            }
        }
    }
}
function editProfile() {
    if (isset($_POST['editprofile'])) {
        if (admin()) {
            if (creator()) {
                $login = htmlspecialchars($_POST['login']);
                $name = $_POST['name'];
                if( empty($login)){
                  $errors[] = 'Логин жазыңыз';
                }
                if(!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
                    $errors[] = 'Кириллица қабылданбайды!';
                }
                if( empty($name)){
                  $errors[] = 'Аты-жөніңізді жазыңыз';
                }
            } else {
                if (admin()) { 
                    if (!creator()) {
                        $login = my2("login");
                        $name = my2("name");
                    }
                }
            }
            $email = htmlspecialchars($_POST['email']);
            $errors = array();
            if( empty($email)){
            $errors[] = 'Email-ді жазыңыз';
            }
            if (empty($errors)) {
                global $conn;
                $checklogin = mysqli_query($conn, "SELECT * FROM `users` WHERE `login` = '$login' LIMIT 1");
                $rchecklogin=mysqli_fetch_array($checklogin);
                if (!empty($rchecklogin)) {
                    $editprof = mysqli_query($conn, "UPDATE `users` SET `email` = '$email', `name` = '$name'  WHERE `users`.`login` = '$login'");
                    echo '<span class="succ"><span class="fa fa-check"></span>&nbsp;Өзгертілді!</span>';
                } else { echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Бұндай қолданушы жоқ!</span>'; }
            } else { echo '<span class="err"><span class="fa fa-times"></span>&nbsp;'; echo array_shift($errors); echo '</span>'; }
        }
    }
}
function editPass() {
    if (isset($_POST['editpass'])) {
        if (admin()) {
            if (creator()) {
                $login = htmlspecialchars($_POST['login']);
                if( empty($login)){
                  $errors[] = 'Логин жазыңыз';
                }
                if(!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
                    $errors[] = 'Кириллица қабылданбайды!';
                }
            } else {
                if (admin()) {
                    $login = my2("login");
                }
            }
            $pass1 = md5(htmlspecialchars($_POST['pass1']) );
            $pass2 = md5(htmlspecialchars($_POST['pass2']) );
            $errors = array();
            if( empty($_POST['pass1'])){
              $errors[] = 'Пароль жазылмаған!';
            }
            if( empty($_POST['pass2'])){
              $errors[] = 'Пароль сәйкес емес!';
            }
            if($pass1 != $pass2){
              $errors[] = 'Пароль сәйкес емес!';
            }
            if (empty($errors)) {
                global $conn;
                $checklogin = mysqli_query($conn, "SELECT * FROM `users` WHERE `login` = '$login' LIMIT 1");
                $rchecklogin=mysqli_fetch_array($checklogin);
                if (!empty($rchecklogin)) {
                    $r = random_int(1, 1000);
                    $reset = md5($r.$_COOKIE["token"]);
                    $online = md5($r.time());
                    $password = md5($login.$pass1);
                    $editprof = mysqli_query($conn, "UPDATE `users` SET `reset` = '$reset', `online` = '$online', `password` = '$password' WHERE `users`.`login` = '$login'");
                    echo '<span class="succ"><span class="fa fa-check"></span>&nbsp;Пароль өзгертілді(обновить етіңіз)!</span>';
                } else { echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Бұндай қолданушы жоқ!</span>'; }
            } else { echo '<span class="err"><span class="fa fa-times"></span>&nbsp;'; echo array_shift($errors); echo '</span>'; }
        }
    }
}
function newItem () {
    if (isset($_POST['newitem'])) {
        if (creator()) {
            global $conn;
            $type = htmlspecialchars($_POST['type']);
            $newitem = mysqli_query($conn, "INSERT INTO `stats` (`id`, `content`, `type`, `block`, `place`) VALUES (NULL, 'Жаңа бөлім', '$type', '1', '0')");
            echo "1";
        } else {
            echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Сайт құрушысы қоса алады!</span>';
        }
    }
}
function getStats() {
    if (isset($_POST['getstats'])) {
        if (creator()) {
            global $conn;
            $getmenu = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'menu' ORDER BY place ");
            $getprice = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'price' ORDER BY place ");
            $getlink = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'link' ORDER BY place ");
            echo "  <p onclick='shownext(\"stat7\")' class='shownext'>Меню</p>
                    <div style='display: none;' id='stat7' class='dfjcc'><div class='editsite'>";
                        while ($gotmenu =mysqli_fetch_array($getmenu)) {
                           echo "<div id='stat' class='stat-{$gotmenu["id"]}'>
                        <input type='text' placeholder='Контент' class='newuser' value='{$gotmenu["content"]}' id='content-{$gotmenu["id"]}'>
                            <div class='editstat'>
                            <select class='block w100p' value='{$gotmenu["place"]}' id='block-{$gotmenu["id"]}'>
                                    <option value='0'>Жариялау</option>
                                    <option value='1'>Жасыру</option>
                            </select>&nbsp;
                            <p>Орын:</p>
                            <input type='text' placeholder='орын' class='newuser w100p' value='{$gotmenu["place"]}' id='place-{$gotmenu["id"]}'>
                        </div>
                        <div class='df'>

                            <input type='button' value='Сақтау' class='newuseradd w100p' onclick='editStat(\"{$gotmenu["id"]}\")'>&nbsp;
                            <input type='button' value='Өшіру' class='newuserdelete w100p' onclick='deleteStat(\"{$gotmenu["id"]}\")'>
                        </div><div class='df' id='errofstat-{$gotmenu["id"]}'></div><br></div>";
                        }
                        echo "<input type='button' value='Жаңасын қосу' class='newuseradd' onclick='newItem(\"menu\")'><br></div></div>


                    <p onclick='shownext(\"stat8\")' class='shownext'>Бағалар</p>
                    <div style='display: none;' id='stat8' class='dfjcc'><div class='editsite'>";
                        while ($gotprice =mysqli_fetch_array($getprice)) {
                           echo "
                        <input type='text' placeholder='Контент' class='newuser' value='{$gotprice["content"]}' id='content-{$gotprice["id"]}'>
                        <div class='editstat'>
                            <select class='block w100p' value='{$gotprice["block"]}' id='block-{$gotprice["id"]}'>
                                    <option value='0'>Жариялау</option>
                                    <option value='1'>Жасыру</option>
                            </select>&nbsp;
                            <p>Орын:</p>
                            <input type='text' placeholder='орын' class='newuser w100p' value='{$gotprice["place"]}' id='place-{$gotprice["id"]}'>
                        </div>
                        <div class='df'>
                            <input type='button' value='Сақтау' class='newuseradd w100p' onclick='editStat(\"{$gotprice["id"]}\")'>&nbsp;
                            <input type='button' value='Өшіру' class='newuserdelete w100p' onclick='deleteStat(\"{$gotprice["id"]}\")'>
                        </div><div class='df' id='errofstat-{$gotprice["id"]}'></div><br>";
                        }
                        echo "<input type='button' value='Жаңасын қосу' class='newuseradd' onclick='newItem(\"price\")'><br></div></div>


                    <p onclick='shownext(\"stat10\")' class='shownext'>Сілтемелер</p>
                    <div style='display: none;' id='stat10' class='dfjcc'><div class='editsite'>";
                        while ($gotlink =mysqli_fetch_array($getlink)) {
                           echo "
                        <input type='text' placeholder='Контент' class='newuser' value='{$gotlink["content"]}' id='content-{$gotlink["id"]}'>
                        <div class='editstat'>
                            <select class='block w100p' value='{$gotlink["block"]}'  id='block-{$gotlink["id"]}'>
                                    <option value='0'>Жариялау</option>
                                    <option value='1'>Жасыру</option>
                            </select>&nbsp;
                            <p>Орын:</p>
                            <input type='text' placeholder='орын' class='newuser w100p' value='{$gotlink["place"]}' id='place-{$gotlink["id"]}'>
                        </div>
                        <div class='df'>
                            <input type='button' value='Сақтау' class='newuseradd w100p' onclick='editStat(\"{$gotlink["id"]}\")'>&nbsp;
                            <input type='button' value='Өшіру' class='newuserdelete w100p' onclick='deleteStat(\"{$gotlink["id"]}\")'>
                        </div><div class='df' id='errofstat-{$gotlink["id"]}'></div><br>";
                        }
                        echo "<input type='button' value='Жаңасын қосу' class='newuseradd' onclick='newItem(\"link\")'><br></div></div>";
                
        }
    }
}
function editStat() {
    if (isset($_POST['editstat'])) {
        if (creator()) {
            global $conn;
            $id = $_POST['id'];
            $content = $_POST['content'];
            $block = $_POST['block'];
            $place = $_POST['place'];

            $errors = array();
            if(empty($content)){
              $errors[] = 'Толық толтырылмады!';
            }    
            if (empty($errors)) {
                mysqli_query($conn, "UPDATE `stats` SET `content` = '$content', `block` = '$block', `place` = '$place'  WHERE `stats`.`id` = '$id'");
                echo '<span class="succ"><span class="fa fa-check"></span>&nbsp;Өзгертілді!</span>';
             } else {
                echo '<span class="err"><span class="fa fa-times"></span>&nbsp;';
                echo array_shift($errors);
                echo '</span>';
             }
        } else {
            echo '<span class="err"><span class="fa fa-times"></span>&nbsp;Сайт құрушысы қоса алады!</span>';
        }
    }
}
function deleteStat () {
    if (isset($_POST['deletestat'])) {
        if (creator()) {
            global $conn;
            $id = $_POST['id'];
            mysqli_query($conn, "DELETE FROM `stats` WHERE `id` = '$id'");
            echo "1";
        }
    }
}
function getPosts() {
        global $conn;
        $num = 15;
        $page = isset($_GET['page']) ? $_GET['page']: 1; 

        $result = mysqli_query($conn, "SELECT COUNT(*) FROM posts WHERE `block` = 0");
        $temp = mysqli_fetch_array($result);
        $posts = $temp[0]; 

        $total = intval(($posts - 1) / $num) + 1; //Барлық бет
        $page = intval($page);

        if(empty($page) or $page < 0) { header("Location: ?page=1"); }
        if($page > $total) { $page = "1"; } 
        $start = $page * $num - $num;
        $resultpost = mysqli_query($conn, "SELECT * FROM `posts` WHERE `block` = 0 ORDER BY date DESC LIMIT $start, $num");
        echo '<div class="posts">';
        while ($post =mysqli_fetch_array($resultpost)) {
            $date = realtive_date($post['date']);
            $id = $post['id'];

            $commentcount = mysqli_query($conn, "SELECT COUNT(*) FROM comments WHERE `block` = 0 AND `uri` = '$id'");
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
        echo '</div>';

        // Стрелка "<" 
        if ($page > 3) { $firstpage = '<a href= .?page=1>1</a><a class="nonactive">...</a>'; } else { $firstpage = ""; }
        // Стрелка ">" 
        if ($page < ($total-2)) { $nextpage = ' <a class="nonactive">...</a><a href= .?page=' .$total. '>'.$total.'</a>'; } else { $nextpage = ""; }

        //Солжақтағы екеуі
        if($page - 2 > 0) { $page2left = '<a href= .?page='. ($page - 2) .'>'. ($page - 2) .'</a> '; } else { $page2left = ""; }
        if($page - 1 > 0) { $page1left = '<a href= .?page='. ($page - 1) .'>'. ($page - 1) .'</a> '; } else { $page1left = ""; }

        //Оңжақтағы екеуі
        if($page + 1 <= $total) { $page2right = ' <a href= .?page='. ($page + 1) .'>'. ($page + 1) .'</a>'; } else { $page2right = ""; }
        if($page + 2 <= $total) { $page1right = ' <a href= .?page='. ($page + 2) .'>'. ($page + 2) .'</a>'; } else { $page1right = ""; }
        if ($posts > $num) {
        echo "<div class='navi'>";
        echo $firstpage.$page2left.$page1left.'<a class="active">'.$page.'</a>'.$page2right.$page1right.$nextpage; 
        echo "</div>";
        } else {
            echo "";
        }
}
function addPost () {
    if (isset($_POST['addpost'])) {
        if (admin()) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $img = $_POST['img'];
            $alt = $_POST['alt'];
            $desc = $_POST['desc'];
            $keys = $_POST['keys'];
            $type = $_POST['type'];
            $block = $_POST['block'];
            $uri = translate($title)."_".date("y")."_".date("m")."_".date("d")."_".date("H");
            $author = my2("name");;
            $uid = my2("id");

            $errors = array();
            if(empty($title)){
              $errors[] = 'Тақырып жазылмаған';
            } elseif(str_word_count($title)>255){
              $errors[] = 'Тақырып 255 сөзден асапауы қажет!';
            }
            if(empty($content)){
              $errors[] = 'Жазба жазылмаған';
            }
            if (empty($img)){
                $alt = "";
            } elseif (empty($alt)) {
                $errors[] = 'Alt жазылмаған!';
            }
            if( empty($desc)){
              $errors[] = 'Сипаттама жазылмаған!';
            }
            if(count(preg_split('/\s+/', $desc))>150){
              $errors[] = 'Сипаттама 150 сөзден асапауы қажет!';
            }
            if( empty($keys)){
              $errors[] = 'Ең кем дегенде 5 кілтсөз жазылуы керек!';
            }
            if (empty($errors)) {
                global $conn;
                $urivali = mysqli_query($conn, "SELECT * FROM `posts` WHERE `uri` = '$uri' LIMIT 1");
                $urival=mysqli_fetch_array($urivali);
                if (empty($urival)) {
                    $add = mysqli_query($conn, "INSERT INTO `posts` (`id`, `uri`, `title`, `content`, `img`, `alt`, `date`, `author`, `description`, `keywords`, `uid`, `type`, `block`, `views`) VALUES (NULL, '$uri', '$title', '$content', '$img', '$alt', NOW(), '$author', '$desc', '$keys', '$uid', '$type', $block, '0')");
                    echo '<span class="succ df"><span class="fa fa-check"></span>&nbsp;Жарияланды!&nbsp;<a class="ahref" href="post/'.$uri.'">көру</a></span>';
                } else { echo '1'; }
            } else {
                echo '<span class="err"><span class="fa fa-times"></span>&nbsp;';
                echo array_shift($errors);
                echo '</span>';
            }
        }
    }
}
function editPost () {
    if (isset($_POST['editpost'])) {
        if (admin()) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $img = $_POST['img'];
            $alt = $_POST['alt'];
            $desc = $_POST['desc'];
            $keys = $_POST['keys'];
            $type = $_POST['type'];
            $block = $_POST['block'];
            $id = $_POST['id'];

            $errors = array();
            if(empty($title)){
              $errors[] = 'Тақырып жазылмаған';
            } elseif(str_word_count($title)>255){
              $errors[] = 'Тақырып 255 сөзден асапауы қажет!';
            }
            if(empty($content)){
              $errors[] = 'Жазба жазылмаған';
            }
            if (empty($img)){
                $alt = "";
            } elseif (empty($alt)) {
                $errors[] = 'Alt жазылмаған!';
            }
            if( empty($desc)){
              $errors[] = 'Сипаттама жазылмаған!';
            }
            if(count(preg_split('/\s+/', $desc))>150){
              $errors[] = 'Сипаттама 150 сөзден асапауы қажет!';
            }
            if( empty($keys)){
              $errors[] = 'Ең кем дегенде 5 кілтсөз жазылуы керек!';
            }
            if (empty($errors)) {
                global $conn;
                $urivali = mysqli_query($conn, "SELECT * FROM `posts` WHERE `uri` = '$uri' AND `id` <> '$id'  LIMIT 1");
                $urival=mysqli_fetch_array($urivali);
                if (empty($urival)) {
                    mysqli_query($conn, "UPDATE `posts` SET `title` = '$title', `content` = '$content', `img` = '$img', `alt` = '$alt', `description` = '$desc', `keywords` = '$keys', `type` = '$type', `block` = '$block'  WHERE `posts`.`id` = '$id'");
                    echo '<span class="succ df"><span class="fa fa-check"></span>&nbsp;Жарияланды!&nbsp;<a class="ahref" href="post/'.$uri.'">көру</a></span>';
                } else { echo '1'; }
            } else {
                echo '<span class="err"><span class="fa fa-times"></span>&nbsp;';
                echo array_shift($errors);
                echo '</span>';
            }
        }
    }
}
function addOrder() {
    if (isset($_POST['addorder'])) {
        $name = $_POST['name'];
        $product = $_POST['product'];
        $link = $_POST['link'];
        $errors = array();
        if (empty($name)) {
            $errors[] = 'Аты-жөніңізді жазыңыз!';
        }
        if (empty($product)) {
            $errors[] = 'Толық толтырылмады!';
        }
        if (empty($link)) {
            $errors[] = 'Сізбен байланысатын сілтеме қалдырыңыз!';
        }
        if (empty($errors)) {
            global $conn;
            $add = mysqli_query($conn, "INSERT INTO `orders` (`id`, `name`, `product`, `link`, `date`, `block`, `readed`) VALUES (NULL, '$name', '$product', '$link', NOW(), '0', '0')");
            echo '<span class="succ"><span class="fa fa-check"></span>&nbsp;Дизайнердің байланысын күтіңіз!</span>';
        } else {
                echo '<span class="err"><span class="fa fa-times"></span>&nbsp;';
                echo array_shift($errors);
                echo '</span>';
        }
    }
}
function comment () {
    if (isset($_POST['comment'])) {
        if (admin()) {
             $name = my2('name');
        } else {
            $name = htmlspecialchars($_POST['name']);
        }
        $content = htmlspecialchars($_POST['content']);
        $id = $_POST['id'];

        $errors = array();
        if (empty($name)) {
             $errors[] = 'Аты-жөніңізді жазыңыз!';
        }
        if (empty ($content)) {
            $errors[] = 'Комментарий жазыңыз';
        } elseif(str_word_count($content)>255){
              $errors[] = '250 сөзден асапауы қажет!';
            }
        if (empty($errors)) {
            global $conn;
            setcookie("name", "$name");
            $add = mysqli_query($conn, "INSERT INTO `comments` (`id`, `uri`, `name`, `content`, `date`, `block`) VALUES (NULL, '$id', '$name', '$content', NOW(), '0')");
            echo "1";
        } else {
                echo '<span class="err"><span class="fa fa-times"></span>&nbsp;';
                echo array_shift($errors);
                echo '</span>';
        }
    }
}
function getComments() {
    if (isset($_POST['getcomment'])) {
        $uri = $_POST['uri'];

        $errors = array();
        if (empty($uri)) {
             $errors[] = 'Бұндай жазба жоқ!';
        }
        if (empty($errors)) {
            global $conn;
            $getcomments = mysqli_query($conn, "SELECT * FROM `comments` WHERE `block` = '0' AND `uri` = '$uri' ORDER BY date DESC ");
            while ($comment =mysqli_fetch_array($getcomments)) {
                if (creator()) {
                    $delete = '&nbsp;&nbsp;<span class="fa fa-trash a-date cp" onclick="deletecomment('.$comment["id"].')"></span>';
                } else { $delete = ''; }
                echo '  <div class="comment" id="comment-'.$comment["id"].'">
                            <div class="df aic">
                                <p class="c-name" onclick="answer(this)" title="Жауап беру">'.$comment["name"].'</p>&nbsp;
                                <span class="a-date">'.realtive_date($comment["date"]).'</span>'.$delete.'</div>
                            <p class="c-content">'.$comment["content"].'</p>
                        </div>';
            }
        } else {
                echo '<span class="err"><span class="fa fa-times"></span>&nbsp;';
                echo array_shift($errors);
                echo '</span>';
        }
    }
}
function getStatistics () {
    if (isset($_POST['getstatistics'])) {
        if (admin()) {
            global $conn;
            $allviews=mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`views`) AS `views` FROM `posts` WHERE `posts`.`block` = 0"));

            $countpost = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM posts WHERE `block` = 0"));
            $allposts = $countpost[0];

            $countcomment = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM comments WHERE `block` = 0"));
            $allcomments = $countcomment[0];

            $countuser = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users"));
            $allusers = $countuser[0];

            $countproduct = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM stats WHERE `block` = 0 AND type = 'price'"));
            $allproducts = $countproduct[0];

            $countorder = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM orders WHERE `block` = 0"));
            $allorders = $countorder[0];
            echo "<div class='statistic'>
                                <div class='stat'>
                                    <p>{$allviews['views']}</p>
                                    <span>Көрілім</span>
                                </div>
                                <div class='stat'>
                                    <p>{$allposts}</p>
                                    <span>Жазба</span>
                                </div>
                                <div class='stat'>
                                    <p>{$allcomments}</p>
                                    <span>Комментарий</span>
                                </div>
                                <div class='stat'>
                                    <p>{$allusers}</p>
                                    <span>Тіркелуші</span>
                                </div>
                                <div class='stat'>
                                    <p>{$allproducts}</p>
                                    <span>Тауар</span>
                                </div>
                                <div class='stat'>
                                    <p>{$allorders}</p>
                                    <span>Тапсырыс</span>
                                </div>
                            </div>";
        }
    }
}
function getStatistics2 () {
    if (isset($_POST['getstatistics2'])) {
        if (admin()) {
            global $conn;
            $allposts = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM posts WHERE `block` = 0")));
            $allcomments = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM comments WHERE `block` = 0")));
            $allorders = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM orders WHERE `block` = 0")));

            $weekposts = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM posts WHERE `block` = 0 AND date > DATE_SUB(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE()) -1) DAY) and date < DATE_ADD(CURDATE(), INTERVAL (9 - DAYOFWEEK(CURDATE())) DAY) ")));
            $weekcomments = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM comments WHERE `block` = 0 AND date > DATE_SUB(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE()) -1) DAY) and date < DATE_ADD(CURDATE(), INTERVAL (9 - DAYOFWEEK(CURDATE())) DAY) ")));
            $weekorders = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM orders WHERE `block` = 0 AND date > DATE_SUB(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE()) -1) DAY) and date < DATE_ADD(CURDATE(), INTERVAL (9 - DAYOFWEEK(CURDATE())) DAY) ")));

            $monthposts = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM posts WHERE `block` = 0 AND DATE_FORMAT(date, '%c')='".date('n')."' ")));
            $monthcomments = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM comments WHERE `block` = 0 AND DATE_FORMAT(date, '%c')='".date('n')."' ")));
            $monthorders = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM orders WHERE `block` = 0 AND DATE_FORMAT(date, '%c')='".date('n')."' ")));

            $dayposts = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM posts WHERE `block` = 0 AND DATE_FORMAT(date, '%e')='".date('j')."' ")));
            $daycomments = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM comments WHERE `block` = 0 AND DATE_FORMAT(date, '%e')='".date('j')."' ")));
            $dayorders = array_shift(mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM orders WHERE `block` = 0 AND DATE_FORMAT(date, '%e')='".date('j')."' ")));
            echo "  <div class='df jcsa fww'>
                        <div class='allstat'>
                            <p class='statp'><b>Жазба</b></p>
                            <p class='statp'>Бүгін: <b> {$dayposts}</b></p>
                            <p class='statp'>Аптада: <b> {$weekposts}</b></p>
                            <p class='statp'>Айда: <b> {$monthposts}</b></p>
                            <p class='statp'>Барлық кез: <b>{$allposts}</b></p>
                        </div>
                        <div class='allstat'>
                            <p class='statp'><b>Комментарий</b></p>
                            <p class='statp'>Бүгін: <b> {$daycomments}</b></p>
                            <p class='statp'>Аптада: <b> {$weekcomments}</b></p>
                            <p class='statp'>Айда: <b> {$monthcomments}</b></p>
                            <p class='statp'>Барлық кез: <b> {$allcomments}</b></p>
                        </div>
                        <div class='allstat'>
                            <p class='statp'><b>Тапсырыс</b></p>
                            <p class='statp'>Бүгін: <b> {$dayorders}</b></p>
                            <p class='statp'>Аптада: <b> {$weekorders}</b></p>
                            <p class='statp'>Айда: <b> {$monthorders}</b></p>
                            <p class='statp'>Барлық кез: <b> {$allorders}</b></p>
                        </div>
                    </div>";
        }
    }
}
function get10() {
    if (isset($_POST['top10'])) {
        if (admin()) {
            global $conn;
            $top10 = mysqli_query($conn, "SELECT * FROM `posts` WHERE `block` = 0 ORDER BY views DESC LIMIT 10");
            while ($post =mysqli_fetch_array($top10)) {
                $id = $post['id'];
                $commentcount = mysqli_query($conn, "SELECT COUNT(*) FROM comments WHERE `block` = 0 AND `uri` = '$id'");
                $temp2 = mysqli_fetch_array($commentcount);
                $allcomment = $temp2[0];
                echo "<div class='post-stat'>
                                    <p class='post-stat-title'><a href=''>{$post['title']}</a></p>
                                    <div class='df'>
                                        <div class='post-stat-info'><span>{$post['views']}</span><p>Көрілім</p></div>
                                        <div class='post-stat-info'><span>{$allcomment}</span><p>Комментарий</p></div>
                                    </div>
                                </div>";
            }
        }
    }
}
function deleteComment() {
    if (isset($_POST['deletecomment'])) {
        if (admin()) {
            global $conn;
            $id = $_POST['deletecomment'];
            mysqli_query($conn, "UPDATE `comments` SET `block` = '1' WHERE `comments`.`id` = '$id'");
        }
    }
}
function postupdating() {
    if (isset($_POST['deletepost'])) {
        if (admin()) {
            global $conn;
            $id = $_POST['id'];
            mysqli_query($conn, "UPDATE `posts` SET `block` = '1' WHERE `posts`.`id` = '$id'");
        }
    }
    if (isset($_POST['restorepost'])) {
        if (admin()) {
            global $conn;
            $id = $_POST['id'];
            mysqli_query($conn, "UPDATE `posts` SET `block` = '0' WHERE `posts`.`id` = '$id'");
        }
    }
}
function hashes() {
    if (isset($_POST['hashes'])) {
        if (creator()) {
            global $conn;
            $comment = mysqli_query($conn, "SELECT COUNT(*) FROM `comments` WHERE `block` = 1");
            $comments = mysqli_fetch_array($comment);

            $order = mysqli_query($conn, "SELECT COUNT(*) FROM `orders` WHERE `block` = 1");
            $orders = mysqli_fetch_array($order);

            $post = mysqli_query($conn, "SELECT COUNT(*) FROM `posts` WHERE `block` = 1");
            $posts = mysqli_fetch_array($post);

            $user = mysqli_query($conn, "SELECT COUNT(*) FROM `users` WHERE `block` = 0");
            $users = mysqli_fetch_array($user);
            echo "<p onclick='clearHash(\"comments\")'>Комментраий <b>".$comments[0]."</b></p>
                <p onclick='clearHash(\"orders\")'>Тапсырыстар <b>".$orders[0]."</b></p>
                <p onclick='clearHash(\"posts\")'>Жазбалар <b>".$posts[0]."</b></p>
                <p onclick='clearHash(\"users\")'>Админдер <b>".$users[0]."</b></p>";
            
        }
    }
}
function clearHash() {
    if (isset($_POST['clearhash'])) {
        if (creator()) {
            global $conn;
            if ($_POST['clearhash']=='users') {
                mysqli_query($conn, "DELETE FROM `".$_POST['clearhash']."` WHERE `block` = '0'");
            } else { mysqli_query($conn, "DELETE FROM `".$_POST['clearhash']."` WHERE `block` = '1'"); }
            
            echo mysqli_error($conn);
        }
    }
}
/*
    echo preg_replace('#h.+/.+/#', '', 'http://localhost/dauletstudio/post/hasdsa');

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $regexp = '#/|/#';
    $parts = preg_split($regexp, $url);
    echo end($parts); echo '<br>';


    echo $parts[count($parts)-2]; echo "<br>";
    echo $parts[count($parts)-3]; 
*/
 ?>