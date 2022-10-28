<div>
    <!-- barre de recherche -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher un joueur">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>

        equipe : <?php echo $_SESSION['login']; ?>
        <button type="button" onclick="window.location.href='index.php?action=tabScore&uc=enigme'">tableau des scores en direct</button>
    </div>