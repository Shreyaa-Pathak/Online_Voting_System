

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="http://localhost/online_voting_system/resources/css/bootstrap.min.css">
	<!-- Datatable -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
  font-family: Arial, sans-serif;
  margin: 20px;
  background-color: #f4f4f4;
}

.title{
  font-size :25px;
  text-align:center;
  font-weight: bold;
}
.table-container {
  width: 50%;
  margin: auto;
  overflow-x: auto;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  background-color: #fff;
}

table {
    margin-left:300px;
  width: 50%;
  border-collapse: collapse;
  text-align: center;
}

thead {
  background-color: rgb(84, 105, 212) ; 
  color: #fff;
}

th, td {
  padding: 10px;
  border: 1px solid #ddd;
}

th {
  font-weight: bold;
  text-align: center;
}

tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

/* tbody tr:hover {
  background-color: #f1f1f1;
} */

.voter-img {
  width: 50px;
  height: 50px;
  border-radius: 4px;
  object-fit: cover;
}

#main-wrapper {
    min-height: 80vh; /* Ensures the container takes at least the full height of the viewport */
    display: flex;
    flex-direction: column;
  
}

  </style>

</head>

<body>
<x-app-layout>

<x-slot name="header">

    <div id="main-wrapper">

        <div class="content-body">
            <!-- row -->
            
				
				<div class="row">
					
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								
										<h1 class="title">Election Result</h1>
								
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display" style="min-width: 200px">
												<thead>
													<tr>
														
                                                        <th>Candidate Profile</th>
                                                        <th>Candidate Name</th>
                                                        <th>Party Name</th>
                                                        <th>Total Votes</th>
                                                      
                                                    </tr>
                                                </thead>
											
												<tbody>
													<tr>
                                                    <td><img src="voter3.png" alt="Voter ID" class="voter-img"></td>
                                                    <td>zz</td>
                                                    <td>Hyderabad</td>
                                                    <td>5</td>													
													</tr>
													
												</tbody>
											</table>
										</div>
									<!-- </div> -->
                                </div>
                            </div>
						</div>
					</div>
				</div>
			   
                
          <div>
            <h1 style="font-size:20px; font-weight:bold; text-align:center">Election is won by me</h1>
          </div>
            </div>
        </div>
</body>
</html>
 

</x-slot>
</x-app-layout> 