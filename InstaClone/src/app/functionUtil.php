<?php
function getGet($param){
  if(isset($_GET[$param])){
    return $_GET[$param];
  }
}

function getPost($param){
  if(isset($_POST[$param])){
    return $_POST[$param];
  }
}

function getSession($param){
  if(isset($_SESSION[$param])){
    return $_SESSION[$param];
  }
}

function toSession($key, $value){
  session_start();
  $_SESSION[$key] = $value;
}

function getUser(){
  if(!isset($_SESSION) || !isset($_SESSION["autenticado"])){
    return null;
  }
  return $_SESSION["autenticado"];
}

function fromSession($param){
  $value = "";
  if(!isset($_SESSION)){
    session_start();
  }
  if(isset($_SESSION[$param])){
    $value = $_SESSION[$param];
    unset($_SESSION[$param]);
  }
  return $value;
}
