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

</body>
</html>