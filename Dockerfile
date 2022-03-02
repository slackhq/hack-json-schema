FROM hhvm/hhvm:4.128.2

RUN apt update -y
RUN DEBIAN_FRONTEND=noninteractive apt install -y php-cli zip unzip openssh-client

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV HHVM_VERSION=4.128.2

ADD . /app
WORKDIR /app
