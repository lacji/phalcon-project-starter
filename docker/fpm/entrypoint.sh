#!/bin/sh

composer install --ignore-platform-reqs

exec $@