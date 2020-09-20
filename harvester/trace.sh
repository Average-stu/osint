#!/bin/bash
echo "Enter the domain you want to find: "
read name
python3 -m pip install -r requirements/base.txt
python3 trace.py -d $name -b all -f $name
