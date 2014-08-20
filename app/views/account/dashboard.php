<section id="dashboard" class="col-md-8 col-sm-8">
<!-- <h3><b>Select Options</b></h3> -->
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="btn btn-sm btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color: #fff !important;">
          <span class="glyphicon glyphicon-pencil"></span> Codes Area
        </a> 
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="pull-right"><span class="glyphicon glyphicon-chevron-down" style="padding-top: 10px;"></span></a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <?php	
    			echo View::make('modules.codesgenerator')->render();
    		?>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="btn btn-sm btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="color: #fff !important;">
          <span class="glyphicon glyphicon-sort-by-attributes"> Unilevel
        </a>
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="pull-right"><span class="glyphicon glyphicon-chevron-down" style="padding-top: 10px;"></span></a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <?php	
    			echo View::make('modules.membertree')->render();
    		?>
      </div>
    </div>
  </div>
</div>

</section>