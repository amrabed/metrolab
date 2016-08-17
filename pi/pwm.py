import RPi.GPIO as gpio

pin = 4
try:
  gpio.setmode(gpio.BCM)
  gpio.setup(pin, gpio.OUT)

  p = gpio.PWM(pin, 1/150)
  p.start(40) 
except KeyboardInterrupt:
  p.stop()
  gpio.cleanup()

