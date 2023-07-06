<?php 
session_start();

$msgArray = [
    'ok' => 'Vôtre livre a bien été ajouté ! 🥳',
    'ko' => 'Vôtre livre n\'a pas pu être ajouté ! 😱',
    'wrongToken' => 'Le token est erroné ! 😱'
    

];


function getMsg(array $array): string
{
    $msg = $_GET['msg'] ?? '';
    if (array_key_exists($msg, $array)) {
        return $array[$msg];
    }
    return '';
};


function verifyToken(){
    if(!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['token'] !== $_REQUEST['token'] ){
        header('location: new-book.php?msg=wrongToken');    
        exit;
    }
}