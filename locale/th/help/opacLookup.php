<h1>หน้าแสดงบาร์โค้ด:</h1>
<br><br>
การค้นหาในฟอร์มสำหรับการยืม การคืน และการจอง ระบบจะเปิดหน้าต่าง Popup ซึ่งเหมือนกับ Online Public Access Catalog (OPAC). ในหน้าแสดงผลลัพธ์จากการค้นหา รหัสบาร์โค้ดจะมีลิงค์ (การยืม คืน และจอง) เมื่อเลือกบาร์โค้ดแล้ว ระบบจะปิดหน้าต่าง Popup และกลับมาแสดงที่หน้าหลักพร้อมรหัสบาร์โค้ด 
.
<br><br>

แนะนำการใช้งาน:
<ul>
  <li><a href="#exam">ตัวอย่างเช่น เลือกรหัสบาร์โค้ดจากหน้าการค้นหา </a></li>
  <li><a href="#seri">Recognizing Copy Serial Numbers in Autogenerated Barcode Numbers</a></li>
</ul>
<br><br>

<a name="exam">
ตัวอย่างนี้แสดงผลจากการค้นหาที่เชื่อมโยงรหัสบาร์โค้ดที่เลือก ถ้าบราวเซอร์ของคุณแสดง Tooltips จะเห็นคำอธิบายการเชื่อมโยงนี้ 
.
<br><br>

<!--**************************************************************************
    *  Printing result table EXAMPLE ALMOST COMPLETELY TRANSLATED BY $loc->getText 
    ************************************************************************** -->
<table class="primary">
  <tbody><tr>
    <th colspan="3" align="left" nowrap="yes" valign="top">
      <?php echo $loc->getText("biblioSearchResults"); ?>:
    </th>
  </tr>
  
  <tr>

    <td class="primary" rowspan="2" align="center" nowrap="true" valign="top">
      1.<br>
      <a href="#exam" title="<?php echo $loc->getText("biblioSearchDetail"); ?>">
      <img src="../images/book.gif" alt="book" align="bottom" border="0" height="20" width="20"></a>
    </td>
    <td class="primary" colspan="2" valign="top">
      <table class="primary" width="100%">
        <tbody><tr>

          <td class="noborder" valign="top" width="1%"><b><?php echo $loc->getText("biblioSearchTitle"); ?>:</b></td>
          <td class="noborder" colspan="3"><a href="#exam" title="<?php echo $loc->getText("biblioSearchDetail"); ?>">โอเพนซอร์สสำหรับห้องสมุด</a></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><b><?php echo $loc->getText("biblioSearchAuthor"); ?>:</b></td>
          <td class="noborder" colspan="3">ประสิทธิชัย เลิศรัตนเคหกาล</td>
        </tr>

        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchMaterial"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small">หนังสือ</font></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchCollection"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small">ห้องหนังสือทั่วไป</font></td>

        </tr>
        <tr>
          <td class="noborder" nowrap="yes" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchCall"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small">004 ป123อ </font></td>
        </tr>
      </tbody></table>
    </td>
  </tr>

        <tr>
        <td class="primary" nowrap="true"><font class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: 000051          
            <a href="#exam" title="<?php echo $loc->getText("biblioSearchBCode2Chk"); ?>"><?php echo $loc->getText("biblioSearchOutIn"); ?></a> | <a href="#exam" title="<?php echo $loc->getText("biblioSearchBCode2Hold"); ?>"><?php echo $loc->getText("biblioSearchHold"); ?></a>
                  </font></td>
        <td class="primary" nowrap="true"><font class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: ยืมออกได้</font></td>
      </tr>

    
  <tr>
    <td class="primary" rowspan="2" align="center" nowrap="true" valign="top">
      2.<br>
      <a href="#exam" title="<?php echo $loc->getText("biblioSearchDetail"); ?>">
      <img src="../images/book.gif" alt="book" align="bottom" border="0" height="20" width="20"></a>
    </td>
    <td class="primary" colspan="2" valign="top">
      <table class="primary" width="100%">

        <tbody><tr>
          <td class="noborder" valign="top" width="1%"><b><?php echo $loc->getText("biblioSearchTitle"); ?>:</b></td>
          <td class="noborder" colspan="3"><a href="#exam" title="<?php echo $loc->getText("biblioSearchDetail"); ?>">Henry Huggins</a></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><b><?php echo $loc->getText("biblioSearchAuthor"); ?>:</b></td>
          <td class="noborder" colspan="3">Cleary,Beverly</td>

        </tr>
        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchMaterial"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small">book</font></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchCollection"); ?>:</b></font></td>

          <td class="noborder" colspan="3"><font class="small">Juvenile Fiction</font></td>
        </tr>
        <tr>
          <td class="noborder" nowrap="yes" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchCall"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small">JF Cle </font></td>
        </tr>
      </tbody></table>

    </td>
  </tr>
        <tr>
        <td class="primary" nowrap="true"><font class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: 000061          
            <a href="#exam" title="<?php echo $loc->getText("biblioSearchBCode2Chk"); ?>"><?php echo $loc->getText("biblioSearchOutIn"); ?></a> | <a href="#exam" title="<?php echo $loc->getText("biblioSearchBCode2Hold"); ?>"><?php echo $loc->getText("biblioSearchHold"); ?></a>
                  </font></td>
        <td class="primary" nowrap="true"><font class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: ยืมออกได้</font></td>

      </tr>
              <tr>
            <td class="primary" align="center" nowrap="true" valign="top"><font class="small">
              3.
            </font></td>
            <td class="primary" nowrap="true"><font class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: 000062              
                <a href="#exam" title="<?php echo $loc->getText("biblioSearchBCode2Chk"); ?>"><?php echo $loc->getText("biblioSearchOutIn"); ?></a> | <a href="#exam" title="<?php echo $loc->getText("biblioSearchBCode2Hold"); ?>"><?php echo $loc->getText("biblioSearchHold"); ?></a>

                          </font></td>
            <td class="primary" nowrap="true"><font class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: ยืมออกได้</font></td>
          </tr>
                    <tr>
            <td class="primary" align="center" nowrap="true" valign="top"><font class="small">
              4.
            </font></td>
            <td class="primary" nowrap="true"><font class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: 000063              
                <a href="#exam" title="<?php echo $loc->getText("biblioSearchBCode2Chk"); ?>"><?php echo $loc->getText("biblioSearchOutIn"); ?></a> | <a href="#exam" title="<?php echo $loc->getText("biblioSearchBCode2Hold"); ?>"><?php echo $loc->getText("biblioSearchHold"); ?></a>

                          </font></td>
            <td class="primary" nowrap="true"><font class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: ยืมออกได้</font></td>
          </tr>
            </tbody>
</table><br>

<a name="seri">
In the example of Barcode Lookup Search Results above, only the last digit(s) of a bibliographies barcodes 
differ.</a>
This is because they were assigned as 
<a href="../shared/help.php?page=biblioCopyEdit#seri">Copy Serial Numbers integrated in Barcode Numbers</a>
when adding copies.
<br>
This and more on adding copies is explained in Help section for 
<a href="../shared/help.php?page=biblioCopyEdit">Copy New and Edit Pages</a>.
<br><br>
Note that the numbering of Search Results, left column, is independent of the Copy Serial Number integrated 
in the Barcode Number.
