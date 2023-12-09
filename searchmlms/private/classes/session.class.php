<?php

class Session {
    public $user_id;
    public $user_level;
    public $user_first_name;
    public $user_email;
    private $last_login;
    public const MAX_LOGIN_AGE = 7 * 60 * 60 * 24;

    public function __construct() {
        session_start();
        $this->check_stored_login();
    }

    public function login($user) {
        if ($user) {
            // prevent session fixation attacks
            session_regenerate_id();
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->user_level = $_SESSION['user_level'] = $user->user_level;
            $this->user_first_name = $_SESSION['user_first_name'] = $user->user_first_name;
            $this->user_email = $_SESSION['user_email'] = $user->user_email;
            $this->last_login = $_SESSION['last_login'] = time();
        }
        return true;
    }

    public function is_logged_in() {
        //echo "user: " . $this->user_id; exit;
        return isset($this->user_id) && $this->last_login_is_recent();
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_first_name']);
        unset($_SESSION['last_login']);
        unset($this->user_id);
        unset($this->user_email);
        unset($this->user_first_name);
        unset($this->last_login);
        return true;
    }

    private function check_stored_login() {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->user_level = $_SESSION['user_level'];
            $this->user_first_name = $_SESSION['user_first_name'];
            $this->user_email = $_SESSION['user_email'];
            $this->last_login = $_SESSION['last_login'];
            if (!$this->last_login_is_recent()){
                $this->logout();
            }
        }

    }

    private function last_login_is_recent() {
        if (!isset($this->last_login)) {
            return false;
        } elseif (($this->last_login + self::MAX_LOGIN_AGE) < time()) {
            return false;
        } else {
            return true;
        }
    }

    public function message($msg = "") {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
            return true;
        } else {
            return $_SESSION['message'] ?? '';
        }
    }
}
