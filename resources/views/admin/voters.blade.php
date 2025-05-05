

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
  width: 100%;
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
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Voters List</h2>
  </x-slot>

  <div class="container mx-auto p-6">
    @if(session('success'))
      <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-container">
      <table id="voters-table">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>User ID</th>
            <th>Voter ID</th>
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
          @foreach($voters as $v)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $v->id }}</td>
              <td>
                @if($v->voterid)
                  <img src="{{ asset('storage/'.$v->voterid) }}" class="voter-img">
                @endif
              </td>
              <td>{{ $v->name }}</td>
              <td>{{ $v->email }}</td>
              <td>{{ $v->dob }}</td>
              <td>{{ $v->address }}</td>
              <td>{{ $v->phonenumber }}</td>
              <td>@if($v->status == 0)<p>Pending</p>
                  @elseif ($v->status == 1) <p>Approved</p>
                  @else <p>Rejected</p>
                @endif
              </td>
              <td>
              @if($v->status === 0)
              <div style="display: flex; gap: 5px;">
                  <form action="{{ route('admin.voters.approve', $v) }}" method="POST">
                  @csrf
                    <button class="approve-btn">Approve</button>
                </form>

                <form action="{{ route('admin.voters.reject', $v) }}" method="POST">
                @csrf
                  <button class="reject-btn">Reject</button>
                </form>
                </div>
            
              @else
              <span class="text-gray-700">Done</span>
              @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
 

</x-app-layout> 