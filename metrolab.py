from threading import Timer
from random import gauss, uniform
from datetime import datetime
import sys
import pymysql.cursors

class Scheduler(object):
    def __init__(self, interval):
        self._timer = None
        self.interval = interval
        self.is_running = False
        self.start()        

    def _run(self):
        self.is_running = False
        self.start()
        self.record_data()

    def start(self):
        if not self.is_running:
            self._timer = Timer(self.interval, self._run)
            self._timer.start()
            self.is_running = True

    def stop(self):
        self._timer.cancel()
        self.is_running = False
 
    def read_sensors(self):
        ozone = round(uniform(0.07, 0.09), 5)
        co = round(uniform(1.5, 5), 5)
        temperature = round(gauss(0, 15), 5)
        pressure = round(gauss(30, 0.5), 5)
        humidity = round(gauss(60, 20), 5)
        return (ozone, co, temperature, pressure, humidity)

    def record_data(self):
        connection = pymysql.connect('127.0.0.1', user='sensor', password='M3troL@b', db='metrolab')
        sql = "INSERT INTO `Blacksburg` (`ozone`, `carbonMonoxide`, `temperature`, `pressure`, `humidity`) VALUES (%s, %s, %s, %s, %s)"

        try:
            with connection.cursor() as cursor:
                cursor.execute(sql, self.read_sensors())
            connection.commit()
        finally:
            connection.close()

def main(argv):
#    print("(Ozone, CarbonMonoxide, Temperature, Pressure, Humidity)")
    scheduler = Scheduler(int(argv))

if __name__ == "__main__":
   main(sys.argv[1])

