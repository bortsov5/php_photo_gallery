<?php
require_once('submitRating.php');

$DB_Host = "localhost"; // ����� ���������� � MySQL
$DB_User = "elitaby"; // ������������ ��� ������� � ����
$DB_Pass = "8Y8aza4yrE8e8E2Y"; // ������ ��� ������
$DB_Name = "elitaby_stolica";
global $my;
$back          = "<center>��������� <a href='javascript:history.back(1)'><B>�����</B></a>"; // ������� ������
$colrubperpage = "3"; // ���-�� �������� � �������
$smwidth       = "150"; // ������ ���������������
$smheight      = "120"; // ������ ���������������
$mainlink      = " ";
$max_file_size = "102400000"; // ����������� ���������� ������ ������������ ����
$maxwidth      = "30000"; // ������ ������������ ����������� � �������� �� �����
$maxheight     = "30000"; // ������ -||- 
$maxname       = "40"; // ������������ ���-�� �������� � �����
$maxmsg        = "70"; // ������������ ���-�� �������� � ���������
$maxzag        = "100"; // ����. ���-�� �������� � �����������
$datadir       = "gallery/data"; // ������� � ���� � �������������/��������
$link = @mysql_connect($DB_Host, $DB_User, $DB_Pass) or die("Unable connect to MySQL server!");
mysql_select_db($DB_Name);
$valid_types = array(
    "gif",
    "jpg",
    "png",
    "jpeg"
); // ���������� ����������
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
  echo '���������� ������������: <font size="" color="#CCFF00">'.$selectedUser.'</font><br>';
}
// ������� ����������
function prcmp($a, $b)
{
    if ($a == $b)
        return 0;
    if ($a < $b)
        return -1;
    return 1;
}
if ($_GET['event'] == "add") { // ���������� ����
}
if ($_GET['event'] == "showimg") { // ���������� ������� �����������

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


    //��� ��������
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
            print "<A href='index.php?event=showimg&msnum=$prev'><IMG alt='���������� ����' border=0 src='gallery/images/forward.gif'></A>";
        }
        print "</td><td width=90><A href='index.php'><IMG alt='��������� �� �������' border=0 src='gallery/images/back.gif'></A></td><td width=80>";
        if ($next > $msnum) {
            print "<A href='index.php?event=showimg&msnum=$next'><IMG alt='��������� ����' border=0 src='gallery/images/next.gif'></A>";
        }
        print "</td></tr></table></td></tr></table></center>";
        print "<table border=0 width=100% height=93%><tr align=center valign=middle><td>";
        print "<img src='gallery/imrun.php?id=$line[filename]&k=$k' border=0></td></tr></table>";
        $ok = "1";
        print "<center><table width=300><TR align=center><TD width=70>";
        if ($prev > 0) {
            print "<A href='index.php?event=showimg&msnum=$prev'><IMG alt='���������� ����' border=0 src='gallery/images/forward.gif'></A>";
        }
        print "</td><td width=90><A href='index.php'><IMG alt='��������� �� �������' border=0 src='gallery/images/back.gif'></A></td><td width=80>";
        if ($next > $msnum) {
            print "<A href='index.php?event=showimg&msnum=$next'><IMG alt='��������� ����' border=0 src='gallery/images/next.gif'></A>";
        }
        print "</td></tr></table></td></tr></table></center>";
    }
    if (!isset($ok)) {
        exit("$back. ������ ����������� ����������� � �����������. ��������, ��� ������ �������������!");
    }


 echo '</body>';
 echo '</html>';
    exit;
}
//==================��������
if ($_GET['event'] == "add") { // ���������� ����
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
    $email = trim($email); // �������� ���������� �������
    if ($name == "" or strlen($name) > $maxname) {
        if ($print_shapka==0)
        {echo $shapka;
        $print_shapka=1;
        }
        print " $back ���� ��� (" . $name . ") ��� ������, ��� ��������� $maxname ��������!</B></center>";
        return 0;
    }
    if ($msg == "" || strlen($msg) > $maxmsg) {
        if ($print_shapka==0)
        {echo $shapka;
        $print_shapka=1;
        }

        print " $back ���� ��������� ��� ������ ��� ��������� $maxmsg ��������.</B></center>";
        return 0;
    }
    if (!eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $email) and strlen($email) > 30 and $email !== "") {
        if ($print_shapka==0)
        {echo $shapka;
        $print_shapka=1;
        }
        print " $back � ������� ���������� E-mail �����!</B></center>";
        return 0;
    }
    $fotoname = $_FILES['file']['name']; // ���������� ��� �����
    $fotosize = $_FILES['file']['size']; // ���������� ������ �����
    // ��������� ���������� �����
    $ext      = strtolower(substr($fotoname, 1 + strrpos($fotoname, ".")));
    if (!in_array($ext, $valid_types)) {
        echo '<B>���� �� ��������.</B> ��������� �������:<BR>
- ��������� �������� ������ ������ � ������ ������������: gif, jpg, jpeg, png<BR>
- �� ��������� ��������� �� ����������� ����;<BR>
- ������� ����� ����� ��� ������ ����;</B><BR>';
        exit;
    }
    // 1. ������� ���-�� ����� � ��������� - ���� ������� ����� - ��������!
    $findtchka = substr_count($fotoname, ".");
    if ($findtchka > 1) {
        echo "����� ����������� � ����� ����� $findtchka ���(�). ��� ���������! <BR>\r\n";
    }
    // 2. ���� � ����� ���� .php, .html, .htm - ��������! 
    $bago = "��������. � ����� ����� <B>���������</B> ������������ .php, .html, .htm";
    if (preg_match("/\.php/i", $fotoname)) {
        echo "��������� <B>\".php\"</B> �������. $bago";
        return 0;
    }
    if (preg_match("/\.html/i", $fotoname)) {
        echo "��������� <B>\".html\"</B> �������. $bago";
        return 0;
    }
    if (preg_match("/\.htm/i", $fotoname)) {
        echo "��������� <B>\".htm\"</B> �������. $bago";
        return 0;
    }
    // 3. �������� �� ������� ���� � ����� ����� � ��������� ���������� ����� 
    if (!preg_match("/^[a-z0-9\.\-_]+\.(jpg|gif|png|)+$/is", $fotoname)) {
        print "��������� ������������ ������� ����� � ����� �����!";
        return 0;
    }
    // 4. ���������, ����� ���� ���� � ����� ������ ��� ���� �� �������
    if (file_exists("$datadir/$dop$fotoname")) {
        print "���� � ����� ������ ��� ���������� �� �������! �������� ��� �� ������! ";
        print "<br>" . $back;
        return 0;
    }
    // ����� ����� �� ����� �����
    // 5. ������ ����
    $fotoksize = round($fotosize / 10.24) / 100; // ������ ������������ ���� � ��.
    if ($email == "admin@elita.by") {
        $max_file_size = 92160000;
    }
    $fotomax = round($max_file_size / 10.24) / 100; // ������������ ������ ���� � ��.
    if ($fotoksize > $fotomax) {
        print "�� ��������� ���������� ������ ����! <BR><B>����������� ����������</B> ������ ����: <B>$fotomax </B>��.<BR> <B>�� ���������</B> ��������� �����������: <B>$fotoksize</B> ��!";
        print $back;
        return 0;
    }
    // 6. "��������" ���� > $maxwidth � $maxheight - �� ��������! :-)
    if ($email == "admin@elita.by") {
        $maxwidth  = 10000000;
        $maxheight = 10000000;
    }
   // SetCookie("f_name", $name);
   // SetCookie("f_msg", $msg);
   // SetCookie("f_email", $email);
    $size = getimagesize($_FILES['file']['tmp_name']);
    if ($size[0] > $maxwidth or $size[1] > $maxheight) {
        print "$size[0] x $size[1] - �� ���������� �������� ����. ��������� ���� $maxwidth � $maxheight px!";
        return 0;
    }
    if ($fotosize > "0" and $fotosize < $max_file_size) {
        copy($_FILES['file']['tmp_name'], $datadir . "/" . $dop . "" . $fotoname);
        print "<br><br>���� ������� ���������: $fotoname (������: $fotosize ����)";
    } else {
        print "<B>���� �� �������� - ������ �������! ���������� � ��������������!<B>";
        return 0;
    }
    $size = getimagesize("$datadir/$dop$fotoname");
    // ��������� ������ ����. ���� "��������" ������ �������� � ������� 150 � 120 - �� ������ � ��� �� ������
    // ���� ������ ������� ����������� �������� ����� - � �������� ���������
    if ($size[0] > $smwidth or $size[1] > $smheight) {
        $smallfoto = "sm-$fotoname";
        require('gallery/tumbmaker.php');
        if (img_resize("$datadir/$dop$fotoname", "$datadir/$dop$smallfoto", $smwidth, $smheight))
            echo '����������� �������������� <B>�������</B>.';
        else
            echo '<font color=red><B>������ �������������� ����! ������� � GD-�����������!</B></font> ���������� � ��������������';
    } else {
        $smallfoto = "$dop$fotoname";
    }
    // ���������� ��������� ���� - msnum-���� 
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
    if ($sendmail == "1") { // �������� ��������� ������ � �� ����
        $headers = null;
        $headers .= "Content-Type: text/plain; charset=windows-1251\r\n";
        $headers .= "From: " . $name . " <" . $email . ">\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $host   = $_SERVER["HTTP_HOST"];
        $self   = $_SERVER["PHP_SELF"];
        $glurl  = "http://$host$self";
        $allmsg = $glname . chr(13) . chr(10) . '��������� ����� �����������: ' . $glurl . chr(13) . chr(10) . '���: ' . $name . chr(13) . chr(10) . 'E-mail: ' . $email . chr(13) . chr(10) . '���������: ' . $msg . chr(13) . chr(10);
        mail("$adminemail", "$glname (���������)", $allmsg, $headers);
    }
    //  ���������� ������������ ���� �� ������
    if (isset($_POST['file'])) {
        if (!copy($file, $file . '.bak')) {
            print("��� ����������� ����� $file ��������� ������...<br>\n");
        }
    }

if ($print_shapka==0)
{echo $shapka;
$print_shapka=1;
}
    print " <script language='Javascript'>function reload() {location = 'index.php?event=addform'}; setTimeout('reload()', 4000);</script>
<BR><BR><BR><center><table border=1 cellpadding=7 cellspacing=0 bordercolor=#224488 width=350><tr><td><center>
������� <B>$name</B>, ���� ���� ������� ���������. ���� ������� �������� ���������������. ����� ��������� ������ �� ������ ���������� �� ����� ���������� ����������.
���� ����� �� ����������, �� ��� �������� ������� <B><a href='index.php'> �����</a></B><br>
<B><a href='index.php?event=addform'>� �����������</a></B>
 </td></tr></table></center><BR><BR><BR>";
    return 0;
}
//===================�������� �����
if ($_GET['event'] == "addform") { // ������� ����� ��� �������� �����
    
    $f_name  = 'anonim'; //$_COOKIE["f_name"];
    $f_msg   = 'Sea Beach Resort & Aqua Park  / ������ / ����-���-���� / ���� ���';
    $f_email = 'admin@elitcomplex.by'; //$_COOKIE["f_email"];
    $fotomax = round($max_file_size / 10.24) / 100; // ������������ ������ ���� � ��.
if ($print_shapka==0)
{echo $shapka;
$print_shapka=1;
}    
print " <BR><BR><form action='index.php?event=add' method=post name=form enctype=\"multipart/form-data\">
<table border=0 class=bakfon align=center cellpadding=2 cellspacing=1><TBODY>
<tr class=toptable><td colspan=3 align=center height=25><font style='font-size: 13px'><b>���������� ����</b></td></tr>
<tr class=row2><td>���</td><TD colspan=2><input type=text value='" . $f_name . "' class=maininput style='FONT-SIZE: 14px; WIDTH: 350px' name=name size=30 maxlength=$maxname></TD></tr>
<tr class=row1><td>�-����</td><TD colspan=2>" . $f_email . "<input type=hidden value='" . $f_email . "' name=email size=26 maxlength=$maxname class=maininput style='FONT-SIZE: 14px; WIDTH: 350px'></td></tr>
<tr class=row2><td>���������� <B>����</B></td><TD colspan=2><input type=file name=file size=48 class=maininput style='FONT-SIZE: 14px; WIDTH: 350px'></TD></tr>
<TR class=row1 height=25><TD colspan=3><font color=red>*</font> <B>�����������</B> ����������� <B>������ ����: $fotomax</B> ��.</br></TD></TR>
<tr class=row2><td><B>�������</B> � ����</td><TD colspan=2><textarea cols=51 rows=4 size=500 name=msg maxlength=$maxmsg class=maininput style='FONT-SIZE: 14px; WIDTH: 350px'>" . $f_msg . "</textarea></TD></tr>
<tr class=row1><td colspan=3 align=center><BR><input type=submit class=longok style='FONT-SIZE: 13px;' value='��������'></form></td></tr>
</table></td></tr></table><BR><BR><a href='index.php'>� �����������</a>"; //exit; 
    return 0;
} else {
  
  
 //������� �����
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
  
    ///�������
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "1";
    }
    if ($page == "0" or $page == "") {
        $page = "1";
    } //else {$page=abs($page);}
    if (!ctype_digit($page)) {
        print "������� ������! �������� ����� ������ ���� ������!";
        return 0;
    }
    $type = 0;
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        if (!ctype_digit($type) or strlen($type) > 2) {
            exit("<B>$back. ������� ������. ������� ����� �� �����.</B>");
        }
    }
    $qq   = 6;
    // ������� qq ���� �� ������� ��������

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
  

    ///========= ���������
    print "<center><small><font size=-1>��������:&nbsp; "; // ������� ������ ������� ������
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
    print "<BR><BR><small>����� ����: <B>$itogofoto</B></small>";
    // if ($maxi>=0)
    //========== ���������
    //   $t21<a href=\"index.php?page=$page&type=2\">���-�� ������������</a>$t22|
    print "<small>
<center>$t01<a href=\"index.php\">��� ����������</a>$t02 |
   $t11<a href=\"index.php?page=$page&type=1&st=" . $st . "\">��������</a>$t12|
   $t31<a href=\"index.php?page=$page&type=3&st=" . $st . "\">���� ��������</a>$t32|
   $t41<a href=\"index.php?page=$page&type=4&st=" . $st . "\">����������</a>$t42|
   $t51<a href=\"index.php?page=$page&type=5&st=" . $st . "\">������� � ������</a>$t52|
   $t51<div class='galleryname'><a href=\"index.php?event=addform\"><b>>>> �������� ���� <<<</b></A></div></small>
</center>

 
      
<table border=0 width=100% align=center>      
      <tr valign='top'>
        <td width='220'>";
      //��� ����� ���������
     //------------------------------------------�- 
  
  

  

  if ($my->username == 'admin') {
  //���������� ���������
  if ($_GET['addkey']==1) {
  
    if ($_POST['NameNew']<>'')
    {
    $res=mysql_query("INSERT INTO elitaby_www.jos_fotobase_category(Name, PARENT_ID, VIS) VALUES (\"". mysql_real_escape_string($_POST['NameNew']) ."\",\"". $tekKey ."\",1)");    
    }
    
  echo "<FORM METHOD=POST ACTION='index.php?KeyKat=".$tekKey."&addkey=1'>";        
    echo "<INPUT TYPE=HIDDEN NAME='KeyKat' VALUE='".$tekKey."'>
    <INPUT NAME='NameNew' maxlength='80' VALUE=''><br>
    <INPUT TYPE=SUBMIT class='button' VALUE='��������'></center>
    </form> ";
  }
  
  echo "<br><A class='link_small_black' HREF=index.php?KeyKat=".$tekKey."&addkey=1>���������� ���������</a></center>";
  echo "<center>� ��������� <b>".$tov."</b> ���. </center>";
  }
    
    
     $res=mysql_query("SELECT ID, Name, PARENT_ID, VIS FROM elitaby_www.jos_fotobase_category where PARENT_ID=0")  or die("������ ���������: " . mysql_error());
     $newArr = array();
    
    while ($r = mysql_fetch_assoc($res)) //������� ������� � ������
        {
        $newArr[] = $r;
    }
  
    echo " <ul>";
     for ($i = 0; $i <= count($newArr)-1; $i++) {
       //     echo "<li><A HREF=index.php?KeyKat=".$newArr[$i][ID].">".$newArr[$i][Name]."</a></li>";  
     }
    echo "</ul>";
  
     //-----------------------------------------�--
      
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
        //=====================����
        $Nom++;
        $LinNom++;
        print "<td>
<table width=180 cellpadding=1 cellspacing=8 class=maintbl><tr><td>
<table width=180 height=270 cellpadding=1 cellspacing=0 class=seredina><tr><td valign=top align=center>
<font size=-1>���� � $line[id]</font><BR>
<table width=180 height=210 cellpadding=1 cellspacing=0><tr><td align=center height=120 colspan=2><a href='index.php?event=showimg&msnum=$line[id]'><img src='gallery/data/$line[filenamesmall]' alt='$line[comment]' border=0></a></td></tr>
<TR height=25><TD colspan=2 align=center>$line[comment]<BR></td></tr>
<TR height=25><TD colspan=2 align=center><small>����������: <B>$line[skalex] � $line[skaley]</B></small><BR></td></tr>
<TR height=25><TD colspan=2 align=center><small>������: <B>$line[size]</B> ��.</small><BR>";
       // echo "�������: ";
       // echo $handler->displayRateValue($line[filenamesmall]);
       // echo "<br>";
       // $handler->displayRating($line[filenamesmall], 5);
       // echo "<br>";
       // echo "����������: ";
       // echo $handler->displayTotalNumberOfRatings($line[filenamesmall]);
        echo "
<br>
</td></tr>";
        //if (is_file("$datadir/$msnum.dat"))  {
        //$rlines=file("$datadir/$msnum.dat"); $ri=count($rlines); $bals=0; $all=0;
        //print"<TR><TD colspan=2 align=center>����������� [<B><a href='index.php?event=coment&msnum=$msnum'> $ri //</a></B>]</TD></TR>";
        //do {$ri--; $edt=explode("|",$rlines[$ri]); $edt[3]=date("d.m.Y H:i:s",$edt[3]); if ($edt[4]!=0) {$bals=$bals+$edt[4]; $all++;} else {$edt[4]="-";} } while($ri>0);
        //if ($bals==0) {$itogobals="+</B>";} else {$itogobals=round($bals*10/$all)/10; $itogobals.="</B>";}
        //print "<TR><TD colspan=2 align=center>������ [<B><a href='addmsg.php?msnum=$msnum'>$itogobals</a>]</TD></TR>";
        //} else {print"<TR><TD colspan=2 align=center>����������� [ <B><a href='addmsg.php?msnum=$msnum'>+</a></B> ]</TD></TR>
        //<TR><TD colspan=2 align=center>������ [<B><a href='addmsg.php?msnum=$msnum'>+</a></B>]</TD></TR>
        //";}
        print "<TR height=30><TD><b><a href=mailto:$line[email]>$dt[1]</a></b></TD><TD align=right></td></tr>
</table>
</td></tr></table>
</td></tr></table>
</td>";
        // ��������!   // ����� ��� ������� �� �������
        if ($LinNom == 3) {
            print "</TR><TR>";
        }
        if ($LinNom >= 3) {
            $LinNom = "0";
        }
        //if ($msginout=="1") {$whm=$Nom; $whe=$lm;} else {$whm=$lm; $whe=$Nom;}
    }
    print "</table>";
    //======================���� ���
    //$lines=file($datafile); 
    //$maxi = count($lines)-1;
    //$maxpage=ceil(($maxi+1)/$qq); if ($page>$maxpage) {$page=$maxpage;}
} //����� �������
print "</td></tr></table>";
echo "</td><tr></table>";
  ?>


&#8203;

</body>
</html>