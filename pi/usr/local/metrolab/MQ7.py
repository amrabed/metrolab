import RPi.GPIO as gpio
from time import sleep
from threading import Timer

class COSensor:
  """Carbon Monoxide Sensor"""
  def __init__(self, hsw, alr):
    gpio.setwarnings(False)
    gpio.setmode(gpio.BCM)
    self.hsw = hsw
    self.alr = alr
    self.data = 0
    self.is_running = False
    self.setup()
    self.start()
    
  def setup(self):
    gpio.setup(self.alr, gpio.IN)
    gpio.setup(self.hsw, gpio.OUT)
    self.pwm = gpio.PWM(self.hsw, 1/150)
    self.pwm.start(40)
    sleep(75)

  def start(self):
    if not self.is_running:
      self.probe()
      self._timer = Timer(150, self._run)
      self._timer.start()
      self.is_running = True

  def _run(self):
    self.is_running = False
    self.start()

  def probe(self):
      self.data = gpio.input(self.alr)
#      print(self.data)

  def read(self):
    return self.data

  def stop(self):
    self.pwm.stop()
    self._timer.cancel()
    self.is_running = False
    gpio.cleanup()

def main():
  try:
    sensor = COSensor(23, 24)
  except KeyboardInterrupt:
    sensor.stop()

if __name__ == "__main__":
   main()
