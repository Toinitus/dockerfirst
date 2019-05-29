#!/bin/bash

docker-compose stop

sleep 3;

docker-compose rm -f

exit 0