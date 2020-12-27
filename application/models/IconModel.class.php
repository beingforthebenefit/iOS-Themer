<?php
// /applcation/model/IconModel.class.php

class IconModel extends Model {
    public $Label;
    public $PayloadDisplayName;
    public $PayloadIdentifier;
    public $PayloadUUID;
    public $TargetApplicationBUndleIdentifier;
    public $Icon;

    public function __construct($label, $bundleId, $iconPath, $fileType) {
        $systemApp = substr($bundleId, 0, 10) === 'com.apple.';
        $hash = md5(date("ymdhsu") . $bundleId);

        if ($systemApp) {
            $urls = json_decode(file_get_contents(CONFIG_PATH . 'system-app-urls.json'), true);
        }

        $this->Label = $label;
        $this->PayloadDisplayName = $label;
        $this->PayloadIdentifier = 'geralds.icon.themer.' . $hash . '.' . (count($_SESSION['icons']) + 1);
        $this->PayloadUUID = $hash;
        $this->TargetApplicationBundleIdentifier = $bundleId;
        $this->URL = $systemApp ? ($urls[$bundleId] ?? ' ') : ' ';
        $this->Icon = $this->encode($iconPath, $fileType);
    }

    public function encode($iconPath, $fileType) {
        return shell_exec("convert $fileType:'$iconPath' jpeg:- | base64");
    }

    public function rename($name) {
        $this->Label = $name;
    }
}