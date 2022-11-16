<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Pets</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-pet">
        <form action="<?php echo FRONT_ROOT ?>Pet/DeactivatePet" method="post">
            <h1>Pets List</h1>
            <table class="list-pet">
                <thead>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Breed</th>
                    <th>Size</th>
                    <th>Picture</th>
                    <th>Vaccination Plan</th>
                    <th>Video </th>
                    <th>Comments </th>
                    <th>Available</th>
                    <th> </th>
                </thead>
                <tbody>
                    <?php
                    foreach ($ownerPetList as $pet) {
                    ?>
                        <tr>
                            <td><?php echo $pet->getName() ?></td>
                            <td><?php echo $pet->getAge() ?></td>
                            <td><?php echo $pet->getBreed() ?></td>
                            <td><?php echo $pet->getSize() ?></td>
                            <td><img width="60" height="60" src="<?php echo FRONT_ROOT.$pet->getPicture()?>"></td>
                            <td><img width="60" height="60" src="<?php echo FRONT_ROOT.$pet->getVaccinationPlan()?>"></td>
                            <?php if(!$pet->getVideo()){?>    
                            <td><img width="100" height="100" src="https://descubrecomohacerlo.com/wp-content/uploads/mch/error-youtube-videos_4028.jpg" alt="Video no disponible" title="Video no disponible"> </td>
                            <?php } else{ ?>
                            <td><video width="200" height="200" autoplay muted> <source src="<?php echo FRONT_ROOT.$pet->getVideo();?>" type="video/mp4"></video></td>
                            <?php } ?>

                             
                            <!--<td><?php $image = $pet->getPicture();
                                if (!filter_var($image, FILTER_VALIDATE_URL) === false) {
                                    $imageData = base64_encode(file_get_contents($image));
                                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" width="auto" height="100">';
                                }
                                ?></td>
                            <td><?php $image = $pet->getVaccinationPlan();
                                if (!filter_var($image, FILTER_VALIDATE_URL) === false) //valdiates if url is valid
                                {
                                    $imageData = base64_encode(file_get_contents($image));
                                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" width="auto" height="100">';
                                }
                                ?></td>
                            <td>
                                <iframe width="150" height="130" src="<?php if (!filter_var($pet->getVideo(), FILTER_VALIDATE_URL) === false) {
                                                                            echo $pet->getVideo();
                                                                        } ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                            </td>-->
                            
                            <td><?php echo $pet->getComments() ?></td>
                            <td><?php echo $pet->getIsActive() ?></td>
                            <td><?php if ($pet->getIsActive() == 'Yes') {
                                ?>
                                    <td><button type="submit" name="petid" class="btn-table" value="<?php echo $pet->getIdPet() ?>">Desactivate Pet </button> </td>
                                <?php
                                }?>
                            </td>
                            
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
        </form>
    </div>
    </table>
    <?php echo $message ?><br>
    <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashsboard</a>
</body>

</html>