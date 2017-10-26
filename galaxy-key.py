import json

with open('galaxy-key.json') as data_file:
    data = json.load(data_file)
print(data['galaxy-key'])