<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Top Professores</h1>
<?php

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);

/* Ensure that the TOP_PROFESSORES table exists. */
VerifyProfessoresTable($connection, DB_DATABASE);

/* If input fields are populated, add a row to the TOP_PROFESSORES table. */
$prof_nome = htmlentities($_POST['NOME']);
$prof_estrelas = htmlentities($_POST['ESTRELAS']);

if (strlen($prof_nome) || strlen($prof_estrelas)) {
    AddProfessor($connection, $prof_nome, $prof_estrelas);
}
?>

<!-- Input form -->
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NOME</td>
      <td>ESTRELAS</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="NOME" maxlength="50" size="30" />
      </td>
      <td>
        <input type="number" step="0.1" min="0" max="5" name="ESTRELAS" />
      </td>
      <td>
        <input type="submit" value="Adicionar Professor" />
      </td>
    </tr>
  </table>
</form>

<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>NOME</td>
    <td>ESTRELAS</td>
    <td>CRIADO EM</td>
  </tr>

<?php
$result = mysqli_query($connection, "SELECT * FROM TOP_PROFESSORES ORDER BY id DESC");

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>", $query_data[0], "</td>",
       "<td>", $query_data[1], "</td>",
       "<td>", $query_data[2], "</td>",
       "<td>", $query_data[3], "</td>";
  echo "</tr>";
}
?>
</table>

<!-- Clean up. -->
<?php
mysqli_free_result($result);
mysqli_close($connection);
?>

</body>
</html>

<?php
/* Add a professor to the table. */
function AddProfessor($connection, $nome, $estrelas) {
   $n = mysqli_real_escape_string($connection, $nome);
   $e = mysqli_real_escape_string($connection, $estrelas);

   $query = "INSERT INTO TOP_PROFESSORES (nome, estrelas) VALUES ('$n', '$e');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding professor data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyProfessoresTable($connection, $dbName) {
  if(!TableExists("TOP_PROFESSORES", $connection, $dbName))
  {
     $query = "CREATE TABLE TOP_PROFESSORES (
         id INT AUTO_INCREMENT PRIMARY KEY,
         nome VARCHAR(50),
         estrelas DECIMAL(2,1) DEFAULT 0.0,
         criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>

