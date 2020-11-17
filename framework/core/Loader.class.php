<?php
// framework/core/Loader.class.php

class Loader {

    // library :: void -> void
    public function library($lib) {
        include LIB_PATH . "{$lib}.class.php";
    }

    // helper :: void -> void
    public function helper($helper) {
        include HELPER_PATH . "{$helper}_helper.php";
    }
}