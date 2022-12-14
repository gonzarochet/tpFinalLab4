<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Pets</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
<table>
    <thead>
        <th>ID</th>
        <th>Name</th>  
        <th>Age</th>   
        <th>Breed</th>
        <th>Size</th>
        <th>Picture</th>
        <th>Vaccination Plan</th>
        <th>Video </th>
        <th>Comments </th>
        <th>Owner</th>   
    </thead>
    <tbody>
        <?php
            foreach($petList as $pet)
            {
                ?>
                    <tr>                        
                        <td><?php echo $pet->getIdPet() ?></td>
                        <td><?php echo $pet->getName() ?></td>                        
                        <td><?php echo$pet->getAge() ?></td>
                        <td><?php echo $pet->getBreed() ?></td>
                        <td><?php echo $pet->getSize() ?></td>
                        <td><?php $image = $pet->getPicture();
                                    if (!filter_var($image, FILTER_VALIDATE_URL) === false)
                                    {
                                        $imageData=base64_encode(file_get_contents($image));
                                        echo '<img src="data:image/jpeg;base64,'.$imageData.'" width="auto" height="150">';
                                    }                                    
                         ?></td>
                        <td><?php $image= $pet->getVaccinationPlan();
                                if (!filter_var($image, FILTER_VALIDATE_URL) === false) //valdiates if url is valid
                                {
                                    $imageData=base64_encode(file_get_contents($image));
                                    echo '<img src="data:image/jpeg;base64,'.$imageData.'" width="auto" height="150">';
                                }                                                           
                        ?></td>                     
                        <td>
                        <iframe width="auto" height="150" src="<?php if (!filter_var($pet->getVideo(), FILTER_VALIDATE_URL) === false)
                                                                        {
                                                                            echo $pet->getVideo();
                                                                        }?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                        </td>
                        <td><?php echo $pet->getComments() ?></td>
                        <td><?php echo $pet->getOwner()->getOwnerId().": ".$pet->getOwner()->getUser()->getUsername() ?></td>                        
                    </tr>
                <?php
            }
        ?>  
        
    </tbody>
</table>
</body>
</html>