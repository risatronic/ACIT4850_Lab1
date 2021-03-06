<!DOCTYPE html>
<html>
    <head>
        <title>Marisa Doig - Lab 1</title> 
        <style>
            body{text-align: center; font-family: arial; color: purple;}
            p {font-size: 2em; text-decoration: underline;}
            table{margin-left: auto; margin-right: auto;}
            td {text-align: center; height: 3em; width: 3em; font-weight: bold; font-size: 2em;}
            button {width: 4em; height: 4em;}
            button.restart {width: 6em; height: 2em; font-weight: bold;}

        </style>
    </head>
    <body>
        <p>Marisa's Not-So-Fancy Tic-Tac-Toe<br/></p>

        <?php

        class Game {
            
            //constructor for game with board as parameter
            function __construct($board) {
                //split board into a char array
                $this->position = str_split($board);
            }

            function display() {
                echo '<table cols="3">';
                echo '<tr>'; // open the first row
                for ($pos = 0; $pos < 9; $pos++) {
                    echo $this->show_cell($pos);
                    if ($pos % 3 == 2) {
                        echo '</tr><tr>'; // start a new row for the next square
                    }
                }
                echo '</tr>'; // close the last row
                echo '</table>';
            }

            function show_cell($which) {
                $token = $this->position[$which];
                // deal with the easy case
                if ($token <> '-') {
                    return '<td>' . $token . '</td>';
                }
                // now the hard case
                $this->newposition = $this->position; // copy the original
                $this->newposition[$which] = $token; // this would be their move
                $move = implode($this->newposition); // make a string from the board
                $link = './?board=' . $move; // this is what we want the link to be
                return '<td><a href="' . $link . '"><button type="button">&nbsp;'
                        . '</button></a></td>';
            }

            //iterate through cells and pick first available
            function pick_move() {
                for ($i = 0; $i < 9; $i++) {
                    if ($this->position[$i] != 'X' && $this->position[$i] != 'O') {
                        $this->newposition = $this->position; // copy the original
                        $this->newposition[$i] = 'O'; // this would be our move
                        $move = implode($this->newposition); // make a string from the board
                        $this->position = $move;
                        return;
                    }
                }
            }

            function winner($token) {
                //check rows
                for ($row = 0; $row < 3; $row++) {
                    if ($this->position[$row * 3] == $token &&
                            $this->position[$row * 3 + 1] == $token &&
                            $this->position[$row * 3 + 2] == $token) {
                        return true;
                    }
                }
                //check columns
                for ($col = 0; $col < 3; $col++) {
                    if ($this->position[$col] == $token &&
                            $this->position[$col + 3] == $token &&
                            $this->position[$col + 6] == $token) {
                        return true;
                    }
                }
                //check "forward" diagonal
                if ($this->position[0] == $token &&
                        $this->position[4] == $token &&
                        $this->position[8] == $token) {
                    return true;
                }
                //check "backward" diagonal
                if ($this->position[2] == $token &&
                        $this->position[4] == $token &&
                        $this->position[6] == $token) {
                    return true;
                }
                // return false if game is not yet won
                return false;
            }
        }
        //gets board state if applicable
        if (isset($_GET['board'])) {
            $board = $_GET['board'];
        } else {
            $board = "---------";
        }

        $game = new Game($board);
        $done = false;
        
        if ($game->winner('X')) {
            echo 'You win. Lucky guesses!';
            $done = true;
        } else if ($game->winner('O')) {
            echo 'I win. Muahahahaha';
            $done = true;
        } else {
            echo 'No winner yet, but you are losing.';
        }

        if (implode($game->position) <> '---------'){
            $game->pick_move();
        }
        $game->display();
        


        //displays restart option when game has been won
        if ($done == true) {
            echo '<br/><br/><a href = "/ACIT4850_Lab1/index.php"><button type="button" class="restart">Restart?</button></a>';
        }
        ?>
    </body>
</html>