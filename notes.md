## running local nginx and copying in generated vhost file

docker run --name nginx-router -p 0.0.0.0:10000:80 -v `pwd`/opt/nginx/staging/multi-site-vhost-gen.conf:/etc/nginx/conf.d/default.conf nginx:latest
docker run --name nginx-router -p 0.0.0.0:10000:80 -v default.conf:/etc/nginx/conf.d nginx:latest

## generating the vhost file

php bin/generate-staging-dynamic-vhost.php > ./opt/nginx/staging/multi-site-vhost-gen.conf