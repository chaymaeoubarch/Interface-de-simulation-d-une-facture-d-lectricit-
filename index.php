<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link re="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet"  href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

  <div class="col">  
    <div class="row justify-content-center">
            <div class="container mt-5">
              <div class="row mb-5">
              <h1>Facture d'électricité simulée</h1>
              </div>
            <form action="facturePDF.php" class="offset-md-3 col-md-6" method="POST">
                <div class="row mb-5">
                <label>Ancien index : </label>
                <input type="text"  name="firstIndex" placeholder="Ancien index"  pattern="\d{1,12}" required>
                </div>
                <div class="row mb-5">
                <label>Nouvel index : </label>
                <input type="text"  name="secondIndex"  placeholder="Nouvel index" pattern="\d{1,12}"required>
                </div>

                <div class="row mb-5">

                <label for="cars">Choisir le type de calibre : </label>
                <select class="form-select"  name="cars" value="cars" id="cars">
                <option value="22,65">calibre 5-10</option>
                    <option value="37,05">calibre 15-20</option>
                    <option value="46,20">calibre > 30</option>
                </select>
                </div>
                <div class="row mb-2">
                    <button class="btn btn-success btn-lg btn-block">create PDF</button>
                </div>
            </form>

            </div>
    </div>
  </div>

  <?php
  if (phpversion() != '7.3.33') {
    echo '<script>alert("cette application ne prend en charge que php 7 téléchargez-la ici : https://www.apachefriends.org/download.html")</script>';
    echo 'cette application ne prend en charge que php 7 téléchargez-la <a href="https://www.apachefriends.org/download.html"> ici </a> ';
  } 
  // echo '<script>alert("qwe");</script>';
  ?>
</body>
</html>
