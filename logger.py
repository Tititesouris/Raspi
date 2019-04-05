import time
from sh import tail

descriptions = {
    "LD": "Laundry put to dry",
    "OW": "Window opened",
    "CW": "Window closed"
}

while True:
    labels = {}
    for line in tail("-n 2000", "labeldata.csv", _iter=True):
        labels[line.split(";")[0]] = line

    with open("public/logs.csv", "w") as file:
        for line in tail("-n 2000", "sensordata.csv", _iter=True):
            timestamp, temperature, humidity = line.rstrip().split(";")
            label, description = "", ""
            if timestamp in labels.keys():
                timestamp, label = labels[timestamp].rstrip().split(";")
                description = descriptions.get(label)
            file.write(timestamp + ";" + temperature + ";" + humidity + ";" + label + ";" + description + "\n")
    time.sleep(300)
