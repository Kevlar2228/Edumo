<?php

require 'header.php';
require 'includes/db.inc.php';

$idClass = $_GET['idClass'];
$_SESSION['idClass'] = $idClass;
$userType = $_SESSION['typeSet'];
$idUsers = $_SESSION['idUsers'];

$sql = "SELECT * FROM classes WHERE idClasses=?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
     $_SESSION['error'] = 'sqlerror1';
     header('Location: /Edumo/class.php?idClasses='.$idClass);
     exit();
}

mysqli_stmt_bind_param($stmt, "s", $idClass);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);

$name = $row['nameClasses'];
$desc = $row['descClasses'];
$semester = $row['semesterClasses'];
$owner = $row['ownerClasses'];

echo '
     <h1>'.$name.'</h1>
     <p>'.$desc.'</p>
     <p>'.$semester.'</p>
';

if ($owner == $idUsers) {
     echo '<a href="changeClass.php?idClass='.$idClass.'">Change Class</a>';
}
?>
<br><br>



<a href="assignments.php">Assignments</a>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("includes/search.inc.php?classId=<?=$idClass ?>", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

<?php

if ($userType == "teacher") {
     echo '
     <div class="search-box">
          <label for="uid">Add User:</label>
          <input type="text" name="uid" autocomplete="off" placeholder="Username" />
          <div class="result"></div>
     </div>
     ';
}

 ?>



Users:
<br>

<?php

$sql = "SELECT * FROM classes WHERE idClasses=?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
     $_SESSION['error'] = 'sqlerror1';
     header('Location: /Edumo/class.php?idClasses='.$idClass);
     exit();
}

mysqli_stmt_bind_param($stmt, "s", $idClass);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {

     if (empty($row['memberClasses'])) {
          echo "No members yet";
          exit();
     }

     $members = explode(",", $row['memberClasses']);

     $memberCount = count($members);

     for ($x = 0; $x <= $memberCount-1; $x++) {
          $sql = "SELECT * FROM users WHERE idUsers=?";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
               $_SESSION['error'] = 'sqlerror1';
               header('Location: /Edumo/class.php?idClasses='.$idClass);
               exit();
          }

          mysqli_stmt_bind_param($stmt, "s", $members[$x]);
          mysqli_stmt_execute($stmt);

          $result2 = mysqli_stmt_get_result($stmt);

          $row2 = mysqli_fetch_assoc($result2);

          echo $row2['uidUsers'].' '.$row2['typeSet'];
          echo '<br>';
     }
}

?>
<?php require 'footer.php'; ?>
