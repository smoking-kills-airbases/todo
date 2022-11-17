<?php 
session_start();

setcookie('Test', '...', time()+3600);

if (isset($_COOKIE['Test'])) {
    $thisCookie = json_decode($_COOKIE['Test']);
} else {
    $thisCookie = [];
}

$file = 'todoitems.txt';

if (@file_get_contents($file)) {
    $fileValues = json_decode(file_get_contents($file));
} else {
    $fileValues = [];
}




if (!isset($_SESSION["todo_list_values"])) {
    $_SESSION["todo_list_values"] = [];
}

$toDoList = $_POST;

if (isset($toDoList["ToDo"])) {
    $toDoItem = $toDoList["ToDo"];
    
    // veikia ir vienas ir kitas:
    $_SESSION["todo_list_values"][] = $toDoItem;
    // array_push($_SESSION["todo_list_values"], $toDoItem);

    $thisCookie[] = $toDoItem;
    setcookie('Test', json_encode($thisCookie), time()+3600);
    
    $fileValues[] = $toDoItem;
    file_put_contents($file, json_encode($fileValues));
} else {
    $toDoItem = null;
}



// var_dump($thisCookie);


// var_dump($_SESSION);
// session_destroy();
?>

<html lang="">
    <head>
        <style>
        </style>
        <title>To do list</title>
    </head>
    <body>
        <h2>To Do</h2>

        <form action="todo.php" method="post">
            <label>To do</label>
            <input type="string" id="ToDo" name="ToDo" value="">
            <input type="submit" value="Submit">
        </form> 

        <br>
        
        <?php if ($toDoItem) { ?>
        <div> dalykai kuriuos reikia atlikti : <br> <?php 
            
            foreach($_SESSION["todo_list_values"] as $value) { ?>
                <div> <?php echo $value ?> </div> <br>
            <?php } ?>
        
        </div>
        <?php } ?>
        
        <br>
        <p>---------------------------------------------------</p>
        <br>
        <div> dalykai is cookie : <br> <?php 
            foreach($thisCookie as $value) { ?>
                <div> <?php echo $value ?> </div> <br>
            <?php } ?>
        </div>
        <br>
        <br>

        <br>
        <p>---------------------------------------------------</p>
        <br>
        <div> dalykai is failo : <br> <?php 
            foreach($fileValues as $value) { ?>
                <div> <?php echo $value ?> </div> <br>
            <?php } ?>
        </div>
        <br>
        <br>

        1. Sukurkite formą skirtą skirta susivesti TODO sąrašą. <br>
        <br>
        - forma turi turėti vieną įvedimo laukelį tekstui ir submit mygtuką. <br>
        <br>
        2. Išveskite paduotus formos rezultatus TODO sąraše (Naudokite tik $_POST duomenis). <br>
        3. Pabandykite saugoti susivestą TODO informaciją. <br>
        3.1. Parašykite funkcionalumą, kuomet TODO įrašas saugomas sesijoje <br>
        3.2. Parašykite funkcionalumą, kuomet TODO įrašas saugomas cookies <br>
        3.3. Parašykite funkcionalumą, kuomet TODO įrašas saugomas file <br>
        <br>
        Papildomai <br>
        <br>
        4. Papildykite forma lauku due_date ir išveskite due dayte formatu : 25-01-1999<br>
        <br>
        5. Pridėkite pašalinimo galimybę todo itemui.<br>
        <br>

    </body>
</html>

