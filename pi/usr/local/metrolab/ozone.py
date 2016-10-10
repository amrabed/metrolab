import serial 

class OzoneSensor:
  def __init__(self):
    self.port = serial.Serial('/dev/ttyUSB0', 9600)

  def read(self):
    self.port.write(b'c')
    line = self.port.readline()
    return int(line.decode().split(', ')[1])/1000
