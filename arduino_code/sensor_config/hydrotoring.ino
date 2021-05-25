#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <SoftwareSerial.h>
#include "GravityTDS.h"

LiquidCrystal_I2C lcd(0x27, 20, 4);

//sensor PH
#define VCC2 2
#define GND2 3

//TDS meter
#define VCC3 4
#define GND3 5

//connect ESP32
#define VCC4 6
#define GND4 7

//i2c lcd display
#define VCC5 8
#define GND5 9

//PH
#define pin_ph A0

float calibration = 23.90; //change this value to calibrate
int sensorValue = 0;
unsigned long int avgValue;
float b;
int buf[10], temp;
float phValue;

//TDS & EC
#define pin_tds A1

float aref = 4.3;
float ec = 0;
float tds = 0;
float temperature = 25;
float ecCalibration = 5.7;

GravityTDS gravityTds;

//simbol degrees
byte degree_symbol[8] = {0b00111, 0b00101, 0b00111, 0b00000, 0b00000, 0b00000, 0b00000, 0b00000};

//timer
int timer = 0;

//Arduino to Esp32
SoftwareSerial softSerial(10, 12); //RX, TX

void setup() {
  Serial.begin(115200);
  Serial.println("Interfacing arduino with nodemcu");
  softSerial.begin(115200);

  poweringPin();

  beginTDS();
  beginLCD();
}

void loop() {
  cekPH();
  cekTDSnEC();
  sendToEsp();
  showDataLCD();
  timer++;
  if (timer == 30) {
    timer = 0;
  }
  delay(1000);
}

void cekPH() {
  for (int i = 0; i < 10; i++) {
    buf[i] = analogRead(pin_ph);
    delay(30);
  }
  for (int i = 0; i < 9; i++) {
    for (int j = i + 1; j < 10; j++) {
      if (buf[i] > buf[j]) {
        temp = buf[i];
        buf[i] = buf[j];
        buf[j] = temp;
      }
    }
  }
  avgValue = 0;
  for (int i = 2; i < 8; i++)
    avgValue += buf[i];

  float pHVol = (float)avgValue * 5.0 / 1024 / 6;
  phValue = -5.70 * pHVol + calibration;

  int sensorValue = analogRead(A0);
  float voltage = sensorValue * (5.0 / 1023.0);
}

void cekTDSnEC() {
  if (analogRead(pin_tds) <= 16) {
    tds = 0;
    ec = 0;
  } else {
    gravityTds.setTemperature(temperature);
    gravityTds.update();
    tds = gravityTds.getTdsValue() * 1.65;
    ec = tds * 2 ;
  }

  Serial.print("Nilai Kepekatan Air = ");
  Serial.print(analogRead(tds));
  Serial.println("ppm");
  Serial.print("Nilai Kepekatan Air 2 = ");
  Serial.print(analogRead(ec));
  Serial.println("ppm");
  Serial.print("Nilai Keasaman Air = ");
  Serial.print(analogRead(phValue));
  Serial.println("pH");
  Serial.println();
}

void sendToEsp() {
  //ngirim data ke esp32
  softSerial.print("1:");
  softSerial.print(phValue);
  softSerial.print("&2:");
  softSerial.print(tds);
  softSerial.print("&3:");
  softSerial.print(ec);
}

void poweringPin() {
  pinMode(VCC2, OUTPUT);
  digitalWrite(VCC2, HIGH);
  pinMode(VCC3, OUTPUT);
  digitalWrite(VCC3, HIGH);
  pinMode(VCC4, OUTPUT);
  digitalWrite(VCC4, HIGH);
  pinMode(VCC5, OUTPUT);
  digitalWrite(VCC5, HIGH);

  pinMode(GND2, OUTPUT);
  digitalWrite(GND2, LOW);
  pinMode(GND3, OUTPUT);
  digitalWrite(GND3, LOW);
  pinMode(GND4, OUTPUT);
  digitalWrite(GND4, LOW);
  pinMode(GND5, OUTPUT);
  digitalWrite(GND5, LOW);
}

void beginTDS() {
  gravityTds.setPin(pin_tds);
  gravityTds.setAref(5.0);
  gravityTds.setAdcRange(1024);
  gravityTds.begin();
}

void beginLCD() {
  lcd.begin();
  lcd.createChar(1, degree_symbol);
  lcd.backlight();
  lcd.setCursor(5, 0);
  lcd.print("HYDROTORING");
  lcd.setCursor(5, 2);
  lcd.print("HYDROPONIC");
  lcd.setCursor(5, 3);
  lcd.print("MONITORING");
}

void showDataLCD() {
  if (timer < 10) {
    lcd.clear();
    lcd.setCursor(5, 0);
    lcd.print("HYDROTORING");
    lcd.setCursor(0, 1);
    lcd.print("PH  = ");
    lcd.print(phValue);
    lcd.setCursor(13, 1);
//    lcd.print(" pH");
    lcd.setCursor(0, 2);
    lcd.print("PPM = ");
    lcd.print(tds);
    lcd.setCursor(0, 3);
    lcd.print("EC  = ");
    lcd.print(ec);
  }
  if (timer % 10 == 0) {
    lcd.clear();
    lcd.setCursor(5, 0);
    lcd.print("HYDROTORING");
    lcd.setCursor(0, 1);
    lcd.print("PH  = ");
    lcd.print(phValue);
    lcd.setCursor(13, 1);
//    lcd.print(" pH");
    lcd.setCursor(0, 2);
    lcd.print("PPM = ");
    lcd.print(tds);
    lcd.setCursor(0, 3);
    lcd.print("EC  = ");
    lcd.print(ec);
  }
}
