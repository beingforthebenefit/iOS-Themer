<?php
// application/models/PackModel.class.php

class PackModel extends Model {

    // add :: (string, bool, string{6}) -> bool
    public function add(
        $background,
        $paid,
        $title,
        $description,
        $link1Text,
        $link1Url,
        $link2Text,
        $link2Url
    ) {
        return $this->insert([
            'background' => $background,
            'paid' => $paid ? 1 : 0,
            'title' => $title,
            'description' => $description,
            'link1Text' => $link1Text,
            'link1Url' => $link1Url,
            'link2Text' => $link2Text,
            'link2Url' => $link2Url
        ]);
    }
}