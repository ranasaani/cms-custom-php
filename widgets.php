

    <!-- Sidebar -->

    <aside class="large-3 columns">
         <form>
              <div class="row collapse">
                <div class="small-10 columns">
                  <input type="text" placeholder="Search">
                </div>
                <div class="small-2 columns">
                  <a href="#" class="button prefix icon-search"></a>
                </div>
            
          </div>
        </form>
        <div class="panel ads">
			<?php 
				$obj->map(array('position'=>'"sidebar"'));
				$ads_sidebar = $obj->get_ads_by_position();
				echo($ads_sidebar['code']);
            ?>
        </div>
		<?php
        $all_widgets= $obj->get_widgets_records();
        
        foreach ($all_widgets as $row){
        echo $row['code'];
        }
        ?>

    </aside>

    <!-- End Sidebar -->