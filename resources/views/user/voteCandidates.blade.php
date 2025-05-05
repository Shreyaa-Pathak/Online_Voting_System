
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
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
										<h1 class="title">Vote for {{ $election->name}}</h1>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="display" style="min-width: 200px">
    <thead>
        <tr>
            <th>Candidate Profile</th>
            <th>Candidate Name</th>
            <th>Party Name</th>
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        @foreach ($candidates as $candidate)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Photo" width="100">
                </td>
                <td>{{ $candidate->candidatename }}</td>
                <td>{{ $candidate->partyname }}</td>
                <td>
                    <form action="{{ route('vote.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                        <input type="hidden" name="election_id" value="{{ $electionId }}">

                        <input type="hidden" name="otp" class="otp-input">

                        <button type="button" class="btn btn-primary generate-otp">Vote</button>
                     
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

											
										</div>

                                </div>
                            </div>
						</div>
					</div>
				</div>
		
            </div>
        </div>
       

</body>
</html>
<script>
    document.querySelectorAll('.generate-otp').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const otp = Math.floor(100000 + Math.random() * 900000); // 6-digit OTP
            const userInput = prompt("Enter the OTP to confirm your vote:\nOTP: " + otp);

            if (userInput == otp) {
                form.submit();
            } else {
                alert("Invalid OTP. Try again.");
            }
        });
    });
</script>

 

</x-slot>
</x-app-layout> 
