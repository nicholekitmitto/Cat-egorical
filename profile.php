<?php include("inc/header.php"); ?>
<body id="profile">
<?php
if ($_GET):
    $db = connectToDatabase();
    $user = $_GET['id'];
    $query = "SELECT * FROM `users` WHERE `id` = $user";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); ?>
    <div class="profile-info">
      <h1>
        <?php echo $result['username']; ?>
      </h1>
      <?php
      if (getUsernameFromId($result['id']) == $_SESSION['username']) { ?>
        <a href="userdetails.php?id=<?php echo getUserId($_SESSION['email']); ?>" class="small round button edit">Edit Profile</a>
      <?php } ?>
      <p><span class="profilespec">About <?php echo $result['username']; ?>:</span>
        <?php echo $result['bio']; ?>
      </p>
      <p><span class="profilespec">Lives in:</span>
        <?php echo $result['country'] ?>
      </p>
      <p>
        See all questions asked by <?php echo $result['username']; ?> <a href="userquestions.php?id=<?php echo $result['id']; ?>">here</a>!
      </p>
    </div>
<?php endif;



include("inc/footer.php");
?>