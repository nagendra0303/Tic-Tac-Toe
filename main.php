<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Tic Tac Toe</title>
    <style>
        body {
            background-color: lightblue;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .images img {
            width: 400px;
            height: 400px;
            margin: 10px;
        }
        .start-button {
            margin-top: 20px;
            font-size: 20px;
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }
        .start-button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Tic Tac Toe</h1>
        <div class="images">
            <img src="tic1.png" alt="Tic Tac Toe 1">
            <img src="tic2.png" alt="Tic Tac Toe 2">
        </div>
        <div>
            <button class="start-button" onclick="startGame('user')">Start Game (User)</button>
            <button class="start-button" onclick="startGame('computer')">Start Game (Computer)</button>
        </div>
    </div>
    <script>
        function startGame(player) {
            window.location.href = 'tictac.php?start=' + player;
        }
    </script>
</body>
</html>
