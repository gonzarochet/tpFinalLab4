


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Owner</title>
</head>
<body>
    <form action = "<?php echo FRONT_ROOT?>Pet/Add" method="POST">
        <div>
            <label for = "">Name of Pet</label>
            <input type = "text" name = "name">
        </div>
        <div> 
            <label for="">Birth of Pet</label>
            <input type = "date" name = "birthDate">
        </div>
        
        <div>
            <label for = "">VaccinationPlan</label>
            <input type = "text" name = "vaccinationPlan">
        </div>
        <div>
            <label for="">Photo</label>
            <input type = "text" name="picture">
        </div>
        <div>
            <label for="">Breed</label>
            <input type = "text" name="breed">
        </div>
        <div>
            <label for="">Size</label>
            <select name="size">
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Big">Big</option>
            </select>            
        </div>
        <div>
            <label for="">Video</label>
            <input type = "text" name="video">
        </div>
        <div>
            <label for="">Comments</label>
            <textarea name="comments" cols="50" rows="10"></textarea>
        </div>
        
        <div>
            <input type="submit" class="btn" value = "Agregar"/>
        </div>
        
    </form>
    
    <a class="" href="<?php echo FRONT_ROOT ?>Pet/ShowListView">Listar Pets</a>

    <!-- Coolors Palette Widget -->
    <script src="https://coolors.co/palette-widget/widget.js"></script>
      <script data-id="08938602411245342">new CoolorsPaletteWidget("08938602411245342", ["fefeff","d6efff","fed18c","fed99b","fe654f"]); </script>

</body>
</html>


