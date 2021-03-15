#!/bin/bash
if [ -z $1 ]; then
    tag="1.2.0"
else
    tag=$1
fi

docker build -t everforo/standalone-apiflask:$tag -f Dockerfile.stage .