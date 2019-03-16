import board
import busio
import adafruit_am2320
import time

i2c = busio.I2C(board.SCL, board.SDA)
sensor = adafruit_am2320.AM2320(i2c)
with open("sensorlogs.csv", "a") as file:
    file.write(str(time.time()) + ";" + str(sensor.temperature) + ";" + str(sensor.relative_humidity))
