
"""งานที่ 4"""
#กำหนดตัวแปล
#x = 10
#y = 2
#1. จงเขียนฟังก์ชันหาค่าแฟคทอเรียลของ x
#import math
#x=math.factorial(x)
#print(x)
#2. จงเขียนฟังก์ชันหาผลรวมของค่า x และ y
#import math
#print(x+y)
#3. จงเขียนฟังก์ชันหาค่า x ยกกำลังด้วย y
#import math
#x=math.pow(x, y)
#print(x)
#4. จงเขียนฟังก์ชั้นหาค่าสัมบูรณ์ของ y
#import math
#x=math.fabs(x)
#print(x)
#5. จงเขียนฟังก์ชั้นหาค่ารากที่ 2 ของ X
#import math
#x=math.sqrt(x)
#print(x)


"""งานที่ 5.1"""
def show_profile():
    print("ชื่อ นามสกุล")
    print("เลขที่")
    print("ชั้น")
    print("โรงเรียนสารภีพิทยาคม")
show_profile()


"""งานที่ 5.2"""
def triangle_area():
    base = int(input("ความยาวฐาน : "))
    high = int(input("ความสูงฐาน : "))
    area = 1/2*base*high
    print("พื้นที่สามเหลี่ยม",area)
triangle_area()


"""งานที่ 6"""
def print_name(name,surname):
    print("ชื่อ",name + surname)
fristname=(input("ระบุชื่อ : "))
lastname=(input("ระบุนามสกุล : "))
print_name(fristname,lastname)


"""งานที่ 7"""
#1. จากโปรแกรม ไฟล์ของโมดูลมีชื่อว่า
#ตอบ number.py หรือ number
#2. ในโมดูลนี้ มีกี่ฟังก์ชัน อะไรบ้าง
#ตอบ 2 ฟังก์ชั่น factorial() และ fibonacci()  
#3. จากโปรแกรมมีการคืนค่าจากฟังก์ชันหรือไม่
#ตอบ ไม่มี
#4. คำสั่งใดเป็นการนำโมดูล number เข้ามาใช้งานที่
#โปรแกรมหลัก (Main program)
#ตอบ import number
#5. คำสั่งใดคือ การใช้งานฟังก์ชัน
#ตอบ from number import factorial


"""งานที่ 8.1 """
number=int(input("ระบุตัวเลข : "))
if number%2 == 0:
     print(number," เป็นเลข คู่")
else:
     print(number," เป็นเลข คี่")


"""งานที่ 8.2 """
score=int(input("ระบุคะแนน : "))
if score >=80 and score <=100:
    print(score," คะแนน อยู่ในระดับ ดีมาก")
elif score >=60 and score <=79:
    print(score," คะแนน อยู่ในระดับ ดี")
elif score >=40 and score <=59:
    print(score," คะแนน อยู่ในระดับ พอใข้")
elif score >=0 and score <=39:
    print(score," คะแนน อยู่ในระดับ ต้องปรับปรุง")
else:
    print(score,"คะแนน ไม่ถูกต้อง")


"""งานที่ 9"""
key = 1
summantion = 0
while True:
  if key >=1:
    summantion+=key
    key=int(input("ระบุตัวเลข : "))
  else:
    print("ผลรวมทั้งหมดเท่ากับ : ",summantion-1)
    break
#ในสมุด
#กำหนดตัวแปล
#key = 1
#summantion = 0
#===================
#1. ข้อมูลนำเข้าคือ key
#2. การประมวลผลคือ summantion+=key
#มีเงื่อนไขในการวนซ้ำอะไรบ้าง key >=1
#3. ข้อมูลส่งออกหรือแสดงผลคือ print("ผลรวมทั้งหมดเท่ากับ : ",summantion-1)
#4. เขียนโปรแกรมได้ดังนี้ เขียนตามด้านบน


"""งานที่ 10"""


