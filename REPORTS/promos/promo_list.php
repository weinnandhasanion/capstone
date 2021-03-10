<?php 
require "./../connect.php";
session_start();

$promo_status = $_POST["status"];
$promo_type = $_POST["type"];
$timespan = $_POST["timespan_promos_list"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_promos_list"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_promos_list"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}
//--SEASONAL
if($promo_status == "Active" AND $promo_type == "Seasonal"){
$reportTitle = "List of Active seasonal Promos";
  if($timespan == "Custom") {
    $reportText = "Generating reports for active seasonal promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$fromDate' 
            AND date_added <= '$toDate'
            AND promo_type = 'Seasonal'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for active seasonal  promo list  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM promo
            WHERE date_added = '$today'
            AND promo_type = 'Seasonal'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for active seasonal  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$lastWeek'
            AND date_added <= '$today'
            AND promo_type = 'Seasonal'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for active seasonal  promo list  this month of ".date("F")."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$monthStart'
            AND date_added <= '$monthEnd'
            AND promo_type = 'Seasonal'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for active seasonal  promo list this year (".date("Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$yearStart'
            AND date_added <= '$yearEnd'
            AND promo_type = 'Seasonal'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for active seasonal  promo list  since all of time...";
    $sql = "SELECT * FROM promo WHERE   status = 'Active' AND promo_type = 'Seasonal'";
    $res = mysqli_query($conn, $sql);
  }
}else if($promo_status == "Expired" AND $promo_type == "Seasonal"){
  $reportTitle = "List of Expired Promos";
    if($timespan == "Custom") {
        $reportText = "Generating reports for Expired seasonal promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND promo_type = 'Seasonal'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Expired seasonal  promo list  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today'
                AND promo_type = 'Seasonal'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Expired seasonal  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND promo_type = 'Seasonal'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Expired seasonal  promo list  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND promo_type = 'Seasonal'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Expired seasonal  promo list this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND promo_type = 'Seasonal'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Expired seasonal  promo list  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Expired' AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      }
}else if($promo_status == "Deleted" AND $promo_type == "Seasonal"){
  $reportTitle = "List of Deleted Promos";
    if($timespan == "Custom") {
        $reportText = "Generating reports for Deleted seasonal promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND promo_type = 'Seasonal'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Deleted  seasonal promo list  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today'
                AND promo_type = 'Seasonal'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Deleted seasonal promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND promo_type = 'Seasonal'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Deleted seasonal promo list  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND promo_type = 'Seasonal'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Deleted seasonal promo list this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND promo_type = 'Seasonal'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Deleted seasonal promo list  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Deleted' AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      }
}
//---- PERMANENT
else if($promo_status == "Active" AND $promo_type == "Permanent"){
$reportTitle = "List of Active  Permanent Promos";
  if($timespan == "Custom") {
    $reportText = "Generating reports for active Permanent promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$fromDate' 
            AND date_added <= '$toDate'
            AND promo_type = 'Permanent'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for active Permanent  promo list  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM promo
            WHERE date_added = '$today'
            AND promo_type = 'Permanent'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for active Permanent  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$lastWeek'
            AND date_added <= '$today'
            AND promo_type = 'Permanent'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for active Permanent  promo list  this month of ".date("F")."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$monthStart'
            AND date_added <= '$monthEnd'
            AND promo_type = 'Permanent'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for active Permanent  promo list this year (".date("Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$yearStart'
            AND date_added <= '$yearEnd'
            AND promo_type = 'Permanent'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for active Permanent  promo list  since all of time...";
    $sql = "SELECT * FROM promo WHERE   status = 'Active' AND promo_type = 'Permanent'";
    $res = mysqli_query($conn, $sql);
  }
}else if($promo_status == "Expired" AND $promo_type == "Permanent"){
  $reportTitle = "List of Expired Promos";
    if($timespan == "Custom") {
        $reportText = "Generating reports for Expired Permanent promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND promo_type = 'Permanent'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Expired Permanent  promo list  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today'
                AND promo_type = 'Permanent'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Expired Permanent  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND promo_type = 'Permanent'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Expired Permanent  promo list  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND promo_type = 'Permanent'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Expired Permanent  promo list this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND promo_type = 'Permanent'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Expired Permanent  promo list  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Expired' AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      }
}else if($promo_status == "Deleted" AND $promo_type == "Permanent"){
  $reportTitle = "List of Deleted Promos";
    if($timespan == "Custom") {
        $reportText = "Generating reports for Deleted Permanent promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND promo_type = 'Permanent'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Deleted  Permanent promo list  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today'
                AND promo_type = 'Permanent'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Deleted Permanent promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND promo_type = 'Permanent'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Deleted Permanent promo list  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND promo_type = 'Permanent'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Deleted Permanent promo list this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND promo_type = 'Permanent'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Deleted Permanent promo list  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Deleted' AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      }
}
//---- BOTH SEASONAL AND PERMANENT
else if($promo_status == "Active" AND $promo_type == "Both"){
  $reportTitle = "List of Active both permanent and seasonal Promos";
    if($timespan == "Custom") {
      $reportText = "Generating reports for active  both permanent and seasonal promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
      $sql = "SELECT * FROM promo
              WHERE date_added >= '$fromDate' 
              AND date_added <= '$toDate'
              AND status = 'Active'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "Today") {
      $reportText = "Generating reports for active  both permanent and seasonal  promo list  today, ".date("F d, Y")."...";
      $today = date("Y-m-d");
      $sql = "SELECT * FROM promo
              WHERE date_added = '$today'
              AND promo_type = 'Permanent'
              AND status = 'Active'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This week") {
      $today = date("Y-m-d");
      $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
      $reportText = "Generating reports for active  both permanent and seasonal  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
      $sql = "SELECT * FROM promo
              WHERE date_added >= '$lastWeek'
              AND date_added <= '$today'
              AND status = 'Active'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This month") {
      $monthStart = date("Y-m-01");
      $monthEnd = date("Y-m-t");
      $reportText = "Generating reports for active  both permanent and seasonal  promo list  this month of ".date("F")."...";
      $sql = "SELECT * FROM promo
              WHERE date_added >= '$monthStart'
              AND date_added <= '$monthEnd'
              AND status = 'Active'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This year") {
      $yearStart = date("Y-01-01");
      $yearEnd = date("Y-12-31");
      $reportText = "Generating reports for active both permanent and seasonal  promo list this year (".date("Y").")...";
      $sql = "SELECT * FROM promo
              WHERE date_added >= '$yearStart'
              AND date_added <= '$yearEnd'
              AND status = 'Active'";
      $res = mysqli_query($conn, $sql);
    } else {
      $reportText = "Generating reports for active  both permanent and seasonal  promo list  since all of time...";
      $sql = "SELECT * FROM promo WHERE   status = 'Active'";
      $res = mysqli_query($conn, $sql);
    }
  }else if($promo_status == "Expired" AND $promo_type == "Both"){
    $reportTitle = "List of Expired Promos";
      if($timespan == "Custom") {
          $reportText = "Generating reports for Expired  both permanent and seasonal promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
          $sql = "SELECT * FROM promo
                  WHERE date_added >= '$fromDate' 
                  AND date_added <= '$toDate'
                  AND status = 'Expired'";
          $res = mysqli_query($conn, $sql);
        } else if($timespan == "Today") {
          $reportText = "Generating reports for Expired  both permanent and seasonal  promo list  today, ".date("F d, Y")."...";
          $today = date("Y-m-d");
          $sql = "SELECT * FROM promo
                  WHERE date_added = '$today'
                  AND status = 'Expired'";
          $res = mysqli_query($conn, $sql);
        } else if($timespan == "This week") {
          $today = date("Y-m-d");
          $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
          $reportText = "Generating reports for Expired  both permanent and seasonal  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
          $sql = "SELECT * FROM promo
                  WHERE date_added >= '$lastWeek'
                  AND date_added <= '$today'
                  AND status = 'Expired'";
          $res = mysqli_query($conn, $sql);
        } else if($timespan == "This month") {
          $monthStart = date("Y-m-01");
          $monthEnd = date("Y-m-t");
          $reportText = "Generating reports for Expired  both permanent and seasonal  promo list  this month of ".date("F")."...";
          $sql = "SELECT * FROM promo
                  WHERE date_added >= '$monthStart'
                  AND date_added <= '$monthEnd'
                  AND status = 'Expired'";
          $res = mysqli_query($conn, $sql);
        } else if($timespan == "This year") {
          $yearStart = date("Y-01-01");
          $yearEnd = date("Y-12-31");
          $reportText = "Generating reports for Expired  both permanent and seasonal  promo list this year (".date("Y").")...";
          $sql = "SELECT * FROM promo
                  WHERE date_added >= '$yearStart'
                  AND date_added <= '$yearEnd'
                  AND status = 'Expired'";
          $res = mysqli_query($conn, $sql);
        } else {
          $reportText = "Generating reports for Expired  both permanent and seasonal  promo list  since all of time...";
          $sql = "SELECT * FROM promo WHERE   status = 'Expired'";
          $res = mysqli_query($conn, $sql);
        }
  }else if($promo_status == "Deleted" AND $promo_type == "Both"){
    $reportTitle = "List of Deleted Promos";
      if($timespan == "Custom") {
          $reportText = "Generating reports for Deleted  both permanent and seasonal promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
          $sql = "SELECT * FROM promo
                  WHERE date_added >= '$fromDate' 
                  AND date_added <= '$toDate'
                  AND status = 'Deleted'";
          $res = mysqli_query($conn, $sql);
        } else if($timespan == "Today") {
          $reportText = "Generating reports for Deleted   both permanent and seasonal promo list  today, ".date("F d, Y")."...";
          $today = date("Y-m-d");
          $sql = "SELECT * FROM promo
                  WHERE date_added = '$today'
                  AND status = 'Deleted'";
          $res = mysqli_query($conn, $sql);
        } else if($timespan == "This week") {
          $today = date("Y-m-d");
          $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
          $reportText = "Generating reports for Deleted  both permanent and seasonal promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
          $sql = "SELECT * FROM promo
                  WHERE date_added >= '$lastWeek'
                  AND date_added <= '$today'
                  AND status = 'Deleted'";
          $res = mysqli_query($conn, $sql);
        } else if($timespan == "This month") {
          $monthStart = date("Y-m-01");
          $monthEnd = date("Y-m-t");
          $reportText = "Generating reports for Deleted  both permanent and seasonal promo list  this month of ".date("F")."...";
          $sql = "SELECT * FROM promo
                  WHERE date_added >= '$monthStart'
                  AND date_added <= '$monthEnd'
                  AND status = 'Deleted'";
          $res = mysqli_query($conn, $sql);
        } else if($timespan == "This year") {
          $yearStart = date("Y-01-01");
          $yearEnd = date("Y-12-31");
          $reportText = "Generating reports for Deleted  both permanent and seasonal promo list this year (".date("Y").")...";
          $sql = "SELECT * FROM promo
                  WHERE date_added >= '$yearStart'
                  AND date_added <= '$yearEnd'
                  AND status = 'Deleted'";
          $res = mysqli_query($conn, $sql);
        } else {
          $reportText = "Generating reports for Deleted  both permanent and seasonal promo list  since all of time...";
          $sql = "SELECT * FROM promo WHERE   status = 'Deleted'";
          $res = mysqli_query($conn, $sql);
        }
  }
  

if($_POST["status"] == "Active" || $_POST["status"] == "Expired"){
  $data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
      $row["promo_starting_date"] = date("M d, Y", strtotime($row["promo_starting_date"]));
      $row["promo_ending_date"] = date("M d, Y", strtotime($row["promo_ending_date"]));
      $row["date_deleted"] = date("M d, Y", strtotime($row["date_deleted"]));
      $data[] = $row;
    }
  }

  $labels = array("Promo ID", "Promo Name", "Promo Type", "Starting Date","Ending Date","Amount");
  $rowLabels = array("promo_id", "promo_name", "promo_type", "promo_starting_date","promo_ending_date","amount");

  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'reportTitle' => $reportTitle,
    'fileName' => "ReportPromoList_".date("MdY")
  ];

}else if($_POST["status"] == "Deleted"){

  $data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
      $row["promo_starting_date"] = date("M d, Y", strtotime($row["promo_starting_date"]));
      $row["promo_ending_date"] = date("M d, Y", strtotime($row["promo_ending_date"]));
      $row["date_deleted"] = date("M d, Y", strtotime($row["date_deleted"]));
      $data[] = $row;
    }
  }
  
  $labels = array("Promo ID", "Promo Name", "Promo Type", "Starting Date","Ending Date","Amount","Date Deleted");
  $rowLabels = array("promo_id", "promo_name", "promo_type", "promo_starting_date","promo_ending_date","amount","date_deleted");
  
  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'reportTitle' => $reportTitle,
    'fileName' => "ReportPromoList_".date("MdY")
  ];

}

$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;

?>
