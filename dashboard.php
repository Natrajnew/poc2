<?php

session_start();

if (isset($_SESSION['data'])) 
{

    $data = $_SESSION['data'];

    $userProfile = $data['_embedded']['user']['profile'];

    $userLogin = $userProfile['login'];
    
    $userFirstName = $userProfile['firstName'];
    
    $userLastName = $userProfile['lastName'];

    $status = $data['status'];

    $token = $data['sessionToken'];

    $userId = $data['_embedded']['user']['id'];

    $_SESSION['data'] = $data;


}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

   </head>
<body>
    <div class="container">
        <div class="main-body">
                <!-- Breadcrumb -->
            <div class="row">&nbsp;</div>
              <!-- Breadcrumb -->
              <nav aria-label="breadcrumb" class="main-breadcrumb">
               <img src="boh.png" /> <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
              </nav>
              <!-- /Breadcrumb -->
        
              <div class="row gutters-sm">
                <div class="col-md-10">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?php echo $userFirstName.' '.$userLastName; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?php echo $userLogin; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Token</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?php echo $token; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Status</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?php echo $status; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-12">
                          <form action="logout.php" method="post">
                                <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                                <button class="btn btn-info " type="submit">Logout</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>    
    
                </div>
              </div>
    
            </div>
        </div>
</body>
</html>