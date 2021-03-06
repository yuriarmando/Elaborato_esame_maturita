<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>THESIS login</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="csslogin.css">
</head>
<body>
    
    <div class="container">
        <form class="form" action="./login.php" method="POST" id="login" >
            <h1 class="form__title">Login</h1>
            <div class="form__input-group">
                <input type="text" class="form__input" autofocus placeholder="Username" name="user">
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" autofocus placeholder="Password" name="psw">
            </div>
            <button class="form__button" type="submit">Avanti</button>
            <p class="form__text">
                <a class="form__link" href="registra.html" id="linkCreateAccount">Non sei ancora registrato? Fallo ora</a>
            </p>
        </form>
        <form class="form form--hidden" id="createAccount">
            <h1 class="form__title">Crea account</h1>
            <div class="form__input-group">
                <input type="text" id="signupUsername" class="form__input" autofocus placeholder="Nome" name="nome">
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" autofocus placeholder="Cognome" name="cognome">
            </div>
            <div class="form__input-group">
                <input type="email" class="form__input" autofocus placeholder="E-mail" name="email">
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" autofocus placeholder="Username" name="username">
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" autofocus placeholder="Password" name="psw">
            </div>
            <div class="form__input-group">
            <br>
            <label for="argomento">Scegli la scuola</label>
            <br>
            <select name="idscuola">
              <?php 
               $dbh = new PDO('mysql:host=localhost;dbname=elaborato', "root", "");
               $query = $dbh->prepare("SELECT * FROM scuole");
               $query -> execute();
               $materie = $query -> fetchAll(PDO::FETCH_ASSOC);
               foreach($materie as $materia){
               echo("<option value='".$materia["idscuola"]."'>".$materia["nomescuola"]."</option>");
               }
              ?>
            </select>
            </div>
            <input type="checkbox" id="c1" name="anonimo" value="anonimo" />
            <label for="c1"><span></span>Vuoi rimanere anonimo?</label>
            <br>
            <button class="form__button" type="submit">Registrati</button>
            <p class="form__text">
                <a class="form__link" href="registra.html" id="linkLogin">Possiedi gi?? un account? Vai al login</a>
            </p>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const url = new URL(window.location.href);

        const message = url.searchParams.get("message");

        if(message){
          alert(message);
        }

        $("#login").submit(async(e)=>{
            e.preventDefault();
            const params = new URLSearchParams([...new FormData(document.getElementById("login")).entries()]);
            // fetch("/path/to/server", {method:"POST", body:params})
            console.log(params)
            const Res = await fetch("login.php" , {
                method:"POST",
                body: params
            });
            const res = await Res.text();
            console.log(res)

            if (res == "ok"){
                window.location.href = "afterlogin.php";
            }
            /*
            const response = await new Response(params).text();
            console.log(response);*/
        })
        $("#createAccount").submit(async(e)=>{
            e.preventDefault();
            const params = new URLSearchParams([...new FormData(document.getElementById("createAccount")).entries()]);
            // fetch("/path/to/server", {method:"POST", body:params})
            console.log(params)
            const Res = await fetch("registra.php" , {
                method:"POST",
                body: params
            });
            const res = await Res.text();
            console.log(res)

            if (res == "ok"){
                window.location.href = "afterlogin.php";
            }
            /*
            const response = await new Response(params).text();
            console.log(response);*/
        })
      </script>
    <script src="jslogin.js"></script>

</body>
      

</html>