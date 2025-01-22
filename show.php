<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("conn.php")
    ?>
    <!-- เพิ่มส่วน ใช้งาน Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ส่วนของ DataTable -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- เพิ่มส่วน ใช้งาน Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Kanit:ital,wght@0,200;0,300;1,100;1,200&family=Prompt:ital,wght@0,200;0,300;1,300&display=swap" rel="stylesheet">

    <!-- เพิ่ม CSS ให้ใช้ Font  -->
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            margin-right: 100px;
            margin-left: 100px;
            margin-top: 100px;
        }
    </style>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลกระเป๋า</title>
</head>

<body>
    <?php
    if (isset($_GET['action_even']) == 'delete') {
        //echo "Test";

        $bag_id = $_GET['bag_id'];
        $sql = "SELECT * FROM bags WHERE employee_id=$bag_id";
        // echo $sql;
        $result = $conn->query($sql);
        // $lvsql =mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            // sql to delete a record
            $sql = "DELETE FROM bags WHERE bag_id =$bag_id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>ลบข้อมูลสำเร็จ</div>";
            } else {
                echo "<div class='alert alert-danger'>ลบข้อมูลมีข้อผิดพลาด กรุราตรวจสอบ !!! </div>" . $conn->error;
            }
            // $conn->close();
        } else {
            echo 'ไม่พบข้อมูล กรุณาตรวจสอบ';
        }
    }
    ?>
    <h1>แสดงข้อมูลกระเป๋า</h1>
    <h2>พัฒนาโดย 664485039 นางสาวคัมภีรพรรณ ศุขบุญ </h2>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>รหัสกระเป๋า</th>
                <th>แบรนด์</th>
                <th>รุ่น</th>
                <th>สี</th>
                <th>วัสดุ</th>
                <th>ราคา</th>
                <th>จำนวนสินค้าในสต็อก</th>
                <th>จัดการข้อมูล</th>
            </tr>
        </thead>
        </tbody>
        <?php
        $sql = "SELECT * FROM bags";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo " <tr>";
                echo "<td>" . $row["bag_id"] . "</td>";
                echo "<td>" . $row["brand"] . "</td>";
                echo "<td>" . $row["model"] . "</td>";
                echo "<td>" . $row["color"] . "</td>";
                echo "<td>" . $row["material"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["stock_quantity"] . "</td>";
                echo '<td><a type="button" href="show.php?action_even=del&employee_id=' . $row['bag_id'] . '" 
                    title="ลบข้อมูล" onclick="return confirm(\'ต้องการจะลบข้อมูลรายชื่อ ' . $row['bag_id'] . ' ' . $row['brand'] .
                    ' ' . $row['model'] . '?\')" class="btn btn-danger btn-sm"> ลบข้อมูล </a>  
                    
                    <a type="button" href="edit.php?action_even=edit&id=' . $row['bag_id'] . '" 
                    title="แก้ไขข้อมูล" onclick="return confirm(\'ต้องการจะแก้ไขข้อมูลรายชื่อ ' .
                    $row['bag_id'] . ' ' . $row['brand'] . ' ' . $row['model'] . '?\')" class="btn btn-primary btn-sm"> แก้ไขข้อมูล </a> </td>';
                echo "</tr>";

                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>

    </table>
</body>

<!-- Latest compiled JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    new DataTable('#example');
</script>

</html>