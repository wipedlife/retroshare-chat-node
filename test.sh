#!/bin/bash

if [ $# \< 1 ];then
	echo $1
	echo "$0 cert_string"
	exit 1
fi;

curl 'http://127.0.0.1:9090/api/v2/peers/examine_cert' --data-binary "{\"cert_string\": \"$1\"}"  --compressed

echo
