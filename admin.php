<?php
session_start();
if(!empty($_SESSION['auth'])){
    $link = mysqli_connect("localhost", "root", "root", "db");
    if(isset($_GET['checkboxes']) && isset($_GET['choice'])){
        $checkboxes = $_GET['checkboxes'];
        $choice = $_GET['choice'];

        if($choice == '1'){
            foreach($checkboxes as $id){
                $obj = mysqli_query($link, "SELECT * FROM upcoming WHERE id = '$id'");
                $arr = mysqli_fetch_assoc($obj);
                $text = $arr['text'];
                $category = $arr['category_id'];
                mysqli_query($link, "INSERT INTO anecdotes SET text = '$text', category_id = '$category'");
                mysqli_query($link, "DELETE FROM upcoming WHERE id = '$id'");
            }
        }
        else{
            foreach($checkboxes as $id){
                mysqli_query($link, "DELETE FROM upcoming WHERE id = '$id'");
            }
        }
    }
?>
<?php
    $obj = mysqli_query($link, "SELECT *, categories.name as category FROM upcoming 
    LEFT JOIN categories ON categories.id = upcoming.category_id");
    for($data = [];$arr = mysqli_fetch_assoc($obj);$data[] = $arr);
?>
    <form action="">
    <?php
            $str = '<table>';
            foreach($data as $elem){
                $str .= "<tr><td>$elem[text]</td><td>$elem[category]</td><td><input type = \"checkbox\" value = \"$elem[id]\" name = \"checkboxes[]\"></td></tr>";
            }
            $str .= '</table>';
            echo $str;
    ?>
    <input type="radio" value = '1'>добавить
    <input type="radio" value = '2'>удалить
    <input type="submit">
</form>
<?php
}
else{
    header('Location: http://task/auth.php');
}