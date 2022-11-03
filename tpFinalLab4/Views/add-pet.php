

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    
</head>

<body>
    <?php include("nav.php"); ?>
    <section id="add-pet-principal">
        <div class="form-add-pet">
            <form action="<?php echo FRONT_ROOT ?>Pet/Add" method="POST">
                <h1>Add Pet</h1>
                <div class="form-content-add-pet">
                    <label for="">Name of Pet</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-content-add-pet">
                    <label for="">Birth of Pet</label>
                    <input type="date" name="birthDate" required>
                </div>

                <div class="form-content-add-pet">
                    <label for="">VaccinationPlan</label>
                    <input type="text" name="vaccinationPlan">
                </div>
                <div class="form-content-add-pet">
                    <label for="">Photo</label>
                    <input type="text" name="picture">
                </div>
                <div class="form-content-add-pet">
                    <label for="">Breed</label>
                    <input type="text" name="breed">
                </div>
                <div class="form-content-add-pet">
                    <label for="">Size</label>
                    <select name="size">
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Big">Big</option>
                    </select>
                </div>
                <div class="form-content-add-pet">
                    <label for="">Video</label>
                    <input type="text" name="video">
                </div>
                <div class="form-content-add-pet">
                    <label for="">Comments</label>
                    <textarea name="comments" cols="50" rows="10"></textarea>
                </div>
                <div class="form-content-add-pet-btn">
                    <input type="submit" class="btn" value="Agregar" />
                </div>
            </form>
            <a class="btn-goback" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashboard</a>
        </div>
    </section>

</body>

</html>