Phân tích hệ thống:
* Process Model (Mô hình hoạt động):
1. Đăng ký:
1.1. Người dùng chưa có tài khoản hệ thống:
===
        - Đăng ký trực tuyến qua hệ thống, xác nhận bằng hình thức verify code!
                + Acitve ngay sau khi hệ thống verify thành công.
                + Active by admin nếu người dùng không thể tự xác nhận được (Call or message)
        - Đăng ký tạm thời bằng người dùng vãng lai:
                + Xem quảng cáo để active tài khoản.
        - Đăng ký bằng thủ tục với người quản trị hệ thống.
2. Đăng nhập vào hệ thống:
===
2.1 Đăng nhập sử dụng tài nguyên mạng của hệ thống:
===
        - Dùng trang đăng nhập mặc định của người dùng.
        - Chuyển trang quản lý tài khoản.
2.2 Đăng nhập quản lý thông tin tài khoản.
===
        - Dùng trang quản lý tài khoản.
        - Không tính là đăng nhập sử dụng dữ liệu của hệ thống.
3. Quản trị hệ thống:
===
3.1 Quản trị thông tin dữ liệu:
===
        - Thống kê dữ liệu toàn bộ hệ thống: (Tổng số người dùng, Tổng dữ liệu trao đổi(Trong ngày, trong tháng), Tổng người dùng đăng nhập vào hệ thống(Trong ngày, trong tháng).
===
3.2 Quản trị người dùng:
===
        - Nhóm người dùng, người dùng.
        - Quản trị group policy.
3.3 Quản trị module:
===
        - quản trị module( Thêm module mới, sửa module).
3.4 Quản trị thanh toán: 
===
        - Thống kê hóa đơn hệ thống.
        - Thống kê doanh số.
        - Xuất báo cáo
3.5 Quản trị quảng cáo:
===
        - Thống kê quảng cáo.
        - Danh sách use login tương ứng với quảng cáo họ đã xem.
4. Access
===
4.1 Authentication:
===
        - Login khi cần quản trị hệ thống.
4.2 Access Level:
===
        - Phân quyền quản trị hệ thống dựa trên các module.
        
===========
*Database system:

1. Quản trị người dùng:
        - table: User, group_user.
2. Quản trị module:
        - table: module.
3. Quản trị thanh toán:
        - table: bill.
