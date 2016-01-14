 #!/usr/bin/env bash

if [ "$1" == "" ];
then
    echo "You need to enter a build number like: CPL-PTP-36"
    exit
fi

buildnum="$1"

docker pull 10.20.27.132:5000/pplweb:$buildnum

id=$(docker create 10.20.27.132:5000/pplweb:$buildnum)
docker cp $id:/var/www/opt/deployment/staging/docker-compose.yml ./docker-compose.yml
docker rm -v $id