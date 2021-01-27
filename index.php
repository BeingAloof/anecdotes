<a href="suggest.php">Предложи свой анекдот</a>
<form action="">
    <select name="category" id="">
        <option value="1">1 категория</option>
        <option value="2">2 категория</option>
        <option value="3">3 категория</option>
    </select>
    <input type="submit">
</form>
<?php
    if(isset($_GET['category'])){
        if(empty($_GET['page']))
            $from = 0;
        else
            $from = $_GET['page'] * 3;
        $category = $_GET['category'];
        $link = mysqli_connect("localhost", "root", "root", "db");
        $obj = mysqli_query($link, "SELECT * FROM anecdotes WHERE category_id = '$category'");
        for($data = []; $arr = mysqli_fetch_assoc($obj); $data[] = $arr);
        for($i = 0; $i < (ceil(count($data) / 3)); $i++){
            $index = $i + 1;
            echo "<a href = \"?page=$i&category=$category\">$index</a>";
        }
        $obj = mysqli_query($link, "SELECT * FROM anecdotes WHERE category_id = '$category' LIMIT 3 OFFSET $from") or die(mysqli_error($link));
        for($data = []; $arr = mysqli_fetch_assoc($obj); $data[] = $arr);
        foreach($data as $elem){
            echo "<p>$elem[text]</p>";
        }
    }
?>