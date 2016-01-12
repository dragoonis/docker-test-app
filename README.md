# Setup

## Linux

Simple: `docker-compose up`

Enjoy!

## OSX
1. Install Docker Toolbox

2. Create Docker Machine
`docker-machine create -d virtualbox --virtualbox-no-share development`

We use `--virtualbox-no-share` because VBoxFs is terribly slow and load times are >= 10s

3. Sync & Up
`./bin/osx-sync` (Needs watch: `brew install watch`)
`docker-compose up` (Application logs will show here)

