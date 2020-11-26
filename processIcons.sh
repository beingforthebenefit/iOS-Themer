#!/bin/bish

hash=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 32 | head -n 1)

unzip $1 -d $hash/