<?php
include("class/User.php");

$US = new User();

if($_POST['pulsante'] == "invia"){
    $US->sendMailUtitly($_POST);
}

?>
<html>
<head>
<title>I-FACTORY.biz >> INVIO MAIL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>

</style>


</head>
<body>
    <form action="invioMail.php" method="post">
    To (mail)<br />
    <input type="text" name="send_mailTO" /><br />
    From (mail)<br />
    <input type="text" name="send_mail" /><br />
    From (name)<br />
    <input type="text" name="send_name" /><br />
    Oggetto mail<br />
    <input type="text" name="send_subject" /><br />
    Titolo mail<br />
    <input type="text" name="titolo" /><br />
    Testo mail<br />
    <textarea name="testo" cols="50" rows="5"></textarea><br />
    <input type="submit" name="pulsante" value="invia" />

    </form>

</body>
</html>