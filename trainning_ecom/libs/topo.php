<?php        
    include __DIR__ . '/config.php';
    error_reporting(0);    
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="mb-4 logo" src="<?php global $config; echo $config["URL_PORTAL"] ."/" ?>media/logo2.png" alt="" width="80">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?php global $config; echo $config["URL_PORTAL"] ."/" ?>">Home <span class="sr-only">(current)</span></a>
            </li>                    
        </ul>
        <form action="<?php global $config; echo $config["URL_PORTAL"] . "/" ?>logout.php" method="post" class="form-inline my-2 my-lg-0">                                    
        <?php 
                    
                    global $config; 
                    if(!isset($_SESSION)){session_start();}                    
                    if(empty($_SESSION["nomeCliente"])){
                        echo "<a class='lnk-entrar' href='". $config['URL_PORTAL'] ."'>Entrar</a>";                         
                    }
                    else{
                        global $config;
                        echo "<span class='nome-cliente'>Olá <a href='" . $config["URL_PORTAL"] . "/clientes'>". $_SESSION["nomeCliente"] . "</a></span>".
                        "<button class='btn btn-logout my-2 my-sm-0' type='submit'>[Sair]</button>";
                    }
                ?>                                    
        </form>
        <form class="form-inline my-2 my-lg-0">            
            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisa">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisa</button>
        </form>
        <div class="user-profile">
            <a href='<?php global $config; echo $config["URL_PORTAL"] ."/carrinho"; ?>'>
            <span class="total-car badge badge-pill badge-danger">                
                <?php echo empty($_COOKIE["carrinho"]) ? 0 : count(json_decode($_COOKIE["carrinho"])); ?>
            </span>
            </a>
            <img  src="<?php global $config; echo $config["URL_PORTAL"] ."/" ?>media/user.png">
        </div>
    </div>
</nav>