import sys
import pymysql.cursors
from threading import Timer
from random import uniform
from datetime import datetime
from BME280 import *
from MQ7 import COSensor

class Device:
    def __init__(self):
        self.weatherSensor = BME280(mode=BME280_OSAMPLE_8)
        self.coSensor = COSensor(23, 24)
           
    def read_sensors(self):
        temperature = round(self.weatherSensor.read_temperature(), 5)
        pressure = round(self.weatherSensor.read_pressure(), 5)
        humidity = round(self.weatherSensor.read_humidity(), 5)
        ozone = round(uniform(0.07, 0.09), 5)
        co = round(self.coSensor.read(), 5)
        return (ozone, co, temperature, pressure, humidity)

    def record_data(self):
        data = self.read_sensors()
        print(data)
        connection = pymysql.connect('127.0.0.1', user='sensor', password='M3troL@b', db='metrolab')
        sql = "INSERT INTO `Blacksburg` (`ozone`, `carbonMonoxide`, `temperature`, `pressure`, `humidity`) VALUES (%s, %s, %s, %s, %s)"
        try:
            with connection.cursor() as cursor:
                cursor.execute(sql, data)
            connection.commit()
        finally:
            connection.close()

class Scheduler(object):
    def __init__(self, interval):
        self.device = Device()
        self._timer = None
        self.interval = interval
        self.is_running = False
        self.start()        

    def _run(self):
        self.is_running = False
        self.start()

    def start(self):
        if not self.is_running:
            self.device.record_data()
            self._timer = Timer(self.interval, self._run)
            self._timer.start()
            self.is_running = True

    def stop(self):
        self._timer.cancel()
        self.is_running = False
 
def main(argv):
  try:
    print("(Ozone, CarbonMonoxide, Temperature, Pressure, Humidity)")
    scheduler = Scheduler(int(argv))
  except KeyboardInterrupt:
    pass

if __name__ == "__main__":
   main(sys.argv[1])
