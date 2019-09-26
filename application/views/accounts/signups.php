
<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
                <?php echo $title ; ?>

                </small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Sign Ups</li>
			</ol>
		</section>

	<section>
		<div class="row" style="width: 55%;float: right">
			<label>Choose Date</label>
			<input type="date" min="2019-09-23"  class="form-control" id="date" name="date" style="width: 25%;" onchange="dateChanged()" >

		</div>
		<div class="box-body">

			<table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
					<th> #</th>
					<th>Name </th>
					<th>Gender</th>
					<th>Phone Number</th>
					<th>School</th>
					<th>Study Level</th>
                    <th>Subscription Status</th>
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

    var dateString_initial = year_initial + "-0" + (month_initial + 1) + "-" + date_initial;
    window.onLoad = loadSignUps(dateString_initial);
    //from date picker
    function dateChanged(){
        var date = document.getElementById("date").value;
        loadSignUps(date)
    }
    function loadSignUps(date) {
        console.log(dateString_initial)
        var request = new XMLHttpRequest();
        request.open("POST", "<?php echo base_url() . 'accountsByDay'?>");
        request.setRequestHeader('Content-Type', 'application/json');
        var tbody = document.getElementById("signUps");
        var tr ='';
        let data = JSON.stringify({
            "date": date
        });
        request.send(data);

        request.onload = () => {
            var response = JSON.parse(request.responseText);
            for(var i =0; i<response.length; i++){
                var fname = response[i].fname;
                var gender = response[i].gender;
                var level_name = response[i].level_name;
                var mobile = response[i].mobile;
                var school_name = response[i].school_name;
                var subscription_Status= response[i].status;

              //  console.log(school_name);

                 tr += "<tr><td>"+(i+1)+"</td><td>"+fname+"</td><td>"+gender+"</td><td>"+mobile+"</td><td>"+school_name+"</td><td>"+level_name+"</td><td>"+subscription_Status+"</td></tr>";
               // console.log(tr)

            }
            tbody.innerHTML = tr;
        }
    }
</script>
