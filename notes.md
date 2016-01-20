## running local nginx and copying in generated vhost file


```
docker run --name nginx-router -p 0.0.0.0:10000:80 -v `pwd`/opt/nginx/staging/multi-site-vhost-gen.conf:/etc/nginx/conf.d/default.conf nginx:latest
docker run --name nginx-router -p 0.0.0.0:10000:80 -v default.conf:/etc/nginx/conf.d nginx:latest
```

## generating the vhost file

```
php bin/gen-staging-vhost.php > ./opt/nginx/staging/multi-site-vhost-gen.conf
```

# deployment

## pulling the image 

```
docker pull 10.20.27.132:5000/pplweb:CPL-PTP-33
```

## copying out the docker-compose.yml

```
id=$(docker create 10.20.27.132:5000/pplweb:CPL-PTP-33)
docker cp $id:/var/www/opt/deployment/staging/docker-compose.yml ./docker-compose.yml
docker rm -v $id
```

## spinning it up

```
docker compose up
```
