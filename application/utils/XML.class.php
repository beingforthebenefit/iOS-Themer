<?php
// application/utils/XML.class.php

// Application utilities

class XML {

    public static function createConfig($icons = [ ]) {
        ob_start();
        include TEMPLATE_PATH . 'head.xml';
        foreach ($icons as $icon) {
            $icon = unserialize($icon);
            $label = htmlspecialchars($icon->Label);
            $id = $icon->PayloadIdentifier;
            $uid = $icon->PayloadUUID;
            $bundleId = $icon->TargetApplicationBundleIdentifier;
            $url = $icon->URL;
            $data = $icon->Icon;
            include TEMPLATE_PATH . 'entry.xml';
        }
        include TEMPLATE_PATH . 'tail.xml';
        return ob_get_clean();
    }
}