<?php
class User {
    public function Login($username,$pwd,$pdo) {
        $req = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $req->execute([$username]);
        $res = $req->fetch();
        if (password_verify($pwd, $res['passowrd'])) {
            return $res;
        } else {
            return false;
        }
    }
    public function Registre($username,$pwd,$email,$name,$key,$pdo) {
        $pwdhash = password_hash($pwd, PASSWORD_BCRYPT);
        $req = $pdo->prepare("INSERT INTO users SET username = ?, name = ?, passowrd = ?, email = ? , cle = ?");
        $req->execute([$username,$name,$pwdhash,$email,$key]);
        $res = $req->fetch();
        return $res;
    }
    public function save_comment($imageid,$comment,$userid,$pdo) {
        $pdo->prepare("INSERT INTO comment SET imageid = ?, userid = ?, comment = ?")->execute([$imageid,$userid,$comment]);
    }
    public function save_like($imageid,$userid,$pdo) {
        $pdo->prepare("INSERT INTO likes SET `user_id` = ?, picture_id = ?")->execute([$userid,$imageid]);
    }
    public function delete_like($imageid,$userid,$pdo) {
        $pdo->prepare("DELETE FROM likes WHERE `user_id` = ? AND picture_id = ?")->execute([$userid,$imageid]);
    }
    public function delete_image($imageid,$pdo) {
        $req = $pdo->prepare("SELECT * FROM images WHERE `imageid` = ?");
        $req->execute([$imageid]);
        $res = $req->fetch();
        if (!empty($res['img_name']))
            unlink(".." . $res['img_name']);
        $pdo->prepare("DELETE FROM images WHERE `imageid` = ?")->execute([$imageid]);
    }
    public function isUsername($username,$pdo)
    {
        try {
            $query = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $query->execute([$username]);
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function isEmail($email,$pdo)
    {
        try {
            $query = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $query->execute([$email]);
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function isLiked($userid,$imageid,$pdo)
    {
        try {
            $query = $pdo->prepare("SELECT id FROM likes WHERE `user_id` = ? AND picture_id = ?");
            $query->execute([$userid,$imageid]);
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}
?>