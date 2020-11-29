<?php
// application/models/AdminModel.class.php

class AdminModel extends Model {

    // addKey :: (string, string, string) -> bool
    public function addUser($username, $password) {
        return $this->insert([
            'username' => $username,
            'password' => $password,
            'lastLogin' => null
        ]);
    }

    // validateKey :: filters -> bool
    // filters = [string => a]
    public function validate($username, $password) {
        return !empty(
            $this->rows([
                'username' => $username,
                'password' => $password
            ])
        );
    }

    // logTime :: void -> bool
    public function logTime() {
        return $this->update([
            'adminId' => $_SESWSION['adminId'],
            'lastLogin' => date('Y-m-d H:i:s'),
        ]);
    }

    // login :: void -> bool
    public function login() {
        $thisUser = $this->row([
            'username' => $_SERVER['PHP_AUTH_USER'],
        ]);
        $_SESSION['adminId'] = $thisUser['adminId'];
        $_SESSION['username'] = $thisUser['username'];
        $this->logTime();
    }
}