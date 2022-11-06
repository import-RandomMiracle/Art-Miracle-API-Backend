# Art Miracle (API Backend) by Import Random Miracle
    Final Project 1/2022

**Art Miracle** เป็นเว็บไซต์เกี่ยวกับการซื้อ-ขาย แบ่งปันรูปภาพ ไม่ว่าจะเป็นภาพถ่าย ภาพวาด หรือรูปภาพดิจิทัลก็ตาม

## สมาชิกภายในกลุ่ม

| รหัสนิสิต | ชื่อ - นามสกุล | เรียน SE | เรียน WT | |
| --- | --- | --- | --- | --- |
| 6310403974 | ณัฐดนัย ตันวาณิชกุล | / | / | (หัวหน้ากลุ่ม) |
| 6310400959 | ชัชวาล เมืองใหม่ |  | / | |
| 6310401033 | ทินรัตน์ จีระกุลกิจ |  | / | |
| 6310401041 | ธิติ ทวีสิน | / |  | |
| 6310401084 | พีรพัฒน์ ตันตระกูล | / | / | |

หมายเหตุ :
* SE ย่อมาจากชื่อวิชา Introduction to Software Engineering
* WT ย่อมาจากชื่อวิชา Web Technology and Web Service

## การติดตั้งใช้งาน
> การใช้งานจำเป็นต้องติดตั้งร่วมกันทั้ง Frontend และ API Backend เพื่อให้เว็บไซต์สามารถใช้งานได้อย่างเต็มประสิทธิภาพ สำหรับ repository นี้ เป็นเว็บไซต์สำหรับ API backend เท่านั้น โปรดไปยัง[ลิงก์นี้](https://github.com/import-RandomMiracle/Art-Miracle/) เพื่อดาวน์โหลด frontend มาใช้งานร่วมกันด้วย

### การใช้งานเว็บไซต์ (แบบ local)
1. ใช้คำสั่งต่อไปนี้เพื่อติดตั้ง laravel framework ลงใน repository
```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

2. ใช้คำสั่งต่อไปนี้เพื่อเริ่มทำงานโปรแกรม
```
./vendor/bin/sail up
```

## การทดสอบด้วย PHP Unit Test/Feature Test
- มีการทดสอบ http request กับ API controllers บน API Backend ดังนี้
  -  ArtistController
  -  ArtworkController
  -  CategoryController
  -  CommentController
  -  LikeController
  -  ReportController
  -  TagController
  -  UserController

## การดำเนินงาน
ตรวจสอบการดำเนินงานของกลุ่มได้ที่ [ลิงก์ Jira](https://import-random-miracle.atlassian.net/jira/software/projects/AM/boards/1/roadmap)


## เอกสารที่เกี่ยวข้อง
- User Persona
- User Journey
- Burn Down Chart
- UI Flow
> เอกสารทั้งหมดนี้อยู๋ใน directory documents
