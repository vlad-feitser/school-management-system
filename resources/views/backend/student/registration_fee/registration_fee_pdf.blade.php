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
        <p><b>Student Registration Fee</b></p></td>
    </tr>
    </table>

@php

    $registrationfee = App\Models\FeeCategoryAmount::where('fee_category_id','1')->where('class_id',$details->class_id)->first();

    $originalfee = $registrationfee->amount;
    $discount = $details['discount']['discount'];
    $discounttablefee = $discount/100*$originalfee;
    $finalfee = (float)$originalfee-(float)$discounttablefee;

@endphp

<table id="customers">
  <tr>
    <th width="10%">Sl</th>
    <th width="45%">Student Details</th>
    <th width="45%">Student Data</th>
  </tr>
  <tr>
    <td>1</td>
    <td><b>Student ID №</b></td>
    <td>{{ $details['student']['id_no'] }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td><b>Role №</b></td>
    <td>{{ $details->roll }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td><b>Student Name</b></td>
    <td>{{ $details['student']['name'] }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Year</b></td>
    <td>{{ $details['student_year']['name'] }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Class</b></td>
    <td>{{ $details['student_class']['name'] }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td><b>Registration Fee</b></td>
    <td>{{ $originalfee }}$</td>
  </tr>
  <tr>
    <td>7</td>
    <td><b>Discount</b></td>
    <td>{{ $discount }}%</td>
  </tr>
  <tr>
    <td>8</td>
    <td><b>Fee for student</b></td>
    <td>{{ $finalfee }}$</td>
  </tr>  

</table>
<br>
<i style="font-size:12px; float: right;">Print Data : {{ date("d M Y") }}</i>

    <hr style="border:dashed 2px; width:95%;color:#000000; margin-bottom:50px;">

    <table id="customers">
        <tr>
          <th width="10%">Sl</th>
          <th width="45%">Student Details</th>
          <th width="45%">Student Data</th>
        </tr>
        <tr>
          <td>1</td>
          <td><b>Student ID №</b></td>
          <td>{{ $details['student']['id_no'] }}</td>
        </tr>
        <tr>
          <td>2</td>
          <td><b>Role №</b></td>
          <td>{{ $details->roll }}</td>
        </tr>
        <tr>
          <td>3</td>
          <td><b>Student Name</b></td>
          <td>{{ $details['student']['name'] }}</td>
        </tr>
        <tr>
          <td>4</td>
          <td><b>Year</b></td>
          <td>{{ $details['student_year']['name'] }}</td>
        </tr>
        <tr>
          <td>5</td>
          <td><b>Class</b></td>
          <td>{{ $details['student_class']['name'] }}</td>
        </tr>
        <tr>
          <td>6</td>
          <td><b>Registration Fee</b></td>
          <td>{{ $originalfee }}$</td>
        </tr>
        <tr>
          <td>7</td>
          <td><b>Discount</b></td>
          <td>{{ $discount }}%</td>
        </tr>
        <tr>
          <td>8</td>
          <td><b>Fee for student</b></td>
          <td>{{ $finalfee }}$</td>
        </tr>  
      
    </table>
    <br>
    <i style="font-size:12px; float: right;">Print Data : {{ date("d M Y") }}</i>

</body>
</html>


