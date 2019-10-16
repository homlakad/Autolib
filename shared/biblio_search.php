<?php

error_reporting(0);
ini_set('display_errors', 0);


function lev($s,$t) {

  $m = mb_strlen($s, 'utf-8');
  $n = mb_strlen($t, 'utf-8');

  
  for($i=0;$i<=$m;$i++) $d[$i][0] = $i;
  for($j=0;$j<=$n;$j++) $d[0][$j] = $j;
  
  for($i=1;$i<=$m;$i++) {
      for($j=1;$j<=$n;$j++) {
          $c = ($s[$i-1] == $t[$j-1])?0:1;
          $d[$i][$j] = min($d[$i-1][$j]+1,$d[$i][$j-1]+1,$d[$i-1][$j-1]+$c);
      }
  }

  return $d[$m][$n];
}



$hostname_openbb = "localhost";
$database_openbb = "openbiblio";
$username_openbb = "root";
$password_openbb = "";
$openbb = mysql_pconnect($hostname_openbb, $username_openbb, $password_openbb) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db($database_openbb, $openbb);

$TextCompare = $_POST["searchText"] ;
$query_housland= "SELECT title,bibid FROM biblio  ";  
$housland = mysql_query($query_housland, $openbb) or die(mysql_error());

// $strKeyword=null;
// if(isset($_POST["txtKeyword"])) {
//          $strKeyword=$_POST["txtKeyword"]; 
// $query_housland= "SELECT * FROM housland WHERE hlname LIKE '%".$strKeyword."%' ";  
// }else{
//     $query_housland= "SELECT * FROM housland " ;
// }
// $housland = mysql_query($query_housland, $landandhouse) or die(mysql_error());
                   
$textkeyfail = "ยังไม่มีรายการหนังสือแนะนำที่คล้ายคลึง" ;

?>

<!-- <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</head> -->

<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  session_cache_limiter(null);

  #****************************************************************************
  #*  Checking for post vars.  Go back to form if none found.
  #****************************************************************************
  if (count($_POST) == 0 && empty($_GET['tag'])) {
    header("Location: ../catalog/index.php");
    exit();
  }

  #****************************************************************************
  #*  Checking for tab name to show OPAC look and feel if searching from OPAC
  #****************************************************************************
  $tab = "cataloging";
  $helpPage = "biblioSearch";
  $lookup = "N";
  if (isset($_POST["tab"])) {
    $tab = $_POST["tab"];
  }
  if (isset($_POST["lookup"])) {
    $lookup = $_POST["lookup"];
    if ($lookup == 'Y') {
      $helpPage = "opacLookup";
    }
  }

  $nav = "search";
  if ($tab != "opac") {
    require_once("../shared/logincheck.php");
  }
  require_once("../classes/BiblioSearch.php");
  require_once("../classes/BiblioSearchQuery.php");
  require_once("../classes/BiblioFieldQuery.php");
  require_once("../functions/searchFuncs.php");
  require_once("../classes/DmQuery.php");

  #****************************************************************************
  #*  Function declaration only used on this page.
  #****************************************************************************
  function printResultPages(&$loc, $currPage, $pageCount, $sort) {
    if ($pageCount <= 1) {
      return false;
    }
    echo $loc->getText("biblioSearchResultPages").": ";
    $maxPg = OBIB_SEARCH_MAXPAGES;
    if ($maxPg % 2 == 0) $maxPg++;
    $borderPg = ($maxPg - 1) / 2;
    
    if ($maxPg > $pageCount) {
      $startPg = 1;
      $endPg = $pageCount;
    }
    else {
      if ($currPage - $borderPg < 1) {
        $startPg = 1;
        $endPg = $maxPg;
      }
      elseif ($currPage + $borderPg > $pageCount) {
        $endPg = $pageCount;
        $startPg = $endPg - $maxPg + 1;
      }
      else {
        $startPg = $currPage - $borderPg;
        $endPg = $currPage + $borderPg;
      }
    }

    if ($currPage > 1) {
      echo "<a href=\"javascript:changePage(1,'".H(addslashes($sort))."')\">&laquo;".$loc->getText("biblioSearchFirst")."</a> ";
      echo "<a href=\"javascript:changePage(".H(addslashes($currPage-1)).",'".H(addslashes($sort))."')\">&lsaquo;".$loc->getText("biblioSearchPrev")."</a> ";
    }
    for ($i = $startPg; $i <= $endPg; $i++) {
      if ($i == $currPage) {
        echo "<b>".H($i)."</b> ";
      } else {
        echo "<a href=\"javascript:changePage(".H(addslashes($i)).",'".H(addslashes($sort))."')\">".H($i)."</a> ";
      }
    }
    if ($currPage < $pageCount) {
      echo "<a href=\"javascript:changePage(".($currPage+1).",'".$sort."')\">".$loc->getText("biblioSearchNext")."&rsaquo;</a> ";
      echo "<a href=\"javascript:changePage(".$pageCount.",'".$sort."')\">".$loc->getText("biblioSearchLast")."&raquo;</a> ";
    }
  }

  #****************************************************************************
  #*  Loading a few domain tables into associative arrays
  #****************************************************************************
  $dmQ = new DmQuery();
  $dmQ->connect();
  $collectionDm = $dmQ->getAssoc("collection_dm");
  $materialTypeDm = $dmQ->getAssoc("material_type_dm");
  $materialImageFiles = $dmQ->getAssoc("material_type_dm", "image_file");
  $biblioStatusDm = $dmQ->getAssoc("biblio_status_dm");
  $dmQ->close();

  #****************************************************************************
  #*  Retrieving post vars and scrubbing the data
  #****************************************************************************
  if (isset($_POST["page"])) {
    $currentPageNmbr = $_POST["page"];
  } else {
    $currentPageNmbr = 1;
  }
  
  if (!empty($_POST['searchType'])) {
    $searchType = $_POST["searchType"];
    $sortBy = $_POST["sortBy"];
    if ($sortBy == "default") {
      if ($searchType == "author") {
        $sortBy = "author";
      } else {
        $sortBy = "title";
      }
    }
    // echo "sdadasdsasad".$_POST["searchText"];
    $searchText = trim($_POST["searchText"]);
    # remove redundant whitespace
    $searchText = preg_replace("/[[:space:]]+/i", " ", $searchText);
    if ($searchType == "barcodeNmbr") {
      $sType = OBIB_SEARCH_BARCODE;
      $words[] = $searchText;
    } else {
      $words = explodeQuoted($searchText);
      if ($searchType == "author") {
        $sType = OBIB_SEARCH_AUTHOR;
      } elseif ($searchType == "subject") {
        $sType = OBIB_SEARCH_SUBJECT;
      } elseif ($searchType == "isbn") {
        $sType = OBIB_SEARCH_ISBN;
      } elseif ($searchType == "advanced") {
        $sType = OBIB_ADVANCED_SEARCH;
        $words = $_POST;
      } else {
        $sType = OBIB_SEARCH_TITLE;
      }
    }
  }
  else if (isset($_GET['tag'])) {
    $sortBy = 'title';
    $words = $_GET['words'];
    if (empty($words)) {
      $words = '';
    }
  }

  #****************************************************************************
  #*  Search database
  #****************************************************************************
  $biblioQ = new BiblioSearchQuery();
  $biblioQ->setItemsPerPage(OBIB_ITEMS_PER_PAGE);
  $biblioQ->connect();
  if ($biblioQ->errorOccurred()) {
    $biblioQ->close();
    displayErrorPage($biblioQ);
  }
  # checking to see if we are in the opac search or logged in
  if ($tab == "opac") {
    $opacFlg = true;
  } else {
    $opacFlg = false;
  }
  if (!empty($searchType)) {
    if (!$biblioQ->search($sType, $words, $currentPageNmbr, $sortBy, $opacFlg)) {
      $biblioQ->close();
      displayErrorPage($biblioQ);
    }
  }
  else if (isset($_GET['tag'])) {
    if (!$biblioQ->searchTag($_GET['tag'], $words, $currentPageNmbr, $opacFlg)) {
      $biblioQ->close();
      displayErrorPage($biblioQ);
    }
  }
  else {
    exit();
  }

  #**************************************************************************
  #*  Show search results
  #**************************************************************************
  if ($tab == "opac") {
    require_once("../shared/header_opac.php");
  } else {
    require_once("../shared/header.php");
  }
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,"shared");

  # Display no results message if no results returned from search.
  if ($biblioQ->getRowCount() == 0) {
    $biblioQ->close();
    echo $loc->getText("biblioSearchNoResults");
    require_once("../shared/footer.php");
    exit();
  }
?>

<!--**************************************************************************
    *  Javascript to post back to this page
    ************************************************************************** -->
<script language="JavaScript" type="text/javascript">
  <!--
  function changePage(page, sort) {
    document.changePageForm.page.value = page;
    document.changePageForm.sortBy.value = sort;
    document.changePageForm.submit();
  }
  -->
</script>


<!--**************************************************************************
    *  Form used by javascript to post back to this page
    ************************************************************************** -->
<form name="changePageForm" method="POST"
  action="../shared/biblio_search.php<?php echo isset($_GET['tag']) ? '?tag=' . $_GET['tag'] . '&words=' . $_GET['words'] : ''?>">
  <input type="hidden" name="searchType" value="<?php echo H($_POST["searchType"]);?>">
  <input type="hidden" name="searchText" value="<?php echo H($_POST["searchText"]);?>">
  <input type="hidden" name="sortBy" value="<?php echo H($_POST["sortBy"]);?>">
  <input type="hidden" name="lookup" value="<?php echo H($lookup);?>">
  <input type="hidden" name="page" value="1">
  <input type="hidden" name="tab" value="<?php echo H($tab);?>">
</form>

<!--**************************************************************************
    *  Printing result stats and page nav
    ************************************************************************** -->
<?php 
  echo $loc->getText("biblioSearchResultTxt", array("items" => $biblioQ->getRowCount()));
  /*if ($biblioQ->getRowCount() > 1) {
    echo $loc->getText("biblioSearch".$sortBy);
    if ($sortBy == "author") {
      echo "(<a href=\"javascript:changePage(".$currentPageNmbr.",'title')\">".$loc->getText("biblioSearchSortByTitle")."</a>).";
    } else {
      echo "(<a href=\"javascript:changePage(".$currentPageNmbr.",'author')\">".$loc->getText("biblioSearchSortByAuthor")."</a>).";
    }
  }*/
?>
<br />
<?php printResultPages($loc, $currentPageNmbr, $biblioQ->getPageCount(), $sortBy); ?><br>
<br>

<!--**************************************************************************
    *  Printing result table
    ************************************************************************** -->
<table class="primary">
  <tr>
    <th valign="top" nowrap="yes" align="left" colspan="4">
      <?php echo $loc->getText("biblioSearchResults"); ?>:
    </th>
  </tr>
  <?php
    // Show bibliographies
    while ($biblio = $biblioQ->fetchRow()) { // START WHILE 1
  ?>
  <tr>
    <td nowrap="true" class="primary" valign="top" align="center">
      <?php echo H($biblioQ->getCurrentRowNmbr());?>.<br />
      <a
        href="../shared/biblio_view.php?bibid=<?php echo HURL($biblio->getBibid());?>&amp;tab=<?php echo HURL($tab);?>">
        <img src="../images/<?php echo HURL($materialImageFiles[$biblio->getMaterialCd()]);?>" width="20" height="20"
          border="0" align="bottom" alt="<?php echo H($materialTypeDm[$biblio->getMaterialCd()]);?>"></a>
    </td>
    <td nowrap="true" class="primary picture" valign="top" align="center">
      <?php
      $bfq = new BiblioFieldQuery();
      $bfq->execSelect($biblio->getBibid(), '902a');
      $flds = $bfq->fetchField();
      
      if ($flds->_fieldData):
        $filepath = '../' . COVER_PATH . '/'. $flds->_fieldData;
        $title = H($biblio->getTitle());
        if ($thumbpath = make_thumbnail($filepath, array('height' => 160))): 
      ?>
      <a href="<?php echo $filepath ?>" title="<?php echo $title ?>" target="_blank"><img src="<?php echo $thumbpath ?>"
          border="0" title="<?php echo $title ?>" alt="<?php echo $title ?>" style="padding: 3px;" /></a>
      <?php 
        endif;
      endif; ?>
    </td>
    <td class="primary" valign="top" colspan="2">
      <table class="primary" width="100%">
        <tr>
          <td class="noborder" width="1%" valign="top"><b><?php echo $loc->getText("biblioSearchTitle"); ?>:</b></td>
          <td class="noborder" colspan="3"><a
              href="../shared/biblio_view.php?bibid=<?php echo HURL($biblio->getBibid());?>&amp;tab=<?php echo HURL($tab);?>"><?php echo H($biblio->getTitle());?></a>
          </td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><b><?php echo $loc->getText("biblioSearchAuthor"); ?>:</b></td>
          <td class="noborder" colspan="3"><?php 
          if ($biblio->getAuthor() != "") {
            $val = H($biblio->getAuthor());
            echo '<a href="../shared/biblio_search.php?tag=100a&words=' . $val . '">' . $val . '</a>';
          }
          ?></td>
        </tr>
        <tr>
          <td class="noborder" valign="top">
            <font class="small"><b><?php echo $loc->getText("biblioSearchMaterial"); ?>:</b></font>
          </td>
          <td class="noborder" colspan="3">
            <font class="small"><?php echo H($materialTypeDm[$biblio->getMaterialCd()]);?></font>
          </td>
        </tr>
        <tr>
          <td class="noborder" valign="top">
            <font class="small"><b><?php echo $loc->getText("biblioSearchCollection"); ?>:</b></font>
          </td>
          <td class="noborder" colspan="3">
            <font class="small"><?php echo H($collectionDm[$biblio->getCollectionCd()]);?></font>
          </td>
        </tr>
        <tr>
          <td class="noborder" valign="top" nowrap="yes">
            <font class="small"><b><?php echo $loc->getText("biblioSearchCall"); ?>:</b></font>
          </td>
          <td class="noborder" colspan="3">
            <font class="small">
              <?php echo H($biblio->getCallNmbr1()." ".$biblio->getCallNmbr2()." ".$biblio->getCallNmbr3());?></font>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <?php
    // Show bibliography copies
    require_once('../classes/BiblioCopyQuery.php');
    $copyQ = new BiblioCopyQuery();
    $copyQ->connect();
    if ($copyQ->errorOccurred()) {
      $copyQ->close();
      displayErrorPage($copyQ);
    }
    if (!$copy = $copyQ->execSelect($biblio->getBibid())) {
      $copyQ->close();
      displayErrorPage($copyQ);
    }

    if ($copyQ->getRowCount() == 0) { // START IFELSE 2
  ?>
  <tr>
    <td class="primary" colspan="2">&nbsp;</td>
    <td class="primary" colspan="2">
      <font class="small"><?php echo $loc->getText("biblioSearchNoCopies"); ?></font>
    </td>
  </tr>
  <?php
    } else {
      while ($copy = $copyQ->fetchCopy()) { // START WHILE 2
  ?>
  <tr>
    <td class="primary" colspan="2">&nbsp;</td>
    <td class="primary" colspan="2">
      <font class="small">
        <span style="padding:0px 5px;">
          <b><?php echo $loc->getText('biblioSearchCopyBCode'); ?>:</b>
          <?php echo $copy->getBarcodeNmbr(); ?>
        </span>

        <span style="padding:0px 5px;">
          <?php if ($lookup == 'Y') { ?>
          <a
            href="javascript:returnLookup('barcodesearch','barcodeNmbr','<?php echo H(addslashes($copy->getBarcodeNmbr()));?>')"><?php echo $loc->getText("biblioSearchOutIn"); ?></a>
          | <a
            href="javascript:returnLookup('holdForm','holdBarcodeNmbr','<?php echo H(addslashes($copy->getBarcodeNmbr()));?>')"><?php echo $loc->getText("biblioSearchHold"); ?></a>
          <?php } else { ?>
          &nbsp;
          <?php } ?>
        </span>

        <span style="padding:0px 5px;">
          <b><?php echo $loc->getText("biblioSearchCopyStatus"); ?>:</b>
          <?php echo H($biblioStatusDm[$copy->getStatusCd()]); ?>
        </span>
      </font>
    </td>
  </tr>
  <?php
      } // END WHILE 2
    } // END IFELSE 2

    } // END WHILE 1
    $biblioQ->close();
  ?>
</table><br>

<div class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h3 class="text-dark"> รายการหนังสือแนะนำ </h3>
    </div>

    <?php
$counti = 0 ;
while($objResult = mysql_fetch_array($housland))
{
  $TitleCompare =  $objResult["title"] ;
  if($TitleCompare != $TextCompare) {
  $lev =  lev($TextCompare,$TitleCompare, 'utf-8');
  $mm = mb_strlen($TextCompare, 'utf-8');
  $nn = mb_strlen($TitleCompare, 'utf-8');
  $max = max($mm, $nn);
  $result = (1 - $lev / $max) * 100;
  }

?>


    <?php if ($result > 40 ){?>
   <h1> 
      <a target="_blank" href="biblio_view.php?bibid=<?php echo $objResult["bibid"] ;?>&tab=opac">   <h5>  ชื่อหนังสือ :  <?php echo $TitleCompare ; ?> </h5> </a> 
      </h1>
    <?php $counti++; }else{
    
    }
  
  }  if($counti == 0){
    echo "<center> $textkeyfail </center>"; 
  }else{
    echo "";
  }?>





  </div>
</div>
<?php printResultPages($loc, $currentPageNmbr, $biblioQ->getPageCount(), $sortBy); ?><br>
<?php require_once("../shared/footer.php"); ?>