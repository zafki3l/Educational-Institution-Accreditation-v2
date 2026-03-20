INSERT INTO educational_institution_accreditation.users
(id, first_name, last_name, email, password, role_id, created_at, updated_at, department_id)
VALUES('bfbaa88f-79fc-4c22-b58d-aac589eef658', 'Your last name', 'Your first name', 'youremail@abc.com', 'YOUR_BCRYPT_HASH', 3, CURRENT_TIMESTAMP, null, null);

-- Instructions:
-- 1. Generate a bcrypt hash for your password (e.g. https://bcrypt-generator.com/)
-- 2. Replace 'YOUR_BCRYPT_HASH' with your generated hash
-- 3. Log in using your email and the original password you used to generate the hash
-- 4. (Recommended) Change your password after first login

-- Hướng dẫn:
-- 1. Tạo một hash bcrypt cho mật khẩu của bạn (ví dụ: https://bcrypt-generator.com/)
-- 2. Thay 'YOUR_BCRYPT_HASH' bằng hash bạn vừa tạo
-- 3. Đăng nhập bằng email và mật khẩu gốc bạn đã dùng để tạo hash
-- 4. (Khuyến nghị) Đổi mật khẩu sau lần đăng nhập đầu tiên
