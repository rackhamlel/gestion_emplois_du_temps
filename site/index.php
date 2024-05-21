<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>       
    <form class="login" action="/php/verifier_mdp.php" method="post">
    
    <fieldset>
        
        <legend class="legend">Connexion</legend>
        
        <div class="input">
            <input type="text" placeholder="Nom" required name="username" />
        
        </div>
        
        <div class="input">
            <input type="password" placeholder="Mot de passe" name="password" required />
        
        </div>
        
        <button type="submit" class="submit"><i class="fa fa-long-arrow-right"></i></button>
        
    </fieldset>
    
    </form>
    
    <script src="/js/login.js"></script>
</body>
</html>
