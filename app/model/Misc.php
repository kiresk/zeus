<?php

namespace app\model;

use Nette;

class Misc {
    use Nette\SmartObject;

    public static function getAge($DOB, $format = 'd/m/Y') {
        $tz  = new \DateTimeZone('Europe/Bratislava');
        $age = Nette\Utils\DateTime::createFromFormat($format, $DOB, $tz)
            ->diff(new Nette\Utils\DateTime('now', $tz))
            ->y;

        return $age;
    }
}