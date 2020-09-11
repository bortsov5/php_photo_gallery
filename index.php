<?php
require_once('submitRating.php');

$DB_Host = "localhost"; // Адрес компьютера с MySQL
$DB_User = "elitaby"; // Пользователь для доступа к базе
$DB_Pass = "8Y8aza4yrE8e8E2Y"; // Пароль для доступ
$DB_Name = "elitaby_stolica";
global $my;
$back          = "<center>Вернитесь <a href='javascript:history.back(1)'><B>назад</B></a>"; // Удобная строка
$colrubperpage = "3"; // Кол-во столбцов с фотками
$smwidth       = "150"; // Ширина миниизображения
$smheight      = "120"; // Высота миниизображения
$mainlink      = " ";
$max_file_size = "102400000"; // Максимально допустимый размер загружаемого фото
$maxwidth      = "30000"; // Ширина загружаемого изображения в пикселях не более
$maxheight     = "30000"; // Высота -||- 
$maxname       = "40"; // Максимальное кол-во символов в имени
$maxmsg        = "70"; // Максимальное кол-во символов в сообщении
$maxzag        = "100"; // Макс. кол-во символов в комментарии
$datadir       = "gallery/data"; // Каталог с фото и комментариями/оценками
$link = @mysql_connect($DB_Host, $DB_User, $DB_Pass) or die("Unable connect to MySQL server!");
mysql_select_db($DB_Name);
$valid_types = array(
    "gif",
    "jpg",
    "png",
    "jpeg"
); // допустимые расширения
$print_shapka=0;
$shapka      = '<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
  <meta http-equiv="content-type" content="text/html; charset=win-1251" /> 
  <title></title> 
</head>
<body><script language="javascript" type="text/javascript" src="gallery/js/maxrating.js"></script>';


if ($print_shapka==0)
{echo $shapka;
$print_shapka=1;
}


    echo "<div class='galleryname'>";    
    echo "<table border='0'>";
    echo "<tr>";
    echo "<td><small>Avtors: <A href='index.php'>Vse|</a>";
    //var_dump($my);
    //echo $my->username;
    $res = mysql_query("SELECT distinct Name FROM fotobase_s order by Name");

    while ($line = mysql_fetch_array($res)) {
        echo "<A href='index.php?user=" . $line[Name] . "'>" . $line[Name] . "</a>|";
    }    
    echo "</small></td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";


if (!isset($_GET['user'])) {
  $selectedUser='';
  $selUser='';
 
} else
{
$selectedUser=substr($_GET['user'], 0, 30);
$selUser= substr($_GET['user'], 0, 30); 
  echo 'Фотографии пользователя: <font size="" color="#CCFF00">'.$selectedUser.'</font><br>';
}
// Функция сортировки
function prcmp($a, $b)
{
    if ($a == $b)
        return 0;
    if ($a < $b)
        return -1;
    return 1;
}
if ($_GET['event'] == "add") { // Добавление ФОТО
}
if ($_GET['event'] == "showimg") { // показываем КРУПНОЕ ИЗОБРАЖЕНИЕ

$k=6;
if ($_GET['k'] == "1") { $k=1; }
if ($_GET['k'] == "2") { $k=2; }
if ($_GET['k'] == "3") { $k=3; }
if ($_GET['k'] == "4") { $k=4; }
if ($_GET['k'] == "5") { $k=5; }
if ($_GET['k'] == "6") { $k=6; }
if ($_GET['k'] == "7") { $k=7; }
if ($_GET['k'] == "8") { $k=8; }
if ($_GET['k'] == "9") { $k=9; }


    //Код страницы
if ($print_shapka==0)
{echo $shapka;
$print_shapka=1;
}

echo '<br><br>';


    $msnum = $_GET['msnum'];
    $msnum = trim($msnum);
    $itog  = mysql_query("SELECT COUNT(*) FROM fotobase_s");
    $pos   = mysql_fetch_row($itog);
    $maxi  = intval($pos[0]);
    $inext = mysql_query("SELECT id FROM fotobase_s where id>$msnum order by id asc");
    $pnext = mysql_fetch_row($inext);
    $next  = intval($pnext[0]);
    $iprev = mysql_query("SELECT id FROM fotobase_s where id<$msnum order by id desc");
    $pprev = mysql_fetch_row($iprev);
    $prev  = intval($pprev[0]);
    $res   = mysql_query("SELECT id, comment, Name, email, date, time,  filenamesmall, filename, size, skalex, skaley, num, numd, numk FROM fotobase_s where id=$msnum");
    while ($line = mysql_fetch_array($res)) {
        print "<center><table bgcolor='#DDDDDD' width=300><tr align=center><td>
<A href='index.php?event=showimg&msnum=$msnum&k=9'>20</a> 
<A href='index.php?event=showimg&msnum=$msnum&k=8'>30</a> 
<A href='index.php?event=showimg&msnum=$msnum&k=7'>40</a></td><td>
<A href='index.php?event=showimg&msnum=$msnum&k=6'>50</a> 
<A href='index.php?event=showimg&msnum=$msnum&k=5'>60</a> 
<A href='index.php?event=showimg&msnum=$msnum&k=4'>70</a></td><td> 
<A href='index.php?event=showimg&msnum=$msnum&k=3'>80</a> 
<A href='index.php?event=showimg&msnum=$msnum&k=2'>90</a> 
<A href='index.php?event=showimg&msnum=$msnum&k=1'>100</a></td></tr><TR align=center><TD width=70>";
        if ($prev > 0) {
            print "<A href='index.php?event=showimg&msnum=$prev'><IMG alt='Предыдущее фото' border=0 src='gallery/images/forward.gif'></A>";
        }
        print "</td><td width=90><A href='index.php'><IMG alt='Вернуться на главную' border=0 src='gallery/images/back.gif'></A></td><td width=80>";
        if ($next > $msnum) {
            print "<A href='index.php?event=showimg&msnum=$next'><IMG alt='Следующее фото' border=0 src='gallery/images/next.gif'></A>";
        }
        print "</td></tr></table></td></tr></table></center>";
        print "<table border=0 width=100% height=93%><tr align=center valign=middle><td>";
        print "<img src='gallery/imrun.php?id=$line[filename]&k=$k' border=0></td></tr></table>";
        $ok = "1";
        print "<center><table width=300><TR align=center><TD width=70>";
        if ($prev > 0) {
            print "<A href='index.php?event=showimg&msnum=$prev'><IMG alt='Предыдущее фото' border=0 src='gallery/images/forward.gif'></A>";
        }
        print "</td><td width=90><A href='index.php'><IMG alt='Вернуться на главную' border=0 src='gallery/images/back.gif'></A></td><td width=80>";
        if ($next > $msnum) {
            print "<A href='index.php?event=showimg&msnum=$next'><IMG alt='Следующее фото' border=0 src='gallery/images/next.gif'></A>";
        }
        print "</td></tr></table></td></tr></table></center>";
    }
    if (!isset($ok)) {
        exit("$back. Данное изображение отсутствует в фотогалерее. Возможно, его удалил администратор!");
    }


 echo '</body>';
 echo '</html>';
    exit;
}
//==================Загрузка
if ($_GET['event'] == "add") { // Добавление ФОТО
    $dop  = date("m.d.y.h.mm.ss");
    $date = date("m.d.y");
    $time = date("h.mm");
    if (isset($_POST['name']) & isset($_POST['msg']) & isset($_POST['email'])) {
        $name  = $_POST['name'];
        $msg   = $_POST['msg'];
        $email = $_POST['email'];
    } else {
        return 0;
    }
    $name  = trim($name);
    $msg   = trim($msg);
    $email = trim($email); // Вырезаем ПРОБЕЛьные символы
    if ($name == "" or strlen($name) > $maxname) {
        if ($print_shapka==0)
        {echo $shapka;
        $print_shapka=1;
        }
        print " $back ваше имя (" . $name . ") или пустое, или превышает $maxname символов!</B></center>";
        return 0;
    }
    if ($msg == "" || strlen($msg) > $maxmsg) {
        if ($print_shapka==0)
        {echo $shapka;
        $print_shapka=1;
        }

        print " $back ваше сообщение или пустое или превышает $maxmsg символов.</B></center>";
        return 0;
    }
    if (!eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $email) and strlen($email) > 30 and $email !== "") {
        if ($print_shapka==0)
        {echo $shapka;
        $print_shapka=1;
        }
        print " $back и введите корректный E-mail адрес!</B></center>";
        return 0;
    }
    $fotoname = $_FILES['file']['name']; // определяем имя файла
    $fotosize = $_FILES['file']['size']; // Запоминаем размер файла
    // проверяем расширение файла
    $ext      = strtolower(substr($fotoname, 1 + strrpos($fotoname, ".")));
    if (!in_array($ext, $valid_types)) {
        echo '<B>ФАЙЛ НЕ загружен.</B> Возможные причины:<BR>
- разрешена загрузка только файлов с такими расширениями: gif, jpg, jpeg, png<BR>
- Вы пытаетесь загрузить не графический файл;<BR>
- неверно введён адрес или выбран файл;</B><BR>';
        exit;
    }
    // 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
    $findtchka = substr_count($fotoname, ".");
    if ($findtchka > 1) {
        echo "ТОЧКА встречается в имени файла $findtchka раз(а). Это ЗАПРЕЩЕНО! <BR>\r\n";
    }
    // 2. если в имени есть .php, .html, .htm - свободен! 
    $bago = "Извините. В имени ФАйла <B>запрещено</B> использовать .php, .html, .htm";
    if (preg_match("/\.php/i", $fotoname)) {
        echo "Вхождение <B>\".php\"</B> найдено. $bago";
        return 0;
    }
    if (preg_match("/\.html/i", $fotoname)) {
        echo "Вхождение <B>\".html\"</B> найдено. $bago";
        return 0;
    }
    if (preg_match("/\.htm/i", $fotoname)) {
        echo "Вхождение <B>\".htm\"</B> найдено. $bago";
        return 0;
    }
    // 3. защищаем от РУССКИХ букв в имени файла и проверяем расширение файла 
    if (!preg_match("/^[a-z0-9\.\-_]+\.(jpg|gif|png|)+$/is", $fotoname)) {
        print "Запрещено использовать РУССКИЕ буквы в имени файла!";
        return 0;
    }
    // 4. Проверяем, может быть файл с таким именем уже есть на сервере
    if (file_exists("$datadir/$dop$fotoname")) {
        print "Файл с таким именем уже существует на сервере! Измените имя на другое! ";
        print "<br>" . $back;
        return 0;
    }
    // Конец защит по имени файла
    // 5. Размер фото
    $fotoksize = round($fotosize / 10.24) / 100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
    if ($email == "admin@elita.by") {
        $max_file_size = 92160000;
    }
    $fotomax = round($max_file_size / 10.24) / 100; // максимальный размер фото в Кб.
    if ($fotoksize > $fotomax) {
        print "Вы превысили допустимый размер фото! <BR><B>Максимально допустимый</B> размер фото: <B>$fotomax </B>Кб.<BR> <B>Вы пытаетесь</B> загрузить изображение: <B>$fotoksize</B> Кб!";
        print $back;
        return 0;
    }
    // 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
    if ($email == "admin@elita.by") {
        $maxwidth  = 10000000;
        $maxheight = 10000000;
    }
   // SetCookie("f_name", $name);
   // SetCookie("f_msg", $msg);
   // SetCookie("f_email", $email);
    $size = getimagesize($_FILES['file']['tmp_name']);
    if ($size[0] > $maxwidth or $size[1] > $maxheight) {
        print "$size[0] x $size[1] - не допустимые габариты фото. Допустимо лишь $maxwidth х $maxheight px!";
        return 0;
    }
    if ($fotosize > "0" and $fotosize < $max_file_size) {
        copy($_FILES['file']['tmp_name'], $datadir . "/" . $dop . "" . $fotoname);
        print "<br><br>Фото УСПЕШНО загружено: $fotoname (Размер: $fotosize байт)";
    } else {
        print "<B>Файл НЕ ЗАГРУЖЕН - ошибка СЕРВЕРА! Обратитесь к администратору!<B>";
        return 0;
    }
    $size = getimagesize("$datadir/$dop$fotoname");
    // Проверяем размер фото. Если "габариты" меньше заданный в админке 150 х 120 - то ничего с ним не делаем
    // блок делает мальное изображение исходной фотки - в качестве превьюшки
    if ($size[0] > $smwidth or $size[1] > $smheight) {
        $smallfoto = "sm-$fotoname";
        require('gallery/tumbmaker.php');
        if (img_resize("$datadir/$dop$fotoname", "$datadir/$dop$smallfoto", $smwidth, $smheight))
            echo 'Изображение масштабировано <B>успешно</B>.';
        else
            echo '<font color=red><B>Ошибка МАСШАБИРОВАНИЯ фото! Поблемы с GD-библиотекой!</B></font> Обратитесь к Администратору';
    } else {
        $smallfoto = "$dop$fotoname";
    }
    // Генерируем рандомный КЛЮЧ - msnum-фото 
    $z = 1;
    do {
        $key = mt_rand(10000, 99999);
        if (strlen($key) == 5) {
            $z++;
        }
    } while ($z < 1);
    $res = mysql_query("INSERT INTO fotobase_s (comment, Name, email, date, time,  filenamesmall, filename, size, skalex, skaley, num, numd, numk, vid) VALUES (
 \"" . $msg . "\",
 \"" . $name . "\",
 \"" . $email . "\",
 \"" . $date . "\",
 \"" . $time . "\",
 \"" . $dop . "" . $smallfoto . "\",
 \"" . $dop . "" . $fotoname . "\",
 \"" . $fotoksize . "\",
 \"" . $size[0] . "\",
 \"" . $size[1] . "\",
 \"" . $key . "\",
 \"0\",
 \"-1\",
 \"0\" )");
    if ($sendmail == "1") { // отправка СООБЩЕНИЯ админу и на мыло
        $headers = null;
        $headers .= "Content-Type: text/plain; charset=windows-1251\r\n";
        $headers .= "From: " . $name . " <" . $email . ">\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $host   = $_SERVER["HTTP_HOST"];
        $self   = $_SERVER["PHP_SELF"];
        $glurl  = "http://$host$self";
        $allmsg = $glname . chr(13) . chr(10) . 'Загружено новое изображение: ' . $glurl . chr(13) . chr(10) . 'Имя: ' . $name . chr(13) . chr(10) . 'E-mail: ' . $email . chr(13) . chr(10) . 'Сообщение: ' . $msg . chr(13) . chr(10);
        mail("$adminemail", "$glname (сообщение)", $allmsg, $headers);
    }
    //  закачиваем прикреплённый файл на сервер
    if (isset($_POST['file'])) {
        if (!copy($file, $file . '.bak')) {
            print("при копировании файла $file произошла ошибка...<br>\n");
        }
    }

if ($print_shapka==0)
{echo $shapka;
$print_shapka=1;
}
    print " <script language='Javascript'>function reload() {location = 'index.php?event=addform'}; setTimeout('reload()', 4000);</script>
<BR><BR><BR><center><table border=1 cellpadding=7 cellspacing=0 bordercolor=#224488 width=350><tr><td><center>
Спасибо <B>$name</B>, Ваше фото успешно добавлено. Фото ожидает проверки администратором. Через несколько секунд Вы будете перемещены на форму добавления фотографий.
Если этого не происходит, то для возврата нажмите <B><a href='index.php'> здесь</a></B><br>
<B><a href='index.php?event=addform'>В фотогалерею</a></B>
 </td></tr></table></center><BR><BR><BR>";
    return 0;
}
//===================загрузка конец
if ($_GET['event'] == "addform") { // Выводим ФОРМУ ДЛЯ ЗАГРУЗКИ ФОТКИ
    
    $f_name  = 'anonim'; //$_COOKIE["f_name"];
    $f_msg   = 'Sea Beach Resort & Aqua Park  / Египет / Шарм-Эль-Шейх / Набк Бей';
    $f_email = 'admin@elitcomplex.by'; //$_COOKIE["f_email"];
    $fotomax = round($max_file_size / 10.24) / 100; // максимальный размер фото в Кб.
if ($print_shapka==0)
{echo $shapka;
$print_shapka=1;
}    
print " <BR><BR><form action='index.php?event=add' method=post name=form enctype=\"multipart/form-data\">
<table border=0 class=bakfon align=center cellpadding=2 cellspacing=1><TBODY>
<tr class=toptable><td colspan=3 align=center height=25><font style='font-size: 13px'><b>Добавление ФОТО</b></td></tr>
<tr class=row2><td>Имя</td><TD colspan=2><input type=text value='" . $f_name . "' class=maininput style='FONT-SIZE: 14px; WIDTH: 350px' name=name size=30 maxlength=$maxname></TD></tr>
<tr class=row1><td>Е-майл</td><TD colspan=2>" . $f_email . "<input type=hidden value='" . $f_email . "' name=email size=26 maxlength=$maxname class=maininput style='FONT-SIZE: 14px; WIDTH: 350px'></td></tr>
<tr class=row2><td>Прикрепить <B>фото</B></td><TD colspan=2><input type=file name=file size=48 class=maininput style='FONT-SIZE: 14px; WIDTH: 350px'></TD></tr>
<TR class=row1 height=25><TD colspan=3><font color=red>*</font> <B>Максимально</B> разрешённый <B>размер фото: $fotomax</B> Кб.</br></TD></TR>
<tr class=row2><td><B>Подпись</B> к фото</td><TD colspan=2><textarea cols=51 rows=4 size=500 name=msg maxlength=$maxmsg class=maininput style='FONT-SIZE: 14px; WIDTH: 350px'>" . $f_msg . "</textarea></TD></tr>
<tr class=row1><td colspan=3 align=center><BR><input type=submit class=longok style='FONT-SIZE: 13px;' value='Добавить'></form></td></tr>
</table></td></tr></table><BR><BR><a href='index.php'>В фотогалерею</a>"; //exit; 
    return 0;
} else {
  
  
 //Текущий выбор
if ($_GET['KeyKat']<>'')
 {$tekKey=intval($_GET['KeyKat']);} else
 {
  if ($_POST['KeyKat']<>'')
    {$tekKey=intval($_POST['KeyKat']);} else 
    {$tekKey=0;}
 } 
  
  
      if ($tekKey>0)    {
      $selKey=' and kat='.$tekKey.' ';
     } else {
      $selKey=' ';
    }
  
    ///Главная
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "1";
    }
    if ($page == "0" or $page == "") {
        $page = "1";
    } //else {$page=abs($page);}
    if (!ctype_digit($page)) {
        print "Попытка взлома! Страница может только быть цифрой!";
        return 0;
    }
    $type = 0;
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        if (!ctype_digit($type) or strlen($type) > 2) {
            exit("<B>$back. Попытка взлома. Хакерам здесь не место.</B>");
        }
    }
    $qq   = 6;
    // Выводим qq фото на текущей странице

    if ($selectedUser<>'') {
      $selectedUser=" and Name='".$selectedUser."'";
    }

    $SQLZapros="SELECT COUNT(*) FROM fotobase_s where 1=1 ".$selKey." ".$selectedUser;
    //echo $SQLZapros;
    $itog = mysql_query($SQLZapros);
    $pos  = mysql_fetch_row($itog);
    $maxi = intval($pos[0]);
    if (($maxi) / 9 > round(($maxi) / 9)) {
        $maxpage = round(($maxi) / 9) + 1;
        if ($page > $maxpage) {
            $page = $maxpage;
        }
    } else {
        $maxpage = round(($maxi) / 9);
        if ($page > $maxpage) {
            $page = $maxpage;
        }
    }
    if ($_GET['st'] == "2") {
        $st = 2;
    } else {
        $st = 1;
    }
  

    ///========= навигация
    print "<center><small><font size=-1>Страницы:&nbsp; "; // выводим СПИСОК СТРАНИЦ ВВЕРХУ
    if ($page >= 4 and $maxpage > 5)
        print "<a href=index.php?page=1&type=$type&st=$st&user=$selUser>1</a> ... ";
    $f1 = $page + 2;
    $f2 = $page - 2;
    if ($page == 1) {
        $f1 = $page + 4;
        $f2 = $page;
    }
    if ($page == 2) {
        $f1 = $page + 3;
        $f2 = $page - 1;
    }
    if ($page == $maxpage) {
        $f1 = $page;
        $f2 = $page - 4;
    }
    if ($page == $maxpage - 1) {
        $f1 = $page + 1;
        $f2 = $page - 3;
    }
    if ($maxpage < 4) {
        $f1 = $maxpage;
        $f2 = 1;
    }
    for ($i = $f2; $i <= $f1; $i++) {
        if ($page == $i) {
            print "<B>$i</B> &nbsp;";
        } else {
            print "<a href=index.php?page=$i&type=$type&st=$st&user=$selUser>$i</a> &nbsp;";
        }
    }
    if ($page <= $maxpage - 3 and $maxpage > 5) {
        print "... <a href=index.php?page=$maxpage&type=$type&st=$st&user=$selUser>$maxpage</a>";
        print "</font></small>";
    }
    $itogofoto = $maxi;
    print "<BR><BR><small>Всего фото: <B>$itogofoto</B></small>";
    // if ($maxi>=0)
    //========== навигация
    //   $t21<a href=\"index.php?page=$page&type=2\">кол-ву комментариев</a>$t22|
    print "<small>
<center>$t01<a href=\"index.php\">без сортировки</a>$t02 |
   $t11<a href=\"index.php?page=$page&type=1&st=" . $st . "\">рейтингу</a>$t12|
   $t31<a href=\"index.php?page=$page&type=3&st=" . $st . "\">дате загрузки</a>$t32|
   $t41<a href=\"index.php?page=$page&type=4&st=" . $st . "\">разрешению</a>$t42|
   $t51<a href=\"index.php?page=$page&type=5&st=" . $st . "\">размеру в байтах</a>$t52|
   $t51<div class='galleryname'><a href=\"index.php?event=addform\"><b>>>> Добавить фото <<<</b></A></div></small>
</center>

 
      
<table border=0 width=100% align=center>      
      <tr valign='top'>
        <td width='220'>";
      //Тут будут категории
     //------------------------------------------К- 
  
  

  

  if ($my->username == 'admin') {
  //Добавление категории
  if ($_GET['addkey']==1) {
  
    if ($_POST['NameNew']<>'')
    {
    $res=mysql_query("INSERT INTO elitaby_www.jos_fotobase_category(Name, PARENT_ID, VIS) VALUES (\"". mysql_real_escape_string($_POST['NameNew']) ."\",\"". $tekKey ."\",1)");    
    }
    
  echo "<FORM METHOD=POST ACTION='index.php?KeyKat=".$tekKey."&addkey=1'>";        
    echo "<INPUT TYPE=HIDDEN NAME='KeyKat' VALUE='".$tekKey."'>
    <INPUT NAME='NameNew' maxlength='80' VALUE=''><br>
    <INPUT TYPE=SUBMIT class='button' VALUE='Добавить'></center>
    </form> ";
  }
  
  echo "<br><A class='link_small_black' HREF=index.php?KeyKat=".$tekKey."&addkey=1>Добавление категории</a></center>";
  echo "<center>В категории <b>".$tov."</b> тов. </center>";
  }
    
    
     $res=mysql_query("SELECT ID, Name, PARENT_ID, VIS FROM elitaby_www.jos_fotobase_category where PARENT_ID=0")  or die("Запрос обломался: " . mysql_error());
     $newArr = array();
    
    while ($r = mysql_fetch_assoc($res)) //засунем выборку в массив
        {
        $newArr[] = $r;
    }
  
    echo " <ul>";
     for ($i = 0; $i <= count($newArr)-1; $i++) {
       //     echo "<li><A HREF=index.php?KeyKat=".$newArr[$i][ID].">".$newArr[$i][Name]."</a></li>";  
     }
    echo "</ul>";
  
     //-----------------------------------------К--
      
 print "</td><td>
              
      
<table border=0 width=730 align=center cellpadding=0 cellspacing=15><TR align=center>";
    $sort = 'id';
    if ($type == "1") {
        $sort = 'numd';
    }
    //if ($type=="2") {$sort='numd';}
    if ($type == "3") {
        $sort = 'date';
    }
    if ($type == "4") {
        $sort = 'skalex';
    }
    if ($type == "5") {
        $sort = 'size';
    }
    if ($st == "2") {
        $stt = " desc";
    } else {
        $stt = " asc";
    }
    $lims   = ($page * $colrubperpage * 3) - 9;
    $limf   = 9;
    $Nom    = "0";
    $LinNom = "0";
  
    if ($tekKey>0)
    {
      $selKey=' and kat='.$tekKey.' ';
     } else {
      $selKey=' ';
    }
    
  
    $resSql="SELECT id, comment, Name, email, date, time,  filenamesmall, filename, size, skalex, skaley, num, numd, numk FROM fotobase_s where 1=1 ".$selectedUser." ".$selKey." order by $sort $stt LIMIT $lims,$limf";
    $res    = mysql_query($resSql) ;
  
     
  
    while ($line = mysql_fetch_array($res)) {
        //=====================цикл
        $Nom++;
        $LinNom++;
        print "<td>
<table width=180 cellpadding=1 cellspacing=8 class=maintbl><tr><td>
<table width=180 height=270 cellpadding=1 cellspacing=0 class=seredina><tr><td valign=top align=center>
<font size=-1>Фото № $line[id]</font><BR>
<table width=180 height=210 cellpadding=1 cellspacing=0><tr><td align=center height=120 colspan=2><a href='index.php?event=showimg&msnum=$line[id]'><img src='gallery/data/$line[filenamesmall]' alt='$line[comment]' border=0></a></td></tr>
<TR height=25><TD colspan=2 align=center>$line[comment]<BR></td></tr>
<TR height=25><TD colspan=2 align=center><small>Разрешение: <B>$line[skalex] х $line[skaley]</B></small><BR></td></tr>
<TR height=25><TD colspan=2 align=center><small>Размер: <B>$line[size]</B> Кб.</small><BR>";
       // echo "Рейтинг: ";
       // echo $handler->displayRateValue($line[filenamesmall]);
       // echo "<br>";
       // $handler->displayRating($line[filenamesmall], 5);
       // echo "<br>";
       // echo "Голосовало: ";
       // echo $handler->displayTotalNumberOfRatings($line[filenamesmall]);
        echo "
<br>
</td></tr>";
        //if (is_file("$datadir/$msnum.dat"))  {
        //$rlines=file("$datadir/$msnum.dat"); $ri=count($rlines); $bals=0; $all=0;
        //print"<TR><TD colspan=2 align=center>Комментарии [<B><a href='index.php?event=coment&msnum=$msnum'> $ri //</a></B>]</TD></TR>";
        //do {$ri--; $edt=explode("|",$rlines[$ri]); $edt[3]=date("d.m.Y H:i:s",$edt[3]); if ($edt[4]!=0) {$bals=$bals+$edt[4]; $all++;} else {$edt[4]="-";} } while($ri>0);
        //if ($bals==0) {$itogobals="+</B>";} else {$itogobals=round($bals*10/$all)/10; $itogobals.="</B>";}
        //print "<TR><TD colspan=2 align=center>Оценка [<B><a href='addmsg.php?msnum=$msnum'>$itogobals</a>]</TD></TR>";
        //} else {print"<TR><TD colspan=2 align=center>Комментарии [ <B><a href='addmsg.php?msnum=$msnum'>+</a></B> ]</TD></TR>
        //<TR><TD colspan=2 align=center>Оценка [<B><a href='addmsg.php?msnum=$msnum'>+</a></B>]</TD></TR>
        //";}
        print "<TR height=30><TD><b><a href=mailto:$line[email]>$dt[1]</a></b></TD><TD align=right></td></tr>
</table>
</td></tr></table>
</td></tr></table>
</td>";
        // додумать!   // ДЕЛИМ ВСЕ РУБРИКИ на столбцы
        if ($LinNom == 3) {
            print "</TR><TR>";
        }
        if ($LinNom >= 3) {
            $LinNom = "0";
        }
        //if ($msginout=="1") {$whm=$Nom; $whe=$lm;} else {$whm=$lm; $whe=$Nom;}
    }
    print "</table>";
    //======================цикл кон
    //$lines=file($datafile); 
    //$maxi = count($lines)-1;
    //$maxpage=ceil(($maxi+1)/$qq); if ($page>$maxpage) {$page=$maxpage;}
} //конец главной
print "</td></tr></table>";
echo "</td><tr></table>";
  ?>


&#8203;

</body>
</html>