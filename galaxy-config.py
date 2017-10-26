import json
import sys

with open('galaxy-config.json') as data_file:
    data = json.load(data_file)

print(data[sys.argv[1]])