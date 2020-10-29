<?php

namespace App\Interfaces;

interface Positionnable {
    public function setPosition(int $position) : Positionnable;
    public function getPosition() : int;
}
