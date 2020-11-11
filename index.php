<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="http://cube.rider.biz/visualcube.jpg?fmt=svg&size=200&view=plan&case=y2%27F%20R2%20U%20R%27%20D%20R2%20D%27%20R%20U%27%20R2%20F%27%20R%20U%27%20R%27">
    <link rel="stylesheet" href="gaming.css">
    <title>algs</title>
  </head>
  <body>

<?php $sql = new mysqli("mysql.stud.ntnu.no", "jonatso_admin", "fiskesaus", "jonatso_algorithms") ?>
    <div class="navbar">
      <ul>
        <li><a href="index.php">Home</a></li>

<?php
$result1 = $sql->query("SELECT * FROM algsets");
while($row = $result1->fetch_assoc()): ?>
        <li><a href="index.php?set=<?php echo $row['algset_id']; ?>"><?php echo $row['algset_name']; ?></a></li>
<?php endwhile; ?>
      </ul>
    </div>
    <?php if (isset($_GET['set'])) {
      $page = $_GET['set'];
      include 'cases.php';
    } elseif (isset($_GET['case'])) {
      $page = $_GET['case'];
      include 'algs.php';
    } else {
      include 'home.php';
    }
     ?>
  </body>
</html>
