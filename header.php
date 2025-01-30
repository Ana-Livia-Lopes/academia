<header id="header">
        <div id="container">
            <a href="index.php" id="box-img"><img class= "logo" src="img/logo.png" alt="logo"></li></a>
            <nav>
                <ul id="nav1">
                    <li><h3><a id="inicio" href="./index.php">início</a></h3></li>
                    <li><h3><a href="./pagAluno.php">Aluno</a></h3></li>
                    <li><h3><a href="./pagInstrutor.php">Instrutor</a></h3></li>
                    <li><h3><a href="./aulas.php">Aulas</a></h3></li>
                    <li><h3><a href="./loginAlu.php">Entrar</a></h3></li>

                </ul>
                <div id="user-div">
               

                <script>
                    function redirecionar(url) {
                        if (url) {
                            window.location.href = url;
                        }
                    }
                </script>
                </div>
                <input type="checkbox" id="checkbox">
                <label for="checkbox" id="botao">☰</label>
                <ul id="nav2">
                    <li><h3><a id="inicio" href="./index.php">início</a></h3></li>
                    <li><h3><a href="/pagAluno.php">Aluno</a></h3></li>
                    <li><h3><a href="./pagInstrutor.php">Instrutor</a></h3></li>
                    <li><h3><a href="./aulas.php">Aulas</a></h3></li>
                    <li><h3><a href="./loginAlu.php">Entrar</a></h3></li>
                </ul>
            </nav>
        </div>
    </header>


    <style>
        header {
    background-color: rgb(98, 56, 0);
    color:rgb(255, 255, 255);
    padding: 10px;
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 50;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    transition: all 0.4s ease;
}

#header.ativo{
    top: -95px;
    opacity: 0;
}

#container {
    max-width: 1300px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
#box-img{
    width: 180px;
    height: 70px;
    display: flex;
    align-items: center;
}
.logo {
    width: 80px;
    float: left;
}
#nav1{
    margin-left: 8%;
    display: flex;
    justify-content: center;
}
#login{
    color: #0e3960;
    text-decoration: none;
    font-size: 17px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-transform: uppercase;
}
#user-div{
    display: flex;
    align-items: center;
    list-style: none;
}
#user{
    background-color: rgba(255, 255, 255, 0);
    border: none;
    color: #0e3960;
    text-decoration: none;
    font-size: 17px;
    font-weight: bold;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-transform: uppercase;
    cursor: pointer;
    height: 30px;
    margin-top: 7px;
    align-self: center;
}
#opt-nome{
    display: none;
}
#opt-sair{
    background-color: rgb(255, 255, 255);
    font-weight: 600;
    cursor: pointer;
}
header nav {
    display: flex;
    flex-direction: row;
    flex-grow: 1;
    justify-content: space-between;
}

header nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

header nav ul li {
    padding: 10px;
}

header nav ul li a {
    color:rgb(228, 228, 228);
    text-decoration: none;
    font-size: 17px;
    font-weight: bold;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-transform: uppercase;
    margin: 0 3vw;
}

a{
    transition: color 0.3s;
}

a:hover{
    color:rgb(171, 171, 171);
}


#checkbox{
    display: none;
}

#botao{
    display: none;
    font-size: 40px;
    color:#d66e2d;
    cursor: pointer;
    float: right;
    margin-right: 10%;
}

#nav2{ 
    display: none;
    position: absolute;
    background-color:rgba(214, 110, 45, 0.59);
    top: 70px;
    right: 0;
    width: 200px;
    z-index: 1; 
    border: solid 5px #d66e2d);
}

@media (max-width: 768px) {
    #nav1{
        display: none;
    }
    nav{
        justify-content:right;
    }
    #botao{
        display: block;
    }
    #checkbox:checked + #botao + #nav2{
        display: block;
    }
}

    </style>