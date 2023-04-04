<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>


<table id="customers">
    <tr>
        <td>
          <?php $image_path ='/upload/easyschool.png'; ?>
          <img src="{{public_path() . $image_path}}" width="200px" height="100px" alt="">
        </td>
        <td><h2>Easy School ERP</h2>
        <p>School Address: UA, Severodonetsk</p>
        <p>Phone: +380668022598</p>
        <p>Email: feysaball123@gmail.com</p>
        <p><b>Employee Monthly Salary</b></p></td>
    </tr>
    </table>

@php

    $date = date('Y-m',strtotime($details['0']->date));
        if ($date !='') {
        $where[] = ['date','like',$date.'%'];
        }

    $totalAttend = App\Models\EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$details['0']->employee_id)->get();

        $salary = (float)$details['0']['user']['salary'];
        $salary_per_day = (float)$salary/30;
        $absentCount = count($totalAttend->where('attend_status', 'Absent'));
        $total_salary_minus = (float)$absentCount*(float)$salary_per_day;
        $total_salary = (int)((float)$salary - (float)$total_salary_minus);

@endphp

<table id="customers">
  <tr>
    <th width="10%">Sl</th> 
    <th width="45%">Employee Details</th>
    <th width="45%">Employee Data</th>
  </tr>
  <tr>
    <td>1</td>
    <td><b>Employee Name</b></td>
    <td>{{ $details['0']['user']['name'] }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td><b>Basic Salary</b></td>
    <td>{{ $details['0']['user']['salary'] }}$</td>
  </tr>
  <tr>
    <td>3</td>
    <td><b>Total Absent for This Month</b></td>
    <td>{{ $absentCount }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Month</b></td>
    <td>{{ date('M Y', strtotime($details['0']->date)) }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Salary This Month</b></td>
    <td>{{ $total_salary }}$</td>
  </tr>
</table>
<br>
<i style="font-size:12px; float: right;">Print Data : {{ date("d M Y") }}</i>

    <hr style="border:dashed 2px; width:95%;color:#000000; margin-bottom:50px;">

    <table id="customers">
        <tr>
          <th width="10%">Sl</th> 
          <th width="45%">Employee Details</th>
          <th width="45%">Employee Data</th>
        </tr>
        <tr>
          <td>1</td>
          <td><b>Employee Name</b></td>
          <td>{{ $details['0']['user']['name'] }}</td>
        </tr>
        <tr>
          <td>2</td>
          <td><b>Basic Salary</b></td>
          <td>{{ $details['0']['user']['salary'] }}$</td>
        </tr>
        <tr>
          <td>3</td>
          <td><b>Total Absent for This Month</b></td>
          <td>{{ $absentCount }}</td>
        </tr>
        <tr>
          <td>4</td>
          <td><b>Month</b></td>
          <td>{{ date('M Y', strtotime($details['0']->date)) }}</td>
        </tr>
        <tr>
          <td>5</td>
          <td><b>Salary This Month</b></td>
          <td>{{ $total_salary }}$</td>
        </tr>
      </table>
    <br>
    <i style="font-size:12px; float: right;">Print Data : {{ date("d M Y") }}</i>

</body>
</html>


