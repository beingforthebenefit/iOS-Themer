<?php
// application/models/ApiKeyModel.class.php

class ApiKeyModel extends Model {

    // addKey :: (string, string, string) -> bool
    public function addKey($owner, $key, $expiration) {
        return $this->insert([
            'key' => $key,
            'owner' => $owner,
            'dateCreated' => date('Y-m-d H:i:s'),
            'dateExpires' => $expiration,
        ]);
    }

    // validateKey :: filters -> bool
    // filters = [string => a]
    public function validateKey($key) {
        return !empty(
            array_filter(
                $this->rows(['key' => $key]),
                function($validKey) use ($key) {
                    return $validKey['key'] == $key;
                }
            )
        );
    }
}