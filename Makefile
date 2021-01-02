SUPPORTED_COMMANDS := build up down restart
SUPPORTS_MAKE_ARGS := $(findstring $(firstword $(MAKECMDGOALS)), $(SUPPORTED_COMMANDS))
ifneq "$(SUPPORTS_MAKE_ARGS)" ""
  COMMAND_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  $(eval $(COMMAND_ARGS):;@:)
endif

.PHONY: help

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

build: ## Build a service
	cd $(COMMAND_ARGS) && docker-compose build

up: ## Up a service
	cd $(COMMAND_ARGS) && docker-compose up -d

down: ## Down a service
	cd $(COMMAND_ARGS) && docker-compose down

restart: ## Restart a service
	cd $(COMMAND_ARGS) && docker-compose restart

shutdown: ## Down all services
	make down traefik
	make down dashboard
	make down mediacenter
	make down nextcloud

launch: ## Start all services
	make up traefik
	make up dashboard
	make up mediacenter
	make up nextcloud
