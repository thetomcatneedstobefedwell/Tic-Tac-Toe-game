<?php

game();

function game (&$matrix = null, $x = true, $o = false) {

    if (!$matrix) {
        $matrix = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0];
    }

    print_matrix($matrix);

    if ($x) {
        $value = 'X';
    } else {
        $value = 'O';
    }
    $input = readline("$value turn: \n");

    if (intval($input) && $input < 10 && $input > 0) {
        if ($matrix[$input]) {
            echo "You can't use this place. It is already taken. Try another one\n";
            game($matrix, $x, $o);
        }
        $matrix[$input] = $value;

        if (check_win($matrix)) {
            print_matrix($matrix);
            echo "$value won!!!";
            exit;
        }

        game($matrix, !$x, !$o);
    } else {
        echo "Incorrect value, try again\n";
        game($matrix, $x, $o);
    }
}

function check_win($matrix)
{
    $winMatches = [
        [1, 2, 3],
        [1, 5, 9],
        [1, 4, 7],
        [2, 5, 8],
        [3, 5, 7],
        [3, 6, 9],
        [4, 5, 6],
        [7, 8, 9]
    ];
    $won = false;
    $x = 0;
    $o = 0;

    foreach ($winMatches as $winMatch) {

        foreach ($winMatch as $try) {

            if ($matrix[$try] === 'X') {
                $x++;

                if ($x === 3) {
                    $won = true;
                }
            } else {
                $x = 0;
            }

            if ($matrix[$try] === 'O') {
                $o++;

                if ($o === 3) {
                    $won = true;
                }
            } else {
                $o = 0;
            }
        }
        $x = 0;
        $o = 0;
    }

    $friendship = 0;
    foreach ($matrix as $point) {

        if ($point) {
            $friendship++;

            if ($friendship === 9) {
                print_matrix($matrix);
                echo "Game over. Friendship won.";
                die();
            }
        }
    }

    return $won;
}

function print_matrix ($matrix)
{
    foreach ($matrix as $index => $str) {

        if (!$str) {
            echo $index;
        } else {
            echo $str;
        }

        if (($index % 3) === 0) {
            echo "\n";
        } else {
            echo '|';
        }
    }
}
die();
