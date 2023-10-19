#!/bin/bash

echo ""
source docker/.env
echo $COMPOSE_PROJECT_NAME

BOLD="$(tput bold)"
RED="$(tput setaf 1)"
GREEN="$(tput setaf 2)"
YELLOW="$(tput setaf 3)"
BLUE="$(tput setaf 4)"
RESET="$(tput sgr0)"

cd docker
docker compose pull
docker compose -p ${COMPOSE_PROJECT_NAME} build --progress plain --no-cache
sleep 3
docker compose -p ${COMPOSE_PROJECT_NAME} up -d
cd ../
echo ""
echo -e "Project config: "

echo -e "${BOLD}${RED}---------${RESET}"
echo -e "${BOLD}Wait for containers and network${RESET}"
sleep 10

#Setup internal docker network
#if ! (docker network ls | grep overlay); then
#    echo -e "${BOLD}${RED}---------${RESET}"
#    echo -e 'docker swarm init'
#    docker swarm init
#fi
#
#if ! (docker network ls | grep ${COMPOSE_NETWORK}); then
#    echo -e "${BOLD}${RED}---------${RESET}"
#    echo -e "docker network create -d overlay --attachable ${COMPOSE_NETWORK}"
#    docker network create -d overlay --attachable ${COMPOSE_NETWORK}
#fi

echo -e "${BOLD}${RED}---------${RESET}"
echo -e "Composer install"
docker exec -it ${COMPOSE_PROJECT_NAME}_php composer install


echo -e "${BOLD}${RED}---------${RESET}"
echo -e "${BOLD}${RED}TESTS${RESET}"
echo -e "${BOLD}${YELLOW}TESTS${RESET}"
echo -e "${BOLD}${GREEN}TESTS${RESET}"
docker exec -it ${COMPOSE_PROJECT_NAME}_php ./vendor/bin/phpunit

echo "${BOLD}${RED}--------------------------------------------------------------------------------${RESET}"
#echo "${YELLOW}DB server available at: ${BOLD}${GREEN}${COMPOSE_IP}:${COMPOSE_PORT_DB}${RESET}"
echo "${YELLOW}App available at: ${BOLD}${GREEN}${COMPOSE_IP}:${COMPOSE_PORT_HTTP}${RESET}"
echo "${BOLD}${RED}--------------------------------------------------------------------------------${RESET}"
echo ""

read -n 1 -s -r -p "Press enter to continue..."
