<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Time Log</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php

  if (isset($_GET['date'])) {
    $safeDate = htmlentities($_GET['date']);
    echo "got date";
    addDate(getDb(), $safeDate);
    $result = pg_query(getDb(), "select * from time_log;");
    var_dump($result);
    
    
    
  }



  // if (isset($_GET['activity'])) {
  //   $safeActivity = htmlentities($_GET['activity']);
  //   echo "got activity";
  //   // addDate(getDb(), $safeDate);
    
  // }
  // if (isset($_GET['startTime'])) {
  //   $safeStartTime = htmlentities($_GET['startTime']);
  //   echo "got startTime";
  //   // addDate(getDb(), $safeDate);
    
  // }
  // if (isset($_GET['endTime'])) {
  //   $safeEndTime = htmlentities($_GET['endTime']);
  //   echo "got endTime";
  //   // addDate(getDb(), $safeDate);
    
  // }

  function addDate($db, $date) {
    $stmt = "insert into time_log (date_of_activity) values ("
      . '\'' . $date . '\');';
      // $result = pg_query($db, $stmt);  
      var_dump($stmt);
  }

  function getDb() {
    $db = pg_connect("host=localhost port=5432 dbname=timelog user=timelog password=timelog");
    return $db;
  }

?>








<div class="container">  

<h1 class="text-center">Time Log</h1>

<div class="row">
  


<form class="form-inline" method="get" action="">
  <label class="sr-only" for="date">Date</label>
  <input type="text" name="date" class="form-control mb-2 mr-sm-2 mb-sm-0" id="date" placeholder="Date">

  <label class="sr-only" for="activity">Activity</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <input type="text" name="activity" class="form-control" id="activity" placeholder="Activity Name">
  </div>

 <label class="sr-only" for="startTime">Start Time</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <input type="text" name="startTime" class="form-control" id="startTime" placeholder="Start Time">
  </div>

  <label class="sr-only" for="endTime">End Time</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <input type="text" name="endTime" class="form-control" id="endTime" placeholder="End Time">
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>



</div> 
</body>
</html>