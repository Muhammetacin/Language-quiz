<?php

class Player
{
    // add name and score
    private int $score = 0;
    private string $playerName;

    public function __construct(int $score, string $playerName)
    {
        // add 👤 automatically to their name
        $this->score = $score;
        $this->playerName = '👤' . $playerName;
    }
}
