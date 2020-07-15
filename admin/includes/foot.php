  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/jquery/popper.min.js"></script>
  <script src="../assets/vendor/jquery/holder.min.js"></script>
  <script src="../assets/vendor/jquery/jquery-ui.js"></script>
  <script src="../assets/vendor/jquery/jquery.timepicker.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/jquery.dataTables.min.js"></script> 
  <script src="../assets/vendor/bootstrap/js/dataTables.bootstrap4.min.js"></script>
  <script>
  	$("#menu-toggle").click(function(e) {
  		e.preventDefault();
  		$("#wrapper").toggleClass("toggled");
  	});
  	$(document).ready(function() {
  		$('#example').DataTable();
  		$('#dateedit').datepicker({minDate:0});
  		$('#startedit').timepicker();
  		$('#endedit').timepicker();
  	});
  </script>
  <script>  
    $(document).ready(function(){  
      $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd'
      });
      $(function(){  
        $("#from_date").datepicker();  
        $("#to_date").datepicker();  
      });  
      $('#filter').click(function(){  
        var from_date = $('#from_date').val();  
        var to_date = $('#to_date').val();  
        if(from_date != '' && to_date != '')  
        {  
         $.ajax({  
          url:"filter.php",  
          method:"POST",  
          data:{from_date:from_date, to_date:to_date},  
          success:function(data)  
          {  
           $('#order_table').html(data);  
         }  
       });  
       }  
       else  
       {  
         alert("Please select a date range");  
       }  
     });  
    });  
  </script>
</body>
</html>
