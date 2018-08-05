<?php
session_start();

define("Consumer_Key", "2Kyon5DYMwMsIw97OqydsaLSf");
define("Consumer_Secret", "JAWr9efw9655JmZzoD90qNQf7iBOXC5aP7KZFVG23CyxZesMzJ");

//Callback URL
define('Callback',
'/Users/reason/Documents/dvlp/01_study/OAuth/callback.php');
//'http://◯◯◯/callback.php');

//ライブラリを読み込む
require "twitteroauth-master/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//TwitterOAuthのインスタンスを生成し、Twitterからリクエストトークンを取得する
$connection = new TwitterOAuth(Consumer_Key, Consumer_Secret);
$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => Callback));

//リクエストトークンはcallback.phpでも利用するのでセッションに保存する
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// Twitterの認証画面へリダイレクト
$url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
header('Location: ' . $url);
