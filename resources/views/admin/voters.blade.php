

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
  width: 90%;
  margin: auto;
  overflow-x: auto;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  background-color: #fff;
}

table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
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

.approve-btn {
  background-color: rgb(84, 105, 212); 
  color: #fff;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
  border-radius: 4px;
}

.reject-btn {
  background-color: #dc3545; /* Red */
  color: #fff;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
  border-radius: 4px;
}

button:hover {
  opacity: 0.9;
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
   

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

       
     
		
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            
				
				<div class="row">
					
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<!-- <div class="card"> -->
									<!-- <div class="card-header"> -->
										<h1 class="title">Voters list</h1>
										
									<!-- </div> -->
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display" style="min-width: 845px">
												<thead>
													<tr>
														
                                                        <th>User ID</th>
                                                        <th>Voter ID</th>
                                                        <th>Voter ID No</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>DOB</th>
                                                        <th>Address</th>
                                                        <th>Phone No</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
											
												<tbody>
													<tr>
                                                    <td>1</td>
                                                    <td><img src="voter3.png" alt="Voter ID" class="voter-img"></td>
                                                   
                                                    <td>98974564</td>
                                                    <td>zz</td>
                                                    <td>zz@gmail.com</td>
                                                    <td>2000-04-04</td>
                                                    <td>Hyderabad</td>
                                                    <td>33333333</td>
                                                    <td>No</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary">Approve</a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger">Reject</a>
                                                    </td>													
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
			   
            </div>
        </div>
</body>
</html>
 

</x-slot>
</x-app-layout> 