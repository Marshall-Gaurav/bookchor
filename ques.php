<?php 
include('connection.php');

$book = "SELECT * from book";
$qBook = mysqli_query($conn, $book);

$auth = "SELECT * from author";
$qAuth = mysqli_query($conn, $auth);

$pub = "SELECT * from publisher";   
$qPub = mysqli_query($conn, $pub);

$defBook = "SELECT * from defective_book";
$qDef = mysqli_query($conn, $defBook);

$allGBook = "SELECT * from book JOIN defective_book ON book.id!=defective_book.book_id ";
$qAll = mysqli_query($conn, $allGBook);
            
$allPrice = "SELECT * 
    FROM book JOIN defective_book 
    ON book.id!=defective_book.book_id 
    CASE book.mrp
        WHEN book.mrp < 100 THEN 'Cheap'
        WHEN book.mrp > 100 AND book.mrp < 200 THEN 'Economic'
        ELSE 'Standard Rate' 
    END AS 'status'";
$qPrice = mysqli_query($conn, $allPrice);

$allLoss = "SELECT 
    book.mrp,
    book.id, 
    book.vendor_id, 
    book.title 
    from book JOIN defective_book 
    ON book.id=defective_book.book_id ";
$qAllLoss = mysqli_query($conn, $allLoss);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
    <!-- <script src="main.js"></script> -->
</head>
<body>
<a href='index.php'>Link to Previous Question</a>    
<table border='1'>
<td>
    <h3>Book Table</h3>
    <table border='1'>
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Author ID</th>
            <th>MRP</th>
            <th>Publisher ID</th>
            <th>Vendor ID</th>
        </thead>
        <tbody>
        <?php while($allBook = mysqli_fetch_array($qBook)){?>
            <tr>
                <td><?php echo $allBook['id']?></td>
                <td><?php echo $allBook['title']?></td>
                <td><?php echo $allBook['author_id']?></td>
                <td><?php echo $allBook['mrp']?></td>
                <td><?php echo $allBook['publisher_id']?></td>
                <td><?php echo $allBook['vendor_id']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <h3>Author Table</h3>
    <table border='1'>
        <thead>
            <th>ID</th>
            <th>Name</th>
        </thead>
        <tbody>
        <?php while($allAuth = mysqli_fetch_array($qAuth)){?>
            <tr>
                <td><?php echo $allAuth['id']?></td>
                <td><?php echo $allAuth['name']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <h3>Publisher Table</h3>
    <table border='1'>
        <thead>
            <th>ID</th>
            <th>Name</th>
        </thead>
        <tbody>
        <?php while($allPub = mysqli_fetch_array($qPub)){?>
            <tr>
                <td><?php echo $allPub['id']?></td>
                <td><?php echo $allPub['name']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <h3>Defective Book Table</h3>
    <table border='1'>
        <thead>
            <th>ID</th>
            <th>Book ID</th>
        </thead>
        <tbody>
        <?php while($allDef = mysqli_fetch_array($qDef)){
            $defList[]=$allDef['book_id'];    
        ?>
            <tr>
                <td><?php echo $allDef['id']?></td>
                <td><?php echo $allDef['book_id']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</td>
<td>
    <h3>Book Table (Not Defective)</h3>
    <table border='1'>
        <thead>
            <th>Title</th>
            <th>Author ID</th>
            <th>Publisher ID</th>
        </thead>
        <tbody>
        <?php 
            while($allG = mysqli_fetch_array($qAll)){?>
            <tr>
                <td><?php echo $allG['title']?></td>
                <td><?php echo $allG['publisher_id']?></td>
                <td><?php echo $allG['author_id']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <h3>Book Price Category Table</h3>
    <table border='1'>
        <thead>
            <th>Title</th>
            <th>Author ID</th>
            <th>MRP</th>
            <th>Publisher ID</th>
            <th>Vendor ID</th>
            <th>Status</th>
        </thead>
        <tbody>
        <?php while($allPr = mysqli_fetch_array($qPrice)){?>
            <tr>
                <td><?php echo $allPr['title']?></td>
                <td><?php echo $allPr['author_id']?></td>
                <td><?php echo $allPr['mrp']?></td>
                <td><?php echo $allPr['publisher_id']?></td>
                <td><?php echo $allPr['vendor_id']?></td>
                <td><?php echo $allPr['status']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <h3>Vendor Net Loss Table</h3>
    <table border='1'>
        <thead>
            <th>ID</th>
            <th>Vendor ID</th>
            <th>Loss</th>
            <th>Titles</th>
            <th>First 3 letters</th>
        </thead>
        <tbody>
        <?php while($allLoss = mysqli_fetch_array($qAllLoss)){?>
            <tr>
                <td><?php echo $allLoss['id']?></td>
                <td><?php echo $allLoss['vendor_id']?></td>
                <td><?php echo $allLoss['mrp']?></td>
                <td><?php echo $allLoss['title']?></td>
                <!-- Since I dont have Vendor name so using title->
                <td><?php echo substr($allLoss['title'],0,3)?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>

</td>
</table>
</body>
</html>












