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
        <p><b>Monthly/Yearly Profit</b></p></td>
    </tr>
    </table>

@php

        $student_fee =  App\Models\AccountStudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $other_cost =  App\Models\AccountOtherCost::whereBetween('date',[$sdate,$edate])->sum('amount');
        $employee_salary =  App\Models\AccountEmployeeSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');

        $total_cost = $other_cost + $employee_salary;
        $profit = $student_fee - $total_cost;

@endphp

<table id="customers">
  <tr>
    <td colspan="2" style="text-align: center"><h4>Reporting Date: {{ date('d M Y',strtotime($sdate)) }} - {{ date('d M Y',strtotime($edate)) }}</h4></td>
  </tr>
  <tr>
    <td width="50%"><h4>Purpose</h4></td>
    <td width="50%"><h4>Amount</h4></td>
  </tr>
  <tr>
    <td>1. Student Fee</td>
    <td>{{$student_fee}}$</td>
  </tr>
  <tr>
    <td>2. Employee Salary</td>
    <td>{{$employee_salary}}$</td>
  </tr>
  <tr>
    <td>3. Other Cost</td>
    <td>{{$other_cost}}$</td>
  </tr>
  <tr>
    <td>4. Total Cost</td>
    <td>{{$total_cost}}$</td>
  </tr>
  <tr>
    <td>5. Profit</td>
    <td>{{$profit}}$</td>
  </tr>
</table>
<br>
<i style="font-size:12px; float: right;">Print Data : {{ date("d M Y") }}</i>

    <hr style="border:dashed 2px; width:95%;color:#000000; margin-bottom:50px;">

</body>
</html>


