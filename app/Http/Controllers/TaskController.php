<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(10);

        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('task.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    //     $validateData = $request->validate([
    //         'title' => 'nullable|string|max:255',
    //         'description' => 'nullable|string|max:255',
    //         'file' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048', // Added 'nullable' to allow optional upload
    //         // 'status' => 'sometimes|boolean'

    //     ]);

    //     Task::create([
    //         'title' => $validateData['title'],
    //         'description' => $validateData['description'],
    //         'file' => $validateData['file'],
    //         // 'status' => $validateData['status']? 1:0,
    //     ]);

                
    //     return redirect()->with('status', 'Task Created Successfully');

    // }

    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            // 'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'status' => 'nullable'
        ]);

        Task::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            // 'file' => $validateData['file'],
            'status' => $validateData['status']? 1:0,
        ]);

        return redirect('task')->with('status', 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            // 'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'status' => 'nullable',
        ]);

        $task->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            // 'file' => $validatedData['file'],
            'status' => $validatedData['status']? 1:0,
        ]);

        return redirect('/task')->with('status','Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/task')->with('status','Task Delete Successfully');
        //
    }

    public function viewUploadDocuments(Request $request, $id)
    {
        try {

            // Fetch the crew details by ID
            $tasks = Task::findOrFail($id);

            // Return the view with the crew details
            return view('task.task.create', compact('tasks'));
        } catch (\Exception $e) {
            // Redirect back with an error message if crew not found or other error occurs
            return redirect()
                ->route('tasks')
                ->withErrors(['msg' => 'task not found or error occurred: ' . $e->getMessage()]);
        }
    }

    public function uploadDocuments(Request $request, $id)
    {


        // Validate and store the uploaded documents
        $tasks = Task::findOrFail($id);

        $request->validate([
            'add_documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240', // max 10MB per file
        ]);

        // Handle multiple file uploads
        if ($request->hasFile('add_documents')) {
            foreach ($request->file('add_documents') as $file) {
                // Store each file
                $uploadedDocument = $file->store('documents', 'public');

                // Create a record in the 'documents' table for each file
                $tasks->documents()->create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $uploadedDocument,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Documents uploaded successfully.');
    }
}