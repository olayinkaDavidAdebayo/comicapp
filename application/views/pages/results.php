<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Continuum</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        
      </nav>
      <a class="btn btn-outline-primary" href="<?php print $url.'download/csv/'.$header.'/'.$character_name; ?>">Download CSV</a>
    </div>


<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Results</h1>
      <?php
      print '<p class="lead">Listview of '.$header.' result for character: '.str_replace("-", " ", $character_name).'.</p>';
      //print_r($results['data']['results'][0]);
      ?>    
    </div>
    <hr />
    <div style="height:50px">
     <a style="float:right" class="btn btn-outline-primary" href="<?php print $url; ?>">Return to Search</a>
   </div>
    <div class="row">

      <?php 

        if($results){

      ?>
      <div class="table-responsive">
        <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th scope="col">#</th>
                <?php

                    foreach ($table_headers as $key => $value) {
                      print '<th scope="col">'.$value.'</th>';
                    }

                ?>
              </tr>
            </thead>
            <tbody>
              <?php

              for($start = 0; $start < sizeof($results);$start++) {

                  $number = $start+1;

                  //date title. if not output 'Not Available'
                  $title = $results[$start]['title'];
                  if(empty($title)){ $title = "Not Available"; }

                  //description. if not output 'Not Available'
                  $description = $results[$start]['description'];
                  if(empty($description)){ $description = "Not Available"; }

                  //date first published. if not output 'Not Available'
                  $published_date = substr($results[$start]['date_first_published'],1, -1);
                  if(empty($published_date)){ $published_date = "Not Available"; }


                  print '<tr>
                            <th scope="row">'.$number.'</th>
                            <td>'.$character_name.'</td>
                            <td>'.$header.'</td>
                            <td>'.$title.'</td>
                            <td>'.$description.'</td>
                            <td>'.$published_date.'</td>
                        </tr>';
                        
              }

              ?>
              
            </tbody>
          </table>

    </div>

    <hr />
    <div style="height:50px">
     <a style="float:right" class="btn btn-outline-primary" href="<?php print $url; ?>">Return to Search</a>
   </div>

   <?php

    }else{
      print 'No result found ';
    }

   ?>
</div>
<footer>
<p class="mt-5 mb-3 text-muted text-center">© Continuum 2018</p>
</footer>