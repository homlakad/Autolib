<?php

require_once("../shared/common.php");
?>
<h1>รูปแบบเอกสาร CSV สำหรับนำเข้ารายการลงใน OpenBiblio:</h1>
<p>ต้นแบบเอกสาร CSV ที่มีให้ดาวน์โหลดในหน้า "นำเข้าจากไฟล์ CSV" ของ OpenBiblio นั้นเป็นแบบแบ่งเนื้อหาด้วยการแท็บ (Tab-Seperated Value Format : TSV).</p>

<strong>สำหรับโปรแกรม Microsoft Excel รุ่น XP, 2003 หรือ 2007</strong>
<p>ดาวน์โหลดไฟล์ต้นแบบ และเพิ่มรายการทรัพยากรสารสนเทศตั้งแต่แถวที่ 2 เป็นต้นไป จากนั้นอัพโหลดไฟล์ที่บันทึกแล้วในหน้า "นำเข้าจากไฟล์ CSV"</p>
<strong>สำหรับโปรแกรม OpenOffice หรือโปรแกรมอื่นๆ ที่จัดการเอกสาร CSV ได้</strong>
<p>ตรวจสอบให้แน่ใจว่าชนิดอักขระสำหรับการเปิดเอกสารเป็น Unicode หรือ UTF-16 อย่างใดอย่างหนึ่ง
และกำหนดให้เครื่องหมายแท็บ (Tab) เป็นตัวแบ่ง (Seperator) ในการอ่านเอกสารนอกเหนือจากการแบ่งด้วยเครื่องหมายลูกน้ำ (Comma) ก่อนเปิดเอกสาร ในการบันทึกเอกสารสำหรับโปรแกรม OpenOffice จำเป็นต้องกดปุ่ม 'Keep Current Format' ในขณะบันทึกด้วย</p>
<h4>การใช้งานเอกสารต้นแบบโดยสรุป:</h4>
<ul>
  <li>ดาวน์โหลดเอกสารต้นแบบ</li>
  <li>เปิดด้วยโปรแกรมจัดการเอกสาร เช่น Microsoft Office หรือ OpenOffice หรือโปรแกรมอื่นๆ ที่จัดการเอกสาร CSV ได้</li>
  <li>เพิ่มข้อมูลรายการทรัพยากรสารสนเทศทั้งแต่แถวที่ 2 ของตารางเป็นต้นไป มีข้อมูลเช่น ISBN<font color="red">*</font>, ชื่อผู้แต่ง<font color="red">*</font>, ชื่อเรื่อง<font color="red">*</font> ฯลฯ (หมายเหตุ: จำเป็นต้องกรอกข้อมูล 3 คอลัมน์แรกของแต่ละแถว)</li>
<!--  <li>Column 'Book cover filename' require filename link to cover image in <?php echo COVER_PATH; ?> directory.</li>-->
  <li>ห้ามแก้ไขข้อมูลแถวแรกสุดในเอกสารต้นแบบโดยเด็ดขาด เพื่อหลีกเลี่ยงข้อผิดพลาดในการอัพโหลดเอกสาร</li>
  <li>บันทึกเอกสาร และอัพโหลดไฟล์เอกสารในหน้า "นำเข้าจากไฟล์ CSV" (งานลงรายการทรัพยากรสารสนเทศ > นำเข้าจากไฟล์ CSV)</li>
</ul>

<font class="small">หมายเหตุ: การอัพโหลดเอกสารอาจล้มเหลวหรือเกิดข้อผิดพลาดด้วยสาเหตุดังนี้:
<ol>
  <li>ข้อมูลแถวแรกของเอกสารขาดหายไปหรือถูกแก้ไข</li>
  <li>กรอกข้อมูลที่จำเป็นไม่ครบในแถวใดแถวหนึ่ง</li>
  <li>รูปแบบของเอกสาร CSV ไม่ถูกต้อง</li>
  <li>ระบบฐานข้อมูลของ OpenBiblio ล้มเหลว ทำให้ไม่สามารถบันทึกข้อมูลที่นำเข้าได้</li>
</ol>
</font>
