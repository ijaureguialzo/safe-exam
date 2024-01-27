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
	@echo ---------------------------------
	@echo start / stop / restart / stop-all
	@echo workspace
	@echo build
	@echo redis-cli / redis-flush
	@echo stats
	@echo clean
	@echo --------------------------------------------------------

_header:
	@echo ---------
	@echo Safe Exam
	@echo ---------

_start-command:
	@docker compose up -d --remove-orphans

start: _start-command _urls

stop:
	@docker compose stop

restart: stop start

stop-all:
	@docker stop $(shell docker ps -aq)

workspace:
	@docker compose exec php /bin/bash

build:
	@docker compose pull && docker compose build --pull

redis-cli:
	@docker compose exec redis redis-cli

redis-flush:
	@docker compose exec redis redis-cli flushall

stats:
	@docker stats

clean:
	@docker compose down -v --remove-orphans

_urls: _header
	${info }
	@echo Sitios disponibles:
	@echo ----------------------------------------------
	@echo [Sitio web] https://safe-exam.test
	@echo [phpMyAdmin] https://phpmyadmin.safe-exam.test
	@echo ----------------------------------------------
