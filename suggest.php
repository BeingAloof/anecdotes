<?php
session_start();
?>
<form action="" method = "POST">
    <textarea name="text" id="" cols="30" rows="10"></textarea>
    <select name="category" id="">
        <option value="1">1 категория</option>
        <option value="2">2 категория</option>
        <option value="3">3 категория</option>
    </select>
    <input type="submit">
</form>
<?php
    if(isset($_POST['text']) && isset($_POST['category'])){
        $text = htmlentities($_POST['text']);
        $category = $_POST['category'];
        $link = mysqli_connect("localhost", "root", "root", "db");
        mysqli_query($link, "INSERT INTO upcoming SET text = '$text', category_id = '$category
        '");
            echo '<p>Получено</p>';
    }
?>