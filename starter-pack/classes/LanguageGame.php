<?php

class LanguageGame
{
    private array $words;
    private Player $player;
    private string $nickname;
//    private int $rightScorePlayer;
//    private int $wrongScorePlayer;

    // public to show on the index page
    public int $rightScorePlayer;
    public int $wrongScorePlayer;
    public string $randomWord;
    public string $resultMessage;

    public function __construct()
    {
        // :: is used for static functions
        // They can be called without an instance of that class being created
        // and are used mostly for more *static* types of data (a fixed set of translations in this case)
        foreach (Data::words() as $frenchTranslation => $englishTranslation) {
            // create instances of the Word class to be added to the words array
            $this->words[] = new Word($frenchTranslation, $englishTranslation);
        }

        if (isset($_SESSION['nickname'])) {
            $this->nickname = $_SESSION['nickname'];
        } else if (isset($_POST['nickname'])) {
            $this->nickname = $_POST['nickname'];
            $_SESSION['nickname'] = $this->nickname;
        }

        if (isset($_SESSION['player'])) {
            // get player from session
            $this->player = unserialize($_SESSION['player']);
            $this->setPlayerScore();
        } else if (isset($_SESSION['nickname'])) {
            // create player with nickname
            $this->player = new Player($this->nickname);
            $this->setPlayerScore();
            $_SESSION['player'] = serialize($this->player);
        } else {
            // init dummy player
            $this->player = new Player('Mowtje the king', 9999);
        }

        $this->resultMessage = 'Your translation is...';
    }

    public function run(): void
    {
        $this->whatIsHappening();
//        $this->pre_r($this->player);

        // reset score
        if (isset($_POST['reset'])) {
            $this->resetPlayerScore();
            header("Refresh");
        }

        if(isset($_SESSION['resetGame'])) {
            // Reload page
            header("Location: index.php");
            exit();
        }

        // check for option A or B
        if (empty($_POST['answer'])) {
            // Option A: user visits site first time (or wants a new word)
            // select a random word for the user to translate   
            $randomWordObject = $this->words[rand(0, 7)];
            $this->randomWord = $randomWordObject->getWord();
            $_SESSION['wordObject'] = serialize($randomWordObject);
        } else {
            // Option B: user has just submitted an answer
            $wordObject = unserialize($_SESSION['wordObject']);
            $this->randomWord = $wordObject->getWord();
            $userInput = $_POST['answer'];

            // verify the answer (use the verify function in the word class) - you'll need to get the used word from the array first
            $result = $wordObject->verify($userInput);

            // generate a message for the user that can be shown
            if ($result) {
                $this->rightScorePlayer = $this->updatePlayerScore(true);
                $this->resultMessage = 'Your translation is correct! You answered ' . $userInput . '.';
            }

            if (!$result) {
                $this->wrongScorePlayer = $this->updatePlayerScore(false);
                $this->resultMessage = 'Your translation is incorrect :( You answered ' . $userInput . '.';
            }

            if ($this->rightScorePlayer >= 10 || $this->wrongScorePlayer >= 10) {
                $_SESSION['endGameRightScore'] = $this->rightScorePlayer;
                $_SESSION['endGameWrongScore'] = $this->wrongScorePlayer;
                header("Location: endgame.php");
            }

            // Refresh page in 1 second --> new word
            header("Refresh:1");
        }
    }

    private function setPlayerScore() {
        $this->rightScorePlayer = $this->player->getRightScore();
        $this->wrongScorePlayer = $this->player->getWrongScore();
    }

    private function updatePlayerScore(bool $correctAnswer): int
    {
        // Get player from session
        $this->player = unserialize($_SESSION['player']);
        // Update score
        $playerScore = $this->player->updateScore($correctAnswer);
        // Set player in SESSION with updated score
        $_SESSION['player'] = serialize($this->player);

        return $playerScore;
    }

    private function resetPlayerScore()
    {
        // Get player from session
        $this->player = unserialize($_SESSION['player']);
        // Update player's score (increment by 1)
        $this->player->resetScores();
        // Set player in SESSION with updated score
        $_SESSION['player'] = serialize($this->player);
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
