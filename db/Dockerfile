FROM mysql/mysql-server:8.0

ENV MYSQL_ROOT_PASSWORD=password \
    MYSQL_DATABASE=resPre \
    MYSQL_USER=user \
    MYSQL_PASSWORD=userPass \
    TZ=UTC \
    MYSQL_DEFAULT_AUTHENTICATION_PLUGIN=mysql_native_password

COPY ./init.sql /docker-entrypoint-initdb.d/init.sql

EXPOSE 3306
