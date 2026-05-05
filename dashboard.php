<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>dashboard</h1>    

    <h2>inserisci iscritto a corso</h2>
    <form action="iscritto_corso.php" method="post">
        <label>Corso:</label>
        <select name="corso">
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
                
                try {
                $sql = "SELECT * FROM corsi;";
                $result = $conn->query($sql);
                $corsi = $result->fetchAll();

                foreach ($corsi as $corso) {
                    echo "<option value='" . $corso['id_corso'] . "'>" . $corso['nome_corso'] . " " . $corso['livello_difficolta'] . "</option>";
                }

                } catch(PDOException $e) {
                // Handle errors during query execution
                echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                }

                // Close connection
                $conn = null;
                        
            ?>
        </select>

        <label>membro</label>
        <select name="iscritto">
        
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
                
                try {
                $sql = "SELECT * FROM membri;";
                $result = $conn->query($sql);
                $iscritti = $result->fetchAll();

                foreach ($iscritti as $iscritto) {
                    echo "<option value='" . $iscritto['id_membro'] . "'>" . $iscritto['nome'] . " " . $iscritto['cognome'] . "</option>";
                }

                } catch(PDOException $e) {
                // Handle errors during query execution
                echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                }

                // Close connection
                $conn = null;
                        
            ?>


        </select>
        <label>orario preferito</label>
        <input type="time" name="orario" required>

        <input type="submit">


    </form>

    
    <h2>istruttori con almeno 5 (per dubugging alemeno 0 iscritti - vedi codice) iscritti:</h2>
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
        
        try {
        // ci vorrebbe HAVING count(c.nome_corso) >= 5 ma per debugging non avendo popolato abbastanza il database lascio cosi
        $sql = "SELECT i.nome , i.cognome, c.nome_corso, count(c.nome_corso) FROM istruttori i, iscrizioni_corsi ic, corsi c WHERE i.id_istruttore = c.id_istruttore AND c.id_corso = ic.id_corso GROUP BY i.nome , i.cognome, c.nome_corso HAVING count(c.nome_corso) >= 0;";
        $result = $conn->query($sql);
        $istruttori = $result->fetchAll();

        foreach ($istruttori as $istruttore) {
            echo $istruttore['nome'] . " " . $istruttore['cognome'] . ", " . $istruttore['nome_corso'] . ": " . $istruttore['count(c.nome_corso)'] . " iscritti <br>";
        }

        } catch(PDOException $e) {
        // Handle errors during query execution
        echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
        }

        // Close connection
        $conn = null;
    
    ?>

    <h2>visualizza iscritti di un corso</h2>
    <form action="dashboard.php" method="post">
        <h3>seleziona corso</h3>
        <select name="corso">
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
                
                try {
                $sql = "SELECT * FROM corsi;";
                $result = $conn->query($sql);
                $corsi = $result->fetchAll();

                foreach ($corsi as $corso) {
                    echo "<option value='" . $corso['id_corso'] . "'>" . $corso['nome_corso'] . " " . $corso['livello_difficolta'] . "</option>";
                }

                } catch(PDOException $e) {
                // Handle errors during query execution
                echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                }

                // Close connection
                $conn = null;
                        
            ?>

        </select>

        <input type="submit">
        

    </form><br>

    <?php
    
        if (isset($_POST["corso"])){
            $corso = $_POST["corso"];
            //echo $_POST["corso"]; //debug


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
                
                try {
                $sql = "SELECT m.id_membro, m.nome, m.cognome FROM corsi c, iscrizioni_corsi ic, membri m  WHERE c.id_corso = $corso AND c.id_corso = ic.id_corso AND ic.id_membro = m.id_membro ;";
                $result = $conn->query($sql);
                $membri = $result->fetchAll();

                foreach ($membri as $membro) {
                    echo $membro['nome'] . " " . $membro['cognome'] . "<form action='change_corso.php' method='post'>
                                                                            <label>cambia corso</label>
                                                                            <select name='corso'>";

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
                                                                            
                                                                            try {
                                                                            $sql = "SELECT * FROM corsi;";
                                                                            $result = $conn->query($sql);
                                                                            $corsi = $result->fetchAll();
                                                            
                                                                            foreach ($corsi as $corso) {
                                                                                echo "<option value='" . $corso['id_corso'] . "'>" . $corso['nome_corso'] . " " . $corso['livello_difficolta'] . "</option>";
                                                                            }
                                                            
                                                                            } catch(PDOException $e) {
                                                                            // Handle errors during query execution
                                                                            echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                                                                            }
                                                            
                                                                            // Close connection
                                                                            $conn = null;

                
                                                                    echo "</select><input type=submit></form><br>";
                }

                } catch(PDOException $e) {
                // Handle errors during query execution
                echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                }

                // Close connection
                $conn = null;
                        








        }
    
    
    
    ?>



</body>
</html>