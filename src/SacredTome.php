<?php

namespace Zalgo;

interface SacredTome
{
    /**
     * @return string an inscription from sacred text
     */
    public function read();
}