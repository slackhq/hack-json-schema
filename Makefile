.PHONY: test hh_autoload composer

COMPOSER=~/.cache/composer/composer.phar

test: hh_autoload
	./vendor/bin/hacktest tests

hh_autoload:
	./vendor/bin/hh-autoload

composer-fetch:
	test -f $(COMPOSER) || mkdir -p `dirname $(COMPOSER)`
	test -f $(COMPOSER) || wget -O $(COMPOSER) https://getcomposer.org/download/1.8.6/composer.phar

composer-install: composer-fetch
	php $(COMPOSER) install

composer-update: composer-fetch
	php $(COMPOSER) update

format:
	find {src,tests} -type f -exec hackfmt -i {} \;

examples: hh_autoload
	hhvm ./bin/generate-examples.php
