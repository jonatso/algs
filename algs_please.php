<p>her kommer algsene fra <?php echo $page   ?></p>

<?php
$result2 = $sql->query("SELECT * FROM cases where algset_id = $page");
while($row = $result2->fetch_assoc()) { ?>
    <p><?php $row['case_name'] ?><img src='http://roudai.net/visualcube/visualcube.php?fmt=png&case=<?php rawurlencode($row['case_pic']) ?>&view=plan&r=y45&bg=t' alt='bildet kan ikke vises...'></p>
<?php } ?>

?>
