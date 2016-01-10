<!DOCTYPE html>
<html>
    <head>
        <title>Marisa Doig - Lab 1</title>
    </head>
    <body>
        <?php
        $position = $_GET['board'];

        $squares = str_split($position);

        if (winner('x', $squares)) {
            echo 'You win.';
        } else if (winner('o', $squares)) {
            echo 'I win.';
        } else {
            echo 'No winner yet.';
        }

        function winner($token, $position) {

            for ($row = 0; $row < 3; $row++) {
                $result = true;
                for ($col = 0; $col < 3; $col++) {
                    echo $position[3 * $row + $col] . '  ' . $token . '  ';
                    if ($position[3 * $row + $col] != $token) {
                        $result = false;
                    }
                }
                if ($result) {
                    return $result;
                }
            }
            for ($col = 0; $col < 3; $col++) {
                $result = true;
                for ($row = 0; $row < 3; $row++) {
                    if ($position[3 * $row + $col] != $token) {
                        $result = false;
                    }
                }
                if ($result) {
                    return $result;
                }
            }
            for ($i = 0; $i < 3; $i++) {
                $result = true;
                $row = $i;
                $col = $i;
                if ($position[$row] != $position[$col]) {
                    $result = false;
                }

                if ($result) {
                    return $result;
                }
            }
            for ($row = 0; $row < 3; $row++) {
                $result = true;
                for ($col = 0; $col < 3; $col++) {
                    if ($row + $col != 2) {
                        $result = false;
                    }
                }
                if ($result) {
                    return $result;
                }
            }
        }
        ?>
    </body>
</html>