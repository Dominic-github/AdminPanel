-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: devt_user
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+07:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` nvarchar(255) NOT NULL,
  `email` nvarchar(255) NOT NULL,
  `password` nvarchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin@gmail.com','$2y$10$YarerdxXKMXBsmzS/o.YJOuQ/H1/CtB4t.354q.i8EN62QYbTfjUC');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_cat`
--

DROP TABLE IF EXISTS `table_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_cat` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `catName` nvarchar(255) NOT NULL,
  `catDesc` nvarchar(255) NOT NULL,
  `catImg` nvarchar(255) NOT NULL,
  `catStatus` nvarchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_cat`
--

LOCK TABLES `table_cat` WRITE;
/*!40000 ALTER TABLE `table_cat` DISABLE KEYS */;
INSERT INTO `table_cat` VALUES 
(1,'All', 'Tất cả sản phẩm', 'all.png','true'),
(2,'Thời Trang Nam','Quần, Áo, Phụ Kiện Cho Nam Giới','thoitrangnam.png','true'),
(3,'Thời Trang Nữ','Quần, Áo, Phụ Kiện Cho Nữ Giới','thoitrangnu.png','true'),
(4,'Điện Thoại & Phụ Kiên','Các Đồ Dùng Cho Điện Thoại Và Phụ Kiện','dienthoaivaphukien.png','true'),
(5,'Thiết Bị Điện Tử','men products','thietbidientu.png','true'),
(6,'Mẹ & Bé','men products','mevabe.png','true'),
(7,'Sắc Đẹp','men products','sacdep.png','true'),
(8,'Nhà Cửa & Đời Sống','men products','nhacuavadoisong.png','true'),
(9,'Sức Khoẻ','men products','suckhoe.png','true'),
(10,'Bách Hoá Online','men products','bachhoaonline.png','true'),
(11,'Nhà Sách Online','women products','nhasachonline.png','true');
/*!40000 ALTER TABLE `table_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_product`
--

DROP TABLE IF EXISTS `table_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_product` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `cat_id` int(255) NOT NULL,
  `pName` nvarchar(255) NOT NULL,
  `pDesc` nvarchar(255) NOT NULL,
  `pImage` text NOT NULL,
  `pPrice` int(255) NOT NULL,
  `pStatus` nvarchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_product`
--

LOCK TABLES `table_product` WRITE;
/*!40000 ALTER TABLE `table_product` DISABLE KEYS */;
INSERT INTO `table_product` VALUES 
(1,2,'Áo khoá nỉ mũ hai lớp logo WASK nỉ lót bông form thụng','Áo chất nỉ bông các màu in logo WASK FORM dáng thụng ','nam1.jpg',53000,'true'),
(2,2,'Quần jean nam vá da boy phố thêu','Quần jeans nam với thiết kế mới thời trang hơn, mang lại sự tự tin tối đa cho người mặc trước những người xung quanh','nam2.jpg',138000,'true'),
(3,2,'Áo phông nam nữ Tommy Hilfiger',' Đường may tỉ mỉ chắc chắc. Chất liệu: chất UMI thấm hút mồ hôi tốt, thoáng mát','nam3.jpg',234000,'true'),
(4,2,'Thắt lưng nam da cao cấp','Thắt lưng nam có thể đeo đi chơi, dạo phố, dự tiệc đều tạo một phong cách đầy cá tính sang trọng.','nam4.jpg',453000,'true'),
(5,2,'Áo thun Fafic','Chất vải cotton siêu đẹp, không bị co rút sau khi giặt nhiều lần, tạo cảm giác thoải mái cho người mặc.','nam5.jpg',325000,'true'),

(6,3,'Bộ Đồ Ngủ Chất Nhung Dày Dặn Giữ Ấm','Sản phẩm của chúng tôi là thương hiệu mới 100%.','nu1.jpg',600000,'true'),
(7,3,'Quần jean bò ống rộng suông xuông nữ','
- Size S: Cân nặng 40 - 43kg, Chiều cao 150 - 160 cm. Eo 58-63 cm

- Size M: Cân nặng 44 - 47kg, Chiều cao 155 - 165 cm. Eo 64-68 cm

- Size L: Cân nặng 48 - 53kg, Chiều cao 155- 165 cm. Eo 69-72 cm

- Size Xl: Cân nặng 53 - 56kg, Chiều cao 155-165 cm. Eo 72-74 cm','nu2.jpg',1200000,'true'),
(8,3,'LEN cuộn MILK bò 50 gram bảng 92 Màu','Len Milk Bò 50gr dùng móc các sản phẩm khăn, áo , nón ,…','nu3.jpg',1800000,'true'),
(9,3,'BỘ NGỦ NỮ CAXA','Set đồ mặc nhà gồm áo pijama và quần short, hoạ tiết trái lê xinh xỉu luôn ạ. Áo tay lỡ có cúc cài đóng/ mở xinh xắn, có 1 túi bên ngực để đựng đồ. Quần short cạp chun co giãn','nu4.jpg',1660000,'true'),
(10,3,'Vớ Trắng Cổ Cao Thời Trang Thu Đông Hàn Quốc Cho Nữ','Tất Nữ - Tất Cổ Cao Phong Cách Vintage Hàn Quốc ❤️ Tất Nữ Đẹp cotton được chọn màu mẫu','nu5.jpg',1900000,'true'),

(11,4,'Dễ Thương Ốp Điện Thoại Chống Rơi Hình Nhân Vật Hoạt Hình ','Tất cả các sản phẩm tại cửa hàng của chúng tôi đều có trong kho và đảm bảo giao hàng kịp thời.','dienthoai&phukien1.jpg',63000,'true'),
(12,4,'Bộ sạc nhanh ( Củ PD 20W + Cáp Type-C ) không nóng máy,','Tên sản phẩm: bộ sạc nhanh 18W - 20W','dienthoai&phukien2.jpg',138000,'true'),
(13,4,'Sạc dự phòng 20000mAh 10000mAh sạc nhanh pin mini',' Sạc dự phòng 20000mAh 10000mAh sạc nhanh pin mini dung lượng lớn có sẵn dây sạc nhiều điện thoại – Natuso XY68','dienthoai&phukien3.jpg',234000,'true'),
(14,4,'Ốp Điện Thoại Cho oppo ','Có rất nhiều phong cách trong cửa hàng của chúng tôi! Mua cùng nhau có thể tiết kiệm rất nhiều thời gian vận chuyển.','dienthoai&phukien4.jpg',453000,'true'),
(15,4,'Giá Đỡ Để Điện Thoại K3 Để Bàn Gập Gọn Đa năng',' Chất liệu: nhựa ABS và đệm silicon','dienthoai&phukien5.jpg',325000,'true'),

(16,5,'Tws Tai Nghe Chụp Tai bluetooth 5.2','Giới thiệu Tai nghe 1 chiếc - tai nghe không dây phải có cho bất kỳ người đam mê âm nhạc hoặc chơi game nào.','thietbidientu1.jpg',53000,'true'),
(17,5,'MICRO CHO LOA KÉO BLUETOOTH','Với thiết kế khá nhỏ gọn, vỏn vẹn trong lòng bàn tay cho bạn dễ dàng sử dụng, với thiết kế này sản phẩm phù hợp với mọi lứa tuổi rất thuận tiện dễ dàng sử dụng.','thietbidientu2.jpg',138000,'true'),
(18,5,'Loa bluetooth karaoke K183 ',' Loa bluetooth karaoke K186 kèm 2 micro không dây xách tay công xuất 20W, âm thanh trầm ấm, bass căng- TECHHIGH','thietbidientu3.jpg',234000,'true'),
(19,5,'Máy Chơi Game Sup 400','1. Tích hợp 400 game cổ điển, kho trò chơi khổng lồ giúp bạn tận hưởng niềm vui thời thơ ấu.','thietbidientu4.jpg',453000,'true'),
(20,5,'Loa Bluetooth JBL CHARGE 4','Loa Bluetooth JBL CHARGE 4+ mini - Loa Nghe Nhạc, Karaoke - Kết Nối Nhanh Với Điện Thoại, Máy Tính - Pin Li-on','thietbidientu5.jpg',325000,'true'),

(21,6,'Ghế nhún, ghế rung','Sản phẩm được thiết kế đặc biệt dành cho trẻ từ 0 đến 2 tuổi. ','mevabe1.jpg',53000,'true'),
(22,6,'Chậu Tắm Cho Bé Đa Năng','Không mua thì phí quá mẹ ơi','mevabe2.jpg',138000,'true'),
(23,6,'Tã bỉm MERRIES nội địa Nhật',' newborn dành cho bé từ sơ sính đến 5kg.','mevabe3.jpg',234000,'true'),
(24,6,'Sữa Đêm Fruto hàng Nội Địa','Ngon mất lưỡiii, huhu không bé nào chê đâu các mẹ ạ. Tonny nhà em tối là dùng sữa nước Fruto thay cho sct nhaa.','mevabe4.jpg',453000,'true'),
(25,6,'Xe đẩy nâng cấp M9 2 chiều','Là một sự lựa chọn vô cùng phù hợp với các mẹ yêu thích sự gọn nhẹ mà vẫn đầy đủ các chức năng','mevabe5.jpg',325000,'true'),

(26,7,'Son Kem GEGE BEAR tông màu hổ phách','Thành phần chính: sáp vi tinh thể, ceresin, glixerin, titanium đioxit, chất tạo màu, v.v.','sacdep1.jpg',53000,'true'),
(27,7,'Lược Chải Tóc Mát Xa Da Đầu',' Được làm bằng chất liệu cao cấp, bền và chống tĩnh điện.','sacdep2.jpg',138000,'true'),
(28,7,'Máy Sấy Tóc 2 Chiều Nóng Lạnh',' Máy sấy tóc ( 3500w ) với thiết kế chác chắn mang lại cho mái tóc bạn sự chăm sóc thật nhẹ nhàng và hiệu quả để luôn giữ được độ ẩm và sự chắc khỏe như được làm khô tự nhiên, duy trì vẻ óng mượt và mềm mại.','sacdep3.jpg',234000,'true'),
(29,7,'Bông tẩy trang 222 miếng Lameila BTT222','ông tẩy trang từ mền xơ bông (không tẩm nước hoa, mỹ phẩm) dùng để làm sạch, chăm sóc da, dùng 01 lần','sacdep4.jpg',453000,'true'),
(30,7,'Set 24 móng tay giả kiểu pháp xinh xắn kèm 12 keo thạch dán móng tiện dụng','Di chuyển móng tay giả lên phía trước móng tay và ấn giữ trong 10 giây cho đến khi móng tay giả dính vào móng tay thật.','sacdep5.jpg',325000,'true'),

(31,8,'Andianins Thảm Lót Sàn Thấm Hút Tốt Thiết Kế Xinh Xắn Đáng Yêu','Màu sắc: Rừng hoa hạnh phúc, Rừng núi, Bóng hoa, Núi mặt cười, Chó con màu cam, Tùy chỉnh','nhacuavadoisong1.jpg',53000,'true'),
(32,8,'Combo 10 Móc quần áo người lớn','Móc quần áo Móc áo người lớn 40cm móc kẹp quần áo Móc treo với độ chịu lực tốt, bền đẹp theo thời gian sử dụng','nhacuavadoisong2.jpg',138000,'true'),
(33,8,'Bộ ga gối 3 món poly coton 1m6x2m và 1m8x2m hàng loại 1',' Chất liệu: Cotton Poly sang trọng, mềm mại không phai màu, không co rút sợi, dễ giặt ủi bằng máy và rất bền ','nhacuavadoisong3.jpg',234000,'true'),
(34,8,'Đèn Ngủ Cảm Biến Ánh Sáng, Tự Động Bật Tắt, Tiết Kiệm Năng Lượng','Đèn có chế độ cảm ứng tự động bật khi phòng tối, tự động tắt khi phòng sáng','nhacuavadoisong4.jpg',453000,'true'),
(35,8,'Gương soi toàn thân chống vỡ siêu nét','Kính chuẩn nét, cho hình ảnh trung thực, tỉ lệ ảnh luôn là 1-1','nhacuavadoisong5.jpg',325000,'true'),

(36,9,'Ống hít mũi Pastel Inhaler Thái Lan Chính Hãng mùi bạc hà tinh dầu hương hoa cực thơm','Tất cả các màu trơn mùi tinh dầu hương hoa mix bạc hà. Màu trong suốt mùi đậm hơn 1 chút.','suckhoe1.jpg',53000,'true'),
(37,9,'Khẩu Trang 5D THÁI LAN,5D MASK CAREION Kháng Khuẩn','Khẩu trang rộng rãi phù hợp với mọi khuôn mặt khách hàng','suckhoe2.jpg',138000,'true'),
(38,9,'Bao tay y tế lattex HQ GANO có bột và không bột',' Găng tay dài 290mm - nặng 9g-13g - Dai - Dài - Dày chắc chắn.','suckhoe3.jpg',234000,'true'),
(39,9,'Túi chườm cắm điện','Túi chườm nóng lạnh làm giảm đau nhức khi bị chấn thương, làm tan máu bầm, tê chân tay, đau nhức hông, xương khớp.','suckhoe4.jpg',453000,'true'),
(40,9,'Ghế gác chân massage','Ghế gác chân massage, Ghế kê chân Công Thái Học cho dân văn phòng, sinh viên, chơi game mát xa thư giãn, giảm stress','suckhoe5.jpg',325000,'true'),

(41,10,'Nama socola tươi 408gr -socola tươi tan chảy vị hoa quả 158g','Socola tươi nama socola công thức Nhật','bachhoaonline1.jpg',53000,'true'),
(42,10,'Kẹo Sữa Chua Viên Nén DEKU Hongkong','2 Vị Sữa Chua - Dâu, đồ ăn vặt nội địa, trọng lượng: 240g ~ 30 hũ nhỏ','bachhoaonline2.jpg',138000,'true'),
(43,10,'Bánh tráng phơi sương muối tép hành',' Thế giới bánh tráng phơi sương, chuyên các loại bánh tráng phơi sương, số lượng lớn mỗi ngày. Ngoài ra còn các loại gia vị ăn kèm thêm, các loại bánh trộn, ăn vặt,...','bachhoaonline3.jpg',234000,'true'),
(44,10,'COMBO Đồ ăn vặt CAY SIÊU HOT','Tổng hợp các loại bánh kẹo đại lý, bách hoá - tổng hợp, quán ăn, căng-tin cổng trường.','bachhoaonline4.jpg',453000,'true'),
(45,10,'Bánh Trứng Muối JIAO XIANG 4 Hương Vị Bánh Ngon Nội Địa Trung Quốc ','Hương vị: vị ngọt/kết hợp nhiều hương vị khác','bachhoaonline5.jpg',325000,'true'),

(46,11,'Móc Chìa Khóa mini Dễ Thương','Những mặt dây chuyền dễ thương này có thể được sử dụng làm móc chìa khóa, phụ kiện túi xách, mặt dây chuyền xe hơi, hoặc làm quà tặng và giải thưởng cho các lễ hội khác nhau.','nhasachonline1.jpg',53000,'true'),
(47,11,'Bút Màu Acrylic Marker 12/24/ Cao Cấp Màu Sắc Tươi Sáng','Bút Màu Acrylic Marker Cao Cấp - Bút Lông Màu được làm từ các vật liệu chất lượng cao, đảm bảo sự bền bỉ và độ tin cậy của sản phẩm. Bạn có thể tin tưởng vào chất lượng của bút màu này trong quá trình sử dụng lâu dài.','nhasachonline2.jpg',138000,'true'),
(48,11,'Lịch Năm 2024 Để Bàn Họa Tiết Hoạt Hình Dễ Thương',' Hồ sơ duyệt ngày hàng ngày hoặc dùng làm vật trang trí trên máy tính để bàn.','nhasachonline3.jpg',234000,'true'),
(49,11,'Cục tẩy bút chì siêu to, siêu sạch','Cục tẩy bút chì cực dễ thương 4B tiện lợi cho học sinh','nhasachonline4.jpg',453000,'true'),
(50,11,'Bút Chì Khổng Lồ Kèm Gôm Tẩy','Bút chì khổng lồ Bút chì gỗ lớn cho họa sĩ Nghệ sĩ Sinh viên Bút chì khổng lồ Món quà thú vị Mới lạ Hiệu suất đồ chơi Prop với tẩy Văn phòng phẩm sáng tạo bằng gỗ Đồ dùng văn phòng trường học','nhasachonline5.jpg',325000,'true');

/*!40000 ALTER TABLE `table_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_user`
--

DROP TABLE IF EXISTS `table_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` nvarchar(255) NOT NULL,
  `username` nvarchar(255) NOT NULL,
  `email` nvarchar(255) NOT NULL,
  `password` nvarchar(255) NOT NULL,
  `phone` nvarchar(255) NOT NULL,
  `address` nvarchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_user`
--

LOCK TABLES `table_user` WRITE;
/*!40000 ALTER TABLE `table_user` DISABLE KEYS */;
INSERT INTO `table_user` VALUES 
(1,'1','user','user@gmail.com','user123','033459527','Ha Noi'),
(2,'1','user1','user1@gmail.com','user123','034559527','Bac Giang'),
(3,'1','user2','user2@gmail.com','user123','034559527','Da Nang');

/*!40000 ALTER TABLE `table_user` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `table_order`
--

DROP TABLE IF EXISTS `table_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_order` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userId` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `created_at` Date DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `order_status` nvarchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `table_order` WRITE;
/*!40000 ALTER TABLE `table_order` DISABLE KEYS */;
INSERT INTO `table_order` VALUES 
(1,1,2630000,CURRENT_TIMESTAMP,"true");
/*!40000 ALTER TABLE `table_order` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `table_order_detail`
--

DROP TABLE IF EXISTS `table_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_order_detail` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `pName` nvarchar(255) NOT NULL,
  `price_item` int(255) NOT NULL,
  `created_at` Date DEFAULT CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `table_order_detail` WRITE;
/*!40000 ALTER TABLE `table_order_detail` DISABLE KEYS */;

INSERT INTO `table_order_detail` VALUES 
(1,1,1,"Stylish shirt for boys",500000,CURRENT_TIMESTAMP),
(2,1,2,"Red Stylish shirt for boys",600000,CURRENT_TIMESTAMP),
(3,1,3,"Matte Black Stylish shirt for boys",580000,CURRENT_TIMESTAMP),
(4,1,4,"Chek Stylish shirt for boys",450000,CURRENT_TIMESTAMP),
(5,1,5,"Casual Stylish shirt for boys",500000,CURRENT_TIMESTAMP);

/*!40000 ALTER TABLE `table_order_detail` ENABLE KEYS */;
UNLOCK TABLES;


/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_cat`
--





/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-08 13:51:26


