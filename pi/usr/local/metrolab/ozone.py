import serial 

class OzoneSensor:
  def __init__(self, dev):
    self.port = serial.Serial(dev, 9600)

  def read(self):
    self.port.write(b'c')
    line = self.port.readline()
    values = line.decode().split(', ')
    return (int(values[1])/1000, values[2], values[3])
    
