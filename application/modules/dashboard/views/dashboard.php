<style type="text/css">
  .col-lg-3 .fa{
    position: relative;
    padding-top: 11px;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <span>No of request :</span><h3><?php if(!empty($total_request)) echo $total_request; else echo '0'; ?></h3>

            <p>Total Request</p></hr>
            <p>All users</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <?php foreach($all_request as $requests) { ?>
       <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <span>No of request :</span><h3><?php echo $requests->request_no; ?></h3>

              <p>Request By </p></hr>
              <p><?php echo $requests->requested_email; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-list-alt"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive">
            <div class="col-sm-3">
                
              <input type="text" name="event_date" placeholder="Select date to filter." class="form-control" id="datepicker">  
            </div>

          <table id="request_table" class="table" data-keys="" data-values="">
            <thead>
              <th>S.No.</th>
              <th>Request By</th>
              <th>Request Date</th>
            </thead>
            <tbody>

            </tbody>
            <tfoot>

            </tfoot>
          </table>
          </div>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
  var base_url = $('#base_url').val();
  function show_loader(){
    $('.preloader').show();
  }

  function hide_loader(){
    $('.preloader').hide();
  }

  $(document).ready(function(){

    var request_table = $("#request_table");
    var request_table_post = $('#request_table').DataTable({ 
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' servermside processing mode.
      "order": [], //Initial no order.

      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,    
      "blengthChange": false,
      "iDisplayLength" :10,

      "bPaginate": true,
      "bInfo": true,
      "bFilter": false,
      "language": {                
      "infoFiltered": ""
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
      "url": base_url + "dashboard/request_list",
      
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = request_table.attr('data-keys');
        var csrf_hash = request_table.attr('data-values');
        d[csrf_key] = csrf_hash;
        d[csrf_key] = csrf_hash;
        d.date_search = $('#datepicker').val();
      },
      beforeSend: function(){
        show_loader()
      },
      dataSrc: function (jsonData) {
        hide_loader();
        if(jsonData.status==-1){
          location.reload();
        }else{
          request_table.attr('data-values',jsonData.csrf);
          return jsonData.data;
        }
      }
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { orderable: false, targets: -1 },

      ]

    });

    var date_inp = $("#datepicker");
    date_inp.datetimepicker({
      maxDate: 'now',
      format:'YYYY-MM-DD HH:mm:ss',
    });

    // Stop Keyboard Wroking   
    $('#datepicker').keydown(function(event) { 
      return false;
    });

    var selectedDates = [];
    date_inp.datetimepicker().on('dp.change', function (ev) {
      selectedDates = ev.date;
      date_inp.data('setDate', selectedDates);
      request_table_post.draw();

    });
  });
</script>

