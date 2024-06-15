<?php
if ($_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES["avatar"]["tmp_name"];
    $name = $_FILES["avatar"]["name"];
    move_uploaded_file($tmp_name, "avatars/" . $name);
    echo "Аватар успешно загружен";
} else {
    echo "Ошибка загрузки аватара";
}
?>
