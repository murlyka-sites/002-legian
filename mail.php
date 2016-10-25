<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'vendor/autoload.php';
use UAParser\Parser;

$ua = $_SERVER["HTTP_USER_AGENT"];

$parser = Parser::create();
print $browser = $parser->parse($ua)->toString();

$gi = geoip_open("GeoLiteCity.dat",GEOIP_STANDARD);
$record = geoip_record_by_addr($gi, $_SERVER["REMOTE_ADDR"]);
$location = $record->country_name . " " . $GEOIP_REGION_NAME[$record->country_code][$record->region] . " " . $record->city;
geoip_close($gi);


$email = "sup.ser.pc@yandex.ru";
$title = "=?utf-8?b?" . base64_encode( htmlspecialchars("zakaz-landing.ru - Новая заявка") ) . "?=";

if(empty($_POST['phone']) AND empty($_POST['email']))
	exit();

$name = @htmlspecialchars($_POST['name']);

if(!empty($_POST['phone'])) {
	$phone = htmlspecialchars($_POST['phone']);
	$time = @htmlspecialchars($_POST['time']);
} elseif(!empty($_POST['email'])) {
	$mail = htmlspecialchars($_POST['email']);
	$time = @htmlspecialchars($_POST['msg']);
	var_dump($mail);
}

$ip = $_SERVER["REMOTE_ADDR"];
$date = date('d.m.Y H:i:s');

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
//$headers .= 'From: milok@murlyka.com'. "\r\n";

if(!empty($_POST['phone'])) {
	$html = 
	'<table>
		<tr>
			<td><b>IP:</b></td>
			<td>'.$ip.'</td>
		</tr>
		<tr>
			<td><b>Дата:</b></td>
			<td>'.$date.'</td>
		</tr>
		<tr>
			<td><b>Имя:</b></td>
			<td>'.$name.'</td>
		</tr>
		<tr>
			<td><b>Телефон:</b></td>
			<td>'.$phone.'</td>
		</tr>
		<tr>
			<td><b>Время:</b></td>
			<td>'.$time.'</td>
		</tr>
		<tr>
			<td><b>Браузер / ОС:</b></td>
			<td>'.$browser.'</td>
		</tr>
		<tr>
			<td><b>Местоположение:</b></td>
			<td>'.$location.'</td>
		</tr>
	</table>';
} else {
	$html = 
	'<table>
		<tr>
			<td><b>IP:</b></td>
			<td>'.$ip.'</td>
		</tr>
		<tr>
			<td><b>Дата:</b></td>
			<td>'.$date.'</td>
		</tr>
		<tr>
			<td><b>Имя:</b></td>
			<td>'.$name.'</td>
		</tr>
		<tr>
			<td><b>Email:</b></td>
			<td>'.$mail.'</td>
		</tr>
		<tr>
			<td><b>Текст:</b></td>
			<td>'.$msg.'</td>
		</tr>
		<tr>
			<td><b>Браузер / ОС:</b></td>
			<td>'.$browser.'</td>
		</tr>
		<tr>
			<td><b>Местоположение:</b></td>
			<td>'.$location.'</td>
		</tr>
	</table>';
}
var_dump($email, $title, $html, $headers);

if(mail($email, $title, $html, $headers))
	echo "Заявка удачно отправлена!";
else
	echo "Ошибка";