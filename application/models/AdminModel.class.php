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

    // logTime :: string -> bool
    public function logTime() {
        return $this->update([
            'adminId' => $this->fields['pk'],
            'lastLogin' => date('Y-m-d H:i:s'),
        ]);
    }
}