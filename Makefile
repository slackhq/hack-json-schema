SHELL := /bin/bash

.PHONY: test autoload composer

HHVM_VERSION=4.80.5
HHVM_NEXT_VERSION=4.80.5

DOCKER_RUN=docker run -v $(shell pwd):/data --workdir /data --rm hhvm/hhvm:$(HHVM_VERSION)
CONTAINER_NAME=hack-json-schema-hhvm

COMPOSER_VERSION=1.9.2
COMPOSER=~/.cache/composer/composer-$(COMPOSER_VERSION).phar

test: autoload
	$(DOCKER_RUN) ./vendor/bin/hacktest tests

lint: autoload
	$(DOCKER_RUN) ./vendor/bin/hhast-lint

autoload:
	$(DOCKER_RUN) ./vendor/bin/hh-autoload

composer-bootstrap:
	test -f $(COMPOSER) || mkdir -p `dirname $(COMPOSER)`
	test -f $(COMPOSER) || wget -O $(COMPOSER) https://getcomposer.org/download/$(COMPOSER_VERSION)/composer.phar

composer-install: composer-bootstrap
	php $(COMPOSER) install

composer-update: composer-bootstrap
	docker run \
		-v $(shell pwd):/data \
		-v $(COMPOSER):/composer.phar \
		--workdir /data \
		--rm \
		hhvm/hhvm:$(HHVM_VERSION) \
		/bin/bash -c 'apt-get update && apt-get -y install php && php /composer.phar update'
	sudo chown -R $$USER vendor/

format:
	$(DOCKER_RUN) find {src,tests} -type f -name '*.php' -o -name '*.hack' -exec hackfmt -i {} \;

examples: autoload
	$(DOCKER_RUN) ./vendor/bin/hacktest tests

typecheck:
	$(DOCKER_RUN) /bin/bash -c './vendor/bin/hh-autoload && hh_server --check .'
typecheck-next: override HHVM_VERSION := $(HHVM_NEXT_VERSION)
typecheck-next: typecheck

#
# Docker commands for remote VSCode development
# https://github.com/slackhq/vscode-hack#remote-development
#
# TL;DR
#
# 1. Put this in your `$PROJECT_ROOT/.vscode/settings.json`:
#
#    {
#        "hack.remote.enabled": true,
#        "hack.remote.type": "docker",
#        "hack.remote.docker.containerName": "hack-json-schema-hhvm"
#    }
#
# 2. Run `make hhvm` to start HHVM in a local container.
#

hhvm: docker-create autoload
	docker exec --workdir ${PWD} $(CONTAINER_NAME) /bin/bash -c 'hh_client || true'

hhvm-restart: hhvm-kill hhvm

hhvm-kill:
	@docker kill $(CONTAINER_NAME) > /dev/null 2>&1 || exit 0

docker-create:
	@which docker > /dev/null || ( echo "Docker is not installed! Please install Docker and try again." && exit 1 )
	@docker info > /dev/null 2>&1 || ( echo "Docker is not running! Please start Docker and try again." && exit 1 )
	@if [ "$$(docker ps -a --format "{{.Names}} {{.Status}}" | awk '/^$(CONTAINER_NAME) / { print $$2 }')" == "Exited" ]; then docker rm $(CONTAINER_NAME) > /dev/null ; fi
	@if [ "$$(docker ps -a --format "{{.Names}} {{.Status}}" | awk '/^$(CONTAINER_NAME) / { print $$2 }')" == "" ]; then docker run -d -t --name $(CONTAINER_NAME) -v ${PWD}:${PWD} hhvm/hhvm:$(HHVM_VERSION) > /dev/null ; fi
