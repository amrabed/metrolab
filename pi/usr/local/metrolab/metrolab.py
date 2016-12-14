import sys
import requests
from threading import Timer
from random import uniform
from datetime import datetime
from BME280 import *
from MQ7 import COSensor
from ozone import OzoneSensor

class Device:
    def __init__(self):
        self.weatherSensor = BME280(mode=BME280_OSAMPLE_8)
        self.coSensor = COSensor(23, 24)
        self.ozoneSensor = OzoneSensor('/dev/ttyUSB0')
           
    def read_sensors(self):
        ozone, temperature, humidity = self.ozoneSensor.read()
        temperature = round(self.weatherSensor.read_temperature(), 5)
        pressure = round(self.weatherSensor.read_pressure(), 5)
        humidity = round(self.weatherSensor.read_humidity(), 5)
        co = round(self.coSensor.read(), 5)
        return (ozone, co, temperature, pressure, humidity)

    def record_data(self):
        try:
            data = self.read_sensors()
            #print(data)
            url = 'http://ultron.ncr.vt.edu:8080/sensor.php'
            #headers = {'content-type': "application/x-www-form-urlencoded",'cache-control': "no-cache"}
            query = 'INSERT INTO `Blacksburg` (`ozone`, `carbonMonoxide`, `temperature`, `pressure`, `humidity`) VALUES {}'.format(data)
            response = requests.post(url, data={'query':query})
            #table = "Blacksburg"
            #fields= "(`ozone`, `carbonMonoxide`, `temperature`, `pressure`, `humidity`)"
            #values= str(data)
            #response = requests.post(url, data = {'table':data, 'fields':fields, 'values':values})
        except Exception as e:
            print(e)

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
    #print("(Ozone, CarbonMonoxide, Temperature, Pressure, Humidity)")
    scheduler = Scheduler(int(argv))
  except KeyboardInterrupt:
    pass

if __name__ == "__main__":
   main(sys.argv[1])

