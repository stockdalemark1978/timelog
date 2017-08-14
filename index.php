 <!DOCTYPE html> 
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Time Log</title>
  <script src="https://use.fontawesome.com/00ed1df00a.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
    crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Sarala" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  
</head>

<body>


  <?php
  $statusMessage = [
    'text' => '',
    'style' => 'alert-info'
  ];

        
  
  if (isset($_GET['submit'])) {
  $safeSubmit = htmlentities($_GET['submit']);
  

  if (isset($_GET['date']) && isset($_GET['activity']) && isset($_GET['startTime']) && isset($_GET['endTime'])) {
    $safeDate = htmlentities($_GET['date']);
    $safeActivity = htmlentities($_GET['activity']);
    $safeStartTime= htmlentities($_GET['startTime']);
    $safeEndTime = htmlentities($_GET['endTime']);
    
    switch ($safeSubmit) {
      case 'add_log':
        global $statusMessage;
        if (strlen($safeDate) == 0) {
          $statusMessage['text'] .= "Must have valid date.";
          $statusMessage['style'] = 'alert-danger';
        }
        if (strlen($safeActivity) == 0) {
          $statusMessage['text'] .= "Activity field must have at least one character.";
          $statusMessage['style'] = 'alert-danger';
        }
        if (strlen($safeStartTime) == 0) {
          $statusMessage['text'] .= "Must have valid start date.";
          $statusMessage['style'] = 'alert-danger';
        }
        if (strlen($safeEndTime) == 0) {
          $statusMessage['text'] .= "Must have valid end date.";
          $statusMessage['style'] = 'alert-danger';
        }

    }
    // var_dump("switch ran");
  }


    // echo "got date all stuff";
    addTimeInfo(getDb(), $safeDate, $safeActivity, $safeStartTime, $safeEndTime);
    $result = pg_query(getDb(), "select * from time_log;");
    // var_dump($result);
  }

  if (isset($_GET['deleteButton'])) {
    $safeDelete = htmlentities($_GET['deleteButton']);
    $safeId = htmlentities($_GET['id']);
    deleteEntry($safeId);
  }



  function addTimeInfo($db, $date, $activity, $startTime, $endTime) {
      $stmt = "insert into time_log (date_of_activity, activity, start_time, end_time) values ("
        . '\'' . $date . '\', \'' . $activity . '\', \'' . $startTime . '\', \'' . $endTime . '\');';
        $result = pg_query($db, $stmt);  
    }

  function deleteEntry($id) {
    $stmt = 'DELETE FROM time_log WHERE id=' . $id;
    pg_query(getDb(), $stmt);
    
   }



  function getDb() {
    $db = pg_connect("host=localhost port=5432 dbname=timelog user=timelog password=timelog");
    return $db;
  }

   function getTimeLogs($db) {
    $request = pg_query(getDb(), "SELECT * FROM time_log order by date_of_activity;");
    // $date = 'date_of_activity';
    
    // $date = strtotime($date);
    // $date = date('m-d-Y', $date);
    // var_dump($date);
    
    return pg_fetch_all($request);
    
  }

?>


    <div class="container">
      <br>

      <h1 class="text-center">Time Log</h1>

      <?php 
      if ($statusMessage['text']) {
      ?>

      <div class="alert <?php echo $statusMessage['style']; ?>" role="alert">
        <strong>Warning!</strong> <?=$statusMessage['text'];?>
      </div>

      <?php 
        }
      ?>

      <div class="row">



        <form class="form-inline" method="get" action="" name="timeLogForm" onsubmit="return validateItems();" >
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
          <div class="input-group mb-2 mr-sm-5 mb-sm-0">
            <input type="text" name="endTime" class="form-control" id="endTime" placeholder="End Time">
          </div>

          <button type="submit" name="submit" value="add_log" class="btn btn-primary" onclick="showTable()"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </form>
      </div>



      

      <table class="table table-striped" id="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Activity</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th></th>
          </tr>  
        </thead>
      
        <tbody>
        <?php 
          foreach (getTimeLogs(getDb()) as $log) {
            $date = strtotime($log['date_of_activity']);
            $date = date('m-d-Y', $date);
            // var_dump($date);
           
        ?>
          <tr id="row">
              
            <td><?=$date?></td>
            <td><?=$log['activity'];?></td>
            <td><?=$log['start_time'];?></td>
            <td><?=$log['end_time'];?></td>
            <form method="get" action="">
              
              <td  id="xRow"><input type="hidden" name="id" value="<?=$log['id'];?>"><button class="btn btn-primary" type="submit" name="deleteButton" value="delete"><i class="fa fa-minus" aria-hidden="true"></i></button></td>
            </form>
          </tr>
        <?php
            
        }
        ?>
        </tbody>

      </table>
     
      


    </div>
    <script src="main.js"></script>
</body>

</html>