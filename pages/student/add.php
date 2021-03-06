<?php
include("../../db_connexion.php");
?>


<?php
$query = "SELECT * FROM  `tuteur` ORDER BY `id` DESC";
$resultats = mysqli_query($connexion, $query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/all.css">
    <link rel="stylesheet" href="../../css/student/add.css">
    <title>Hello, world!</title>
</head>

<?php
if (isset($_GET["success"])) {
    if ($_GET["success"] == 1) {
        echo '
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="../../images/main-logo.png" width="50" height="50" class="rounded me-2" alt="...">
                    <strong class="me-auto">Universite Joseph Ki-Zerbo / URF (SDS) </strong>
                    <small>A l\'instant</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Felicitation, vous avez ajouter un nouveau Tuteur
                </div>
        </div>
      </div>
    ';
    }
}

if (isset($_GET["error"])) {
    echo '
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <img src="../../images/main-logo.png" width="50" height="50" class="rounded me-2" alt="...">
            <strong class="me-auto">Universite Joseph Ki-Zerbo / URF (SDS) </strong>
            <small>A l\'instant</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body bg-danger">
            Echec lors de l\'ajout du Tuteur
          </div>
        </div>
      </div>
    ';
}
?>

<body>
    <form action="../student/process/add.php" method="post" class="card container admin-form">
        <img src="../../images/main-logo.png" alt="logo" class="logo">
        <div class="btn-container">
            <span class="con-ins btn-connexion  btn">Ajouter un Etudiant</span>
        </div>
        <div class="inscription">
            <label for="telephone">Selectionner le Tuteur</label><br>
            <select type="select" name="tuteur" placeholder="Tuteur" class="mt-3 p-2">
                <?php
                while ($row = mysqli_fetch_assoc($resultats)) {
                    echo "<option value='$row[id] '> $row[user] ($row[telephone])</option>";
                }
                ?>
            </select>
            <div type="button" class="btn-container-tut my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="con-ins  btn">Nouveau Tuteur</span>
            </div>
            <div class="row">
                <div class="col-5">
                    <label for="nom"> Nom</label>
                    <input required type="text" name="nom" placeholder="Nom" class="mt-3 p-2 col-6">
                </div>
                <div class="col-6">
                    <label for="prenom"> Prenom</label>
                    <input required type="text" name="prenom" placeholder="prenom" class="mt-3 p-2 col-6">
                </div>
            </div>
            <div class="col">
                <label for="email"> Email</label> <br>
                <input required type="email" name="email" placeholder="Email" class="mt-3 p-2 ">
            </div>
            <label for="naissance">Date de naissance</label></br>
            <input required type="text" name="naissance" onfocus="(this.type='date')" placeholder="Date de naissance" class="mt-3 p-2">
            <label for="telephone"> Telephone</label>
            <input required type="text" name="telephone" placeholder="Telephone" class="mt-3 p-2"><br>
            <div class="submit-container">
                <input type="submit" name="enregistrer" value="Enregistrer" class="submit mt-3 mb-3  btn" style="margin-left: 0 !important;">
            </div>
        </div>
    </form>
    <br>
    <br>
    <div id="tri"></div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Associer un tuteur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../tutor/add.php" method="post" class="card container tut-form">
                        <div class="inscription">
                            <input required type="text" name="nom-tuteur" placeholder="Nom & Prenom" class="mt-3 p-2">
                            <input required type="email" name="email-tuteur" placeholder="Email" class="mt-3 p-2">
                            <input required type="text" name="tel-tuteur" placeholder="Telephone " class="mt-3 p-2">
                            <div class="submit-container">
                                <input type="submit" name="associer" value="Associer" class="submit mt-3 mb-3  btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        var toastLiveExample = document.getElementById('liveToast');
        var toast = new bootstrap.Toast(toastLiveExample)
        toast.show()
    </script>
</body>

</html>