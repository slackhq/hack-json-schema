FROM hhvm/hhvm:4.168.0

RUN apt update -y
RUN DEBIAN_FRONTEND=noninteractive apt install -y php-cli zip unzip openssh-client

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV HHVM_VERSION=4.168.0

WORKDIR /app
COPY . /app
