<?php

$passF = "A123";
$passS = "A123";

$passJ = "J123";
$passD = "D123";
$passZ = "Z123";
$passAdmin = "Admin123";

function encryptPassword($password)
{
	$password = mysqli_real_escape_string(trim(strip_tags($password)));
	$password = md5($password);
	$salt = substr(hash('sha512',rand(1,99999) . microtime()),0,64);
	$password = sha1($password . $salt);
	$password = hash('sha512',$password . $salt);

	return $password;
}

function doEncryptPassword($pass)
{
	$encryptPass = encryptPassword($pass);

	return $encryptPass;
}

function compareTwoEncryptedPasswords($encrpass1, $encrpass2)
{
	echo $encrPass1;
	if(password_verify($encrpass1, $encrPass2) == 0)
	{
		echo "GOOD!"."\n".$encrPass1."\n".$encrPass2;
	} else
	{
		echo "ERROR"."\n".$encrPass1."\n".$encrPass2;
	}
}
/*
$passF2 = doEncryptPassword($passF);
$passS2 = doEncryptPassword($passS);
compareTwoEncryptedPasswords($passF2, $passS2);
*/
/*$passXXX = "";
$passXXX = encryptPassword($passF);
echo $passXXX;
$passZZZ = encryptPassword($passS);
echo $passZZZ;

if(password_verify($passF, $passZZZ) == TRUE)
	{
		echo "GOOD!"."\n".$passXXX."\n".$passZZZ;
	} else
	{
		echo "ERROR"."\n".$passXXX."\n".$passZZZ;
	}*/

$pass_hash = password_hash($passF, PASSWORD_DEFAULT);
echo $pass_hash . "<br>";

$pass_hashJ = password_hash($passJ, PASSWORD_DEFAULT);
$pass_hashD = password_hash($passD, PASSWORD_DEFAULT);
$pass_hashZ = password_hash($passZ, PASSWORD_DEFAULT);
$pass_hashAdmin = password_hash($passAdmin, PASSWORD_DEFAULT);
echo $pass_hashJ . "<br>";
echo $pass_hashD . "<br>";
echo $pass_hashZ . "<br>";
echo $pass_hashAdmin . "<br>";
?>