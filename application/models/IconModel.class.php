<?php
// /applcation/model/IconModel.class.php

class IconModel extends Model {
    public $Label;
    public $PayloadDisplayName;
    public $PayloadIdentifier;
    public $PayloadUUID;
    public $TargetApplicationBUndleIdentifier;
    public $URL;
    public $Icon;

    public function __construct($label, $bundleId, $iconPath, $fileType, $url) {
        $hash = md5(date("ymdhsu") . $bundleId);

        $this->Label = $label;
        $this->PayloadDisplayName = $label;
        $this->PayloadIdentifier = 'geralds.icon.themer.' . $hash . '.' . (count($_SESSION['icons']) + 1);
        $this->PayloadUUID = $hash;
        $this->TargetApplicationBundleIdentifier = $bundleId;
        $this->URL = $url;
        $this->Icon = $this->encode($iconPath, $fileType);
    }

    public function encode($iconPath, $fileType) {
        return shell_exec("convert $fileType:'$iconPath' jpeg:- | base64");
    }

    public function rename($name) {
        $this->Label = $name;
    }
}