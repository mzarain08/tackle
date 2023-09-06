<?php

global $CORE_UI;

?>

<div class="d-flex justify-content-between" ppt-border1>
  <div  class=" w-100 mb-2 mb-lg-0">
    <div class="d-flex flex-row p-3">
      <div  class="mr-3 text-primary">
        <div ppt-icon-size="64" data-ppt-icon>
          <?php echo $CORE_UI->icons_svg['chat']; ?>
        </div>
      </div>
      <div>
         <div class="opacity-5" data-ppt-f1a>Online Now</div>
        <div class="ppt-countup fs-lg text-700" data-ppt-f1b>12</div>
      </div>
    </div>
  </div>
  <div  class="mx-lg-3 border-left border-right w-100  mb-2 mb-lg-0">
    <div class="d-flex flex-row p-3">
      <div  class="mr-3 text-primary">
        <div ppt-icon-size="64" data-ppt-icon2>
          <?php echo $CORE_UI->icons_svg['clock']; ?>
        </div>
      </div>
      <div>
          <div class="opacity-5" data-ppt-f2a>Total Users</div>
       <div class="ppt-countup fs-lg text-700" data-ppt-f2b>6323</div>      
      </div>
    </div>
  </div>
  <div class=" w-100">
    <div class="d-flex flex-row p-3">
      <div  class="mr-3 text-primary">
        <div ppt-icon-size="64" data-ppt-icon3>
          <?php echo $CORE_UI->icons_svg['bell']; ?>
        </div>
      </div>
      <div>
      <div class="opacity-5" data-ppt-f3a>Visitors Today</div>
       <div class="ppt-countup fs-lg text-700" data-ppt-f3b>500</div>
      </div>
    </div>
  </div>
</div> 