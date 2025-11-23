FROM php:8.2-apache


# Install dependencies untuk extension
RUN apt-get update && apt-get install -y \
   libzip-dev unzip && \
   docker-php-ext-install mysqli pdo pdo_mysql && \
   rm -rf /var/lib/apt/lists/*


# Ubah Apache listen port ke 7860 (supaya cocok dengan Hugging Face Spaces)
RUN sed -i 's/80/7860/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf


# Copy VirtualHost config (opsional, kalau punya file 000-default.conf sendiri)
# COPY 000-default.conf /etc/apache2/sites-available/000-default.conf


# Set ServerName untuk hilangkan warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf


# Copy semua kode PHP ke /var/www/html
COPY . /var/www/html/


# Expose port 7860
EXPOSE 7860


CMD ["apache2-foreground"]