#!/bin/sh
if [ -f config-local.sh ]; then
    . ./config-local.sh 
else
    [ -f /usr/local/etc/chilli/defaults ] && . /usr/local/etc/chilli/defaults
    [ -f /usr/local/etc/chilli/config ]   && . /usr/local/etc/chilli/config
fi
