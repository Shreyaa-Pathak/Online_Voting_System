<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Candidate;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    //election
    public function addelection()
{
    return view('admin.addelection'); 
}
    public function storeelection(Request $request)
    {
        $request->validate([
            'electionname' => 'required|string|max:255',
            'date' => 'required|date',
        ]);
    
        Election::create([
            'name' => $request->electionname,
            'end_date' => $request->date,
        ]);
    
        return redirect()->back()->with('success', 'Election added successfully.');
        // return view('admin.addelection');
    }

    //candidate
  
    public function addcandidate()
{
    $elections = Election::all();
    return view('admin.addcandidate', compact('elections'));
}

    public function storecandidate(Request $request)
{
    // dd($request->all());
    $data = $request->validate([
        'election_id'   => 'required|exists:elections,id',
        'candidatename' => 'required|string|max:255',
        'partyname'     => 'required|string|max:255',
        'address'       => 'required|string',
        'phonenumber'   => 'required|numeric',
        'photo'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle upload
    $data['photo'] = $request->file('photo')->store('candidates', 'public');

    
    Candidate::create($data);


    return redirect()->back()->with('success', 'Candidate added successfully!');
}

    public function result()
    {
        $elections = Election::all();
        return view('admin.result', compact('elections'));

    }
    public function showresult(Request $request)
    {
        $electionId = $request->input('election_id');

        // $photo = Candidate:->file('photo')->store('candidates', 'public');

    $candidates = Candidate::withCount('votes')
                    ->where('election_id', $electionId)
                    ->get();

    $election = Election::find($electionId);

    $winner = $candidates->sortByDesc('votes_count')->first();
    return view('admin.showresult', compact('candidates', 'election','winner'));
    }
}
