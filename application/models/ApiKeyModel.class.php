<?php
// application/models/ApiKeyModel.class.php

class ApiKeyModel extends Model {

    // add :: (string, string, string) -> bool
    public function add($owner) {
        return $this->insert([
            'key' => md5(date('yMdhmsu')),
            'owner' => $owner,
            'dateCreated' => date('Y-m-d H:i:s'),
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
                    return ($validKey['key'] == $key) && ($validKey['active'] == true);
                }
            )
        );
    }

    // toggle :: string -> bool
    public function toggle($key) {
        $row = $this->row(['key' => $key]);
        return $this->update([
            'apiKeyId' => $row['apiKeyId'],
            'active' => $row['active'] == '1' ? 0 : 1
        ]);
    }
}