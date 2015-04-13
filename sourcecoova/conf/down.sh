#!/bin/sh
# Coova Chilli - David Bird <david@coova.com>
# Licensed under the GPL, see http://coova.org/
# down.sh /dev/tun0 192.168.0.10 255.255.255.0

TUNTAP=$(basename $DEV)
UNDO_FILE=/usr/local/var/run/chilli.$TUNTAP.sh

. /usr/local/etc/chilli/functions

[ -e "$UNDO_FILE" ] && sh $UNDO_FILE 2>/dev/null
rm -f $UNDO_FILE 2>/dev/null

# site specific stuff optional
[ -e /usr/local/etc/chilli/ipdown.sh ] && . /usr/local/etc/chilli/ipdown.sh
