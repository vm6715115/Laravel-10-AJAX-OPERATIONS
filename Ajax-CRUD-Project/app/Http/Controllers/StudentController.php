<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function addstudent(Request $request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalName();
        $filename = time() . '.' . $extension;
        $path = 'uploads/images/';
        $file->move(public_path($path), $filename);

        Student::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'image'=>$path.$filename,
            ]);

        return response()->json(['res' =>'Student created successfully.']);
    }

    public function getStudents()
    {
        $students = Student::all();
        return response()->json(['students' =>$students]);
    }

    public function getStudentData(string $id)
    {
        $student = Student::where('id',$id)->get();
        return view('edit-student',['student' =>$student]);
    }
    public function updateStudents(Request $request)
    {
        $students = Student::find($request->id);
        if($request->file('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $path = 'uploads/images/';
            $file->move(public_path($path), $filename);

            if(File::exists($students->image))
            {
                File::delete($students->image);
            }

        }
        $students->update(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'image'=>$path.$filename,
            ]);
        
        return response()->json(['result' =>'Data uploaded successfully']);
    }

    public function deleteData(string $id)
    {
        Student::where('id',$id)->delete();
        return response()->json(['result' =>'Student Deleted successfully']);
    }
    
}
