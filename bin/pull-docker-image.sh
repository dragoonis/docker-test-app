 #!/usr/bin/env bash

buildnum="$1"

docker pull 10.20.27.132:5000/pplweb:$buildnum

id=$(docker create 10.20.27.132:5000/pplweb:$buildnum)
docker cp $id:/var/www/opt/deployment/staging/docker-compose.yml ./docker-compose.yml
docker rm -v $id