#!make

ifneq (,$(wildcard ./.env))
    include .env
    export
else
$(error No se encuentra el fichero .env)
endif

help: _header
	${info }
	@echo Opciones:
	@echo ------------------------------------------
	@echo build / build-prod
	@echo start / start-prod
	@echo install / install-prod
	@echo seed
	@echo stop / stop-prod
	@echo ------------------------------------------
	@echo workspace / workspace-root
	@echo test
	@echo locales
	@echo outdated / update
	@echo redis-cli / redis-flush
	@echo stats
	@echo clean
	@echo ------------------------------------------

_urls: _header
	${info }
	@echo Sitios disponibles:
	@echo ----------------------------------------------
	@echo [Sitio web] https://safe-exam.test
	@echo [phpMyAdmin] https://phpmyadmin.safe-exam.test
	@echo ----------------------------------------------

_urls-dev: _header
	${info }
	@echo Sitios disponibles:
	@echo ------------------------------------------------
	@echo [Sitio web] https://safe-exam.test
	@echo [phpMyAdmin] https://phpmyadmin.safe-exam.test
	@echo [Mailpit] https://mailpit.safe-exam.test
	@echo ------------------------------------------------

_header:
	@echo ---------
	@echo Safe Exam
	@echo ---------

DOCKER_COMPOSE_FILES=-f docker-compose.yml -f docker-compose.prod.yml -f docker-compose.traefik.prod.yml
DOCKER_COMPOSE_FILES_DEV=-f docker-compose.yml -f docker-compose.dev.yml -f docker-compose.traefik.dev.yml

_start-command:
	@docker compose $$DOCKER_COMPOSE_FILES up -d --remove-orphans nginx phpmyadmin postfix

_start-command-dev:
	@docker compose $$DOCKER_COMPOSE_FILES_DEV up -d --remove-orphans traefik nginx phpmyadmin mailpit

start: _start-command-dev _urls-dev

start-prod: _start-command _urls

stop:
	@docker compose $$DOCKER_COMPOSE_FILES_DEV down

stop-prod:
	@docker compose $$DOCKER_COMPOSE_FILES down

workspace:
	@docker compose exec php /bin/bash

workspace-root:
	@docker compose exec --user root php /bin/bash

test:
	@docker compose exec php php artisan test

seed:
	@docker compose exec php php artisan migrate:fresh --seed

locales:
	@docker compose exec php php artisan translatable:export es
	@docker compose exec php php artisan translatable:export eu
	@docker compose exec php php artisan lang:update
	@-docker compose exec php php artisan translatable:inspect-translations es
	@-docker compose exec php php artisan translatable:inspect-translations eu

outdated:
	@echo Comprobando composer...
	@docker compose exec php composer outdated
	@echo Comprobando npm...
	@docker compose exec php npm outdated

update:
	@echo Actualizando composer...
	@docker compose exec php composer update
	@echo Actualizando npm...
	@docker compose exec php npm update
	@docker compose exec php npm run build
	@echo Generando commit...
	@sleep 5
	@git commit -a -m "Actualización de dependencias"

install:
	@docker compose exec php composer install
	@docker compose exec php npm install
	@docker compose exec php npm run build

install-prod:
	@docker compose exec php composer install --no-dev
	@docker compose exec php npm install
	@docker compose exec php npm run build

build:
	@docker compose pull && docker compose $$DOCKER_COMPOSE_FILES_DEV build --pull

build-prod:
	@docker compose pull && docker compose $$DOCKER_COMPOSE_FILES build --pull

redis-cli:
	@docker compose exec redis redis-cli

redis-flush:
	@docker compose exec redis redis-cli flushall

stats:
	@docker stats

clean:
	@docker compose $$DOCKER_COMPOSE_FILES_DEV down -v --remove-orphans
