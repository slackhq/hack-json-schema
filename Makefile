.PHONY: build test hh_autoload format

build:
	docker build -t slack/hack-json-schema .

install: build
	docker run -v `pwd`:/app -it slack/hack-json-schema composer install

update: build
	docker run -v `pwd`:/app -it slack/hack-json-schema composer update

hh_autoload:
	docker run -v `pwd`:/app -it slack/hack-json-schema ./vendor/bin/hh-autoload

test:
	docker run -v `pwd`:/app -it slack/hack-json-schema ./vendor/bin/hacktest tests

format:
	docker run -v `pwd`:/app -it slack/hack-json-schema find {src,tests} -type f -name "*.hack" -exec hackfmt -i {} \;
