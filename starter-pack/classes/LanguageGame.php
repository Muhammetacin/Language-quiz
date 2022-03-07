<?php

class LanguageGame
{
    private array $words;
    public string $randomWord;
    public string $resultMessage;
    public Player $player;

    // public int $score;

    public function __construct()
    {
        // :: is used for static functions
        // They can be called without an instance of that class being created
        // and are used mostly for more *static* types of data (a fixed set of translations in this case)
        foreach (Data::words() as $frenchTranslation => $englishTranslation) {
            // create instances of the Word class to be added to the words array
            $this->words[] = new Word($frenchTranslation, $englishTranslation);
        }



        if (isset($_SESSION['player'])) {
            $this->player = unserialize($_SESSION['player']);
            // echo 'getting player from session';
        } else {
            $this->player = new Player('Mowtje');
            $_SESSION['player'] = serialize($this->player);
            echo 'creating new player this time';
        }

        // if (isset($_SESSION['score'])) {
        //     $this->score = $_SESSION['score'];
        //     // echo 'setting score from session';
        // } else {
        //     echo 'getting score from player class';
        //     $this->score = $this->player->getScore();
        //     $_SESSION['score'] = $this->score;
        // }

        $this->resultMessage = 'Your translation is...';
    }

    public function run(): void
    {
        $this->whatIsHappening();
        $this->pre_r($this->player);

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

                // Get player from session
                $this->player = unserialize($_SESSION['player']);
                // Update player's score (increment by 1)
                $this->player->updateScore();
                // Set player in SESSION with updated score
                $_SESSION['player'] = serialize($this->player);

                // Show correct score
                // $this->score = $this->player->getScore();
                // Update latest score in SESSION
                // $_SESSION['score'] = $this->score;


            }
            if (!$result) {
                $this->resultMessage = 'Your translation is incorrect :( You answered ' . $userInput . '.';
            }

            // Refresh page in 1 second --> new word
            header("Refresh:1");
        }
    }

    private function pre_r($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    private function whatIsHappening()
    {
        // echo '<h2>$_GET</h2>';
        // $this->pre_r($_GET);
        echo '<h2>$_POST</h2>';
        $this->pre_r($_POST);
        // echo '<h2>$_COOKIE</h2>';
        // $this->pre_r($_COOKIE);
        echo '<h2>$_SESSION</h2>';
        $this->pre_r($_SESSION);
    }
}
