#!/bin/bash
screen -S mcserver -p 0 -X stuff "$1$(printf \\r)"


