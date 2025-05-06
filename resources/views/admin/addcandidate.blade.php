<x-app-layout>

<x-slot name="header">
<html>
  <style>
    .box-root {
    box-sizing: border-box;
}

.padding-bottom--24 {
  padding-bottom: 24px;
}
.padding-top--24 {
  padding-top: 22px;
}
.padding-horizontal--48 {
  padding: 48px;
}
.padding-bottom--15 {
  padding-bottom: 15px;
}
.formbg {
    margin: 0px auto;
    width: 100%;
    max-width: 800px;
    background: white;
    border-radius: 4px;
    box-shadow: rgba(60, 66, 87, 0.12) 0px 7px 14px 0px, rgba(0, 0, 0, 0.12) 0px 3px 6px 0px;
}
span {
    display: block;
    font-size: 20px;
    line-height: 28px;
    color: #1a1f36;
}
label {
    margin-bottom: 10px;
}
.reset-pass a,label {
    font-size: 14px;
    font-weight: 600;
    display: block;
}

.grid--50-50 {
    display: grid;
    /* grid-template-columns: 50% 50%;
    align-items: center; */
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

.field input,
.input1 {
    font-size: 16px;
    line-height: 28px;
    padding: 8px 16px;
    width: 100%;
    min-height: 44px;
    border: unset;
    border-radius: 4px;
    outline-color: rgb(84 105 212 / 0.5);
    background-color: rgb(255, 255, 255);
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(60, 66, 87, 0.16) 0px 0px 0px 1px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px;
}

input[type="submit"] {
    background-color: rgb(84, 105, 212);
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0.12) 0px 1px 1px 0px, 
                rgb(84, 105, 212) 0px 0px 0px 1px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(0, 0, 0, 0) 0px 0px 0px 0px, 
                rgba(60, 66, 87, 0.08) 0px 2px 5px 0px;
    color: #fff;
    font-weight: 1000;
    font-size:17px;
    cursor: pointer;
    width: 100%; /* Makes the button span the full width */
    padding: 12px; /* Optional: Adjust vertical padding for better appearance */
    border: none;
    border-radius: 4px;
}

.success{
  color: green;
  text-align: center;
}



  </style>
    <body>

        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Add Candidate</span>
              @if($errors->any())
  <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
    <ul class="list-disc pl-5">
      @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
      @endforeach
    </ul>
  </div>
@endif
              <form id="stripe-login" method="POST" action="{{ route('admin.storecandidate') }}" enctype="multipart/form-data" >
                @csrf
                <div class="field padding-bottom--24 grid--50-50">
                  <div class="field-group">
                    <label for="electionname">Election Name</label>
                      <select name="election_id" class="input1" required>
                      <option value="">-- Select Election --</option>
                      @foreach($elections as $election)
                        <option value="{{ $election->id }}">{{ $election->name }}</option>
                      @endforeach
                      </select>
                  </div>
                
                    <div class="field-group">
                        <label for="candidatename">Candidate Name</label>
                        <input type="text" name="candidatename">
                    </div>
               
                <div class="field-group">
                  <label for="partyname">Party Name</label>
                  <input type="text" name="partyname">
                </div>
                <div class="field-group">
                  <label for="address">Address</label>
                  <input type="text" name="address">
                </div>
                <div class="field-group">
                  <label for="candidatenumber">Candidate Number</label>
                  <input type="number" name="candidatenumber">
                </div>
                <div class="field-group">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" accept="image/*">
                </div>
            </div>
                <div class="field padding-top--24">
                  <input type="submit" name="submit" value="Submit">
              </div>
              </form>
              <div class="success">@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif</div>
            </div>
          </div>
</body>
</x-slot>
</x-app-layout>
</html>

