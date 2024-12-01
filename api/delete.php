<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers:Content-Type, Accept-Control-Allow-Method,Authorization, X-Requested-With');
// header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include_once("../core/initialize.php");

$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

if ($post->delete()) {
    echo json_encode(array('message' => 'Post deleted successfully'));
} else {
    echo json_encode(array('message' => 'Unable to delete post'));
}
