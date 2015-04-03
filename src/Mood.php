<?php

namespace Zalgo;

final class Mood
{
    private $mood;

    private function __construct($mood)
    {
        $this->mood = $mood;
    }

    public static function enraged()
    {
        return new Mood('enraged');
    }

    public static function normal()
    {
        return new Mood('normal');
    }

    public static function soothed()
    {
        return new Mood('soothed');
    }

    public static function twitter()
    {
        return new Mood('twitter');
    }

    public function __toString()
    {
        return $this->mood;
    }

    public function getDisturbenceLevels()
    {
        switch($this->mood) {
            case 'soothed':
                return [
                    'up' => rand(0, 8),
                    'down' => rand(0, 8),
                    'mid' => rand(0, 2),
                ];
                break;

            case 'enraged':
                return [
                    'up' => rand(0, 16) + 3,
                    'down' => rand(0, 64) + 3,
                    'mid' => rand(0, 4) + 1,
                ];
                break;

            case 'twitter':
                return [
                    'up' => rand(0, 1),
                    'down' => rand(0, 1),
                    'mid' => rand(0, 0),
                ];
                break;

            default:
                return [
                    'up' => rand(0, 8) + 1,
                    'down' => rand(0, 6) / 2,
                    'mid' => rand(0, 2) + 1,
                ];
                break;
        }
    }

}