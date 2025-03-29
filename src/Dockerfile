# Sử dụng PHP CLI (có sẵn built-in web server)
FROM php:8.2-cli

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Sao chép toàn bộ mã nguồn vào container
COPY . .

# Mở cổng 8000 để chạy PHP server
EXPOSE 8000

# Chạy PHP server khi container khởi động
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
