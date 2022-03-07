<?php

class Word
{
    private string $answer;
    private string $word;

    // add word (FR) and answer (EN) - (via constructor or not? why?)
    // Constructor -> Because a word cannot exist without having both a word and an answer
    public function __construct(string $word, string $answer)
    {
        $this->word = $word;
        $this->answer = $answer;
    }

    public function verify(string $answer): bool
    {
        // use this function to verify if the provided answer by the user matches the correct one
        // Bonus: allow answers with different casing (example: both bread or Bread can be correct answers, even though technically it's a different string)
        if (strtolower($answer) === strtolower($this->answer)) {
            return true;
        }
        return false;
        // Bonus (hard): can you allow answers with small typo's (max one character different)?
    }

    /**
     * Get the value of word
     */
    public function getWord()
    {
        return $this->word;
    }
}
