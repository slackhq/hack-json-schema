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

lint:
	docker run -v `pwd`:/app -it slack/hack-json-schema ./vendor/bin/hhast-lint

format:
	docker run -v `pwd`:/app -it slack/hack-json-schema find {src,tests} -type f -name "*.hack" -o -name "*.php" -exec hackfmt -i {} \;

typecheck:
	docker run -v `pwd`:/app -it slack/hack-json-schema /bin/bash -c './vendor/bin/hh-autoload && hh_server --check .'
