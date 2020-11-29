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

    // logUsage :: string -> bool
    public function logUsage($key) {
        $row = $this->row(['key' => $key]);
        return $this->update([
            'apiKeyId' => $row['apiKeyId'],
            'timesUsed' => $row['timesUsed'] + 1
        ]);
    }

    // validate :: string -> bool
    public function validate($key) {
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