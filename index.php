<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Products</title>
</head>

<body>
    <?php 
    include 'db.php'; //db connection

        $sort = isset($_GET['sort']) ? $_GET['sort'] : ''; //filter in php
        $query = "SELECT * FROM products";

        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
        if (!empty($filter)) {
            $query .= " WHERE `Название товара` LIKE '%" . mysqli_real_escape_string($link, $filter) . "%'";
        }
    
        switch ($sort) { //sort in php
            case 'asc':
                $query .= " ORDER BY Цена ASC";
                break;
            case 'desc':
                $query .= " ORDER BY Цена DESC";
                break;
        }
    
        $sql = mysqli_query($link, $query);
        if (!$sql) {
            die('Ошибка выполнения запроса!');
        }
    ?>
    <h1>Таблица Products</h1>
    <p>
        Сортировать по цене:
        <a class="sort-link" href="?sort=asc">По возрастанию</a> |
        <a class="sort-link" href="?sort=desc">По убыванию</a> |
        <a href="?filter=<?php echo urlencode($filter); ?>">Сбросить сортировку</a>
    </p>

    <p>
        Введите название товара:
        <form method="GET" action="">
            <input type="text" name="filter" value="<?php echo htmlentities($filter); ?>">
            <input type="hidden" name="sort" value="<?php echo $sort; ?>">
            <button type="submit">Применить фильтр</button>
            <a href="?">Сбросить фильтр</a>
        </form>
    </p>
    
    <table class="iksweb"> 
        <tbody>
            <tr>
                <td style="color: #1E90FF;">Название товара</td>
                <td style="color: #32CD32;">Цена</td>
                <td>Наличие товара</td>
                <td>ID товара</td>
            </tr>
            <?php  //db output
            while ($row = mysqli_fetch_assoc($sql)) {
                $productName = $row['Название товара'];
                $price = $row['Цена'];
                $availability = $row['Наличие товара'];
                $productId = $row['ID товара'];
            ?>
                <tr>
                    <td style="color: #1E90FF;"><?php echo $productName; ?></td>
                    <td style="color: #32CD32;"><?php echo $price; ?></td>
                    <td><?php echo $availability; ?></td>
                    <td><?php echo $productId; ?></td>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
</body>

</html>