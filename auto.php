<head>
  <title>Autocomplete con Ajax y Select2</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<!-- JS file -->
<script src="js/jquery.easy-autocomplete.min.js"></script> 

</head>
<body>

  <form> <input id="example-ajax-post"/></form>
 
</div>
<script type="text/javascript">
var options = {

  data: ["blue", "green", "pink", "red", "yellow"]

  getValue: "name"
};

$("#example-ajax-post").easyAutocomplete(options);
</script>
</body>
</html>