<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Sign Ups</li>
		</ol>
	</section>

	<section>
		<form>
		<div class="form-group" style="width: 55%;float: right">
			<label for="date" >Choose a date range</label>
			<input class="form-control" type="text" id="date" name="date" value="" min="23-" style="width: 25%;" onchange="dateChanged()">


		</div>
		</form>
		<div class="box-body">

			<table id="example1" class="table table-bordered table-striped table-responsive">
				<thead>
				<tr>
					<th> #</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Phone Number</th>
					<th>School</th>
					<th>Study Level</th>
					<th>Subscription Status</th>
					<th>SMS confirmation</th>
				</tr>
				</thead>
				<tbody id="signUps">

				</tbody>
			</table>
		</div>
	</section>
</div>
<script>
    var currentDate = new Date();
    var date_initial = currentDate.getDate();
    var month_initial = currentDate.getMonth(); //Be careful! January is 0 not 1
    var year_initial = currentDate.getFullYear();

    var dateString_initial = year_initial + "-" + (month_initial + 1) + "-" + date_initial;
  //  window.onLoad = loadSignUps(dateString_initial);

    //from date picker
    function dateChanged() {
        var date = document.getElementById("date").value;
        console.log(date);
        loadSignUps(date)
    }

    function loadSignUps(date) {
        // console.log(dateString_initial)
        var request = new XMLHttpRequest();
        request.open("POST", "<?php echo base_url() . 'accountsByDay'?>");
        request.setRequestHeader('Content-Type', 'application/json');
        var tbody = document.getElementById("signUps");
        var tr = '';
        let data = JSON.stringify({
            "date": date
        });
        request.send(data);

        request.onload = () => {
            var response = JSON.parse(request.responseText);
            //var response = request.responseText;
            console.log(response)
            for (var i = 0; i < response.length; i++) {
                var fname = response[i].fname;
                var gender = response[i].gender;
                var level_name = response[i].level_name;
                var mobile = response[i].mobile;
                var school_name = response[i].school_name;
                var subscription_Status = response[i].status;
                var userstatus = response[i].userstatus
                //  console.log(school_name);

                tr += "<tr><td>" + (i + 1) + "</td><td>" + fname + "</td><td>" + gender + "</td><td>" + mobile + "</td><td>" + school_name + "</td><td>" + level_name + "</td><td>" + subscription_Status + "</td><td>" + userstatus + "</td></tr>";
                // console.log(tr)

            }
            tbody.innerHTML = tr;
        }
    }

    $('input[name="date"]').daterangepicker({
        "minDate": "09/23/2019",
        "opens": "center",
        "autoApply": true,
    });


</script>
