<?php

class LanguageGame
{
    private array $words;
    public string $randomWord;
    public string $resultMessage = 'Your translation is...';

    public function __construct()
    {
        // :: is used for static functions
        // They can be called without an instance of that class being created
        // and are used mostly for more *static* types of data (a fixed set of translations in this case)
        foreach (Data::words() as $frenchTranslation => $englishTranslation) {
            // create instances of the Word class to be added to the words array
            $this->words[] = new Word($frenchTranslation, $englishTranslation);
        }
    }

    public function pre_r($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    public function run(): void
    {
        // check for option A or B
        if (empty($_POST['answer'])) {
            // Option A: user visits site first time (or wants a new word)
            // select a random word for the user to translate   
            $randomWordObject = $this->words[rand(0, 7)];
            $this->randomWord = $randomWordObject->getWord();
            $_SESSION['word'] = $this->randomWord;
        } else {
            // Option B: user has just submitted an answer
            // verify the answer (use the verify function in the word class) - you'll need to get the used word from the array first
            $this->randomWord = $_SESSION['word'];
            $userInput = $_POST['answer'];
            $result = false;

            foreach ($this->words as $wordObject) {
                if ($wordObject->getWord() === $this->randomWord) {
                    $result = $wordObject->verify($userInput);
                }
            }

            // generate a message for the user that can be shown
            if ($result) {
                $this->resultMessage = 'Your translation is correct! You answered ' . $userInput . '.';
            }
            if (!$result) {
                $this->resultMessage = 'Your translation is incorrect :( You answered ' . $userInput . '.';
            }

            // Refresh page in 1 second --> new word
            header("Refresh:1");
        }
    }
}
