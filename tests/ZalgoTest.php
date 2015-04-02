<?php

namespace Zalgo;

class ZalgoTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function it_should_summon_a_basic_zalgo()
    {
        $zalgo = new Zalgo(new Soul(), Mood::normal());

        $prophecy = $zalgo->speaks('invoke the chaos...');
        $this->assertIsZalgoese($prophecy);
    }

    /**
     * @param $prophecy
     */
    private function assertIsZalgoese($prophecy)
    {
        $this->assertTrue(strlen($prophecy) > 0);
        $this->assertTrue(mb_check_encoding($prophecy), 'utf-8');
    }
}
