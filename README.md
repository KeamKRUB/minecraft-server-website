# Minecraft-Website (2020 - 2022)
เว็บไซต์สำหรับเซิร์ฟเวอร์ Minecraft 
เว็บไซต์มีระบบที่สำคัญ ดังนี้
- ระบบสมัคร/ลงชื่อเข้าใช้ แบบเชื่อมต่อกับ Plugin Authme
- ระบบสำหรับการซื้อของ/ส่งของขวัญ อัตโนมัติ
- ระบบ Code redeem
- ระบบกล่องสุ่ม
- ระบบชวนเพื่อน
- ระบบโปรโมชัน
- ระบบเติมเงินด้วย Truemoney Wallet
- ระบบจัดการหลังบ้านแบบเต็มรูปแบบ
- ระบบการติดตั้งเว็บไซต์อย่างง่ายเมื่อเข้าใช้งานเว็บไซต์ครั้งแรก

---

> วิธีการติดตั้งเว็บไซต์

เข้าไปที่ path install(install/install.php) และทำตามขั้นต่อต่อไปนี้
1. System Chekc (ตรวจสอบระบบ) - เช็ค Operation System & PHP Version
2. MySQL Database - ตั้งค่า Database ให้เรียบร้อย (ตรวจสอบให้แน่ใจว่าได้สร้าง Table ใน Database เตรียมไว้แล้ว)
3. Configuration - กำหนดค่าพื้นฐานของเว็บไซต์
4. เสร็จสิ้นการติดตั้ง - หลังจากดำเนินการครบถ้วนให้ลบ file license.key ใน page/_system

ถ้าหน้า Install เกิด error ให้ตรวจสอบเวอร์ชัน php และแก้ไขในไฟล์ install/install.php

> วิธีการเข้าถึง Backend
1. กำหนดสถานะให้ตัวเองเป็น Admin
2. เข้าไปยัง path backend
3. ใส่รหัสผ่านที่ได้ตั้งค่าเอาไว้

---

> ⚠️ **Warning:** ไม่อนุญาตให้นำเว็บไซต์ไปใช้ในการแสวงหาผลกำไรที่ไม่ได้มาจากการขายของผ่านเว็บไซต์!

video: https://www.youtube.com/watch?v=fmL09J07Yag
