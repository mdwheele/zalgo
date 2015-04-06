<?php

namespace Zalgo\Tomes;

use Zalgo\SacredTome;

class NecroCaptchaCon implements SacredTome
{
    private $adjectives = [
        'sacrificial',
        'bludgeoned',
        'heretical',
        'maniacal',
        'frenzied',
        'infernal',
    ];

    private $nouns = [
        'selfie',
        'pineapple',
        'sturgeon',
        'iPhone',
        'bicycle',
    ];

    public function read()
    {
        return sprintf(
            '%s %s',
            $this->pickFromSetRandomly($this->adjectives),
            $this->pickFromSetRandomly($this->nouns)
        );
    }

    private function pickFromSetRandomly(array $set)
    {
        return $set[array_rand($set)];
    }
}