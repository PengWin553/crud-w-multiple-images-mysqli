<?php
require 'config.php';

$id = $_GET['id'];

// Fetch the image paths to delete the images from the server
$query = "SELECT image FROM tb_images WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$images = json_decode($row['image']);

// Delete images from the server
foreach ($images as $image) {
    if (file_exists('images/' . $image)) {
        unlink('images/' . $image);
    }
}

// Delete the row from the database
$query = "DELETE FROM tb_images WHERE id = $id";
mysqli_query($conn, $query);

echo "
<script>
    alert('Successfully Deleted');
    document.location.href = 'index.php';
</script>
";
?>
