<?php
if (isset($_POST["addalg"])) {
  $alg = addslashes($_POST["alg"]);
  if (!$result5 = $sql->query("INSERT INTO algs (case_id, alg, time_added, in_use) VALUES ($page, '$alg', now(), 0)")) { //adder ny alg
    echo $sql->error;
    exit;
  } else {
    echo "The algorithm was added";
  }

  if (!$result8 = $sql->query("UPDATE cases SET case_pic='$alg' where case_id=$page")) { //endrer bilde når ny alg blir lagt til, kan fjernes når alle cases har alg
    echo $sql->error;
    exit;
  } else {
    echo " and the picture was updated";
  }

}

if (isset($_POST["usethisone"])) {
  $alg_id = $_POST["usethisone"];
  if (!$result7 = $sql->query("UPDATE algs SET in_use=0 WHERE in_use=1 AND case_id=$page")) { //setter andre algs til ikke i bruk
    echo $sql->error;
    exit;
  }

  if (!$result6 = $sql->query("UPDATE algs SET in_use=1 WHERE alg_id=$alg_id")) { //setter nyvalgt alg til i bruk
    echo $sql->error;
    exit;
  } else {
    echo "You've changed your main alg!";
  }
}

if (isset($_POST["deletealg"])) {
  $alg_id = $_POST["deletealg"];
  if (!$result5 = $sql->query("DELETE FROM algs WHERE alg_id=$alg_id")) { //sletter valgt alg
    echo $sql->error;
    exit;
  } else {
    echo "The algorithm was deleted!";
  }
}


  $result3 = $sql->query("SELECT * FROM cases where case_id = $page");
  while($row = $result3->fetch_assoc()) {
      echo "<div class='caseshowof'><p class='casename2'>".$row['case_name']."</p><img src='http://roudai.net/visualcube/visualcube.php?fmt=svg&case=".rawurlencode($row['case_pic'])."&size=200&view=plan&r=y45&bg=t' alt='bildet kan ikke vises...'></div>";
  } ?>

<form class="leggtilalg" action="index.php?case=<?php echo $page ?>" method="post">
  <table>
    <tr>
      <th>Alg</th>
      <th>Time added</th>
      <th>In use</th>
      <th>Change</th>
      <th>Delete</th>
    </tr>

  <?php
  $result4 = $sql->query("SELECT * FROM algs where case_id = $page ORDER BY in_use DESC");
  while($row = $result4->fetch_assoc()) {
    if ($row['in_use']==1) {
      $in_use = "🤍";
    } else {
      $in_use = "🤷";
    } ?>
    <tr><td><?php echo $row['alg'] ?></td><td><?php echo $row['time_added'] ?></td><td><?php echo $in_use ?></td><td><button type="submit" name="usethisone" value="<?php echo $row['alg_id'] ?>">Main</button></td><td><button type="submit" name="deletealg" value="<?php echo $row['alg_id'] ?>">X</button></td></tr>
  <?php
  }
  ?>

    <tr>
      <th colspan="5">Add an algorithm to the database:</th>
    </tr>
    <tr>
      <td colspan="2"><input type="text" name="alg" value=""></td>
      <td colspan="3"><input type="submit" name="addalg" value="Add!"></td>
    </tr>
  </table>
</form>

<a class="teleportnextpage" href="index.php?case=<?php echo $page+1 ?>">Next alg</a>
