<?php 

    include 'check_con.php';

    session_start();

    if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    $user_orgid = $_SESSION['user_orgid'];
    $user_uid = $_SESSION['user_uid'];
    } else {
        header('location:login');
    }

    $sql = 'SELECT * FROM arlab WHERE organization_id	="'.$user_orgid.'" AND user_id	="'.$user_uid.'" ORDER BY id DESC ';

    $result = mysqli_query($conn, $sql);

    $lengths = 0;

?>


<?php 

    include './support/navbar.php';

?>

    <div class="container pt-5">
        <div class="row">

            <div class="col-md-4 display-2 mt-4">
                TOTAL : <span id="total"></span>
            </div>

            <div class="col-md-4 offset-md-4 text-center mt-4">
                <input type="button" class="btn btn-outline-primary " value="ADD NEW MODEL" />
            </div>
            
            <?php if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {

                              $id = $row['id'];
                              $title = $row['title'];
                              $subtitle = $row['subtitle'];
                              $contact = $row['modal'];
                              $user_id = $row['user_id'];
                              $orgid = $row['organization_id'];
                              $lengths++;

                              if($orgid != $user_orgid){
                                if($id != $user_uid){

                                  ?>
                                      <script>
                                        alert('Access Denied!!!');
                                        window.location = 'login';
                                        </script>
                                <?php
                                    }
                                  }
                              ?>

                                  <div class="col-md-4 col-12 mt-4 ">
                                      <div class="col-12  p-3 bg-light shadow-sm">
                                          <h5> <?php echo $lengths; ?> ) <?php echo $title; ?> </h5>
                                          <h5> <?php echo $subtitle; ?> </h5>
                                          <br>
                                          <input type="button" class="btn btn-outline-success" value="Download" onclick="window.location='download-patt?id=<?php echo $user_orgid; ?>' ">  
                                          <input type="button" class="btn btn-outline-primary" value="Open" onclick="window.location='arlab?id=<?php echo $id; ?>' ">  
                                          <input type="button" class="btn btn-outline-danger" value="Delete" onclick="window.location='modal-delete?id=<?php echo $id; ?> ' ">  
                                        </div>
                                  </div>
                                
                              <?php
                          }
                      } ?>

        </div>
    </div>



    <script>
        function updateTotal(){
          document.getElementById("total").innerHTML = "<?php echo $lengths; ?> " ; 
        }updateTotal();
  </script>

<?php

    include './support/footer.php';

?>