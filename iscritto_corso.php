<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=lazzaroni_gym", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    die("Could not connect. " . $e->getMessage());
    }
    

    
    if ($_POST) {
        $id_corso = $_POST['corso'];
        $id_membro = $_POST['iscritto'];
        $data_iscrizione = date("Y/m/d");
        $orario_preferito = $_POST['orario'] . ":00";

        try {
            $sql = "INSERT INTO iscrizioni_corsi (id_corso, id_membro, data_iscrizione, orario_preferito) VALUES (:id_corso, :id_membro, :data_iscrizione, :orario_preferito)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_corso', $id_corso);
            $stmt->bindParam(':id_membro', $id_membro);
            $stmt->bindParam(':data_iscrizione', $data_iscrizione);
            $stmt->bindParam(':orario_preferito', $orario_preferito);
            $stmt->execute();
            echo "iscritto aggiunto con successo al corso.";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    // Close connection
    $conn = null;
     




?>