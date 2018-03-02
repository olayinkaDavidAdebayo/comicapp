<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Continuum</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">Help</a>
      </nav>
      <a class="btn btn-outline-primary" href="#">Download CSV</a>
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

    <div class="row">
      <div class="table-responsive">
        <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Character</th>
                <th scope="col">Data Type</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Published</th>
                <th scope="col">Modified</th>
              </tr>
            </thead>
            <tbody>
              <?php

              for($start = 0; $start < sizeof($results);$start++) {

                  $number = $start+1;

                  print '<tr>
                            <th scope="row">'.$number.'</th>
                            <td>'.$character_name.'</td>
                            <td>'.$header.'</td>
                            <td>'.$results[$start]['title'].'</td>
                            <td>'.$results[$start]['description'].'</td>
                            <td>'.substr($results[$start]['date_first_published'],1, -1).'</td>
                            <td>'.$results[$start]['modified'].'</td>
                        </tr>';
                        
              }
              ?>
              
            </tbody>
          </table>
    </div>
  </div>
</div>
