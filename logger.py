import time

from sh import tail

while True:
    labels = {}
    for line in tail("-n 2000", "labeldata.csv", _iter=True):
        labels[line.split(";")[0]] = line

    file = open("public/logs.csv", "w")
    try:
        for line in tail("-n 2000", "sensordata.csv", _iter=True):
            timestamp, temperature, humidity = line.rstrip().split(";")
            label, description = ["", ""]
            if timestamp in labels.keys():
                timestamp, label, description = labels[timestamp].rstrip().split(";")
            file.write(timestamp + ";" + temperature + ";" + humidity + ";" + label + ";" + description + "\n")
    finally:
        file.close()
    time.sleep(60.0)
