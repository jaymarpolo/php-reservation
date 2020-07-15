  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/jquery/popper.min.js"></script>
  <script src="assets/vendor/jquery/holder.min.js"></script>
  <script src="assets/vendor/jquery/jquery-ui.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/bootstrap/js/jquery.dataTables.min.js"></script> 
  <script src="assets/vendor/bootstrap/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
  <script src="assets/vendor/jquery/datepair.js"></script>
  <script src="assets/vendor/jquery/jquery.datepair.js"></script>
  <!-- Menu Toggle Script -->
  <script>
  	$("#menu-toggle").click(function(e) {
  		e.preventDefault();
  		$("#wrapper").toggleClass("toggled");
  	});
  </script>
  <!-- DataTable Script -->
  <script>
  	$(document).ready(function() {
  		$('#example').DataTable();
      $('#rdate').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate:7});

      $('#timeOnlyExample .time').timepicker({
        showDuration: true,
        timeFormat: 'H:i'
      });

      var timeOnlyExampleEl = document.getElementById('timeOnlyExample');
      var timeOnlyDatepair = new Datepair(timeOnlyExampleEl);
      $('#dialog').dialog();
    });
  </script>
  <!-- Custom Computation Script -->
  <script>
    $(document).ready(function() {
      function updateSum() {
        var total = 0;
        $(".sum:checked").each(function(i, n) {total += parseInt($(n).val());})
        $("#total").val(total);
      }
    // run the update on every checkbox change and on startup
    $("input.sum").change(updateSum);
    updateSum();
  })
</script>
</body>
</html>