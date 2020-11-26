<?php
// application/models/ApiKeyModel.class.php

class ApiKeyModel extends Model {
    
    // repositories :: void -> [[string -> a]]|false
    public function repositories() {
        $sql = "SELECT * FROM {$this->table} ORDER BY `stars` DESC";
        $repositories = $this->db->rows($sql);

        return $repositories;
    }

    // addKey :: (string, string, string) -> bool
    public function addKey($owner, $key, $expiration) {
        return $this->insert([
            'key' => $key;
            'owner' => $owner;
            'dateCreated' => date('Y-m-d H:i:s');
            'dateExpires' => $expiration;
        ]);
    }

    // validateKey :: string -> bool
    public function validateKey($key) {
        $sql = "SELECT * FROM {$this->table}";
        $keys = $this->rows($sql);

        return !empty(
            array_filter(
                $keys,
                function($validKey) use ($key) {
                    return $validKey == $key;
                }
            )
        );
    }
}