<?php include "parts/head.php"; ?>
<body>
    <?php include "parts/header.php"; ?>
    <main class="container">
        <?php
        //Identificar se o ID foi informado
        $id = 0;
        $musica = null;
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $conn = new PDO("sqlite:musicas.sqlite");
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $p = $conn->prepare("SELECT * FROM musicas WHERE id=:id;");
            $p->bindParam(":id", $id);
            $p->execute();
            $musica = $p->fetch();
        }
        ?>
        <form action="ws/save.php" method="get">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <label for="txtMusica">Música</label>
                <input type="text" class="form-control" name="nome" id="txtMusica" placeholder="Nome da música"
                value="<?= is_null($musica)?'':$musica->nome?>">
            </div>
            <div class="form-group">
                <label for="txtBanda">Banda</label>
                <input type="text" class="form-control" name="banda" id="txtBanda" placeholder="Nome da banda"
                value="<?= is_null($musica)?'':$musica->banda?>">
            </div>
            <input type="submit" value="Salvar" class="btn btn-success">
            <a href="index.php" class="btn btn-danger">Cancelar</a>
        </form>
    </main>
    <?php include "parts/footer.php"; ?>
</body>
</html>