<?php 

include('users.php');
include('posts.php');

$isPost = ($_SERVER['REQUEST_METHOD'] == 'POST') ? TRUE : FALSE;
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

function redirect($path) {
    header('Location: ' . $path, true, 301);
    exit();
}

session_start();

$db = new PDO("mysql:dbname=blog;host=localhost", "root", "");
$usersRepo = new UsersRepo($db);
$postsRepo = new PostsRepo($db);


?>