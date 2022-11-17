<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php 
    use Models\Owner;
    use Models\Review;
use Services\SessionsHelper;

    include("nav.php"); 
    $owner = new Owner();
    $owner = SessionsHelper::getOwnerSession();          
    ?>
    <section class="principal-register">
        <div class="form-register">
            <form action="<?php echo FRONT_ROOT ?>Review/GenerateReview" method="POST">
                <h1>Share your review</h1>
                <div class="form-content-register">
                    <label for="">Score</label>
                    <select name="score">
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars </option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                    <span class="error"><?php echo @$message ?></span>
                </div>
                <div class="form-content-register">
                    <label for="">Comment</label>
                    <input type="text" name="comment" required>
                    <span class="error"><?php echo @$message ?></span>
                </div>
                <button type="submit" name = "bookingNr" value = "<?php echo $bookingNr?>" class="btn">Accept</button>

            </form>
            <a class="cancel-register-register" href="<?php echo FRONT_ROOT?>Owner/OwnerLogin">Cancel</a>
        </div>


</body>

</html>