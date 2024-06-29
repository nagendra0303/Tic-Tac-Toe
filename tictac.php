<!DOCTYPE html>
<html>
<head>
    <title>Tic Tac Toe</title>
    <style>
        table {
            margin: 20px auto;
            border-collapse: collapse;
        }
        td {
            width: 175px;
            height: 175px;
            text-align: center;
            font-size: 64px;
            border: 1px solid black;
            background-color: yellow;
        }
        body {
            background-color: lightblue;
            text-align: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <h1>Tic Tac Toe</h1>
    <div id="game">
        <table>
            <tr>
                <td id="cell-0-0" onclick="makeMove(0, 0)"></td>
                <td id="cell-0-1" onclick="makeMove(0, 1)"></td>
                <td id="cell-0-2" onclick="makeMove(0, 2)"></td>
            </tr>
            <tr>
                <td id="cell-1-0" onclick="makeMove(1, 0)"></td>
                <td id="cell-1-1" onclick="makeMove(1, 1)"></td>
                <td id="cell-1-2" onclick="makeMove(1, 2)"></td>
            </tr>
            <tr>
                <td id="cell-2-0" onclick="makeMove(2, 0)"></td>
                <td id="cell-2-1" onclick="makeMove(2, 1)"></td>
                <td id="cell-2-2" onclick="makeMove(2, 2)"></td>
            </tr>
        </table>
        <p id="message"></p>
        <button onclick="resetGame()">Reset</button>
    </div>
    <script>
        let board = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];
        let currentPlayer = '<?php echo $_GET["start"] === "computer" ? "X" : "O"; ?>';

        function printBoard() {
            for (let i = 0; i < 3; i++) {
                for (let j = 0; j < 3; j++) {
                    document.getElementById(`cell-${i}-${j}`).innerText = board[i][j];
                }
            }
        }

        function makeMove(i, j) {
            if (board[i][j] === '') {
                board[i][j] = currentPlayer;
                if (checkWin()) {
                    document.getElementById('message').innerText = `${currentPlayer} wins!`;
                } else if (isBoardFull()) {
                    document.getElementById('message').innerText = 'Draw!';
                } else {
                    currentPlayer = currentPlayer === 'O' ? 'X' : 'O';
                    if (currentPlayer === 'X') {
                        setTimeout(computerMove, 500); // Delay for better UX
                    }
                }
                printBoard();
            }
        }

        function computerMove() {
            let bestMove = getBestMove();
            board[bestMove.i][bestMove.j] = 'X';
            if (checkWin()) {
                document.getElementById('message').innerText = 'Computer wins!';
            } else if (isBoardFull()) {
                document.getElementById('message').innerText = 'Draw!';
            }
            currentPlayer = 'O';
            printBoard();
        }

        function getBestMove() {
            let bestScore = -Infinity;
            let move;
            for (let i = 0; i < 3; i++) {
                for (let j = 0; j < 3; j++) {
                    if (board[i][j] === '') {
                        board[i][j] = 'X';
                        let score = minimax(board, 0, false);
                        board[i][j] = '';
                        if (score > bestScore) {
                            bestScore = score;
                            move = { i, j };
                        }
                    }
                }
            }
            return move;
        }

        function minimax(board, depth, isMaximizing) {
            if (checkWin()) {
                return isMaximizing ? -1 : 1;
            } else if (isBoardFull()) {
                return 0;
            }

            if (isMaximizing) {
                let bestScore = -Infinity;
                for (let i = 0; i < 3; i++) {
                    for (let j = 0; j < 3; j++) {
                        if (board[i][j] === '') {
                            board[i][j] = 'X';
                            let score = minimax(board, depth + 1, false);
                            board[i][j] = '';
                            bestScore = Math.max(score, bestScore);
                        }
                    }
                }
                return bestScore;
            } else {
                let bestScore = Infinity;
                for (let i = 0; i < 3; i++) {
                    for (let j = 0; j < 3; j++) {
                        if (board[i][j] === '') {
                            board[i][j] = 'O';
                            let score = minimax(board, depth + 1, true);
                            board[i][j] = '';
                            bestScore = Math.min(score, bestScore);
                        }
                    }
                }
                return bestScore;
            }
        }

        function checkWin() {
            const winPatterns = [
                [[0, 0], [0, 1], [0, 2]],
                [[1, 0], [1, 1], [1, 2]],
                [[2, 0], [2, 1], [2, 2]],
                [[0, 0], [1, 0], [2, 0]],
                [[0, 1], [1, 1], [2, 1]],
                [[0, 2], [1, 2], [2, 2]],
                [[0, 0], [1, 1], [2, 2]],
                [[0, 2], [1, 1], [2, 0]]
            ];

            for (let pattern of winPatterns) {
                const [a, b, c] = pattern;
                if (board[a[0]][a[1]] !== '' && board[a[0]][a[1]] === board[b[0]][b[1]] && board[a[0]][a[1]] === board[c[0]][c[1]]) {
                    return true;
                }
            }
            return false;
        }

        function isBoardFull() {
            for (let i = 0; i < 3; i++) {
                for (let j = 0; j < 3; j++) {
                    if (board[i][j] === '') {
                        return false;
                    }
                }
            }
            return true;
        }

        function resetGame() {
            board = [
                ['', '', ''],
                ['', '', ''],
                ['', '', '']
            ];
            currentPlayer = '<?php echo $_GET["start"] === "computer" ? "X" : "O"; ?>';
            document.getElementById('message').innerText = '';
            printBoard();
            if (currentPlayer === 'X') {
                setTimeout(computerMove, 500); // Delay for better UX
            }
        }

        // Initialize the game
        printBoard();
        if (currentPlayer === 'X') {
            setTimeout(computerMove, 500); // Delay for better UX
        }
    </script>
</body>
</html>
