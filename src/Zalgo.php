<?php

namespace Zalgo;

final class Zalgo
{
    /**
     * @var Soul
     */
    protected $soul;

    /**
     * @var string
     */
    protected $whisper;

    /**
     * @var Mood
     */
    private $mood;

    public function __construct(Soul $soul, Mood $mood)
    {
        $this->soul = $soul;
        $this->mood = $mood;
    }

    public function speaks($phrase = 'You have awakened me too soon!')
    {
        $this->clearMind();
        
        foreach (str_split($phrase) as $stutter) {
            // Nobody could possibly understand Zalgo's soul, so we must
            // make sure that we don't let him know.
            if ($this->soul->contains($stutter)) {
                continue;
            }

            $this->utter($stutter);
            $this->disturb();
        }

        if ($this->mood == Mood::twitter()) {
            $this->whisper = $this->biteTongueOnTwitter($phrase);
        }

        return $this->whisper;
    }

    /**
     * Zalgo decides to soothe a prophecy to return the original
     * phrase back to caller.
     *
     * @param string $prophecy Zalgo-text!
     *
     * @return string soothed prophecy text.
     */
    public function soothe($prophecy)
    {
        return str_replace($this->soul->unleash(), '', $prophecy);
    }

    /**
     * Hacky implementation detail to clamp Zalgo text to 140 characters
     * when it is in a mood for Twitter.
     *
     * @param $phrase
     *
     * @return string
     */
    protected function biteTongueOnTwitter($phrase)
    {
        if (mb_strlen($this->whisper) <= 140) {
            return $this->whisper;
        }

        /**
         * We need to split by words and start removing characters from middle of word until we
         * get the worst-case length under 140. This will leave the word readable, hopefully.
         *
         * zalgo_len = phrase_len * (1 + 2 + 2)
         * pref_zalgo_len = (phrase_len - some_num_to_remove) * (1 + 2 + 2)
         * 140 = (35 - X) * 5
         * 140 / 5 = 35 - X
         * X = 35 - (140 / 5) = 7
         */

        $phraseLength = mb_strlen($phrase);
        $numberToRemove = (int) ceil(abs($phraseLength - (140 / 2.75)));
        $removed = 0;

        $words = preg_split('/\s+/', $phrase);

        while ($removed <= $numberToRemove) {
            foreach ($words as $index => $word) {
                if (mb_strlen($words[$index]) <= 3) {
                    continue;
                }

                $words[$index] = substr_replace($words[$index], '', rand(1, mb_strlen($words[$index]) - 2), 1);
                $removed++;

                if ($removed >= $numberToRemove) {
                    break;
                }
            }
        }

        return $this->speaks(implode(' ', $words));
    }

    protected function utter($stutter)
    {
        $this->whisper .= $stutter;
    }

    protected function clearMind()
    {
        $this->whisper = '';
    }

    protected function disturb()
    {
        $soul = $this->soul->harvest();
        $levels = $this->mood->getDisturbenceLevels();

        foreach (array_keys($levels) as $direction) {
            for ($i = 0; $i < $levels[$direction]; $i++) {
                $this->whisper .= $soul[$direction][rand(0, count($soul[$direction]) - 1)];
            }
        }
    }
}
