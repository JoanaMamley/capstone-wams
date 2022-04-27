#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

#define SCREEN_WIDTH 128 // OLED display width, in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

// Declaration for an SSD1306 display connected to I2C (SDA, SCL pins)
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);

//declaring bluetooth object 
SoftwareSerial btSerial(13, 15);


#if (defined(__AVR__) || defined(ESP8266)) && !defined(__AVR_ATmega2560__)
// pin #14 is IN from sensor (GREEN wire)
// pin #12 is OUT from esp8266  (WHITE wire)
// Set up the serial port to use softwareserial..
SoftwareSerial mySerial(14, 12);

#else
// On Leonardo/M0/etc, others with hardware serial, use hardware serial!
// #0 is green wire, #1 is white
#define mySerial Serial1

#endif


Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

int id;

void setup()
{
  Serial.begin(115200);
  if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) { // Address 0x3D for 128x64
    Serial.println(F("SSD1306 allocation failed"));
    for(;;);
  }
  delay(2000);
  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  // Display static text
  display.println("Started..");
  display.display(); 
  
  btSerial.begin(9600); 
  while (!Serial);  // For Yun/Leo/Micro/Zero/...
  delay(100);
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.clearDisplay();
  display.println("\n\nAdafruit Fingerprint sensor enrollment");
  display.display();

  // set the data rate for the sensor serial port
  finger.begin(57600);

  if (finger.verifyPassword()) {
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Found fingerprint sensor!");
    display.display();
  } else {
    display.clearDisplay();
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Did not find fingerprint sensor :(");
    display.display();
    while (1) { delay(1); }
  }

//  Serial.println(F("Reading sensor parameters"));
//  finger.getParameters();
//  Serial.print(F("Status: 0x")); Serial.println(finger.status_reg, HEX);
//  Serial.print(F("Sys ID: 0x")); Serial.println(finger.system_id, HEX);
//  Serial.print(F("Capacity: ")); Serial.println(finger.capacity);
//  Serial.print(F("Security level: ")); Serial.println(finger.security_level);
//  Serial.print(F("Device address: ")); Serial.println(finger.device_addr, HEX);
//  Serial.print(F("Packet len: ")); Serial.println(finger.packet_len);
//  Serial.print(F("Baud rate: ")); Serial.println(finger.baud_rate);
}

int acceptInput(void){
  int data = btSerial.parseInt(); 
  return data;
}

void loop()                     // run over and over again
{
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.println("Ready to enroll a fingerprint!");
  display.println("Please type in the ID # (from 1 to 127) you want to save this finger as...");
  display.display();
  id = acceptInput();
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.println(id);
  display.display();
  delay(3000);
  if (id == 0) {// ID #0 not allowed, try again!
     return;
  }
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.print("Enrolling ID #");
  display.println(id);
  display.display();
  delay(3000);

  while (!  getFingerprintEnroll() );
}

uint8_t getFingerprintEnroll() {
  int p = -1;
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.print("Waiting for valid finger to enroll as #"); display.println(id);
  display.display();
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      display.clearDisplay();
      display.setTextSize(1.5);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Image taken");
      display.display();
      delay(3000);
      break;
    case FINGERPRINT_NOFINGER:
      display.clearDisplay();
      display.setTextSize(3);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println(".");
      display.display();
      delay(1000);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Communication error");
      display.display();
      delay(3000);
      break;
    case FINGERPRINT_IMAGEFAIL:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Imaging error");
      display.display();
      delay(3000);
      break;
    default:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Unknown error");
      display.display();
      delay(3000);
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      display.clearDisplay();
      display.setTextSize(1.5);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Image converted");
      display.display();
      delay(3000);
      break;
    case FINGERPRINT_IMAGEMESS:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Image too messy");
      display.display();
      delay(3000);
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Communication error");
      display.display();
      delay(3000);
      return p;
    case FINGERPRINT_FEATUREFAIL:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Could not find fingerprint features");
      display.display();
      delay(3000);
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Could not find fingerprint features");
      display.display();
      delay(3000);
      return p;
    default:
      display.clearDisplay();
      display.setTextSize(1.5);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Unknown error");
      display.display();
      delay(3000);
      return p;
  }
  display.clearDisplay();
  display.setTextSize(1.5);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.println("Remove finger");
  display.display();
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.print("ID "); display.println(id);
  display.display();
  delay(3000);
  p = -1;
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.println("Place same finger again");
  display.display();
  delay(3000);
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      display.clearDisplay();
      display.setTextSize(1.5);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Image taken");
      display.display();
      delay(3000);
      break;
    case FINGERPRINT_NOFINGER:
      display.clearDisplay();
      display.setTextSize(2);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.print(".");
      display.display();
      delay(1000);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Communication error");
      display.display();
      delay(3000);
      break;
    case FINGERPRINT_IMAGEFAIL:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Imaging error");
      display.display();
      delay(3000);
      break;
    default:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Unknown error");
      display.display();
      delay(3000);
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(2);
  switch (p) {
    case FINGERPRINT_OK:
      display.clearDisplay();
      display.setTextSize(2);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Image converted");
      display.display();
      delay(3000);
      break;
    case FINGERPRINT_IMAGEMESS:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Image too messy");
      display.display();
      delay(3000);
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Communication error");
      display.display();
      delay(3000);
      return p;
    case FINGERPRINT_FEATUREFAIL:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Could not find fingerprint features");
      display.display();
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Could not find fingerprint features");
      display.display();
      delay(3000);
      return p;
    default:
      display.clearDisplay();
      display.setTextSize(1);
      display.setTextColor(WHITE);
      display.setCursor(0, 10);
      display.println("Unknown error");
      display.display();
      delay(3000);
      return p;
  }

  // OK converted!
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.print("Creating model for #");  display.println(id);
  display.display();
  delay(3000);

  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    display.clearDisplay();
    display.setTextSize(1.5);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Prints matched!");
    display.display();
    delay(3000);
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Communication error");
    display.display();
    delay(3000);
    return p;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Fingerprints did not match");
    display.display();
    delay(3000);
    return p;
  } else {
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Unknown error");
    display.display();
    delay(3000);
    return p;
  }
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.print("ID "); display.println(id);
  display.display();
  delay(2000);
  p = finger.storeModel(id);
  if (p == FINGERPRINT_OK) {
    display.clearDisplay();
    display.setTextSize(3);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Stored!");
    display.display();
    delay(5000);
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Communication error");
    display.display();
    delay(3000);
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Could not store in that location");
    display.display();
    delay(3000);
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Error writing to flash");
    display.display();
    delay(3000);
    return p;
  } else {
    display.clearDisplay();
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.println("Unknown error");
    display.display();
    delay(3000);
    return p;
  }

  return true;
}
