#!/usr/bin/env python
from gopigo import *
import sys
from twython import Twython, TwythonError
import time
import picamera
import serial
import atexit

#something for atexit
atexit.register(stop)

#initialize Twitter
CONSUMER_KEY = 'DmDFasxACf6nasSfs9UcbkeAl'
CONSUMER_SECRET = 'Mvry1BVjA5KtWbSJl30oYaCGJMijY49ZKMHekIYWmfhz94q9m7'
ACCESS_KEY = '1671366552-MDZcWMkiMhfD0EjQG1rObxZdN9eGgepuJooop36'
ACCESS_SECRET = 'OMiJTRQ1su57i8H6qPevqLjvHQKVvbh8O0NZZTPpnLqRz'

twitter = Twython(CONSUMER_KEY,CONSUMER_SECRET,ACCESS_KEY,ACCESS_SECRET)

#initialize camera
camera = picamera.PiCamera()

#initialize communication to arduino
ser = serial.Serial('/dev/ttyACM0', 9600)

#set initial speed of motors
set_speed(200)

#main loop that will run
while True:
        print "\nCmd:",
        #a=raw_input()
        input=ser.readline()
	a=input[0]
	#a.decode("utf-8")
	print a;
        
        if a=='w':
                fwd()
        elif a=='a':
                left()
        elif a=='d':
                right()
        elif a=='s':
                bwd()
        elif a=='x':
                stop()
        elif a=='t':
                increase_speed()
        elif a=='g':
                #decrease_speed()
		set_speed(10)
		led_on(0)
		led_on(1)
        elif a=='v':
                input = ser.readline()
		currentTime = ''.join(input)
		input2 = ser.readline()
		coordinates = ''.join(input2)
		output = "Here is the picture taken at " + currentTime + " seconds of your trip! Your location is: " + coordinates
		#print volt(),"V"
		print(output)
		camera.capture('image.jpg')
		try:
			image_open = open('image.jpg')
			image_ids = twitter.upload_media(media=image_open)
			twitter.update_status(status=output,media_ids=image_ids['media_id'])
			#twitter.update_status(status='Hey!')
		except TwythonError as e:
    			print e

        elif a=='b': #servo test
                for i in range(180):
                        servo(i)
                        print i
                        time.sleep(.02)
        elif a=='z':
                #sys.exit()
		set_speed(200)
		led_off(0)
		led_off(1)
        elif a=='u':
                print us_dist(15),'cm'
        elif a=='l':
                led_on(0)
                led_on(1)
                time.sleep(1)
                led_off(0)
                led_off(1)
        elif a=='i':
                motor_fwd()
        elif a=='k':
                motor_bwd()
        elif a=='n':
                left_rot()
        elif a=='v':
                print volt(),"V"
        elif a=='b': #servo test
                for i in range(180):
                        servo(i)
                        print i
                        time.sleep(.02)
        elif a=='z':
                sys.exit()
        elif a=='u':
                print us_dist(15),'cm'
        elif a=="l\n":
                led_on(0)
                led_on(1)
                time.sleep(1)
                led_off(0)
                led_off(1)
        elif a=='i':
                motor_fwd()
        elif a=='k':
                motor_bwd()
        elif a=='n':
                left_rot()
        elif a=='m':
                right_rot()
        elif a=='y':
                enc_tgt(1,1,18)
        elif a=='f':
                print "v",fw_ver()
        elif a=='tr':
                val=trim_read()
                if val==-3:
                        print "-3, Trim Value Not set"
                else:
                        print val-100
        elif a=='tw':
                print "Enter trim value to write to EEPROM(-100 to 100):",
                val=int(raw_input())
                trim_write(val)
                time.sleep(.1)
                print "Value in EEPROM: ",trim_read()-100
        elif a=='tt':
                print "Enter trim value to test(-100 to 100):",
                val=int(raw_input())
                trim_test(val)
                time.sleep(.1)
                print "Value in EEPROM: ",trim_read()-100
                right_rot()
        elif a=='y':
                enc_tgt(1,1,18)
        elif a=='f':
                print "v",fw_ver()
        elif a=='tr':
                val=trim_read()
                if val==-3:
                        print "-3, Trim Value Not set"
                else:
                        print val-100
        elif a=='tw':
                print "Enter trim value to write to EEPROM(-100 to 100):",
                val=int(raw_input())
                trim_write(val)
                time.sleep(.1)
                print "Value in EEPROM: ",trim_read()-100
        elif a=='tt':
                print "Enter trim value to test(-100 to 100):",
                val=int(raw_input())
                trim_test(val)
                time.sleep(.1)
                print "Value in EEPROM: ",trim_read()-100
        elif a=='st':
                print "Enter Servo position:",
                val=int(raw_input())
                servo(val)
        time.sleep(.1)
