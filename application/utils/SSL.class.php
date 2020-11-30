<?php
// application/utils/SSL.class.php

// Application utilities

class SSL {

    // sign :: (string, string) -> void
    public static function sign($input, $output) {
        $sslPath = '/home/beingforthebenefit/certs';
        $cmd = "openssl smime -sign -signer " . $sslPath . "/iostheme.crt -inkey " . $sslPath . "/iostheme.key -certfile " . $sslPath . "/chain.crt -nodetach -outform der -in " . $input . " -out " . $output;
        shell_exec($cmd);
    }
}