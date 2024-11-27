# Nội dung MVC B02
1.Hoàn thiện tính năng danh sách sản phẩm
-Có kết nối CSDL để lấy data
-






### 1. Tạo database theo yêu cầu
- Tên database: web2014_demo_mvc_database01
- Tên table: product
- Tên columns:
+ id: Int, AutoIncrement
+ name: Varchar(255)
+ price: Int
+ image_src: Varchar(255), Null
+ created_date: Date
- Tạo ít nhất 3 bản ghi

### 2. Tạo class Product
Class thể hiện các thuộc tính của đối tượng Product
- Tên file: Product.php
- Tên class: Product
- Thuộc tính: $id, $name, $price, $image_src, $created_date


### 3. Tạo class ProductQuery
Class giúp đối tượng Product tương tác với database
- Tên file: ProductQuery.php
- Tên class: ProductQuery
- Thuộc tính: $pdo
