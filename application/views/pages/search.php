
<div id="base">
    <form class="form-search-marvel" method="post" action="<?php print $url.'results'; ?>">
      <div class="text-center mb-4">
        
        <h1 class="h3 mb-3 font-weight-normal">Continuum Comics</h1>
        
      </div>

    <div class="row">
      	<div class="col-md-12 mb-3">
      		<label for="country">Characters</label>
            <select name="character" class="custom-select d-block w-100" id="country" required="">
                <option value="">Choose a Characters...</option>
                
                <?php
                

                	if($response_data)
                	{
                		foreach ($response_data as $key => $value) {
                      //pass data to array //encode to json and store. 
                      $data = array(
                        "character_id"=>$value['id'], 
                        "character_name"=>str_replace(" ", "-", $value['name'])
                      );

                      $option_value = json_encode($data, true);

                			print "<option value='".$option_value."'>".$value['name'].'</option>';
                		}
                	}

                ?>
                
            </select>
        </div>

    </div>

    <div class="row">
      	<div class="col-md-12 mb-3">
      		<label for="country">Headers</label>
            <select name="header" class="custom-select d-block w-100" id="country" required="">
                <option value="">Choose a Header...</option>
                <option value="comics">Comics</option>
                <option value="stories">Stories</option>
                <option value="series">Series</option>
                <option value="events">Events</option>                
            </select>
        </div>
    </div>
    <div>

    </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">SEARCH</button>
      <p class="mt-5 mb-3 text-muted text-center">© Continuum 2018</p>
    </form>

</div>
