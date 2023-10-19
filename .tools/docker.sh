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
docker compose -p ${COMPOSE_PROJECT_NAME} up -d
cd ../
echo ""
echo -e "Project config: "
sleep 3

#echo -e "${BOLD}${RED}---------${RESET}"
#echo -e "chmod -R 0777 storage "
#docker exec -it ${COMPOSE_PROJECT_NAME}_php chmod -R 0777 storage

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
