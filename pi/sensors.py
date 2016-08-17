import RPi.GPIO as gpio
from time import sleep
from abc import ABCMeta
from abc import abstractmethod

class Sensor(metaclass=ABCMeta):
  """Sensor base class"""

  def __init__(self, pin):
    self.pin = pin
    gpio.setmode(gpio.BCM)

  @abstractmethod
  def read(self):
    assert not hasattr(super(), 'read')

class TemperatureSensor(Sensor):
  """Temperature Sensor"""
  def __init__(self, pin, timeout):
    super().__init__(pin)
    self.timeout = timeout
  
  def _start(self):
    """ Send start signal to Sensor """

    # Send start signal
    # HIGH for 250ms, LOW for 20ms, and HIGH for 40us 
    gpio.setup(self.pin, gpio.OUT)
    gpio.output(self.pin, gpio.HIGH)
    sleep(0.25)
    gpio.output(self.pin, gpio.LOW)
    sleep(0.02) 
    gpio.output(self.pin, gpio.HIGH)
    sleep(40e-6)
    gpio.setup(self.pin, gpio.IN)
    sleep(10e-6)

  def read(self):
    self._start()
    for i in range(1,200):   
#      if GPIO.wait_for_edge(self.pin, GPIO.BOTH, self.timeout) is None:
#        print('Timeout')
#        return
#      else:
        print('-' if gpio.input(self.pin) else '_', end="")
    print("\n")

class COSensor(Sensor):
  """Carbon Monoxide Sensor"""
  def __init__(self, hsw, alr):
    super().__init__(hsw)
    self.hsw = hsw
    self.alr = alr
    self.data = 0
    self.setup()
    
  def setup(self):
    gpio.setup(self.alr, gpio.IN)
    gpio.setup(self.hsw, gpio.OUT)
    self.pwm = gpio.PWM(self.hsw, 1/150)

  def cleanup(self):
    self.pwm.stop()

  def read(self):
    self.pwm.start(40)
    while True:
      sleep(60)
      self.data = gpio.input(self.alr)
      print(self.data)
      sleep(90)

  def getData(self):
    return self.data

class OzoneSensor(Sensor):
  """Ozone Sensor"""
  def __init__(self, pin):
    super().__init__(pin)

  def read(self):
    # ToDo: implement this
    pass


def main():
  co = COSensor(23, 24)
  temperature = TemperatureSensor(pin = 18, timeout = 1)
  ozone = OzoneSensor(12)
  try:
    co.read()
#      temperature.read()
  except KeyboardInterrupt:
    pass
  co.cleanup()
  gpio.cleanup()

if __name__ == "__main__":
   main()
