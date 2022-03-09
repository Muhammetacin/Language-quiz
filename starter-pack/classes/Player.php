<?php

class Player
{
    // add name and score
    private int $rightScore;
    private int $wrongScore;
    private string $playerName;

    public function __construct(string $playerName, int $rightScore = 0, int $wrongScore = 0)
    {
        // add 👤 automatically to their name
        $this->rightScore = $rightScore;
        $this->wrongScore = $wrongScore;
        $this->playerName = '👤 ' . $playerName;
    }

    public function updateScore(bool $correctAnswer): int
    {
        if($correctAnswer) {
            $this->rightScore += 1;
            return $this->rightScore;
        }
        $this->wrongScore += 1;
        return $this->wrongScore;
    }

    public function getRightScore(): int
    {
        return $this->rightScore;
    }

    public function getWrongScore(): int
    {
        return $this->wrongScore;
    }

    public function resetScores()
    {
        $this->rightScore = 0;
        $this->wrongScore = 0;
    }
}
