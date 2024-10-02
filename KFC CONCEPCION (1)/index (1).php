<?php
include 'dbconnect2.php'; 


// Add item functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $item_name = $_POST['item_name'];
        $quantity = $_POST['quantity'];
        $sql = "INSERT INTO inventory (item_name, quantity) VALUES ('$item_name', $quantity)";
        $conn->query($sql);
    } elseif (isset($_POST['remove'])) {
        echo "<script>alert('Warning: Removing items directly can lead to inconsistencies. FIFO method is recommended.');</script>";
        $remove_quantity = $_POST['remove_quantity'];

        while ($remove_quantity > 0) {
            $sql = "SELECT * FROM inventory ORDER BY date_added ASC LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['quantity'] > $remove_quantity) {
                    $new_quantity = $row['quantity'] - $remove_quantity;
                    $conn->query("UPDATE inventory SET quantity = $new_quantity WHERE id = " . $row['id']);
                    break; // Stop once the requested quantity is removed
                } elseif ($row['quantity'] == $remove_quantity) {
                    $conn->query("DELETE FROM inventory WHERE id = " . $row['id']);
                    break; // Stop as the exact quantity was removed
                } else {
                    $remove_quantity -= $row['quantity'];
                    $conn->query("DELETE FROM inventory WHERE id = " . $row['id']);
                }
            } else {
                break; // No more items to remove
            }
        }
    }
}

$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KFC Inventory </title>
    <link rel="stylesheet" href="style3.css">
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 50%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        form { text-align: center; margin: 20px; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">KFC Inventory System</h1>

    <form method="post">
        <input type="text" name="item_name" placeholder="Item Name" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit" name="add">Add Item</button>
    </form>

    <form method="post">
        <input type="number" name="remove_quantity" placeholder="Quantity to Remove" required>
        <button type="submit" name="remove">Remove Item</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Date Added</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['item_name'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['date_added'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
