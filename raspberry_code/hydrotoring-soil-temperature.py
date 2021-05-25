#Library
import spidev
import lcddriver
import datetime
import Adafruit_DHT as dht
import urllib3, urllib, http.client
import json
import os

from time import sleep
from firebase import firebase
from numpy import interp # To scale values
from functools import partial

#API Key Firebase
firebase= firebase.FirebaseApplication('https://hydrotoring.firebaseio.com/', None)

# Start SPI connection
spi = spidev.SpiDev() # Created an object
spi.open(0,0)

#Function LCD
display = lcddriver.lcd()

#Define DHT22
pin = 4 #GPIO pin we are communicating on CHANGE THIS

h,t = dht.read_retry(dht.DHT22, pin) #Refreshes the DHT sensor. ARG DHT11 or DHT22 sensor
display = lcddriver.lcd() #Refering to the LCD
temp = 'Temp:{0:0.1f} C'.format(t) #Store temp string info
humid = 'Humidity:{1:0.1f}%'.format(t,h) #Store Humidity info

#Read ADC MCP3008 data
def analogInput(channel):
spi.max_speed_hz = 1350000
adc = spi.xfer2([1,(8+channel)<<4,0])
data = ((adc[1]&3) << 8) + adc[2]
return data

#Proses Sensor
try:
while True:
h,t = dht.read_retry(dht.DHT22, pin) #Loop the check sensor check DHT11 or DHT22 sensor 104
temp = 'Temp: {0:0.1f} C'.format(t) #Update variable temperature
humid = 'Humidity: {1:0.1f} %'.format(t,h) #Update variable humidity
print(temp)
print(humid)
#Progress YL-69
soil = analogInput(0) # Reading from CH0
soil = interp(soil, [0, 1023], [100, 0])
soil = int(soil)
soil_lcd = 'Moisture: {0:0.1f} %'.format(soil)
print("Moisture : ", soil)
#Tampilin ke LCD
display.lcd_clear()
display.lcd_display_string(temp, 1)
display.lcd_display_string(soil_lcd, 2)
sleep(2)
display.lcd_display_string(humid, 1)
#Kirim data ke firebase
firebase.post('sensor/data', {'Temperature':(temp)})
firebase.post('sensor/data', {'Humidity':(humid)})
firebase.post('sensor/data', {'Moisture':(soil)})
#Looping data
sleep(2)

except KeyboardInterrupt:
print("Cleaning up!")
display.lcd_clear()