<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/loggin.css">
</head>
<body>
    <a href="php/emploi_temps.php"><button>skip</button></a>
    <br>
    <div class="container">
        <h2>Login</h2>
        <form action="php/enregistrement.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
    
</body>
</html>
