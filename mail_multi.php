<?php

if($_POST) {

    $filesize = 0;
    for($i=0; $i < count($_FILES['fileFF']['name']); $i++){
        $fname[] = $_FILES['fileFF']['name'][$i];
        $fpath[] = $_FILES['fileFF']['tmp_name'][$i];
        $filesize += $_FILES['fileFF']['size'][$i];
    }

    if ($filesize > 10000000){ // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
        echo 'Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.';
    } else {

        // array with filenames to be sent as attachment
        $files = $fname;

        // email fields: to, from, subject, and so on
        $to = "myauto-bc@ukr.net";
        $from = $to;
        $subject ="Заполнена контактная форма на сайте ".$_SERVER['HTTP_REFERER'];
        $message = "Ім'я: ".$_POST['namePas']."\nПрізвище ".$_POST['surnameFF']."\nТелефон ".$_POST['contactFF']."\nIP: ".$_SERVER['REMOTE_ADDR'];
        $headers = "From: $from";

        // boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

        // headers for attachment 
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

        // multipart boundary
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"UTF-8\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
        $message .= "--{$mime_boundary}\n";

        // preparing attachments
        for($x=0;$x<count($files);$x++){
            $file = fopen($fpath[$x],"rb");
            $data = fread($file,filesize($fpath[$x]));
            fclose($file);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$files[$x]\"\n" . 
            "Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" . 
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            $message .= "--{$mime_boundary}\n";
        }

        // send
        $ok = @mail($to, $subject, $message, $headers);
        if ($ok) { 
            echo $_POST['namePas'].', Ваше сообщение отправлено, спасибо!'; 
        } else { 
            echo "Извините, письмо не отправлено по техническим причинам."; 
        } 
    }

ini_set('short_open_tag', 'On');
$headers = 'From: MyAuto.in.ua';
header('Refresh: 3; URL=index.html');

}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="refresh" content="3; url=index.html">
<title>С вами свяжутся</title>
<meta name="generator">
<style type="text/css">
body
{

   background: #22BFF7 url(img/zakaz.jpg) top -70% center no-repeat;

}

<script type="text/javascript">
setTimeout('location.replace("/index.html")', 3000);
/*Изменить текущий адрес страницы через 3 секунды (3000 миллисекунд)*/
</script>
</head>
</body>
</html>
