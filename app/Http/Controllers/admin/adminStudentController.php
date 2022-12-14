<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminStudentController extends Controller
{
    public function addStudent(Request $request)
    {
        $stu_name = $request->input('stu_name');
        $stu_IC = $request->input('stu_IC');
        $stu_form = $request->input('stu_form');
        $stu_age = $request->input('stu_age');
        $stu_address = $request->input('stu_address');
        $stu_email = $request->input('stu_email');
        $stu_gender = $request->input('stu_gender');
        $stu_dob = $request->input('stu_dob');
        $parent_name = $request->input('parent_name');
        $parent_IC = $request->input('parent_IC');
        $parent_hp = $request->input('parent_hp');
        $parent_job = $request->input('parent_job');
        $parent_age = $request->input('parent_age');
        $parent_address = $request->input('parent_address');
        $parent_relation = $request->input('parent_relation');
        $parent_dob = $request->input('parent_dob');

        $this->validate($request, [
            'stu_name' => 'required',
            'stu_IC' => 'required|digits:12',
            'stu_form' => 'required|integer|between:0,6',
            'stu_age' => 'required|integer|between:13,18',
            'stu_address' => 'required',
            'stu_email' => 'required',
            'stu_gender' => 'required',
            'stu_dob' => 'required',
            'parent_name' => 'required',
            'parent_IC' => 'required|digits:12',
            'parent_hp' => 'required',
            'parent_job' => 'required',
            'parent_age' => 'required|integer|between:18,90',
            'parent_address' => 'required',
            'parent_relation' => 'required',
            'parent_dob' => 'required',
        ]);

        $check_duplicate = DB::select('select student_IC from student_list where student_IC = ?', [$stu_IC]);

        if ($check_duplicate != null) {
            return redirect('adminAddStudent')->with('error_status', 'Failed, student has been registered in the system!');
        } else {
            DB::select('insert into student_list (student_name, student_IC, student_form, student_age, student_address, student_email, student_gender, student_dob, parent_name, parent_IC, parent_hp, parent_occupation, parent_age, parent_address, relationship, parent_dob) 
            values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$stu_name, $stu_IC, $stu_form, $stu_age, $stu_address, $stu_email, $stu_gender, $stu_dob, $parent_name, $parent_IC, $parent_hp, $parent_job, $parent_age, $parent_address, $parent_relation, $parent_dob]);

            $current_id = DB::table('student_list')->where('student_IC', $stu_IC)->pluck('id')->first();
            $new_id = now()->year . (int)$current_id;

            if ($new_id != NULL) {
                DB::table('student_list')->where('student_IC', $stu_IC)->update(['student_id' => 'STU_' . $new_id]);

                $user_name =  DB::table('student_list')->where('student_IC', $stu_IC)->pluck('student_id')->first();
                $user_password = hash::make($stu_IC);
                $user_role = 2;

                DB::select('insert into user_login_details (user_name, user_password, user_role, user_full_name, user_email) values (?,?,?,?,?)', [
                    $user_name, $user_password,
                    $user_role, $stu_name, $stu_email
                ]);

                return redirect('adminAddStudent')->with('pass_status', 'New Student registered successfully');
            }
        }
    }

    public function editStudentRoute(Request $request)
    {
        $stu_id = $request->input('student_id');

        $student = DB::table('student_list')->where('student_id', $stu_id)->get();
        $class = DB::table('class_list')->orderBy('class_id')->get();
        return view('admin/adminEditStudent', compact('student','class'));
    }

    public function editStudent(Request $request)
    {
        $stu_id = $request->input('student_id');
        $stu_name = $request->input('stu_name');
        $stu_IC = $request->input('stu_IC');
        $stu_form = $request->input('stu_form');
        $stu_age = $request->input('stu_age');
        $stu_class = $request->input('stu_class');
        $stu_address = $request->input('stu_address');
        $stu_email = $request->input('stu_email');
        $stu_gender = $request->input('stu_gender');
        $stu_dob = $request->input('stu_dob');
        $parent_name = $request->input('parent_name');
        $parent_IC = $request->input('parent_IC');
        $parent_hp = $request->input('parent_hp');
        $parent_job = $request->input('parent_job');
        $parent_age = $request->input('parent_age');
        $parent_address = $request->input('parent_address');
        $parent_relation = $request->input('parent_relation');
        $parent_dob = $request->input('parent_dob');

        $this->validate($request, [
            'stu_name' => 'required',
            'stu_IC' => 'required|digits:12',
            'stu_form' => 'required|integer|between:0,6',
            'stu_age' => 'required|integer|between:13,18',
            'stu_class' => 'required',
            'stu_address' => 'required',
            'stu_email' => 'required',
            'stu_gender' => 'required',
            'stu_dob' => 'required',
            'parent_name' => 'required',
            'parent_IC' => 'required|digits:12',
            'parent_hp' => 'required',
            'parent_job' => 'required',
            'parent_age' => 'required|integer|between:18,90',
            'parent_address' => 'required',
            'parent_relation' => 'required',
            'parent_dob' => 'required',
        ]);


        $data = array(
            'student_name' => $stu_name,
            'student_IC' =>  $stu_IC,
            'student_form' => $stu_form,
            'student_class' => $stu_class,
            'student_age' => $stu_age,
            'student_address' => $stu_address,
            'student_email' => $stu_email,
            'student_gender' => $stu_gender,
            'student_dob' => $stu_dob,
            'parent_name' =>  $parent_name,
            'parent_IC' =>  $parent_IC,
            'parent_hp' =>  $parent_hp,
            'parent_occupation' => $parent_job,
            'parent_age' =>  $parent_age,
            'parent_address' =>  $parent_address,
            'relationship' =>  $parent_relation,
            'parent_dob' =>  $parent_dob,
        );

        try {
            DB::table('student_list')->where('student_id', $stu_id)->update($data);
            return redirect('adminViewStudent')->with('pass_status', 'Student Information Updated Successfully! ');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->getCode();
            if ($errorCode == 1062) {
            }
        }
        return redirect('adminViewStudent')->with('error_status', 'Student Information Updated Failed, Duplicated Information Found!');
    }

    public function deleteStudent(Request $request)
    {
        $delete_student = $request->input('delete_student');

        DB::table('student_list')->where('student_id', [$delete_student])->delete();
        return redirect('adminViewStudent')->with('delete_status', 'Student Removed successfully! ');
    }

    public function filterStudent(Request $request){
        $stu_id = $request->input('stu_id');
        
        $students = DB::table('student_list')->where('student_id',[$stu_id])->paginate(10);  //To fetch the filtered data from database 
        $count = count($students);

        if($count == 1){
            $class = DB::table('class_list')->orderBy('class_id')->get();
            return view('admin/adminViewStudent',compact('students','class'));
        }
        if($count == 0){
            return redirect('adminViewStudent')->with('error_status', 'Invalid Student ID! ');
        }
    }
}
