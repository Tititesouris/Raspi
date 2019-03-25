import time

from sh import tail

while True:
    labels = {}
    for line in tail("-n 100", "labeldata.csv", _iter=True):
        labels[line.split(";")[0]] = line

    with open("sensordata.csv", "w") as file:
        for line in tail("-n 100", "sensordata.csv", _iter=True):
            timestamp, temperature, humidity = line.split(";")
            label, description = ["", ""]
            if timestamp in labels.keys():
                timestamp, label, description = labels[timestamp].split(";")
            file.write(timestamp + ";" + temperature + ";" + humidity + ";" + label + ";" + description + "\n")
        file.close()
    time.sleep(60.0)
