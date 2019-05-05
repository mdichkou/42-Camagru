<?php
session_start();
$folder = "/42-Camagru/images/";
$destinationFolder = $_SERVER['DOCUMENT_ROOT'] . $folder;
$maxFileSize = 2 * 1024 * 1024;
$postdata = file_get_contents("php://input");
if (!isset($postdata) || empty($postdata))
    exit(json_encode(["success" => false, "reason" => "Not a post data"]));
$request = json_decode($postdata);
if (trim($request->data) === "")
    exit(json_encode(["success" => false, "reason" => "Not a post data"]));
$file = $request->data;
$size = getimagesize($file);
$ext = $size['mime'];
if ($ext == 'image/jpeg')
    $ext = '.jpg';
elseif ($ext == 'image/png')
    $ext = '.png';
else
    exit(json_encode(['success' => false, 'reason' => 'only png and jpg mime types are allowed']));
if (strlen(base64_decode($file)) > $maxFileSize)
    exit(json_encode(['success' => false, 'reason' => "file size exceeds {$maxFileSize} Mb"]));
$img = str_replace('data:image/png;base64,', '', $file);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$img = base64_decode($img);
$filename = date("d_m_Y_H_i_s") . "-" . time() . "-" .$_SESSION['user_id'] . $ext;
$destinationPath = "$destinationFolder$filename";
$success = file_put_contents($destinationPath, $img);
if (!$success)
    exit(json_encode(['success' => false, 'reason' => 'the server failed in creating the image']));
include("../config/setup.php");
$pdo->prepare("INSERT INTO images SET img_name = ?, userid = ?")->execute(["$folder$filename",$_SESSION['user_id']]);
exit(json_encode(['success' => true, 'path' => "$folder$filename"]));
?>