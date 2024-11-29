<?php
// Kiểm tra tham số id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Chuẩn bị truy vấn SQL để xóa
    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Xóa thành công, quay lại danh sách
        header("Location: listKhachHang.php?success=Xóa thành công!");
    } else {
        // Xóa thất bại
        header("Location: listKhachHang.php?error=Xóa thất bại!");
    }
    $stmt->close();
} else {
    // Quay lại nếu không có id hợp lệ
    header("Location: listKhachHang.php?error=ID không hợp lệ!");
}
?>
