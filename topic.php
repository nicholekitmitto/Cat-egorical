<?php include("inc/header.php");

$db = connectToDatabase();
if ($_GET) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `questions` WHERE `id` = $id";

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); ?>
    <div class="topic">
      <h1>
      <?php echo $result['subject']; ?>
      </h1>
      <p>
      <?php echo $result['question']; ?>
      <h3>Asked by <a href="#"><span class="underline"><?php echo getUsernameFromId($result['userid']); ?></span></a></h3>
      </p>
    </div>

    <?php
    if (getUsernameFromId($result['userid']) == $_SESSION['username']) { ?>
        <a href="update.php?id=<?php echo $result['id']; ?>">Edit</a>
    <?php }

 }


include("inc/footer.php");
?>