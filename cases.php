<div class="caser">
  <?php
  $result2 = $sql->query("SELECT * FROM cases where algset_id = $page");
  while($row = $result2->fetch_assoc()) {
    echo "<div class='caseboks'><div class='caseboks_el'><a href='index.php?case=".$row['case_id']."'><p class='casename'>".$row['case_name']."</p>";

    echo "<img src='http://roudai.net/visualcube/visualcube.php?fmt=svg&case=".rawurlencode($row['case_pic'])."&view=plan&r=y45&bg=t' alt='bildet kan ikke vises...'></a></div><div class='caseboks_el2'>";
    $case = $row['case_id'];
    $result3 = $sql->query("SELECT * FROM algs where case_id = $case ORDER BY in_use DESC LIMIT 4");
    while($row2 = $result3->fetch_assoc()) {
      echo "<p class='algminiview'>".$row2['alg']."</p>";
    }
    echo "</div></div>";
  }
  ?>
</div>
