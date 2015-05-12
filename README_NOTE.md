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
*Model process (Mô tả hoạt động)

1. Quản trị hệ thống:
Tất cả các tiến trình đều phải đăng nhập để vào quản trị.
1.1: Quản trị thông tin dữ liệu: 
	1.1.1: Thống kê thông tin lưu lượng sử dụng theo từng ngày,tháng.(Chỉ xem) 
	1.1.2: Thống kê số lượng người truy cập theo ngày, theo tháng.(Chỉ xem)
1.2: Quản trị thông tin người dùng:
	1.2.1: Quản lý người dùng: Thêm, lưu, xóa, sửa thông tin người dùng(Có thể chỉnh sửa các module radius dang áp dụng cho người dùng)
	1.2.2: Quản lý nhóm người dùng. Thêm, lưu, xóa, sửa thông tin nhóm người dùng(Có thể chỉnh sửa các module radius dang áp dụng cho người dùng).
	1.2.3: Quản lý phân quyền nhóm người dùng. Thêm quyền, xóa quyền sửa quyền cho người dùng hoặc nhóm người dùng.
1.3 Quản lý module radius: Thêm,xóa, sửa module radius (thêm đang xem xét làm như thế nào!!)
1.4 Quản lý thanh toán:
	1.4.1. Userpage:
		1.4.1.1: Thanh toán: Xem trước hóa đơn, thanh toán hóa đơn.
	1.4.2. Addminpage: 
		1.4.2.1: Sinh hóa đơn: Tự động, bằng tay. (Thêm, sửa)
		1.4.2.1: Thống kê hóa đơn (Xem)
1.5 Quản lý quảng cáo: 
	1.5.1: Quản lý:Thêm, xóa, sửa.
	1.5.2: Thống kê.(Lượt xem,người dùng nào xem,...)
	1.5.3: Thanh toán (trả tiền quảng cáo)
1.6 Access
	1.6.1: Login hệ thống:
		1.6.1.1: Network hotspot: Đăng nhập để sử dụng internet(Xem quảng cáo để dùng free, thành viên đăng nhập để sử dụng)
		1.6.1.2: Network Profile(Trang userpage): Đăng nhập quản trị tài khoản người dùng.
	1.6.2: Đăng ký thành viên hệ thống.
		1.6.2.1: Autoregister: Xem quảng cáo sẽ tự động đăng nhập.
		1.6.2.1: Đăng ký bằng form. Nhập thống tin. Active (mail hoặc code trực tiếp thông qua hệ thống)để có thể đăng nhập vào hệ thống.
	
===========
*Database system:

1. Quản trị người dùng:
        - table: User, group_user.
2. Quản trị module:
        - table: module.
3. Quản trị thanh toán:
        - table: bill.
