<?php
echo '<div class="col-md-4 mb-4">
  <!--Card-->
  <div class="card">

        <!--Card image-->
        <div class="view overlay hm-white-slight">
            <img src="'.$result['filedestination'].'" class="img-fluid" style="min-width: 100%;height: 220px;" alt="">
            <a href="#">
                <div class="mask"></div>
            </a>
        </div>

        <!--Card content-->
          <div class="card-body">
            <!--Title-->
            <h4 class="card-title">'. substr($result['title'], 0, 25). '</h4>
            <h6>Posted By: <a href="profile.php?user_id='.substr($result['user_id'], 0, 25).'">'. $result['username'].'</a></h6>
            <h6>School Name: <span class="text-info">'. substr($result['school_name'], 0, 25).'</span></h6>
            <!--Text-->
            <p class="card-text">Description: <a href="#">'. substr($result['description'], 0, 25).'...</a></p>
            <a href="contact.php?user_id='.$result['user_id'].'" class="btn btn-indigo mx-0">Contact Me</a><a class="btn btn-indigo" data-toggle="modal" data-target="#description">More Info</a>
        </div>

    </div>


</div>';

?>
