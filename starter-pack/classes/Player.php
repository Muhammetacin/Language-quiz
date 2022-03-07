<?php

class Player
{
    // add name and score
    private int $score;
    private string $playerName;

    public function __construct(string $playerName, int $score = 0)
    {
        // add 👤 automatically to their name
        $this->score = $score;
        $this->playerName = '👤' . $playerName;
    }

    public function updateScore()
    {
        $this->score += 1;
        return $this->score;
    }

    /**
     * Get the value of score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Get the value of playerName
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * Set the value of score
     *
     * @return  self
     */
    public function setScore($score)
    {
        $this->score = $score;
        // return $this->score;
    }
}
