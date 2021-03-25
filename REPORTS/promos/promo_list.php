<?php 
require "./../../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

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
}else if($promo_status == "all" AND $promo_type == "Seasonal"){
      $reportTitle = "List of All Seasonal Promos";
        if($timespan == "Custom") {
            $reportText = "Generating reports for All seasonal promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
            $sql = "SELECT * FROM promo
                    WHERE date_added >= '$fromDate' 
                    AND date_added <= '$toDate'
                    AND promo_type = 'Seasonal'";
            $res = mysqli_query($conn, $sql);
          } else if($timespan == "Today") {
            $reportText = "Generating reports for All seasonal  promo list  today, ".date("F d, Y")."...";
            $today = date("Y-m-d");
            $sql = "SELECT * FROM promo
                    WHERE date_added = '$today'
                    AND promo_type = 'Seasonal'";
            $res = mysqli_query($conn, $sql);
          } else if($timespan == "This week") {
            $today = date("Y-m-d");
            $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
            $reportText = "Generating reports for All seasonal  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
            $sql = "SELECT * FROM promo
                    WHERE date_added >= '$lastWeek'
                    AND date_added <= '$today'
                    AND promo_type = 'Seasonal'";
            $res = mysqli_query($conn, $sql);
          } else if($timespan == "This month") {
            $monthStart = date("Y-m-01");
            $monthEnd = date("Y-m-t");
            $reportText = "Generating reports for All seasonal  promo list  this month of ".date("F")."...";
            $sql = "SELECT * FROM promo
                    WHERE date_added >= '$monthStart'
                    AND date_added <= '$monthEnd'
                    AND promo_type = 'Seasonal'";
            $res = mysqli_query($conn, $sql);
          } else if($timespan == "This year") {
            $yearStart = date("Y-01-01");
            $yearEnd = date("Y-12-31");
            $reportText = "Generating reports for All seasonal  promo list this year (".date("Y").")...";
            $sql = "SELECT * FROM promo
                    WHERE date_added >= '$yearStart'
                    AND date_added <= '$yearEnd'
                    AND promo_type = 'Seasonal'";
            $res = mysqli_query($conn, $sql);
          } else {
            $reportText = "Generating reports for All seasonal  promo list  since all of time...";
            $sql = "SELECT * FROM promo WHERE  promo_type = 'Seasonal'";
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
}else if($promo_status == "all" AND $promo_type == "Permanent"){
      $reportTitle = "List of all Permanent Promos";
        if($timespan == "Custom") {
            $reportText = "Generating reports for all Permanent promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
            $sql = "SELECT * FROM promo
                    WHERE date_added >= '$fromDate' 
                    AND date_added <= '$toDate'
                    AND promo_type = 'Permanent'";
            $res = mysqli_query($conn, $sql);
          } else if($timespan == "Today") {
            $reportText = "Generating reports for all Permanent  promo list  today, ".date("F d, Y")."...";
            $today = date("Y-m-d");
            $sql = "SELECT * FROM promo
                    WHERE date_added = '$today'
                    AND promo_type = 'Permanent'";
            $res = mysqli_query($conn, $sql);
          } else if($timespan == "This week") {
            $today = date("Y-m-d");
            $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
            $reportText = "Generating reports for all Permanent  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
            $sql = "SELECT * FROM promo
                    WHERE date_added >= '$lastWeek'
                    AND date_added <= '$today'
                    AND promo_type = 'Permanent'";
            $res = mysqli_query($conn, $sql);
          } else if($timespan == "This month") {
            $monthStart = date("Y-m-01");
            $monthEnd = date("Y-m-t");
            $reportText = "Generating reports for all Permanent  promo list  this month of ".date("F")."...";
            $sql = "SELECT * FROM promo
                    WHERE date_added >= '$monthStart'
                    AND date_added <= '$monthEnd'
                    AND promo_type = 'Permanent'";
            $res = mysqli_query($conn, $sql);
          } else if($timespan == "This year") {
            $yearStart = date("Y-01-01");
            $yearEnd = date("Y-12-31");
            $reportText = "Generating reports for all Permanent  promo list this year (".date("Y").")...";
            $sql = "SELECT * FROM promo
                    WHERE date_added >= '$yearStart'
                    AND date_added <= '$yearEnd'
                    AND promo_type = 'Permanent'";
            $res = mysqli_query($conn, $sql);
          } else {
            $reportText = "Generating reports for all Permanent  promo list  since all of time...";
            $sql = "SELECT * FROM promo WHERE  promo_type = 'Permanent'";
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
}else if($promo_status == "all" AND $promo_type == "Both"){
        $reportTitle = "List of all both Promos";
          if($timespan == "Custom") {
              $reportText = "Generating reports for all  both permanent and seasonal promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
              $sql = "SELECT * FROM promo
                      WHERE date_added >= '$fromDate' 
                      AND date_added <= '$toDate'";
              $res = mysqli_query($conn, $sql);
            } else if($timespan == "Today") {
              $reportText = "Generating reports for all  both permanent and seasonal  promo list  today, ".date("F d, Y")."...";
              $today = date("Y-m-d");
              $sql = "SELECT * FROM promo
                      WHERE date_added = '$today'";
              $res = mysqli_query($conn, $sql);
            } else if($timespan == "This week") {
              $today = date("Y-m-d");
              $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
              $reportText = "Generating reports for all  both permanent and seasonal  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
              $sql = "SELECT * FROM promo
                      WHERE date_added >= '$lastWeek'
                      AND date_added <= '$today'";
              $res = mysqli_query($conn, $sql);
            } else if($timespan == "This month") {
              $monthStart = date("Y-m-01");
              $monthEnd = date("Y-m-t");
              $reportText = "Generating reports for all  both permanent and seasonal  promo list  this month of ".date("F")."...";
              $sql = "SELECT * FROM promo
                      WHERE date_added >= '$monthStart'
                      AND date_added <= '$monthEnd'";
              $res = mysqli_query($conn, $sql);
            } else if($timespan == "This year") {
              $yearStart = date("Y-01-01");
              $yearEnd = date("Y-12-31");
              $reportText = "Generating reports for all  both permanent and seasonal  promo list this year (".date("Y").")...";
              $sql = "SELECT * FROM promo
                      WHERE date_added >= '$yearStart'
                      AND date_added <= '$yearEnd'";
              $res = mysqli_query($conn, $sql);
            } else {
              $reportText = "Generating reports for all  both permanent and seasonal  promo list  since all of time...";
              $sql = "SELECT * FROM promo ";
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
    'timespan' => $timespan,
    'fileName' => "ReportPromoList_".date("MdY")
  ];
}else if($_POST["status"] == "all"){
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
  
    $labels = array("Promo ID", "Promo Name", "Promo Type", "Starting Date","Ending Date","Amount","Status");
    $rowLabels = array("promo_id", "promo_name", "promo_type", "promo_starting_date","promo_ending_date","amount","status");
  
    $object = (object) [
      'data' => $data,
      'rowLabels' => $rowLabels,
      'labels' => $labels,
      'toDate' => $toDate,
      'fromDate' => $fromDate,
      'reportTitle' => $reportTitle,
      'timespan' => $timespan,
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
?>

<?php
//--------------------------LOGTRAIL DOING
    //this is for puting login_id in the array
    $data_logtrail = array();
    $login_id;
    $log = "SELECT * FROM logtrail ORDER BY login_id DESC";
    $logtrail = mysqli_query($conn, $log);
    if($logtrail) {
        while($rowrow = mysqli_fetch_assoc($logtrail)) {
            $data_logtrail[] = $rowrow["login_id"];
        }

        $login_id = $data_logtrail[0];
    }

 
// INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
$sql0 = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
$query_run = mysqli_query($conn, $sql0);
$rows1 = mysqli_fetch_assoc($query_run);

$last_name = $rows1["last_name"];
$admin_id = $rows1["admin_id"];

$description = "Generated a report for list of promos";
$identity = "Reports";
$timeNow = date("h:i A");
$user_fname = "list of promos";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>

