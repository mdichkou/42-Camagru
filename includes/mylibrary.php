<?php
class User {
    public function Login($username,$pwd,$pdo) {
        $req = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $req->execute([$username]);
        $res = $req->fetch();
        if (password_verify($pwd, $res['passowrd'])) {
            return $res['id'];
        } else {
            return false;
        }
    }
    public function Registre($username,$pwd,$email,$name,$pdo) {
        $pwdhash = password_hash($pwd, PASSWORD_BCRYPT);
        $pdo->prepare("INSERT INTO users SET username = ?, name = ?, passowrd = ?, email = ?")->execute([$username,$name,$pwdhash,$email]);
        return $pdo->lastInsertId();
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
}
?>