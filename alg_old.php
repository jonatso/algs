

<?php
if (isset($_POST["addalg"])) {
  $alg = addslashes($_POST["alg"]);
  if (!$result5 = $sql->query("INSERT INTO algs (case_id, alg, time_added, in_use) VALUES ($page, '$alg', now(), 0)")) {
    echo $sql->error;
    exit;
  } else {
    echo "The algorithm was added!";
  }

}

  $result3 = $sql->query("SELECT * FROM cases where case_id = $page");
  while($row = $result3->fetch_assoc()) {
      echo "<div class='caseshowof'><p class='casename2'>".$row['case_name']."</p><img src='http://roudai.net/visualcube/visualcube.php?fmt=png&case=".rawurlencode($row['case_pic'])."&size=200&view=plan&r=y45&bg=t' alt='bildet kan ikke vises...'></div>";
  } ?>

<form class="leggtilalg" action="index.php?case=<?php echo $page ?>" method="post">
  <table>
    <tr>
      <th>Alg</th>
      <th>Time added</th>
      <th>In use</th>
      <th>id</th>
    </tr>

  <?php
  $result4 = $sql->query("SELECT * FROM algs where case_id = $page");
  while($row = $result4->fetch_assoc()) {
    if ($row['in_use']==1) {
      $in_use = "🤍";
    } else {
      $in_use = "❌";
    }
    echo "<tr><td>".$row['alg']."</td><td>".$row['time_added']."</td><td>".$in_use."</td><td>".$row['alg_id']."</td></tr>";
  }
  ?>

    <tr>
      <th colspan="4">Add an algorithm to the database:</th>
    </tr>
    <tr>
      <td colspan="2"><input type="text" name="alg" value=""></td>
      <td colspan="2"><input type="submit" name="addalg" value="Add!"></td>
    </tr>
  </table>
</form>
